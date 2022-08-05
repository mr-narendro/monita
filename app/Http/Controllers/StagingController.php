<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Exception;
use App\events;


class StagingController extends Controller
{
    public function index()
    {
        return view('staging', ['title' => 'Staging Data']);
    }

    public function cari(Request $request)
    {
        $cari = $request->spa;
        $jancok = DB::connection('staging')->select(
            DB::raw(
                "SELECT * FROM fso_staging fs WHERE fs.NO_PA = '" . $cari . "'"
            )
        );

        foreach ($jancok as $j) {
            $nopa = $j->NO_PA;
            $address = $j->ADDRESS;
            $satuan = $j->SATUAN;
            $latlong = $j->LAT_LONG;
            $layanan = $j->LAYANAN;
            if ($address == '' || $satuan == '' || $latlong == '' || $layanan == '') {
                $j->NO_PA = "<a href='/staging/getPA/" . base64_encode($nopa) . "'>" . $nopa . "</a>";
            }
        }

        if ($jancok == NULL) {
            echo "<script>
                    alert('data tidak ditemukan')
                  </script>";
            $title = 'Staging Data';
            // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
            return redirect()->route('staging.cekCrm', base64_encode($cari));
            // $title = 'Staging Data';
            // // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
            // return view('staging', ['e' => $jancok, 'title' => $title]);
        } else {
            $title = 'Staging Data';
            // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
            return view('staging', ['e' => $jancok, 'title' => $title]);
        }
    }

    public function getData($no_pa)
    {

        $pa = base64_decode($no_pa);
        $data = DB::connection('staging')->select(
            DB::raw(
                "SELECT DISTINCT NO_PA, ADDRESS, SATUAN, LAT_LONG, LAYANAN FROM fso_staging fs WHERE fs.NO_PA = '" . $pa . "'"
            )
        );

        // dd($data);


        $title = 'Edit Data Staging SPA';
        // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
        return view('/getPA', ['e' => $data, 'title' => $title]);
    }

    public function update(Request $request)
    {
        $nopa = $request->NO_PA;
        $address = $request->ADDRESS;
        $satuan = $request->SATUAN;
        $latlong = $request->LAT_LONG;
        $layanan = $request->LAYANAN;

        DB::connection('staging')->update(
            DB::raw("UPDATE fso_staging SET ADDRESS = '" . $address . "', SATUAN = '" . $satuan . "',
            LAT_LONG = '" . $latlong . "', LAYANAN = '" . $layanan . "' where NO_PA = '" . $nopa)
        );


        return redirect()->route('staging.index');
    }

    public function cekCrm($no_pa)
    {
        $no_pa = base64_decode($no_pa);
        $cek = DB::connection('dbo')->select(
            DB::raw("SELECT ab.new_IDPEL, ac.swo_ProjectActivatID as no_pa, CASE WHEN c.swo_id IS NULL THEN '-' ELSE
            c.swo_id
            END AS bandwidth, sib.swo_InternOrderID as NOMOR_IO, pb.Name as Product, i.swo_ProjectInitiationNo as no_pi
            FROM
            AccountBase ab
            LEFT JOIN Cek_Validasi_Antrian_PI cv ON cv.new_IDPEL = ab.new_IDPEL
            LEFT JOIN swo_projectactivationBase ac ON ab.AccountId = ac.swo_CustomerName
            LEFT JOIN swo_projectinitiationBase i ON i.swo_ProjectActivationID = ac.swo_projectactivationId
            LEFT JOIN swo_internalorderBase sib on sib.swo_ProjectActivationIOId = ac.swo_projectactivationId
            LEFT JOIN swo_bandwidthBase c ON ac.swo_Bandwidth = c.swo_bandwidthId
            LEFT JOIN ProductBase pb on pb.ProductId = ac.swo_ProductNameId
            WHERE ac.swo_ProjectActivatID IN ('" . $no_pa . "')")
        );
        return view('cekCrm', ['e' => $cek, 'title' => 'Cek SPA']);
    }

    public function insertData(Request $request)
    {
        $jenis = $request->jenis;
        $data = $request->data;
        if ($jenis == 'produk' || $jenis == 'bandwidth') {
            $pli = DB::connection('dbo')->select(
                DB::raw("SELECT spb.swo_ProjectActivatID as no_pa, ab.new_IDPEL as idpel, pli.swo_id AS PLI, CASE WHEN c.swo_id IS NULL
                THEN '-' ELSE c.swo_id END AS bandwidth, pb.Name as produk
                FROM swo_projectactivationBase spb
                LEFT JOIN AccountBase ab on ab.AccountId = spb.swo_CustomerName
                LEFT JOIN swo_productlineitemBase pli on pli.swo_ProductLineItemProjectActivatioId =
                spb.swo_projectactivationId
                LEFT JOIN swo_bandwidthBase c ON spb.swo_Bandwidth = c.swo_bandwidthId
                LEFT JOIN ProductBase pb ON pb.ProductId = spb.swo_ProductNameId
                where spb.swo_ProjectActivatID IN ('" . $data . "')")
            );
            // dd($pli);
            foreach ($pli as $p) {

                $pli = $p->PLI;
                $idpel = $p->idpel;
                $pa = $p->no_pa;
                $produk = $p->produk;
                $bandwidth = $p->bandwidth;
                if ($pli == '') {

                    //cek opportunity
                    $opor = DB::connection('sqlsrv')->select(
                        DB::raw("SELECT * FROM Tbl_Opportunity WHERE ID_PELANGGAN = '" . $idpel . "' OR CRMID =
                        '" . $idpel . "'")
                    );
                    // dd($opor);
                    foreach ($opor as $o) {
                        $kode_produk_tv = $o->KODE_PRODUK_TV;
                        $harga_tv = $o->HARGA_PRODUK_TV;
                        $kode_produk_internet = $o->KODE_PRODUK_INTERNET;
                        $harga_internet = $o->HARGA_PRODUK_INTERNET;
                        // dd($kode_produk_tv, $harga_tv);
                        DB::connection('sqlsrv')->statement(
                            "EXEC SP_CRM_INSERTPLI @ID_PELANGGAN = '" . $idpel . "',
@KODE_PRODUK_INTERNET = '" . $kode_produk_internet . "', @KODE_PRODUK_TV = '" . $kode_produk_tv . "',
@HARGA_INTERNET = '" . $harga_internet . "', @HARGA_TV= '" . $harga_tv . "'"
                        );


                        $pl = DB::connection('dbo')->update(DB::raw("UPDATE a7 SET
                            a7.swo_ProductLineItemProjectActivatioId = c7.swo_ProjectActivationId FROM
                            swo_productlineitemBase a7
                            LEFT JOIN swo_ProjectActivationBase c7 ON c7.swo_serviceid = a7.new_serviceid
                            LEFT JOIN AccountBase b7 ON b7.AccountId = c7.swo_CustomerName
                            WHERE b7.New_IDPEL = '" . $idpel . "'"));

                        //return redirect()->route('staging.index');
                        if ($pl == TRUE) {
                            if ($produk == '') {
                                $updateProd = DB::connection('dbo')->update(
                                    DB::raw("UPDATE a SET a.swo_ProductNameId = b.swo_product_findim FROM
                                    swo_projectActivationBase a
                                    LEFT JOIN swo_productlineitemBase b ON b.new_serviceid = a.swo_serviceid
                                    LEFT JOIN swo_serviceidBase c ON c.swo_serviceidId = a.swo_serviceid
                                    WHERE a.swo_ProjectActivatID = '" . $pa . "'")
                                );
                                if ($updateProd == TRUE) {
                                    echo "<script>
                                        alert('berhasil insert produk')
                                    </script>";
                                    return redirect()->route('staging.index');
                                } else {
                                    echo "ada kesalahan :(";
                                }
                            } elseif ($bandwidth == '' || $pli != '') {
                                $updateBW = DB::connection('sqlsrv')->statement("EXEC SP_UPDATE_PRODUCT_BW @_NOPA =
                                '" . $pa . "'");

                                if ($updateBW == TRUE) {
                                    echo "<script>
                                        alert('berhasil insert bandwidth')
                                    </script>";
                                    return redirect()->route('staging.index');
                                } else {
                                    echo "ada kesalahan :(";
                                }
                            }
                        }
                    }
                } elseif ($pli != '') {
                    if ($produk == '') {
                        $updateProd = DB::connection('dbo')->update(
                            DB::raw("UPDATE a SET a.swo_ProductNameId = b.swo_product_findim FROM
                    swo_projectActivationBase a
                    LEFT JOIN swo_productlineitemBase b ON b.new_serviceid = a.swo_serviceid
                    LEFT JOIN swo_serviceidBase c ON c.swo_serviceidId = a.swo_serviceid
                    WHERE a.swo_ProjectActivatID = '" . $pa . "'")
                        );
                        if ($updateProd == TRUE) {
                            echo "<script>
                        alert('berhasil insert produk')
                    </script>";
                            return redirect()->route('staging.index');
                        } else {
                            echo "ada kesalahan :(";
                        }
                    } elseif ($bandwidth == '' || $pli != '') {
                        $updateBW = DB::connection('sqlsrv')->statement("EXEC SP_UPDATE_PRODUCT_BW @_NOPA =
                    '" . $pa . "'");

                        if ($updateBW == TRUE) {
                            echo "<script>
                        alert('berhasil insert bandwidth')
                    </script>";
                            return redirect()->route('staging.index');
                        } else {
                            echo "ada kesalahan :(";
                        }
                    }else if ($produk == '' AND $bandwidth == '') {
                    $updateProd = DB::connection('dbo')->update(
                    DB::raw("UPDATE a SET a.swo_ProductNameId = b.swo_product_findim FROM
                    swo_projectActivationBase a
                    LEFT JOIN swo_productlineitemBase b ON b.new_serviceid = a.swo_serviceid
                    LEFT JOIN swo_serviceidBase c ON c.swo_serviceidId = a.swo_serviceid
                    WHERE a.swo_ProjectActivatID = '" . $pa . "'")
                    );

                    $updateBW = DB::connection('sqlsrv')->statement("EXEC SP_UPDATE_PRODUCT_BW @_NOPA =
                    '" . $pa . "'");

                    if ($updateProd == TRUE AND $updateBW == TRUE) {
                    echo "<script>
                        alert('berhasil insert produk')
                    </script>";
                    return redirect()->route('staging.index');
                    } else {
                    echo "ada kesalahan :(";
                    }
                    }
                    // return redirect()->route('staging.index');
                } elseif ($produk != '') {
                    echo "PRODUK sudah ada coy silahkan kembali";
                    // return redirect()->route('staging.index');
                } elseif ($bandwidth != '') {
                    echo "bandwidth sudah ada coy silahkan kembali";
                    // return redirect()->route('staging.index');
                }
            }
        } elseif ($jenis == 'no_io') {
            DB::connection('sqlsrv')->statement("EXEC SP_CRM_INSERTIO @ID_PELANGGAN = '" . $data . "'
            ");

            echo "<script>
                        alert('berhasil insert data io')
                      </script>";

            return redirect()->route('staging.index');
        } elseif ($jenis == 'no_pi') {
            DB::connection('sqlsrv')->statement("EXEC SP_CRM_INSERTPI @ID_PELANGGAN = '" . $data . "'
            ");

            echo "<script>
                    alert('berhasil insert data pi')
                </script>";

            return redirect()->route('staging.index');
        }
    }
}

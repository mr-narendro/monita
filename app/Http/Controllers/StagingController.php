<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
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
        if ($jenis == 'bandwidth' || $jenis == 'produk') {
            DB::connection('sqlsrv')->select("EXEC SP_UPDATE_PRODUCT_BW @_NOPA = '" . $data . "'
            ");

                echo "<script>alert('berhasil insert data')</script>";

                return redirect()->route('staging.index');

        } elseif ($jenis == 'no_io') {
            DB::connection('sqlsrv')->select("EXEC SP_CRM_INSERTIO @ID_PELANGGAN = '" . $data . "' ");

                echo "<script>
                        alert('berhasil insert data io')
                      </script>";

                return redirect()->route('staging.index');

        } elseif ($jenis == 'no_pi') {
            DB::connection('sqlsrv')->select("EXEC SP_CRM_INSERTPI @ID_PELANGGAN = '" . $data . "' ");

                echo "<script>
                    alert('berhasil insert data pi')
                </script>";

                return redirect()->route('staging.index');

        }
    }
}

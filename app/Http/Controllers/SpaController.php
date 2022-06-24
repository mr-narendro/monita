<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\events;


class SpaController extends Controller
{
    public function index()
    {
        return view('spa', ['title' => 'No SPA']);
    }

    public function cari(Request $request)
    {
        $cari = $request->idpel;
        $submit = $request->submit;

        $jancok = DB::connection('dbo')
            ->select(
                DB::raw("SELECT ab.new_IDPEL, ac.swo_ProjectActivatID as no_pa, CASE WHEN c.swo_id IS NULL THEN '-' ELSE
        c.swo_id
        END AS bandwidth, ac.CreatedOn FROM AccountBase ab
        LEFT JOIN swo_projectactivationBase ac ON ab.AccountId = ac.swo_CustomerName
        LEFT JOIN swo_bandwidthBase c ON ac.swo_Bandwidth = c.swo_bandwidthId
        WHERE ab.new_IDPEL IN ('" . $cari . "')")
        );

        foreach($jancok as $j)
        {
            if ($j->no_pa == '') {
                $koko = DB::connection('dbo')
                ->select(
                DB::raw("SELECT ab.new_IDPEL, ac.swo_ProjectActivatID as no_pa, CASE WHEN c.swo_id IS NULL THEN '-' ELSE
                c.swo_id
                END AS bandwidth, ac.CreatedOn, ac.swo_ProjectActivatID as no_pa2 FROM AccountBase ab
                LEFT JOIN swo_projectactivationBase ac ON ab.AccountId = ac.swo_CustomerName
                LEFT JOIN swo_bandwidthBase c ON ac.swo_Bandwidth = c.swo_bandwidthId
                WHERE swo_ProjectActivatID IS NULL AND ab.new_IDPEL IN ('".$cari."')")
                );

                // dd($koko);
                foreach($koko as $k)
                {
                    $k->no_pa2 = "<a href='/spa/update/$k->new_IDPEL' class='btn btn-success'>NAIKAN PA</a>";
                }

                $title = 'No SPA';
                return view('spa', ['e' => $koko, 'title' => $title]);


            }elseif ($j->no_pa != '') {
            $kaka = DB::connection('dbo')
                ->select(
                DB::raw("SELECT ab.new_IDPEL, ac.swo_ProjectActivatID as no_pa, CASE WHEN c.swo_id IS NULL THEN '-' ELSE
                c.swo_id
                END AS bandwidth, ac.CreatedOn, ac.swo_ProjectActivatID as no_pa2 FROM AccountBase ab
                LEFT JOIN swo_projectactivationBase ac ON ab.AccountId = ac.swo_CustomerName
                LEFT JOIN swo_bandwidthBase c ON ac.swo_Bandwidth = c.swo_bandwidthId
                WHERE swo_ProjectActivatID IS NOT NULL AND ab.new_IDPEL IN ('".$cari."')")
                );

                // dd($kaka);
                foreach($kaka as $k)
                {
                $k->no_pa2 = "-";
                }
                $title = 'No SPA';
                return view('spa', ['e' => $kaka, 'title' => $title]);
            }
        }


            // $title = 'No SPA';
            // // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
            // return view('spa', ['e' => $jancok, 'title' => $title]);
        }


    public function getData($idpel)
    {

        $jancok = DB::connection('dbo')
            ->select(
                DB::raw("SELECT ab.new_IDPEL, ac.swo_ProjectActivatID as no_pa, CASE WHEN c.swo_id IS NULL THEN '-' ELSE
            c.swo_id
            END AS bandwidth, ac.CreatedOn FROM AccountBase ab
            LEFT JOIN swo_projectactivationBase ac ON ab.AccountId = ac.swo_CustomerName
            LEFT JOIN swo_bandwidthBase c ON ac.swo_Bandwidth = c.swo_bandwidthId
            WHERE ab.new_IDPEL IN ('" . $idpel . "')")
        );

        foreach($jancok as $j)
        {
        if ($j->no_pa == '') {
        $koko = DB::connection('dbo')
        ->select(
        DB::raw("SELECT ab.new_IDPEL, ac.swo_ProjectActivatID as no_pa, CASE WHEN c.swo_id IS NULL THEN '-' ELSE
        c.swo_id
        END AS bandwidth, ac.CreatedOn, ac.swo_ProjectActivatID as no_pa2 FROM AccountBase ab
        LEFT JOIN swo_projectactivationBase ac ON ab.AccountId = ac.swo_CustomerName
        LEFT JOIN swo_bandwidthBase c ON ac.swo_Bandwidth = c.swo_bandwidthId
        WHERE swo_ProjectActivatID IS NULL AND ab.new_IDPEL IN ('".$idpel."')")
        );

        // dd($koko);
        foreach($koko as $k)
        {
        $k->no_pa2 = "<a href='/spa/update/".$k->new_IDPEL."' class='btn btn-success'>NAIKAN PA</a>";
        }

        $title = 'No SPA';
        return view('spa', ['e' => $koko, 'title' => $title]);


        }elseif ($j->no_pa != '') {
        $kaka = DB::connection('dbo')
        ->select(
        DB::raw("SELECT ab.new_IDPEL, ac.swo_ProjectActivatID as no_pa, CASE WHEN c.swo_id IS NULL THEN '-' ELSE
        c.swo_id
        END AS bandwidth, ac.CreatedOn, ac.swo_ProjectActivatID as no_pa2 FROM AccountBase ab
        LEFT JOIN swo_projectactivationBase ac ON ab.AccountId = ac.swo_CustomerName
        LEFT JOIN swo_bandwidthBase c ON ac.swo_Bandwidth = c.swo_bandwidthId
        WHERE swo_ProjectActivatID IS NOT NULL AND ab.new_IDPEL IN ('".$idpel."')")
        );

        // dd($kaka);
        foreach($kaka as $k)
        {
        $k->no_pa2 = "-";
        }
        $title = 'No SPA';
        return view('spa', ['e' => $kaka, 'title' => $title]);
        }
        }

        // $title = 'No SPA';
        // // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
        // return view('/spa', ['e' => $jancok, 'title' => $title]);
    }

    // public function edit($idpel)
    // {


    //     $data = DB::connection('sqlsrv')->select(
    //         DB::raw("SELECT * FROM Tbl_Opportunity
    //         WHERE ID_PELANGGAN = '" . $idpel . "' OR CRMID = '" . $idpel . "'")
    //     );

    //     $title = "SPA | EDIT STATUS";
    //     return view('/editStatus', ['data' => $data, 'title' => $title]);
    // }

    public function update($idpel)
    {
        // $a = $request->idpel;
        // dd($idpel);
        $id = $idpel;
        // $jancok = TRUE;
        $jancok = DB::connection('sqlsrv')->update(
            DB::raw("UPDATE Tbl_Opportunity set STATUS = 0 where CRMID = '" . $idpel . "' AND STATUS = 1")
        );

        if ($jancok && $id != '') {
            echo "<script>
                alert('PA berhasil di naikan')
            </script>";

            $title = "SPA | EDIT STATUS";
            return view('spa', ['title' => $title]);
        } else {
            echo "<script>
                alert('PA Tidak berhasil di naikan')
            </script>";

            $title = "SPA | EDIT STATUS";
            return view('spa', ['title' => $title]);
        }




        $status = "Data telah diupdate";
    }

    public function cek()
    {
        return view('spaSync', ['title' => 'No SPA']);
        // dd('jancok');
    }

    public function cekStaging(Request $request)
    {
        $data = $request->spa;

        $jancok = DB::connection('dbo')
        ->select(
        DB::raw("SELECT * FROM Cek_Validasi_Antrian_PI cvap where swo_ProjectActivatID in ('".$data."')")
        );

        return view('spaSync', ['e'=>$jancok, 'title' => 'CEK SPA STAGING']);
    // dd('jancok');
    }
}

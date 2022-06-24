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


            $title = 'No SPA';
            // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
            return view('/spa', ['e' => $jancok, 'title' => $title]);
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

        // $title = 'No SPA';
        // // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
        // return view('/spa', ['e' => $jancok, 'title' => $title]);

        foreach ($jancok as $k) {
            if ($k->no_pa == "") {
                $b = DB::connection('dbo')
                    ->select(
                        DB::raw("SELECT ab.new_IDPEL, ac.swo_ProjectActivatID as no_pa, CASE WHEN c.swo_id IS NULL THEN '-' ELSE
                c.swo_id
                END AS bandwidth, ac.CreatedOn FROM AccountBase ab
                LEFT JOIN swo_projectactivationBase ac ON ab.AccountId = ac.swo_CustomerName
                LEFT JOIN swo_bandwidthBase c ON ac.swo_Bandwidth = c.swo_bandwidthId
                WHERE ac.swo_ProjectActivatID = '' AND ab.new_IDPEL IN ('" . $idpel . "')")
                    );

                $title = 'No SPA';
                // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
                return view('/spa', ['e' => $b, 'title' => $title]);

            } else {
                $b = DB::connection('dbo')
                    ->select(
                        DB::raw("SELECT ab.new_IDPEL, ac.swo_ProjectActivatID as no_pa, CASE WHEN c.swo_id IS NULL THEN '-' ELSE
                c.swo_id
                END AS bandwidth, ac.CreatedOn FROM AccountBase ab
                LEFT JOIN swo_projectactivationBase ac ON ab.AccountId = ac.swo_CustomerName
                LEFT JOIN swo_bandwidthBase c ON ac.swo_Bandwidth = c.swo_bandwidthId
                WHERE ac.swo_ProjectActivatID <> '' AND ab.new_IDPEL IN ('" . $idpel . "')")
                    );

                $title = 'No SPA';
                // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
                return view('/spa', ['e' => $b, 'title' => $title]);
            }
        }


    }

    public function edit($idpel)
    {


        $data = DB::connection('sqlsrv')->select(
            DB::raw("SELECT * FROM Tbl_Opportunity
            WHERE ID_PELANGGAN = '" . $idpel . "' OR CRMID = '" . $idpel . "'")
        );

        $title = "SPA | EDIT STATUS";
        return view('/editStatus', ['data' => $data, 'title' => $title]);
    }

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
}

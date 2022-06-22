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

        $jancok = DB::connection('dbo')->select(
            DB::raw("SELECT ab.new_IDPEL, ac.swo_ProjectActivatID as no_pa, CASE WHEN c.swo_id IS NULL THEN '-' ELSE
            c.swo_id
            END AS bandwidth, ac.CreatedOn FROM AccountBase ab
            LEFT JOIN swo_projectactivationBase ac ON ab.AccountId = ac.swo_CustomerName
            LEFT JOIN swo_bandwidthBase c ON ac.swo_Bandwidth = c.swo_bandwidthId
            WHERE ab.new_IDPEL IN ('".$cari."')")
        );

        $title = 'No SPA';
        // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
        return view('/spa', ['e' => $jancok, 'title' => $title]);
    }

    public function getData($idpel)
    {

        $jancok = DB::connection('dbo')
        ->select
        (
            DB::raw("SELECT ab.new_IDPEL, ac.swo_ProjectActivatID as no_pa, CASE WHEN c.swo_id IS NULL THEN '-' ELSE
            c.swo_id
            END AS bandwidth, ac.CreatedOn FROM AccountBase ab
            LEFT JOIN swo_projectactivationBase ac ON ab.AccountId = ac.swo_CustomerName
            LEFT JOIN swo_bandwidthBase c ON ac.swo_Bandwidth = c.swo_bandwidthId
            WHERE ab.new_IDPEL IN ('".$idpel."')")
        );

        $title = 'No SPA';
        // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
        return view('/spa', ['e' => $jancok, 'title' => $title]);
    }
}

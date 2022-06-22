<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\events;


class OpportunityController extends Controller
{
    public function index()
    {
        return view('opportunity', ['title'=>'Opportunity']);
    }

    public function cari(Request $request)
    {
        $cari = $request->idpel;
        $submit = $request->submit;

        $jancok = DB::connection('sqlsrv')->table("Tbl_Opportunity as OPOR")
        ->select(
            "OPOR.NAMA_PELANGGAN",
            "OPOR.ORDERID",
            "OPOR.CRMID",
            "OPOR.ID_PELANGGAN",
            "OPOR.STATUS",
            "OPOR.TGL_LUNAS",
            "OPOR.KODE_VA",
            "OPOR.BATAL",
            "OPOR.TGL_BATAL"
        )
        ->where([
                ['OPOR.ID_PELANGGAN', '=', $cari]

        ])
        ->orWhere([
            ['OPOR.CRMID', '=', $cari]
        ])
        ->get();

        foreach ($jancok as $k) {
            $a = $k->TGL_LUNAS;
            $b = $k->TGL_BATAL;
            $c = $k->BATAL;

            if ($a != "" && $b != "" && $c != "") {
                $k->CRMID = "<a href=''>".$k->CRMID."</a>";
            }

        }

        $title = 'Opportunity';
        // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
        // $a =  json_encode($jancok);
        // $b =  json_decode($jancok);
        return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
        // echo json_decode($a);


    }
}

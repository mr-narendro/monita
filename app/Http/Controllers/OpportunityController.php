<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\events;
use DataTables;
//use Yajra\Datatables\Datatables;

class OpportunityController extends Controller
{
    public function index()
    {
        return view('opportunity', ['title'=>'Opportunity']);
    }

    // public function getAll()
    // {
    //     // $cari = $request->idpel;
    //     //$id = $request->id;

    //    // $jancok = $cari;
    //     return DataTables(DB::connection('sqlsrv')
    //     ->select(DB::raw(
    //     "SELECT top 1 NAMA_PELANGGAN, ORDERID, CRMID, ID_PELANGGAN, STATUS, TGL_LUNAS, KODE_VA, BATAL, TGL_BATAL FROM
    //     Tbl_Opportunity"
    //     )
    //     ))->make(true);


    // }

    public function setData($idpel, Request $request)
    {

    $type = $request->type;
    return DataTables(DB::connection('sqlsrv')
    ->select(DB::raw(
    "SELECT NAMA_PELANGGAN, ORDERID, CRMID, ID_PELANGGAN, STATUS, TGL_LUNAS, KODE_VA, BATAL, TGL_BATAL FROM
    Tbl_Opportunity WHERE $type = '".$idpel."'"
    )
    ))->make(true);


    }
}

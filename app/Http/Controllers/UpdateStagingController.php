<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\events;


class UpdateStagingController extends Controller
{
    public function index()
    {
        return view('updateStaging', ['title'=>'Update STaging Manual']);
    }

    public function cari(Request $request){
        $spa = $request->data;
        $response = DB::connection('staging')->select(
            DB::raw("SELECT * FROM fso_staging fs WHERE NO_PA = '".$spa."'")
        );

        return json_encode($response);

    }

    public function updatePTL(Request $request){
        $ptl = $request->ptl;
        $pa = $request->pa;
        $response = DB::connection('staging')->update(
        DB::raw("UPDATE fso_staging SET NAMA_PTL = '".$ptl."' WHERE NO_PA = '".$pa."'")
        );
    }

    public function updateIO(Request $request){
        $nomor_io = $request->nomor_io;
        $pa = $request->pa;
        $response = DB::connection('staging')->update(
        DB::raw("UPDATE fso_staging SET nomor_io = '".$nomor_io."' WHERE NO_PA = '".$pa."'")
        );
    }
}

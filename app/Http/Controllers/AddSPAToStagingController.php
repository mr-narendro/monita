<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\events;


class AddSPAToStagingController extends Controller
{
    public function index()
    {
        return view('addPAStagingManual', ['title' => 'Add PA Stagin Manual']);
    }

    public function insert($spa)
    {
        $spa = str_replace("_","/",$spa);
        $datas = DB::connection('dbo')->table("Cek_Validasi_Antrian_PI")
        ->select("*")
        ->where([
            ['swo_ProjectActivatID', '=', $spa]
        ])->get();

        $saveStaging = DB::connection('dbo')->table('fso_staging')->insert([            
            'NO_PA'           => $datas[0]->swo_ProjectActivatID,
            ''
        ]);   

    }

    public function getData($spa)
    {
        $spa = str_replace("_","/",$spa);
        $datas = DB::connection('dbo')->table("Cek_Validasi_Antrian_PI")
            ->select("*")
            ->where([
                ['swo_ProjectActivatID', '=', $spa]
            ])->get();
        return datatables()->of($datas)
        ->addIndexColumn()        
        ->make(true);
        
        
    }
}

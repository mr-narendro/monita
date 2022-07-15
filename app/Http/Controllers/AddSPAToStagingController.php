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
        $datas = DB::connection('dbo')->table("VIEW_ADD_STAGING_MANUAL")
        ->select("*")
        ->where([
            ['NO_PA', '=', $spa]
        ])->get();

        $data = $datas[0];
        // dd($data);

        // return response()->json([
        //     "kiki_jancok" => $data
        // ]);

        $saveStaging = DB::connection('dbo_dev')->table('fso_staging')->insert([
            'NO_PA'           => $data->NO_PA,
            'TGL_PA'          => date('Y-m-d h:m:s'),
            'TGL_TARGET_PA'   => date('Y-m-d h:m:s'),
            'NAMA_SALES'      => $data->NAMA_SALES,
            'NAMA_PTL'        => $data->NAMA_PTL,
            'PTL_EMAIL'       => $data->PTL_EMAIL,
            'NAMA_PELANGGAN'  => $data->NAMA_PELANGGAN,
            'SEGMEN'          => $data->SEGMEN,
            'LAYANAN'         => $data->LAYANAN,
            'TIPE_SO'         => $data->TIPE_SO,
            'SID'             => $data->SID,
            'NO_PA_NODE'      => $data->NO_PA_NODE,
            'ADDRESS'         => $data->ADDRESS,
            'REGION'          => $data->REGION,
            'PIC'             => $data->PIC,
            'PIC_EMAIL'       => $data->PIC_EMAIL,
            'LAT_LONG'        => $data->LAT_LONG,
            'QTY'             => $data->QTY,
            'SATUAN'          => $data->SATUAN,
            'TYPE'            => $data->TYPE,
            'RELATED_DOCUMENT'=> $data->RELATED_DOCUMENT,
            'RELATED_DOCUMENT_GUID' => $data->RELATED_DOCUMENT_GUID,
            'VENDOR_REQUEST'  => $data->VENDOR_REQUEST,
            'WORK_ORDER_PERMIT'=> $data->WORK_ORDER_PERMIT,
            'requeststatus'   => $data->requeststatus,
            'modifiedby'      => $data->modifiedby,
            'modifiedon'      => date('Y-m-d h:m:s'),
            'RequestDate'     => date('Y-m-d h:m:s'),
            'entitylogicalname' => $data->entitylogicalname,
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

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\events;


class SapController extends Controller
{
    public function index()
    {
        return view('sap.index', ['title' => 'SAP']);
    }

    public function cek($io)
    {
        $username = 'integrasi';
        $password = '1nts4p';
        //$header = ['Authorization' => 'Basic ' . base64_encode($username . ':' . $password)];
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($username . ':' . $password),
        ])->get('http://icndbpi1.iconpln.co.id:8000/sap/bc/zapi_check_io?sap-client=100&internal_order='.$io);
        return $response;
        // $ioe = ";


        // $res = response()->json([
        // 'message' => 'mantap'
        // ]);
        // echo $ioe;
        // echo "<script>alert('oke')</script>";
        // $m = 'IO '.$io.' Tersedia';

        // $title = 'SAP - CEK IO';
        // return view('sap.index', ['title' => $title]);
        // $a =  json_encode($jancok);
        // $b =  json_decode($jancok);
        // return redirect()->back();
        // echo json_decode($a);


    }
}

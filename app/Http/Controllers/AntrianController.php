<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\events;


class AntrianController extends Controller
{
    public function index()
    {
        return view('antrian', ['title' => 'Antrian']);
    }

    public function cari(Request $request)
    {
        $cari = $request->idpel;
        $submit = $request->submit;

        $jancok = DB::table("View_OptActive as voa")
            ->select(
                "voa.NAMA_PELANGGAN",
                "voa.ID_PELANGGAN",
                "voa.EMAIL",
                "voa.KODE_PRODUK_INTERNET",
                "voa.BANDWIDTH",
                "voa.KODE_VA",
                "voa.TGL_LUNAS"
            )
            ->where([
                ['voa.ID_PELANGGAN', '=', $cari]

            ])
            ->get();

        $title = 'Antrian Pelanggan';
        // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
        return view('/antrian', ['e' => $jancok, 'title' => $title]);
    }

    public function getData($idpel)
    {

        $jancok = DB::table("View_OptActive as voa")
            ->select(
                "voa.NAMA_PELANGGAN",
                "voa.ID_PELANGGAN",
                "voa.EMAIL",
                "voa.KODE_PRODUK_INTERNET",
                "voa.BANDWIDTH",
                "voa.KODE_VA",
                "voa.TGL_LUNAS"
            )
            ->where([
                ['voa.ID_PELANGGAN', '=', $idpel]

            ])
            ->get();

        $title = 'Antrian Pelanggan';
        // return view('/opportunity', ['e'=>$jancok,'title'=>$title]);
        return view('/antrian', ['e' => $jancok, 'title' => $title]);
    }
}

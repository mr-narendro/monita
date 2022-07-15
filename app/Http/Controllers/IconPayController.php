<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class IconPayController extends Controller
{
    public function index()
    {
        return view('iconpay.index', ['title' => 'IconPay || Piutang']);
    }

    public function cariIdPel(Request $request)
    {
        $idPel = $request->idPel;

        $cariIdPel = DB::connection('sqlsrv')
            ->select(
                DB::raw("SELECT * from View_CekTagihan vct where vct.idpel = '" . $idPel . "'")
            );

        if ($cariIdPel) {
            return json_encode($cariIdPel);
        } else {
            echo "<script>alert('jancok')</script>";
        }
    }

    public function addPiutang(Request $request)
    {
        $nova = $request->nova;
        $noinvoice = $request->noinvoice;
        $idpel = $request->idpel;
        $produk = $request->produk;
        $addon = $request->addon;
        $thbltagihan = $request->thbltagihan;
        $nama = $request->nama;
        $rptag = $request->rptag;
        $rpdenda = $request->rpdenda;
        $rpmaterai = $request->rpmaterai;
        $rpadmin = $request->rpadmin;
        $rpadminpartner = $request->rpadminpartner;
        $rpadminicon = $request->rpadminicon;
        $tglexpired = $request->tglexpired;
        $paymentCode = $request->paymentCode;
        $alfaCode = $request->alfaCode;
        $indomartCode = $request->indomartCode;
        $email = $request->email;
        $type = $request->type;

        $username = "stroomnet";
        $password = "icon123/";
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . env("ICONPAY_BEARER_TOKEN_PRD", ""),
        ])->post(env("ICONPAY_ADDPIUTANG_PRD", ""), [
            'nova' => $nova,
            'noinvoice' => $noinvoice,
            'idpel' => $idpel,
            'produk' => $produk,
            'addon' => $addon,
            'thbltagihan' => $thbltagihan,
            'nama' => $nama,
            'rptag' => $rptag,
            'rpdenda' => $rpdenda,
            'rpmaterai' => $rpmaterai,
            'rpadmin' => $rpadmin,
            'rpadminpartner' => $rpadminpartner,
            'rpadminicon' => $rpadminicon,
            'tglexpired' => $tglexpired,
            'paymentCode' => $paymentCode,
            'alfaCode' => $alfaCode,
            'indomartCode' => $indomartCode,
            'email' => $email,
            'type' => $type

        ]);

        return $response;
    }

    public function editPiutang(Request $request)
    {
        $nova = $request->nova;
        $noinvoice = $request->noinvoice;
        $idpel = $request->idpel;
        $produk = $request->produk;
        $addon = $request->addon;
        $thbltagihan = $request->thbltagihan;
        $nama = $request->nama;
        $rptag = $request->rptag;
        $rpdenda = $request->rpdenda;
        $rpmaterai = $request->rpmaterai;
        $rpadmin = $request->rpadmin;
        $rpadminpartner = $request->rpadminpartner;
        $rpadminicon = $request->rpadminicon;
        $tglexpired = $request->tglexpired;
        $paymentCode = $request->paymentCode;
        $alfaCode = $request->alfaCode;
        $indomartCode = $request->indomartCode;
        $email = $request->email;
        $type = $request->type;

        $username = "stroomnet";
        $password = "icon123/";
        //echo json_encode($idpel);
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . env("ICONPAY_BEARER_TOKEN_PRD", ""),
        ])->post(env("ICONPAY_EDITPIUTANG_PRD", ""), [
            'nova' => $nova,
            'noinvoice' => $noinvoice,
            'idpel' => $idpel,
            'produk' => $produk,
            'addon' => $addon,
            'thbltagihan' => $thbltagihan,
            'nama' => $nama,
            'rptag' => $rptag,
            'rpdenda' => $rpdenda,
            'rpmaterai' => $rpmaterai,
            'rpadmin' => $rpadmin,
            'rpadminpartner' => $rpadminpartner,
            'rpadminicon' => $rpadminicon,
            'tglexpired' => $tglexpired,
            'paymentCode' => $paymentCode,
            'alfaCode' => $alfaCode,
            'indomartCode' => $indomartCode,
            'email' => $email,
            'type' => $type

        ]);

        return $response;
    }

    public function batalPiutang(Request $request)
    {
        $nova = $request->nova;
        $idpel = $request->idpel;
        $thbltagihan = $request->thbltagihan;
        $alasanBatal = $request->alasanBatal;

        $username = "stroomnet";
        $password = "icon123/";
        //echo json_encode($idpel);
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . env("ICONPAY_BEARER_TOKEN_PRD", ""),
        ])->post(env("ICONPAY_BATALPIUTANG_PRD", ""), [
            'nova' => $nova,
            'idpel' => $idpel,
            'thbltagihan' => $thbltagihan,
            'alasanBatal' => $alasanBatal
        ]);

        return $response;
    }
}

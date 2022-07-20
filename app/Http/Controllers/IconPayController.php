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
        $type = $request->progress;

        $cariIdPel = DB::connection('sqlsrv')
            ->select(
                DB::raw("SELECT * from Tbl_GenerateBilling tgb where ".$type." = '" . $idPel . "' AND tgb.STATUS = 'BELUM BAYAR'")
            );

        if ($cariIdPel) {
            return json_encode($cariIdPel);
        } else {
            echo "Gagal";
        }
    }

    public function addPiutang(Request $request)
    {
        $noinvoice = $request->noinvoice;
        $idpel = $request->idpel;

        $add = DB::connection('sqlsrv')
        ->select(
        DB::raw("SELECT * from View_CekTagihan vct where vct.idpel = '" . $idpel . "' OR vct.noinvoice = '". $noinvoice ."'")
        );

        $adds = $add[0];


        $nova = $adds->nova;
        $noinvoice = $adds->noinvoice;
        $idpel = $adds->idpel;
        $produk = $adds->produk;
        $addon = $adds->addon;
        $thbltagihan = $adds->thbltagihan;
        $nama = $adds->nama;
        $rptag = $adds->rptag;
        $rpdenda = $adds->rpdenda;
        $rpmaterai = $adds->rpmaterai;
        $rpadmin = $adds->rpadmin;
        $rpadminpartner = $adds->rpadminpartner;
        $rpadminicon = $adds->rpadminicon;
        $tglexpired = $adds->tglexpired;
        $paymentCode = $adds->paymentCode;
        $alfaCode = $adds->alfaCode;
        $indomartCode = $adds->indomartCode;
        $email = $adds->email;
        $type = $adds->type;

        $username = "stroomnet";
        $password = "icon123/";

        // --COBA DI SARMA DEV
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($username . ':' . $password),
            ])->post("http://10.14.152.45:8282/stroomnetcrm/addPiutang", [
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

        // $response = Http::withHeaders([
        //     'Authorization' => 'Basic ' . env("ICONPAY_BEARER_TOKEN_PRD", ""),
        // ])->post(env("ICONPAY_ADDPIUTANG_PRD", ""), [
        //     'nova' => $nova,
        //     'noinvoice' => $noinvoice,
        //     'idpel' => $idpel,
        //     'produk' => $produk,
        //     'addon' => $addon,
        //     'thbltagihan' => $thbltagihan,
        //     'nama' => $nama,
        //     'rptag' => $rptag,
        //     'rpdenda' => $rpdenda,
        //     'rpmaterai' => $rpmaterai,
        //     'rpadmin' => $rpadmin,
        //     'rpadminpartner' => $rpadminpartner,
        //     'rpadminicon' => $rpadminicon,
        //     'tglexpired' => $tglexpired,
        //     'paymentCode' => $paymentCode,
        //     'alfaCode' => $alfaCode,
        //     'indomartCode' => $indomartCode,
        //     'email' => $email,
        //     'type' => $type

        // ]);

        return $response;
    }

    public function updateBillingCRM(Request $request)
    {
        $KODE_INVOICE = $request->KODE_INVOICE;
        $PRODUK_NAME = $request->PRODUK_NAME;
        $BANDWIDTH = $request->BANDWIDTH;
        $ADDON = $request->ADDON;
        $PERIODE_INVOICE = $request->PERIODE_INVOICE;
        $BIAYA_LAYANAN = $request->BIAYA_LAYANAN;
        $BIAYA_ADDON = $request->BIAYA_ADDON;
        $BIAYA_PPN = $request->BIAYA_PPN;
        $BIAYA_MATERAI = $request->BIAYA_MATERAI;
        $BIAYA_PENYESUAIAN = $request->BIAYA_PENYESUAIAN;
        $BIAYA_RESTITUSI = $request->BIAYA_RESTITUSI;
        $BIAYA_ADMIN = $request->BIAYA_ADMIN;
        $PAYMENTCODE = $request->PAYMENTCODE;
        $EMAIL = $request->EMAIL;
        $TOTAL_HARGA_NORMAL = $request->TOTAL_HARGA_NORMAL;
        $CATATAN = $request->CATATAN;

        $response = DB::connection('sarma_dev')->update(
            DB::raw(
                "UPDATE Tbl_GenerateBilling SET PRODUK_NAME = '" . $PRODUK_NAME . "', BANDWIDTH = '" . $BANDWIDTH . "', ADDON = '" . $ADDON . "', PERIODE_INVOICE = '" . $PERIODE_INVOICE . "', BIAYA_LAYANAN = '" . $BIAYA_LAYANAN . "', BIAYA_ADDON = '" . $BIAYA_ADDON . "',
                BIAYA_PPN = '" . $BIAYA_PPN . "',
                BIAYA_MATERAI = '" . $BIAYA_MATERAI . "',
                BIAYA_ADMIN = '" . $BIAYA_ADMIN . "',
                PAYMENTCODE = '" . $PAYMENTCODE . "',
                EMAIL = '" . $EMAIL . "',
                TOTAL_HARGA_NORMAL = '" . $TOTAL_HARGA_NORMAL . "',
                CATATAN = '" . $CATATAN . "'
                WHERE KODE_INVOICE = '" . $KODE_INVOICE . "'")
        );

        return $response;
    }

    public function editPiutang(Request $request)
    {

        $idPel = $request->idpel;

        $edits = DB::connection('sarma_dev')
            ->select(
                DB::raw("SELECT * from View_CekTagihan vct where vct.idpel = '" . $idPel . "'")
            );

        $edit = $edits[0];


        $nova = $edit->nova;
        $noinvoice = $edit->noinvoice;
        $idpel = $edit->idpel;
        $produk = $edit->produk;
        $addon = $edit->addon;
        $thbltagihan = $edit->thbltagihan;
        $nama = $edit->nama;
        $rptag = $edit->rptag;
        $rpdenda = $edit->rpdenda;
        $rpmaterai = $edit->rpmaterai;
        $rpadmin = $edit->rpadmin;
        $rpadminpartner = $edit->rpadminpartner;
        $rpadminicon = $edit->rpadminicon;
        $tglexpired = $edit->tglexpired;
        $paymentCode = $edit->paymentCode;
        $alfaCode = $edit->alfaCode;
        $indomartCode = $edit->indomartCode;
        $email = $edit->email;
        $type = $edit->type;

        $username = "stroomnet";
        $password = "icon123/";

        // --COBA DI SARMA DEV
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($username . ':' . $password),
        ])->post("http://10.14.152.45:8282/stroomnetcrm/editPiutang", [
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
        // $response = Http::withHeaders([
        //     'Authorization' => 'Basic ' . env("ICONPAY_BEARER_TOKEN_PRD", ""),
        // ])->post(env("ICONPAY_EDITPIUTANG_PRD", ""), [
        //     'nova' => $nova,
        //     'noinvoice' => $noinvoice,
        //     'idpel' => $idpel,
        //     'produk' => $produk,
        //     'addon' => $addon,
        //     'thbltagihan' => $thbltagihan,
        //     'nama' => $nama,
        //     'rptag' => $rptag,
        //     'rpdenda' => $rpdenda,
        //     'rpmaterai' => $rpmaterai,
        //     'rpadmin' => $rpadmin,
        //     'rpadminpartner' => $rpadminpartner,
        //     'rpadminicon' => $rpadminicon,
        //     'tglexpired' => $tglexpired,
        //     'paymentCode' => $paymentCode,
        //     'alfaCode' => $alfaCode,
        //     'indomartCode' => $indomartCode,
        //     'email' => $email,
        //     'type' => $type

        // ]);

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

    public function saveLogIconPay(Request $request)
    {
        $CONTROLLER = $request->controller;
        $JENISTRANSAKSI = $request->jenisTransaksi;
        $KODERC = $request->kodeRc;
        $KETERANGAN = $request->keterangan;
        $IDPELANGGAN = $request->idpel;
        $PERIODETAGIHAN = $request->periodeTagihan;
        $KODEINVOICE = $request->kodeInvoice;
        $DATA = $request->data;

        DB::connection('sqlsrv')->table('Tbl_LogTrxIconpay')->insert([
            'CONTROLLER' => $CONTROLLER,
            'JENISTRANSAKSI' => $JENISTRANSAKSI,
            'KODERC' => $KODERC,
            'KETERANGAN' => $KETERANGAN,
            'IDPELANGGAN' => $IDPELANGGAN,
            'PERIODETAGIHAN' => $PERIODETAGIHAN,
            'CREATEDON' => date('Y-m-d h:m:s'),
            'KODEINVOICE' => $KODEINVOICE,
            'DATA' => $DATA
        ]);
    }
}

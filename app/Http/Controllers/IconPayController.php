<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use function PHPUnit\Framework\isEmpty;

class IconPayController extends Controller
{
    public function index()
    {
        return view('iconpay.index', ['title' => 'IconPay || Piutang']);
    }

    public function viewEditPiutang()
    {
        return view('iconpay.viewEditPiutang', ['title' => 'IconPay || Edit Piutang']);
    }

    public function viewBatalPiutang()
    {
        return view('iconpay.viewBatalPiutang', ['title' => 'IconPay || Batal Piutang']);
    }

    public function cariIdPel(Request $request)
    {
        $idPel = $request->idPel;
        $type = $request->progress;

        $cariIdPel = DB::connection('sqlsrv')
            ->select(
                DB::raw("SELECT ID, KODE_VA, KODE_INVOICE, ID_PELANGGAN, PRODUK_NAME, BANDWIDTH, ADDON, PERIODE_INVOICE, BIAYA_LAYANAN, BIAYA_ADDON, BIAYA_PPN, BIAYA_MATERAI, BIAYA_PENYESUAIAN, BIAYA_RESTITUSI, BIAYA_ADMIN, PAYMENTCODE,CRMID, EMAIL, TOTAL_HARGA_NORMAL, CATATAN, STATUS, FORMAT(PERIODE_INVOICE, 'yyyyMM') AS THBLTAGIHAN from Tbl_GenerateBilling tgb where ".$type." = '" . $idPel . "' AND tgb.STATUS = 'BELUM BAYAR'")
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
        DB::raw("SELECT * from View_CekTagihan vct where vct.idpel = '" . $idpel . "' AND vct.noinvoice = '". $noinvoice ."'")
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

        // $response = Http::withHeaders([
        //     'Authorization' => 'Basic ' . base64_encode($username . ':' . $password),
        //     ])->post("http://10.14.152.45:8282/stroomnetcrm/addPiutang", [
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

        $response = DB::connection('sqlsrv')->update(
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

    public function editInvoiceBilling($request)
    {
        $oldInvoice = DB::connection('sqlsrv')->select(
            DB::raw("SELECT * FROM Tbl_GenerateBilling WHERE KODE_INVOICE='".$request->kodeInvoice."'")
        );

        $invoice = $oldInvoice[0];

        DB::beginTransaction();

        try{
            $newKodeInvoice = str_replace("INV", "CN", $request->kodeInvoice);
            print_r($newKodeInvoice);
            DB::connection('sqlsrv')->table('Tbl_GenerateBilling')->insert([
            'KODE_INVOICE' => $newKodeInvoice,
            'ID_PELANGGAN' => $invoice->ID_PELANGGAN,
            'NAMA_PELANGGAN' => $invoice->NAMA_PELANGGAN,
            'KODE_INVOICE_REFF' => $request->kodeInvoice,
            'DUEDATE' => $invoice->DUEDATE,
            'PERIODE_BILLING' => $invoice->PERIODE_BILLING,
            'KODE_VA' => $invoice->KODE_VA,
            'AL_NO' => $invoice->AL_NO,
            'AGR_NO' => $invoice->AGR_NO,
            'SERVICEID' => $invoice->SERVICEID,
            'ADDRESS' => $invoice->ADDRESS,
            'EMAIL' => $request->email,
            'AL_STATUS' => $invoice->AL_STATUS,
            'AL_TYPE' => $invoice->AL_TYPE,
            'PRODUK_ID' => $invoice->PRODUK_ID,
            'PRODUK_NAME' => $invoice->PRODUK_NAME,
            'ADDON' => $invoice->ADDON,
            'BANDWIDTH' => $request->bandwidth,
            'BIAYA_LAYANAN' => $request->biayaLayanan,
            'BIAYA_ADDON' => $request->biayaAddon,
            'BIAYA_AKTIVASI' => $invoice->BIAYA_AKTIVASI,
            'BIAYA_MATERAI' => $request->biayaMaterai,
            'BIAYA_DENDA' => $invoice->BIAYA_DENDA,
            'BIAYA_DISCOUNT' => $invoice->BIAYA_DISCOUNT,
            'BIAYA_PPN' => $invoice->BIAYA_PPN,
            'CURRENCY' => $invoice->CURRENCY,
            'PERIODE_DENDA' => $invoice->PERIODE_DENDA,
            'START_BILLING_DATE' => $invoice->START_BILLING_DATE,
            'USAGE_FROM' => $invoice->USAGE_FROM,
            'USAGE_TO' => $invoice->USAGE_TO,
            'NEXT_BILLING_DATE' => $invoice->NEXT_BILLING_DATE,
            'LAST_BILLING_DATE' => $invoice->LAST_BILLING_DATE,
            'CREATEDBY' => $invoice->CREATEDBY,
            'CREATEDON' => $invoice->CREATEDON,
            'MODIFIEDBY' => $invoice->MODIFIEDBY,
            'MODIFIEDON' => $invoice->MODIFIEDON,
            'PERIODE_INVOICE' => $invoice->PERIODE_INVOICE,
            'STATUS' => $invoice->STATUS,
            'FLAGTAGIHAN' => $invoice->FLAGTAGIHAN,
            'ICONPAY' => $invoice->ICONPAY,
            'TGLLUNAS' => $invoice->TGLLUNAS,
            'SENDMAIL' => $invoice->SENDMAIL,
            'DISCOUNT_CGC' => $invoice->DISCOUNT_CGC,
            'IDPEL_CGC' => $invoice->IDPEL_CGC,
            'BANDWIDTH_CGC' => $invoice->BANDWIDTH_CGC,
            'TOTAL_HARGA_NORMAL' => $invoice->TOTAL_HARGA_NORMAL,
            'CATATAN' => '',
            'REMINDER' => $invoice->REMINDER,
            'ISOLIR' => $invoice->ISOLIR,
            'ISOLIR_DATE' => $invoice->ISOLIR_DATE,
            'UNISOLIR_DATE' => $invoice->UNISOLIR_DATE,
            'SEND_TO_SAP' => $invoice->SEND_TO_SAP,
            'BIAYA_ADMIN' => $request->biayaAdmin,
            'ALERT' => $invoice->ALERT,
            'PAYMENTCODE' => $invoice->PAYMENTCODE,
            'PAYMENTBY' => $invoice->PAYMENTBY,
            'TYPE_INVOICE' => $invoice->TYPE_INVOICE,
            'VVIP' => $invoice->VVIP,
            'BIAYA_PENYESUAIAN' => $request->biayaPenyesuaian,
            'ID_AREA' => $invoice->ID_AREA,
            'BIAYA_RESTITUSI' => $request->biayaRestitusi,
            'BILL_TYPE' => $invoice->BILL_TYPE,
            'CRMID' => $invoice->CRMID,
            'SBU' => $invoice->SBU
            ]);

            DB::connection('sqlsrv')->table('Tbl_GenerateBilling')
            ->where('KODE_INVOICE', $request->kodeInvoice)
            ->update([
            'ISCANCEL' => 1,
            'TGL_CANCEL' => date('Y-m-d H:i:s'),
            'CATATAN' => 'Edit piutang dengan Kode Invoice Baru ' . $newKodeInvoice
            ]);

            DB::commit();

            return array(
                'success' => true,
                'kodeinvoice' => $newKodeInvoice,
                'message' => 'success'
            );
        }catch(\Exception $e){
            DB::rollBack();

            return array(
                'success' => false,
                'kodeinvoice' => '',
                'message' => $e->getMessage()
            );
        }
    }

    public function editPiutang(Request $request)
    {

        // $idPel = $request->idpel;

        $editInvoice = $this->editInvoiceBilling($request);

        if($editInvoice['success'] == true){
            $edits = DB::connection('sqlsrv')
            ->select(
                DB::raw("SELECT * from View_CekTagihan vct where vct.noinvoice = '" . $request->kodeInvoice . "'")
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
            // $response = Http::withHeaders([
            // 'Authorization' => 'Basic ' . base64_encode($username . ':' . $password),
            // ])->post("http://10.14.152.45:8282/stroomnetcrm/editPiutang", [
            // 'nova' => $nova,
            // 'noinvoice' => $noinvoice,
            // 'idpel' => $idpel,
            // 'produk' => $produk,
            // 'addon' => $addon,
            // 'thbltagihan' => $thbltagihan,
            // 'nama' => $nama,
            // 'rptag' => $rptag,
            // 'rpdenda' => $rpdenda,
            // 'rpmaterai' => $rpmaterai,
            // 'rpadmin' => $rpadmin,
            // 'rpadminpartner' => $rpadminpartner,
            // 'rpadminicon' => $rpadminicon,
            // 'tglexpired' => $tglexpired,
            // 'paymentCode' => $paymentCode,
            // 'alfaCode' => $alfaCode,
            // 'indomartCode' => $indomartCode,
            // 'email' => $email,
            // 'type' => $type
            // ]);

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
        } else {
            return $editInvoice;
        }
    }

    public function batalPiutang(Request $request)
    {
        $nova = $request->nova;
        $idpel = $request->idpel;
        $thbltagihan = $request->thbltagihan;
        $alasanBatal = $request->alasanBatal;



        $username = "stroomnet";
        $password = "icon123/";

        // $response = Http::withHeaders([
        // 'Authorization' => 'Basic ' . base64_encode($username . ':' . $password),
        // ])->post("http://10.14.152.45:8282/stroomnetcrm/batalPiutang", [
        //     'nova' => $nova,
        //     'idpel' => $idpel,
        //     'thbltagihan' => $thbltagihan,
        //     'alasanBatal' => $alasanBatal
        // ]);
        // //echo json_encode($idpel);
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

    function updateBatalPiutang(Request $request)
    {

        $idBilling = $request->idbilling;
        $alasanBatal = $request->alasanBatal;

        DB::connection('sqlsrv')->table('Tbl_GenerateBilling')
        ->where('ID', $idBilling)
        ->update([
        'ISCANCEL' => 1,
        'TGL_CANCEL' => date('Y-m-d H:i:s'),
        'CATATAN' =>  $alasanBatal
        ]);
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

        DB::connection('sarma_dev')->table('Tbl_LogTrxIconpay')->insert([
            'CONTROLLER' => $CONTROLLER,
            'JENISTRANSAKSI' => $JENISTRANSAKSI,
            'KODERC' => $KODERC,
            'KETERANGAN' => $KETERANGAN,
            'IDPELANGGAN' => $IDPELANGGAN,
            'PERIODETAGIHAN' => $PERIODETAGIHAN,
            'CREATEDON' => date('Y-m-d h:m:s'),
            'KODEINVOICE' => $KODEINVOICE,
            'DATA' => $DATA,
        ]);

        // DB::connection('sqlsrv')->table('Tbl_LogTrxIconpay')->insert([
        // 'CONTROLLER' => $CONTROLLER,
        // 'JENISTRANSAKSI' => $JENISTRANSAKSI,
        // 'KODERC' => $KODERC,
        // 'KETERANGAN' => $KETERANGAN,
        // 'IDPELANGGAN' => $IDPELANGGAN,
        // 'PERIODETAGIHAN' => $PERIODETAGIHAN,
        // 'CREATEDON' => date('Y-m-d h:m:s'),
        // 'KODEINVOICE' => $KODEINVOICE,
        // 'DATA' => $DATA,
        // 'CREATEDBY' => ''
        // ]);
    }
}

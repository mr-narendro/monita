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
        ])->get('http://icndbpi1.iconpln.co.id:8000/sap/bc/zapi_check_io?sap-client=100&internal_order=' . $io);
        return $response;
    }

    public function unlock()
    {
        return view('sap.unlock', ['title' => 'Unlock User']);
    }

    public function changePassword()
    {
        return view('sap.changePassword', ['title' => 'Change Password User']);
    }

    public function stagingIo()
    {
        return view('sap.stagingIo', ['title' => 'Cek IO Staging']);
    }

    public function unlockUser(Request $request)
    {

        $username = 'integrasi';
        $password = '1nts4p';
        $user = $request->user;

        $response = Http::withHeaders([
        'Authorization' => 'Basic ' . base64_encode($username . ':' . $password),
        ])->post("http://icndbpi1.iconpln.co.id:8000/sap/bc/zapi_user/zapi_unlock?sap-client=100&username=" . $user);
        return $response;
    }

    public function changePasswordUser(Request $request)
    {

        $username = 'integrasi';
        $password = '1nts4p';
        $user = $request->user;
        $pass = $request->pass;
        $response = Http::withHeaders([
        'Authorization' => 'Basic ' . base64_encode($username . ':' . $password),
        ])->post("http://icndbpi1.iconpln.co.id:8000/sap/bc/zapi_user/zapi_reset_pass?sap-client=100&username=" . $user
        . "&password=" . $pass);

        return $response;
    }

    public function cekIoStaging(Request $request)
    {
        $data = $request->data;
        $type = $request->type;
        $res = DB::connection('staging')
            ->select(
                DB::raw(
                    "SELECT record_id, swo_internorderid, swo_description, swo_profitcenter,
                        swo_externalordernumber, swo_customeralias, swo_ptl, swo_amount,
                        transactioncurrencyid, DATE_FORMAT(createdon,'%Y%-%m%-%d') as createdon, swo_flagcreated, swo_customerclassification,
                        swo_investmentprogram, requeststatus, swo_internorderguid
                        FROM swo_internalorderstaging WHERE " . $type . " = '" . $data . "'"
                )
            );
        if ($res == '') {
            $res = 'Data kosong';
            return $res;
        } else {
            return $res;
        }
    }

    public function lemparSap(Request $request)
    {
        $io = $request->io;
        $swo_description = $request->swo_description;
        $swo_profitcenter = $request->swo_profitcenter;
        $swo_externalordernumber = $request->swo_externalordernumber;
        $swo_ptl = $request->swo_ptl;
        $transactioncurrencyid = $request->transactioncurrencyid;
        $createdon = $request->createdon;
        $swo_flagcreated = $request->swo_flagcreated;
        $swo_customerclassification = $request->swo_customerclassification;
        $swo_investmentprogram = $request->swo_investmentprogram;
        $swo_customeralias = $request->swo_customeralias;

        $xmlBody = "<?xml version='1.0' encoding='UTF-8'?>
                    <soapenv:Envelope xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/'
                        xmlns:urn='urn:sap-com:document:sap:rfc:functions'>
                        <soapenv:Header />
                        <soapenv:Body>
                            <urn:ZF_CREATE_RELEASE_IO>
                                <I_INTERNAL>
                                    <!--Zero or more repetitions:-->
                                    <item>
                                        <AUFNR>" . $io . "</AUFNR>
                                        <KTEXT>" . $swo_description . "</KTEXT>
                                        <PRCTR>" . $swo_profitcenter . "</PRCTR>
                                        <AUFEX>" . $swo_externalordernumber . "</AUFEX>
                                        <USER2>" . $swo_ptl . "</USER2>
                                        <WERT>1.0</WERT>
                                        <WAERS>" . $transactioncurrencyid . "</WAERS>
                                        <BUDAT>" . $createdon . "</BUDAT>
                                        <FLAG>" . $swo_flagcreated . "</FLAG>
                                        <CLASS>" . $swo_customerclassification . "</CLASS>
                                        <INVEST>" . $swo_investmentprogram . "</INVEST>
                                        <ZZALIAS>" . $swo_customeralias . "</ZZALIAS>
                                    </item>
                                </I_INTERNAL>
                                <I_RETURN>
                                    <!--Zero or more repetitions:-->
                                    <item>
                                        <TYPE />
                                        <ID />
                                        <NUMBER />
                                        <MESSAGE />
                                        <LOG_NO />
                                        <LOG_MSG_NO />
                                        <MESSAGE_V1 />
                                        <MESSAGE_V2 />
                                        <MESSAGE_V3 />
                                        <MESSAGE_V4 />
                                        <PARAMETER />
                                        <ROW />
                                        <FIELD />
                                        <SYSTEM />
                                    </item>
                                </I_RETURN>
                            </urn:ZF_CREATE_RELEASE_IO>
                        </soapenv:Body>
                    </soapenv:Envelope>";

        $username = 'integrasi';
        $password = '1nts4p';
        $url = "http://icnappi1.iconpln.co.id:8000/sap/bc/srt/rfc/sap/zfi_io/100/zfi_io/zfi_io?sap-client=100";

        $response = Http::withBody($xmlBody, 'text/xml')
            ->withHeaders([
                'Authorization' => 'Basic ' . base64_encode($username . ':' . $password),
                'SOAPAction' => 'balance'
            ])
            ->post($url);

        // $response .= simplexml_load_string($response);
        return $response;
    }

    public function updateRequest($io)
    {
        $res = DB::connection('staging')
            ->update(
                DB::raw(
                    "UPDATE swo_internalorderstaging SET requeststatus='3' WHERE
                    swo_internorderid='".$io."'"
                )
            );
        return $res;
    }
}

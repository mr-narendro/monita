<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;

class LoginController extends Controller
{

    public function login(){
        if(Session::get('login')){
            return redirect('/');
        } else {
            return view('login',['error' => false, 'message' => '']);
        }
    }

    public function actLogin(Request $request){

        if(Session::get('login')){
            return redirect('/');
        }
        $email = strpos($request->input('email'), "@iconpln.co.id") ?  str_replace("@iconpln.co.id", "",$request->input('email')) : $request->input('email');
        // $email = $request->input('email');
        $password = $request->input('password');

        $data = DB::connection('user_login')->select(DB::raw("SELECT * FROM users vdw WHERE vdw.email = '".$email."' AND monita =1 limit 1"));


        if($data){
            $data = $data[0];
            if($data->flag_status == 'INTERNAL'){
                $server = "ldap://10.14.23.75";
                $port = "389";
                $conn = ldap_connect($server, $port) or die("Tidak dapat terhubung ke $server");
                if ($conn) {
                    ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
                    ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);
                    if (@ldap_bind($conn, $email."@iconpln.co.id", $password)) {
                        Session::put('name',$data->name);
                        Session::put('email',$data->email);
                        Session::put('id',$data->id);
                        Session::put('login',true);
                        return redirect('/');
                    } else {
                        return redirect('login')->with('alert','Username atau Password, Salah!');
                    }
                } else {
                    $result = array(
                        'status' => 400,
                        'message' => 'Failed to connect LDAP'
                    );
                    $this->response($result, 400);
                }
            } else if ($data->flag_status == 'EXTERNAL') {
                return redirect('login')->with('alert','Username atau Password, Salah!');
            }
        }else {
      	     return redirect('login')->with('alert','Email Tidak Terdaftar!');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('login');
    }
}

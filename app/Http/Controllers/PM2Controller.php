<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\events;


class PM2Controller extends Controller
{
    public function index()
    {
        $status = DB::connection('sqlsrv')->table("Tbl_Pm2_Node as voa")
            ->select('*')->get();
            if($status[0]->isRunning == 1){
                $text = 'Running';
            }else{
                $text = 'Idle';
            }

        return view('pm2', ['title' => 'PM2 Monitoring', 'status' =>$text]);
    }
}

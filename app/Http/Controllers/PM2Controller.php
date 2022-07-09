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
            ->select('*')->where([['id','=',1]])->get();
            foreach ($status as $s) {
                $st = $s->isRunning;
                if($st == 1){
                    $s->isRunning = 'Status : <span class="badge bg-success">Running</span>';
                }else{
                    $s->isRunning = 'Status : <span class="badge bg-warning">Idle</span>';
                }
            }

        return view('pm2', ['title' => 'PM2 Monitoring', 'status' =>$status]);
    }

    public function updateStatus(Request $request)
    {
        $update = DB::connection('sqlsrv')->update(DB::raw("UPDATE Tbl_Pm2_Node SET isRunning = 0 WHERE id = 1"));
        // // echo $reset;
        return $update;
    }
}

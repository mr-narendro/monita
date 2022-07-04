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
            foreach ($status as $s) {
                $st = $s->isRunning;
                if($st == 1){
                    $s->isRunning = 'Running';
                }else{
                    $s->isRunning = 'Jancok';
                }
            }

        return view('pm2', ['title' => 'PM2 Monitoring', 'status' =>$status]);
    }

    public function updateStatus($id)
    {
        $id = $id;

        $update = DB::connection('sqlsrv')
        ->update(DB::raw("UPDATE Tbl_Pm2_Node SET isRunning = 0 WHERE id = ".$id));
        // echo $reset;


        return $update;
    }
}

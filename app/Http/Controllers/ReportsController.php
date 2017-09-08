<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ReportsController extends Controller
{
    public function Census()
    {
    	$servgroup = DB::table('service_group_tbl')->where('status',1)->get();
    	return view('reports.Census',['servgroup'=>$servgroup]);
    }
    public function censusReportData(Request $req)
    {
    	$servgroup_id = $req->id;
    	
    	$servgroup = DB::table('service_group_tbl')->whereIn('servgroup_id',$servgroup_id)->get();
    	$service =DB::table('service_tbl')->where('status',1)->get();
    	return response()->json([$servgroup,$service]);
    }
    public function censusServiceCount(Request $req)
    {
    	$id = ($req->id)*1;

    	$date1 = date('Y-m-d',strtotime($req->date[0]))." 00:00:00.000000";
    	$date2 = date('Y-m-d',strtotime($req->date[1]))." 00:00:00.000000";
    	
    	$count = DB::select(DB::raw("SELECT * FROM trans_result_service_tbl WHERE service_id = ".$id." AND date BETWEEN '".$date1."' AND '".$date2."'"));
    	
    	
    	return response()->json($count);
    }
}

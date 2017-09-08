<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class UpdateModalValues extends Controller
{
    public function updateEmployeeType(Request $req){
    	$emptype = DB::table('employee_role_tbl')->where('role_id',$req->id)->where('status',1)->get();
    	return response()->json($emptype);
    }
    public function updateServGroup(Request $req){
    	$servgroup = DB::table('service_group_tbl')->where('servgroup_id',$req->id)->where('status',1)->get();
    	return response()->json($servgroup);
    }
    public function updateServType(Request $req){
    	$servtype = DB::table('service_type_tbl')->where('service_type_id',$req->id)->where('status',1)->get();
    	return response()->json($servtype);	
    }
    public function updatePackage(Request $req){
        $servtype = DB::table('package_tbl')->where('pack_id',$req->id)->get();
        $servoffer = DB::table('package_service_tbl')->where('pack_serv_package_id',$req->id)->get();
        return response()->json([$servtype,$servoffer]); 
    }
    public function updateCorporate(Request $req){

        $servoffer = DB::table('corp_packserv_tbl')
            ->leftjoin('corp_package_tbl','corp_package_tbl.corpPack_id','=','corp_packserv_tbl.corpPack_id')
            ->leftjoin('corporate_accounts_tbl','corporate_accounts_tbl.corp_id','=','corp_package_tbl.corp_id')
            ->where('corp_package_tbl.corp_id',$req->id)
            ->get();
        return response()->json($servoffer); 
    }
}

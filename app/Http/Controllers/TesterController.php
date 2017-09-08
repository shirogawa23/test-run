<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class TesterController extends Controller
{   
    public function resultdashboard(){
        $servgroup = DB::table('service_group_tbl')->where('status',1)->get();
        return view('testers.resultdashboard',['servgroup'=>$servgroup]);
    }
    public function result_trans(){
        $servgroup_id = $_GET['id'];
        $group_name = DB::table('service_group_tbl')->where('servgroup_id',$servgroup_id)->get();
        foreach ($group_name as $g) {
            $servgroup_name = $g->servgroup_name;
        }
        $result_id = DB::select(DB::raw('SELECT DISTINCT transresult_tbl.result_id FROM trans_result_service_tbl,transresult_tbl WHERE service_group_id = '.$servgroup_id.' and trans_result_service_tbl.result_id = transresult_tbl.result_id and status = "PENDING"'));
        $res_id = array();
        foreach($result_id as $r)
        {
            $res_id[] = $r->result_id;
        }

        $trans_table = DB::table('transaction_tbl')
            ->leftjoin('patient_tbl','patient_tbl.patient_id','=','transaction_tbl.trans_patient_id')
            ->leftjoin('transresult_tbl','transresult_tbl.trans_id','=','transaction_tbl.trans_id')
            ->whereIn('transresult_tbl.result_id',$res_id)
            ->get();
        
        return view('testers.result_trans',['servgroup_name'=>$servgroup_name,'trans_table'=>$trans_table,'servgroup_id'=>$servgroup_id]);
    }
    public function add_result(){
        // $pid = $_GET['id'];
        // $emp_rebates = DB::table('employee_tbl')
        //     ->leftjoin('rolefields_tbl','rolefields_tbl.role_id','=','employee_tbl.emp_type_id')
        //     ->leftjoin('emp_rebate_tbl','emp_rebate_tbl.emp_id','=','employee_tbl.emp_id')
        //     ->leftjoin('employee_role_tbl','employee_role_tbl.role_id','=','employee_tbl.emp_type_id')
        //     ->where('rolefields_tbl.rebate',1)
        //     ->where('emp_rebate_tbl.status',1)->get();
        // $patientinfo = DB::table('patient_tbl')
        //     ->leftjoin('patient_type_tbl','patient_type_tbl.ptype_id','=','patient_tbl.patient_type_id')
        //     ->where('patient_tbl.status',1)
        //     ->where('patient_id',$pid)->get();

        // $service = DB::table('service_tbl')
        //     ->leftjoin('service_group_tbl','service_group_tbl.servgroup_id','=','service_tbl.service_group_id')
        //     ->leftjoin('service_type_tbl','service_type_tbl.service_type_id','=','service_tbl.service_type_id')
        //     ->where('service_tbl.status',1)->get();
        //,['patientinfo'=>$patientinfo,'service'=>$service,'emp_rebates'=>$emp_rebates]
        $trans_id = $_GET['trans_id'];
        $servgroup_id = $_GET['servgroup_id'];
        $result_id = $_GET['result_id'];
        $patient_id = $_GET['patient_id'];
        $services = DB::table('trans_result_service_tbl')
            ->leftjoin('service_tbl','service_tbl.service_id','=','trans_result_service_tbl.service_id')
            ->where('result_id',$result_id)
            ->where('trans_result_service_tbl.service_group_id',$servgroup_id)
            ->orWhere('result_id',$result_id)
            ->where('trans_result_service_tbl.service_group_id',null)
            ->get();
        
        $patient_info = DB::table('transaction_tbl')
            ->leftjoin('patient_tbl','patient_tbl.patient_id','=','transaction_tbl.trans_patient_id')
            ->where('trans_id',$trans_id)
            ->get();
        $group_name = DB::table('service_group_tbl')->select('servgroup_name')->where('servgroup_id',$servgroup_id)->get();
        foreach($group_name as $g)
        {
            $group_name = $g->servgroup_name;
        }
        foreach($patient_info as $p)
        {
            $date= date_create($p->trans_date);
            $transDate = date_format($date,'m/d/Y');
        }
        $remark = DB::table('transresult_tbl')->select('remarks')->where('result_id',$result_id)->get();
        foreach($remark as $r)
        {
            $remark = $r->remarks;
        }
        return view('testers.add_result',['services'=>$services,'patient_info'=>$patient_info,'group_name'=>$group_name,'transDate'=>$transDate,'remark'=>$remark]);
    }
    public function result_addlayout()
    {
        return view('testers.result_addlayout');
    }
}

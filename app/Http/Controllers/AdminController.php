<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class AdminController extends Controller
{
    
    public function getFields(Request $req){
      $var1 = DB::table('rolefields_tbl')->where('role_id',$req->ID)->get();
      return response()->json($var1);
    }
    public function updateEmpDetails(Request $req){
      
      $empdata = DB::select(DB::raw("SELECT * FROM employee_tbl e JOIN rolefields_tbl r ON r.role_id = e.emp_type_id LEFT OUTER JOIN medtech_rank m on m.rank_id =e.emp_medtech_rank_id WHERE e.emp_id = $req->id"));

      return response()->json($empdata);
    }
    public function viewEmpDetails(Request $req){
      
      $empdata = DB::select(DB::raw("SELECT * FROM employee_tbl e JOIN rolefields_tbl r ON r.role_id = e.emp_type_id LEFT OUTER JOIN medtech_rank m on m.rank_id =e.emp_medtech_rank_id WHERE e.emp_id = $req->id"));

      return response()->json($empdata);
    }
    
    public function getType(Request $req){
      $var = DB::table('service_type_tbl')->where('service_type_group_id',$req->ID)->get();
      return response()->json($var);
    }
    public function getService(Request $req){
      $var = DB::table('service_tbl')->where('service_id',$req->ID)->get();
      return response()->json($var);
    }
    public function emprebate(){
      $emp_worebates = DB::table('employee_tbl')
      ->leftjoin('rolefields_tbl','rolefields_tbl.role_id','=','employee_tbl.emp_type_id')
      ->leftjoin('emp_rebate_tbl','emp_rebate_tbl.emp_id','=','employee_tbl.emp_id')

      ->where('rolefields_tbl.rebate',1)
      ->where('emp_rebate_tbl.status',null)
      ->where('emp_rebate_tbl.emp_id',null)

      ->orwhere('rolefields_tbl.rebate',1)
      ->where('emp_rebate_tbl.status',0)->select('employee_tbl.emp_id as emp_id','emp_fname','emp_mname','emp_lname')->get();

      $emp_rebates = DB::table('employee_tbl')
      ->leftjoin('rolefields_tbl','rolefields_tbl.role_id','=','employee_tbl.emp_type_id')
      ->leftjoin('emp_rebate_tbl','emp_rebate_tbl.emp_id','=','employee_tbl.emp_id')
      ->leftjoin('employee_role_tbl','employee_role_tbl.role_id','=','employee_tbl.emp_type_id')
      ->where('rolefields_tbl.rebate',1)
      ->where('emp_rebate_tbl.status',1)->get();

      return view('EmpRebate',['emp_rebates'=>$emp_rebates,'emp_worebates'=>$emp_worebates]);
    }
    public function rebate(){
      $rebate = DB::table('rebate_tbl')->orderBy('created_at','desc')->get();
      return view('Rebate',['rebate'=>$rebate]);
    }

   
    public function corporate(){
        $corporates = DB::table('corporate_accounts_tbl')->where('status',1)->get();
        $packages = DB::table('package_tbl')->where('status',1)->get();
        $servicegroup = DB::table('service_group_tbl')->where('status',1)->get();
        $serviceoffer = DB::table('service_tbl')
          ->leftjoin('service_group_tbl','service_group_tbl.servgroup_id','=','service_tbl.service_group_id')
          ->leftjoin('service_type_tbl','service_type_tbl.service_type_id','=','service_tbl.service_type_id')->where('service_tbl.status',1)->get();
        return view('Corporate',['corporates'=>$corporates,'packages'=>$packages,'servicegroup'=>$servicegroup,'serviceoffer'=>$serviceoffer]);
    }
           
    public function package(){
      $servicegroup = DB::table('service_group_tbl')->where('status',1)->get();
      $serviceoffer = DB::table('service_tbl')
        ->leftjoin('service_group_tbl','service_group_tbl.servgroup_id','=','service_tbl.service_group_id')
        ->leftjoin('service_type_tbl','service_type_tbl.service_type_id','=','service_tbl.service_type_id')->where('service_tbl.status',1)->get();
      $packages = DB::select(DB::raw("SELECT * FROM package_tbl WHERE status = 1"));
      return view('Package',['serviceoffer'=>$serviceoffer,'packages'=>$packages,'servicegroup'=>$servicegroup]);
    }
    public function service(){
        $groupdropdown = DB::table('service_group_tbl')->where('status',1)->get();
        $typedropdown = DB::table('service_group_tbl')->join('service_type_tbl','service_type_tbl.service_type_group_id','=','service_group_tbl.servgroup_id')->get();
        
        $service = DB::table('service_tbl')
        ->leftjoin('service_group_tbl','service_group_tbl.servgroup_id','=','service_tbl.service_group_id')
        ->leftjoin('service_type_tbl','service_type_tbl.service_type_id','=','service_tbl.service_type_id')
        ->where('service_tbl.status',1)
        ->get();

      return view('Service',['service'=>$service,'groupdropdown'=>$groupdropdown,'typedropdown'=>$typedropdown]);
    }
    public function servicegroup(){
      $serviceGroups = DB::table('service_group_tbl')->where('status',1)->get();
      return view('ServiceGroup',['serviceGroups'=>$serviceGroups]);
    }
    public function servicetype(){
        $serviceGroup = DB::table('service_group_tbl')->where('status',1)->get();
        $serviceType = DB::table('service_group_tbl')->join('service_type_tbl','service_type_tbl.service_type_group_id','=','service_group_tbl.servgroup_id')->where('service_type_tbl.status',1)->where('service_group_tbl.status',1)->get();
      return view('ServiceType',['serviceType'=>$serviceType,'serviceGroup'=>$serviceGroup]);
    }
    public function dashboard(){
    	return view('dashboard');
    }
    public function EmployeeType(){
    	$emptype = DB::table('employee_role_tbl')->where('status',1)->get();
    	return view('EmployeeType',['emptype'=> $emptype]);
    }
    public function employee(){

        $emp1 = DB::table('employee_tbl')->join('employee_role_tbl','employee_role_tbl.role_id','=','employee_tbl.emp_type_id')->where('employee_tbl.status',1)->get();
        $empTypes = DB::table('employee_role_tbl')->where('status',1)->get();
        $ranks = DB::table('medtech_rank')->where('status',1)->get();
        return view('Employee',['emp1' => $emp1,'empTypes'=> $empTypes,'ranks'=>$ranks] );

    }
   	
    
    public function deleteEmployeeType(){
      DB::table('employee_role_tbl')->where('role_id',$_POST['id'])->update(['status'=>0]);
      return redirect('/EmployeeType');
    }
    public function deleteEmployee(){
      DB::table('employee_tbl')->where('emp_id',$_POST['id'])->update(['status'=>0]);
      return redirect('/Employee');
    }
    public function deleteServiceGroup(){
      DB::table('service_group_tbl')->where('servgroup_id',$_POST['id'])->update(['status'=>0]);
      return redirect('/ServiceGroup');
    }
    public function deleteServiceType(){
      DB::table('service_type_tbl')->where('service_type_id',$_POST['id'])->update(['status'=>0]);
      return redirect('/ServiceType');
    }
    public function deleteService(){
      DB::table('service_tbl')->where('service_id',$_POST['id'])->update(['status'=>0]);
      return redirect('/Service');
    }
    public function deletePackage(){
      DB::table('package_tbl')->where('pack_id',$_POST['id'])->update(['status'=>0]);
      return redirect('/Package');
    }
    public function deleteCorporate(){
      DB::table('corporate_accounts_tbl')->where('corp_id',$_POST['id'])->update(['status'=>0]);
      return redirect('/Corporate');
    }
    public function deleteRebate(){
      DB::table('emp_rebate_tbl')->where('emp_id',$_POST['id'])->update(['status'=>0]);
      return redirect('/EmpRebate');
    }

}

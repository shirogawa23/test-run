<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
class SaveUpdateModals extends Controller
{
    public function update_employee(){
      $empid = ($_POST['update_emp_id'])*1;

      $emp_type = $_POST['update_emp_type'];
      $checkfields = DB::table('rolefields_tbl')->where('role_id',$emp_type)->get();
      $firstname = $_POST['firstname'];
      $middlename = $_POST['middlename'];
      $lastname = $_POST['lastname'];
      $rank_id = null;
      $address = null;
      $contact = null;
      $license = null;
      $username = null;
      $password = null;
     
      if($checkfields[0]->address==1){
        $address = $_POST['address'];
      }
      
      if($checkfields[0]->license==1){
        $license = $_POST['license'];
        
      }
      if($checkfields[0]->contact==1){
        $contact = $_POST['contact'];
        
      }
      
      DB::table('employee_tbl')->where('emp_id',$empid)
      ->update([
        'emp_fname'=>$firstname,
        'emp_mname'=>$middlename,
        'emp_lname'=>$lastname,
        'emp_address'=>$address,
        'license_no'=>$license,
        'emp_contact'=>$contact
      ]);

      

      DB::table('employee_log_tbl')->insert
      ([
        'emp_id'=>$empid,
        'emp_fname'=>$firstname,
        'emp_mname'=>$middlename,
        'emp_lname'=>$lastname,
        'emp_address'=>$address,
        'license_no'=>$license,
        'emp_contact'=>$contact,
        'updated_at'=>date_create('now')
        ]);
    	Session::flash('title', 'Success!');
      	Session::flash('type', "success");
      	Session::flash('message', "Record Successfully Updated!");
    	return redirect()->back();
    }
    public function save_empRebate(){
      $rebate_id = DB::table('rebate_tbl')->where('created_at','>','CURRENT_DATE')->select('rebate_id')->max('rebate_id');
      $emp_id = $_POST['emp_id'];
      DB::table('emp_rebate_tbl')
      ->insert([
        'emp_id'  =>  $emp_id,
        'rebate_id' =>  $rebate_id,
        'status'  =>  1
      ]);
      DB::table('emprebate_log_tbl')
      ->insert([
        'emp_id'  =>  $emp_id,
        'rebate_id' =>  $rebate_id,
        'updated_at'  =>  date_create('now')
      ]);
      Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', "Rebate Successfully Added!");
      return redirect('/EmpRebate');
    }
    public function save_rebatePercentage(){
      $rebatepercent = $_POST['rebatepercent'];
      DB::table('rebate_tbl')->insert
      ([
        'percentage'=>$rebatepercent,
        'created_at'=>date_create('now')
      ]);
       Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', "Successfully Added!");
      return redirect('/Rebate');
    }
    public function save_patient(){
      $patienttype = $_POST['patienttype'];
      $patient_fname  = $_POST['patient_fname'];
      $patient_mname  = $_POST['patient_mname'];
      $patient_lname  = $_POST['patient_lname'];
      $patient_address  = $_POST['patient_address'];
      $patient_contact  = $_POST['patient_contact'];
      $birthday = $_POST['birthday'];
      $age  = $_POST['age'];
      $gender = $_POST['gender'];
      $addcorpid= null;
      if($patienttype == 2){
        $addcorpid  = $_POST['addcorpid'];
      }
      DB::table('patient_tbl')->insert([
        'patient_fname' =>  $patient_fname,
        'patient_mname' =>  $patient_mname,
        'patient_lname' =>  $patient_lname,
        'patient_address' =>  $patient_address,
        'patient_contact' =>  $patient_contact,
        'patient_birthdate' =>  $birthday,
        'age'   =>  $age,
        'patient_gender'  =>  $gender,
        'patient_type_id' =>  $patienttype,
        'patient_corp_id' =>  $addcorpid
      ]);

      $patient_id = DB::table('patient_tbl')
        ->select('patient_id')
        ->max('patient_id');
        

      DB::table('patient_log_tbl')->insert([
        'patient_id'    =>  $patient_id,
        'patient_fname' =>  $patient_fname,
        'patient_mname' =>  $patient_mname,
        'patient_lname' =>  $patient_lname,
        'patient_address' =>  $patient_address,
        'patient_contact' =>  $patient_contact,
        'patient_birthdate' =>  $birthday,
        'age'   =>  $age,
        'patient_gender'  =>  $gender,
        'patient_type_id' =>  $patienttype,
        'patient_corp_id' =>  $addcorpid,
        'updated_at'    =>  date_create('now')
      ]);
       Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', "Successfully Added!");
      return redirect('/frontdesk_trans');
    }
    public function save_corp(){
      $companyname  = $_POST['companyname'];
      $contactperson  = $_POST['contactperson'];
      $contactnumber  = $_POST['contactnumber'];
      $packprice = $_POST['packprice'];
      $services = $_POST['services'];
      $email  = $_POST['email'];
      
      DB::table('corporate_accounts_tbl')->insert([
        'corp_name' =>  $companyname,
        'corp_contact'  =>  $contactnumber,
        'corp_email'  =>  $email,
        'corp_contactperson'  =>$contactperson
      ]);
      $corp_id = DB::table('corporate_accounts_tbl')->select('corp_id')->max('corp_id');

      DB::table('corporate_accounts_log_tbl')->insert([
        'corp_id' =>  $corp_id,
        'corp_name' =>  $companyname,
        'corp_contact'  =>  $contactnumber,
        'corp_email'  =>  $email,
        'corp_contactperson'  =>$contactperson,
        'updated_at'  =>  date_create('now')
      ]);

      DB::table('corp_package_tbl')
        ->insert([
          'corp_id' =>  $corp_id,
          'price' =>  $packprice,
          'status'  =>  1
        ]);
      DB::table('corp_package_log_tbl')
        ->insert([
          'corp_id' =>  $corp_id,
          'price' =>  $packprice,
          'updated_at'  => date_create('now')
        ]);
      $corpPack_id = DB::table('corp_package_tbl')->select('corpPack_id')->max('corpPack_id');
      foreach($services as $ps)
      {
        DB::table('corp_packserv_tbl')
          ->insert([
            'corpPack_id' =>  $corpPack_id,
            'service_id'  =>  $ps
          ]);
        DB::table('corp_packserv_log_tbl')
          ->insert([
            'corpPack_id' =>  $corpPack_id,
            'service_id'  =>  $ps,
            'updated_at'  =>  date_create('now')
          ]);
      }
       Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', "Successfully Added!");
      return redirect('/Corporate');
    }
    public function save_package(){
      $packagename = $_POST['packagename'];
      $services  =$_POST['services'];
      $packageprice = $_POST['packageprice'];
      DB::table('package_tbl')->insert([
        'pack_name' =>  $packagename,
        'pack_price'  =>  $packageprice
      ]);
      $pack_id = DB::table('package_tbl')->select('pack_id')->max('pack_id');
      DB::table('package_log_tbl')->insert([
        'pack_id' =>  $pack_id,
        'pack_name' =>  $packagename,
        'pack_price'  =>  $packageprice,
        'updated_at'  =>  date_create('now')
      ]);
      foreach($services as $servid)
      {
        DB::table('package_service_tbl')->insert([
          'pack_serv_package_id'  =>  $pack_id,
          'pack_serv_serv_id'     =>  $servid
        ]);
        DB::table('package_service_log_tbl')->insert([
          'packserv_package_id'  =>  $pack_id,
          'packserv_serv_id'     =>  $servid,
          'updated_at'          =>  date_create('now')
        ]);
      }
      Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', "Successfully Added!");
      return redirect('/Package');
    }
    public function save_employee(){
      $emp_type = $_POST['emp_type'];
      $checkfields = DB::table('rolefields_tbl')->where('role_id',$emp_type)->get();
      $emp_type = $_POST['emp_type'];
      $firstname = $_POST['firstname'];
      $middlename = $_POST['middlename'];
      $lastname = $_POST['lastname'];
      $rank_id = null;
      $address = null;
      $contact = null;
      $license = null;
      $username = null;
      $password = null;
      $createaccountctr = null;

      if($checkfields[0]->rank==1){
        $rank_id = $_POST['rank_id'];
      }
      if($checkfields[0]->address==1){
        $address = $_POST['address'];
      }
      
      if($checkfields[0]->license==1){
        $license = $_POST['license'];
        
      }
      if($checkfields[0]->contact==1){
        $contact = $_POST['contact'];
        
      }
      if($checkfields[0]->username==1){
        $username = $_POST['username'];
        $createaccountctr = 1;

      }
      if($checkfields[0]->password==1){
        $password = $_POST['password'];
        $confirmpass = $_POST['confirmpass'];
        
      }
      DB::table('employee_tbl')->insert
      ([
        'emp_fname'=>$firstname,
        'emp_mname'=>$middlename,
        'emp_lname'=>$lastname,
        'emp_type_id'=>$emp_type,
        'emp_medtech_rank_id'=>$rank_id,
        'emp_address'=>$address,
        'license_no'=>$license,
        'emp_contact'=>$contact
      ]);

      $empid = DB::table('employee_tbl')->select('emp_id')->max('emp_id');

      DB::table('employee_log_tbl')->insert
      ([
        'emp_id'=>$empid,
        'emp_fname'=>$firstname,
        'emp_mname'=>$middlename,
        'emp_lname'=>$lastname,
        'emp_address'=>$address,
        'license_no'=>$license,
        'emp_contact'=>$contact,
        'updated_at'=>date_create('now')
        ]);

      if($createaccountctr <> null)
      {
        $getEmpData = DB::table('employee_tbl')->select('emp_id')->max('emp_id');
        DB::table('users')->insert(
          [
          'username'  =>  $username,
          'password'  =>  bcrypt($password),
          'role_id'   =>  $emp_type,
          'display_name'  =>  $firstname,
          'created_at'  =>  date_create('now'),
          'updated_at'  =>  date_create('now'),
          'emp_id'  =>  $getEmpData
          ]
        );
      }
       Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', "Successfully Added!");
      return redirect('/Employee');
      
    }
    public function update_empType(){
    	$upemptype_id = $_POST['upemptype_id'];
    	$updateemptype = $_POST['updateemptype'];
    	DB::table('employee_role_tbl')->where('role_id',$upemptype_id)->update(['role_name'=>$updateemptype]);
      Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', "Successfully Updated!");
    	return redirect('/EmployeeType');
    }
    public function update_servType(){
    	$upservtypeid = $_POST['upservTypeId'];
    	$upservTypeName = $_POST['upservTypeName'];
    	DB::table('service_type_tbl')->where('service_type_id',$upservtypeid)->update(['service_type_name'=>$upservTypeName]);
      DB::table('service_type_log_tbl')->insert([
        'service_type_id'=>$upservtypeid,
        'service_type_name'=>$upservTypeName,
        'updated_at'=>date_create('now')
      ]);
      Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', "Successfully Updated!");
    	return redirect('/ServiceType');
    }

    public function update_servGroup(){
    	$upservice_id = $_POST['upservice_id'];
    	$upservicegroup = $_POST['upservicegroup'];
    	DB::table('service_group_tbl')->
      where('servgroup_id',$upservice_id)->
      update([
        'servgroup_name'=>$upservicegroup
      ]);
      DB::table('servgroup_log_tbl')->insert([
        'servgroup_id'=>$upservice_id,
        'servgroup_name'=>$upservicegroup,
        'updated_at'=>date_create('now')
      ]);
      Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', "Successfully Updated!");
    	return redirect('/ServiceGroup');
    }
    public function save_servGroup(){
    $servGroupName = ucfirst($_POST['servicegroup']);
    DB::table('service_group_tbl')->insert([
      'servgroup_name'=>$servGroupName
      ]);
    $servgroup_id = DB::table('service_group_tbl')->select('servGroup_id')->max('servgroup_id');

    DB::table('servgroup_log_tbl')->insert([
      'servgroup_id'  =>  $servgroup_id,
      'servgroup_name'  =>  $servGroupName,
      'updated_at'    =>  date_create('now')
    ]);
     Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', $servGroupName." Successfully Added!");
    return redirect('/ServiceGroup');
    }
    public function save_servType(){
      $servGroup_id = $_POST['servGroup_id'];
      $servTypeName = $_POST['servTypeName'];
      DB::table('service_type_tbl')->insert(['service_type_name'=>$servTypeName,'service_type_group_id'=>$servGroup_id]);
       Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', $servTypeName." Successfully Added!");
      return redirect('/ServiceType');
    }
    public function save_Service(){
    	$srvcname = $_POST['srvcname'];
    	$srvcgrp_id = $_POST['srvcgrp_id'];
    	$srvctyp_id = $_POST['srvctyp_id'];
    	$srvc_price = $_POST['srvc_price'];
      if($srvcgrp_id==0){
        $srvcgrp_id=null;
      }
      if($srvctyp_id==0){
        $srvctyp_id=null;
      }
      DB::table('service_tbl')->insert
      ([
        'service_name'=>$srvcname,
        'service_group_id'=>$srvcgrp_id,
        'service_type_id'=>$srvctyp_id,
        'service_price'=>$srvc_price
      ]);
      $service_id = DB::table('service_tbl')->select('service_id')->max('service_id');
    	DB::table('service_log_tbl')->insert(
        [
          'service_name'=>$srvcname,
          'service_id'=>$service_id,
          'service_price'=>$srvc_price,
          'updated_at'=>date_create('now')
        ]);
       Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', $srvcname." Successfully Added!");
    	 return redirect('/Service');
    }
    public function save_empType(){
   		$x = array();
      $x[0]=0;
      $x[1]=0;
      $x[2]=0;
      $x[3]=0;
      $x[4]=0;
      $x[5]=0;
      $x[6]=0;
   		if (isset($_POST['number'])) {
   			$x[0]=1;
   		}
   		if (isset($_POST['account'])) {
   			$x[1]=1;
        $x[2]=1;  
   		}
   		if (isset($_POST['license'])) {
   			$x[3]=1;
   		}
   		if (isset($_POST['rank'])) {
   			$x[4]=1;
   		}
   		if (isset($_POST['address'])) {
   			$x[5]=1;
   		}
      if (isset($_POST['rebate'])) {
        $x[6]=1;
      }
   		DB::table('employee_role_tbl')->insert(['role_name'=>$_POST['emptype'],'status'=> 1]);
   		$role_id = DB::table('employee_role_tbl')->select('role_id')->max('role_id');
   		DB::table('rolefields_tbl')->insert(['role_id'=>$role_id,'address'=>$x[5],'rank'=>$x[4],'username'=>$x[1],'password'=>$x[2],'contact'=>$x[0],'license'=>$x[3],'status'=>1,'rebate'=>$x[6]]);
      Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', "Successfully Added!");
   		return redirect('/EmployeeType');
   	}
   	public function update_package(){
        DB::table('package_tbl')->where('pack_id',$_POST['packid'])->update([
            'pack_name' => $_POST['packagename'],
            'pack_price' => $_POST['packageprice'] ,
            ]);
      $services  = $_POST['services'];
      DB::table('package_service_tbl')->where('pack_serv_package_id',$_POST['packid'])->delete();
      foreach($services as $servid)
      {
        DB::table('package_service_tbl')->insert([
          'pack_serv_package_id'  =>  $_POST['packid'],
          'pack_serv_serv_id'     =>  $servid
        ]);
        DB::table('package_service_log_tbl')->insert([
          'packserv_package_id'  =>  $_POST['packid'],
          'packserv_serv_id'     =>  $servid,
          'updated_at'          =>  date_create('now')
        ]);
      }
      Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', "Successfully Updated!");
      return redirect('/Package');
    }   
    public function update_Corporate(){
      $upserv = $_POST['upservices'];
      $upcompanyname  = $_POST['upcompname'];
      $upcontactperson  = $_POST['upcontactperson'];
      $upcontactnumber  = $_POST['upcontactnumber'];
      $upemail  = $_POST['upemail'];
      $upcorpid = ($_POST['upcorpid'])+0;

      DB::table('corporate_accounts_tbl')->where('corp_id',$_POST['upcorpid'])->update([
            'corp_name' => $upcompanyname,
            'corp_contactperson' => $upcontactperson,
            'corp_contact' => $upcontactnumber,
            'corp_email' => $upemail,
            ]);
      DB::table('corporate_accounts_log_tbl')
        ->insert([
          'corp_id' =>  $_POST['upcorpid'],
          'corp_name' => $upcompanyname,
          'corp_contactperson' => $_POST['upcontactperson'],
          'corp_contact' => $_POST['upcontactnumber'],
          'corp_email' => $_POST['upemail'],
          'updated_at'  =>  date_create('now')
        ]);
      DB::table('corp_package_tbl')
        ->update([
          'price' =>  $_POST['uppackprice']
        ]);
      DB::table('corp_package_log_tbl')
        ->insert([
          'corp_id' => $_POST['upcorpid'],
          'price' =>  $_POST['uppackprice'],
          'updated_at'  => date_create('now')
        ]);
      $id = DB::table('corp_package_tbl')->select('corpPack_id')->where('corp_package_tbl.corp_id',$upcorpid)->get();
      foreach ($id as $i)
      {
        $corpPack_id = $i->corpPack_id;
      }
      DB::table('corp_packserv_tbl')
        ->where('corpPack_id',$corpPack_id)
        ->delete();
      foreach($upserv as $ups)
      {
        DB::table('corp_packserv_tbl')
        ->insert([
          'corpPack_id' => $corpPack_id,
          'service_id'  => $ups
        ]);
        DB::table('corp_packserv_log_tbl')
        ->insert([
          'corpPack_id' => $corpPack_id,
          'service_id'  => $ups,
          'updated_at'  => date_create('now')
        ]);
      }
      Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', "Successfully Updated!");
      return redirect('/Corporate');
    }
    public function update_service(){

      
      
      DB::table('service_tbl')->where('service_id',$_POST['srvcid'])->update([
            'service_name' => $_POST['srvcname'],
            'service_price' => $_POST['srvc_price'],
            ]);
      DB::table('service_log_tbl')
        ->insert([
            'service_id'  =>  $_POST['srvcid'],
            'service_name' => $_POST['srvcname'],
            'service_price' => $_POST['srvc_price'],
            'updated_at'  => date_create('now')
          ]);
      Session::flash('title', 'Success!');
      Session::flash('type', "success");
      Session::flash('message', "Successfully Updated!");
      return redirect('/Service');
    }
}

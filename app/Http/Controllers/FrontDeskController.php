<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class FrontDeskController extends Controller
{
    public function retrieveReciept(Request $req)
    {
        $transaction_details = DB::table('transaction_tbl')->where('trans_id',$req->ID)->get();
        foreach($transaction_details as $td)
        {
            $emp_id = $td->issuedBy_emp_id;
            $patient_id = $td->trans_patient_id;
        }
        $ref_id = DB::table('trans_emprebate_tbl')->select('emp_id')->where('trans_id',$req->ID)->get();
        $rid = 0;
        foreach($ref_id as $rid)
        {
            $rid = $rid->emp_id;
        }
        $referring_name = DB::select(DB::raw('SELECT CONCAT(emp_fname," ",emp_mname," ",emp_lname ) as Name FROM employee_tbl  WHERE emp_id = '.$rid));
        $emp_name = DB::select(DB::raw('SELECT CONCAT(emp_fname," ",emp_mname," ",emp_lname ) as Name FROM employee_tbl  WHERE emp_id = '.$emp_id));
        $patient_name = DB::select(DB::raw('SELECT CONCAT(patient_fname," ",patient_mname," ",patient_lname ) as Name FROM patient_tbl WHERE patient_id ='.$patient_id));
        $claimCode = DB::table('transresult_tbl')->select('claimCode')->where('trans_id',$req->ID)->get();

        $result_id = DB::table('transresult_tbl')->select('result_id')->where('trans_id',$req->ID)->get();
        foreach($result_id as $result_id)
        {
            $result_id = $result_id->result_id;
        }
        $services = DB::table('trans_serv_tbl')
            ->where('trans_id',$req->ID)
            ->get();
        $corpPackCharge = DB::table('transcorp_tbl')
            ->leftjoin('corp_package_tbl','corp_package_tbl.corp_id','=','transcorp_tbl.corp_id')
            ->leftjoin('corporate_accounts_tbl','corporate_accounts_tbl.corp_id','=','transcorp_tbl.corp_id')
            ->where('trans_id',$req->ID)->get();
        $corpPackage = DB::table('transcorp_tbl')
                        ->leftjoin('corp_package_tbl','corp_package_tbl.corp_id','=','transcorp_tbl.corp_id')
                        ->leftjoin('corp_packserv_tbl','corp_packserv_tbl.corpPack_id','=','corp_package_tbl.corpPack_id')
                        ->leftjoin('service_tbl','service_tbl.service_id','=','corp_packserv_tbl.service_id')
                        ->where('transcorp_tbl.trans_id',$req->ID)
                        ->get();
        $companyPackage = DB::table('trans_pack_tbl')
                            ->leftjoin('package_tbl','package_tbl.pack_id','=','trans_pack_tbl.pack_id')
                            ->where('trans_id',$req->ID)
                            ->get();
        foreach($companyPackage as $compackage)
        {
            $pack_id = $compackage->pack_id;
        }
        $packageServ = [];
        if(count($companyPackage)>0)
        {$packageServ = DB::table('package_service_tbl')
                                ->leftjoin('service_tbl','service_tbl.service_id','=','package_service_tbl.pack_serv_serv_id')
                                ->where('pack_serv_package_id',$pack_id)
                                ->get();}
        return response()->json([$transaction_details,$emp_name,$patient_name,$claimCode,$referring_name,$services,$corpPackCharge,$corpPackage,$companyPackage,$packageServ]);
    }   
    public function frontdeskdashboard(){
    	return view('frontdesk.frontdeskdashboard');
    }
    
    public function frontdesk_trans(){
    	$patienttype = DB::table('patient_type_tbl')
            ->where('status',1)
            ->get();

    	$corps = DB::table('corporate_accounts_tbl')
            ->where('status',1)
            ->get();

    	$table = DB::table('patient_tbl')
            ->join('patient_type_tbl','patient_type_tbl.ptype_id','=','patient_tbl.patient_type_id')
            ->where('patient_tbl.status',1)
            ->get();

    	return view('frontdesk.frontdesk_trans',['patienttype'=>$patienttype,'corps'=>$corps,'table'=>$table]);
    }
    public function processMedicalService(){
    	$pid = $_GET['id'];
        
        $emp_rebates = DB::table('employee_tbl')
            ->leftjoin('rolefields_tbl','rolefields_tbl.role_id','=','employee_tbl.emp_type_id')
            ->leftjoin('emp_rebate_tbl','emp_rebate_tbl.emp_id','=','employee_tbl.emp_id')
            ->leftjoin('employee_role_tbl','employee_role_tbl.role_id','=','employee_tbl.emp_type_id')
            ->where('rolefields_tbl.rebate',1)
            ->where('emp_rebate_tbl.status',1)->get();
    	$patientinfo = DB::table('patient_tbl')
            ->leftjoin('patient_type_tbl','patient_type_tbl.ptype_id','=','patient_tbl.patient_type_id')
            ->where('patient_tbl.status',1)
            ->where('patient_id',$pid)->get();
        
        $package = DB::table('package_tbl')
            ->where('status',1)
            ->get();
        $servicegroup = DB::table('service_group_tbl')->where('status',1)->get();
        
     	$service = DB::table('service_tbl')
            ->leftjoin('service_group_tbl','service_group_tbl.servgroup_id','=','service_tbl.service_group_id')
            ->leftjoin('service_type_tbl','service_type_tbl.service_type_id','=','service_tbl.service_type_id')
            ->where('service_tbl.status',1)
            ->get();
        foreach($patientinfo as $s)
        {
            $ptype_id = $s->patient_type_id;
        }

    	return view('frontdesk.frontdesk_medicalservice',['patientinfo'=>$patientinfo,'service'=>$service,'emp_rebates'=>$emp_rebates,'ptype_id'=>$ptype_id,'servicegroup'=>$servicegroup,'package'=>$package]);
    }
    
    public function getDataService(Request $req){
        $servicedetails = DB::table('service_tbl')
            ->leftjoin('service_group_tbl','service_group_tbl.servgroup_id','=','service_tbl.service_group_id')
            ->where('service_id',$req->id)
            ->get();
        return response()->json($servicedetails);
    }
    public function getCompanyPackage(Request $req)
    {
        $package = DB::table('package_tbl')
            ->where('pack_id',$req->id)
            ->get();
        return response()->json($package);
    }
    public function getDataPackage(Request $req){
        $packagedetails = DB::table('corp_package_tbl')
            ->where('corp_id',$req->id)
            ->get();
        return response()->json($packagedetails);
    }
    public function proceed_Payment(){
        $issuedBy='32';
        $patient_id = $_POST['patient_id'] ;
        $patient_type_id = $_POST['patient_type_id'];
        $package_total = 0;
        $service_total = 0;
        $serv_id = [];
        // if($_POST['emp_id']>0)
        // {
        //     $emprebate_id = $_POST['emp_id'];
        // }
        // else
        // {
        //     $emprebate_id=null;
        // }
        // if( isset($_POST['package_id']))
        // {
        //     $package_id = $_POST['package_id'];
        //     $plogid=0;
        //     $plog_id = DB::select(DB::raw('SELECT MAX(packageLog_id)as pack_id FROM package_log_tbl WHERE updated_at < CURRENT_DATE and  pack_id ='.$package_id.' GROUP BY pack_id '));
        //     foreach($plog_id as $plog_id)
        //     {
        //         $plogid = $plog_id->pack_id;
        //     }
        //     // $package_details = DB::select(DB::raw('SELECT * FROM package_log_tbl WHERE pack_id = '.$package_id.' and updated_at < CURRENT_DATE and packageLog_id = (SELECT MAX(packageLog_id) FROM package_log_tbl)'));
            
        //     $package_details = DB::table('package_tbl')
        //         ->where('pack_id',$package_id)
        //         ->where('status',1)
        //         ->get();
        //     // $servicePackage = DB::select(DB::raw('SELECT * FROM `package_service_log_tbl` LEFT OUTER JOIN service_log_tbl on service_log_tbl.service_id = package_service_log_tbl.packserv_serv_id where  package_service_log_tbl.updated_at in (SELECT updated_at from package_service_log_tbl WHERE updated_at < CURRENT_DATE) and package_service_log_tbl.packserv_package_id = '.$package_id));
        //     // $servicePackage = DB::table('package_service_tbl')
        //     //     ->leftjoin('package_tbl','package_tbl.pack_id','=','package_service_tbl.pack_serv_package_id')
        //     //     ->leftjoin('service_tbl','service_tbl.service_id','=','package_service_tbl.pack_serv_serv_id')
        //     //     ->where('pack_serv_package_id',$package_id)
        //     //     ->get();
        //     foreach($package_details as $pd)
        //     {
        //         $package_total = $pd->pack_price;
        //     }
        // }
        // else
        // {
        //     $package_id = null;
        // }

        

        $stotal=0;
        $current_date = date('m/d/Y');
        $empRebate_id = null;
        $name="N/A";
        // TABLE PART
        // $patientinfo = DB::table('patient_log_tbl')
        //     ->where('updated_at','>','CURRENT_DATE')
        //     ->where('patient_id',$patient_id)
        //     ->get();
        $patientinfo = DB::table('patient_tbl')
            ->where('patient_id',$patient_id)
            ->where('status',1)
            ->get();
        
        // $service = DB::table('service_log_tbl')
        //     ->whereIn('service_id',$medservice_id)
        //     ->where('updated_at','>','CURRENT_DATE')
        //     ->get();      
        
        if(isset($_POST['medservice_id'])){
            $medservice_id=$_POST['medservice_id']; 
            $service = DB::table('service_tbl')
                ->whereIn('service_id',$medservice_id)
                ->where('status',1)
                ->get();

            
            // $stotal = DB::table('service_log_tbl')
            //     ->select(DB::raw('SUM(service_price) as total_price'))
            //     ->whereIn('service_id',$medservice_id)
            //     ->where('updated_at','>','CURRENT_DATE')            
            //     ->get(); 

            $stotal = DB::table('service_tbl')
                ->select(DB::raw('SUM(service_price) as total_price'))
                ->whereIn('service_id',$medservice_id)
                ->where('status',1)
                ->get();
        
        foreach($stotal as $stotal)
        {
            $service_total = $stotal->total_price;
        }
        }
        
        $gtotal = $service_total+$package_total;
        // GENERATE CODE
        $code = "";
       function randStr($length){
        $allCharacters = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $allCharacters = str_shuffle($allCharacters);
        $randomKey = substr($allCharacters, 0, $length);
        
        return $randomKey;
        }

        $randomChar = randStr(4);
        $year = date('Y');

        $code = $year.'-'.$randomChar;
        $exit = 1;
        
        while($exit == 1)
        {
        $checkCode = DB::table('transresult_tbl')
            ->select('claimCode')
            ->where('claimCode',$code)->get();
            

        if(count($checkCode)>0)
        {
            
            $randomChar = randStr(4);
            $year = date('Y');
            $code = $year.'-'.$randomChar;   
            
        }
        else
        {
            $exit = 0;
        }
        }
        

        // if($emprebate_id !=  0)
        // {

        //    $name = DB::select(DB::raw('SELECT CONCAT(emp_fname," ",emp_mname," ",emp_lname ) as Name FROM employee_tbl  WHERE emp_id = '.$emprebate_id));
        //    // $sample = implode(", ",$name['Name']);
        //    foreach($name as $name)
        //    {
        //     $name = $name->Name;
        //    }
        // }


        
        
    $totalpriceinput = $_POST['totalpriceinput'];
    $paymentinput = $_POST['paymentinput'];
        DB::table('transaction_tbl')
                ->insert([
                    'trans_total'   =>  $totalpriceinput,
                    'trans_date'    =>  date_create('now'),
                    'trans_patient_id'  =>  $patient_id,
                    'issuedBy_emp_id'   =>  $issuedBy,
                    'trans_change'  =>  ($paymentinput - $totalpriceinput),
                    'trans_payment' =>  $paymentinput
                ]);
        $trans_id = DB::table('transaction_tbl')
                        ->select('trans_id')
                        ->max('trans_id');

       

        if($_POST['emp_id'] != 'null')
        {
            $emprebate_id = $_POST['emp_id'];
            $rebate_id = DB::table('rebate_tbl')->select('rebate_id')->max('rebate_id');
            DB::table('trans_emprebate_tbl')
                ->insert([
                    'emp_id'    =>  $emprebate_id,
                    'trans_id'  =>  $trans_id,
                    'rebate_id' =>  $rebate_id,
                    'date'      =>  date_create('now')
                ]);
        }
        DB::table('transresult_tbl')
            ->insert([
                'trans_id'  =>  $trans_id,
                'date'      =>  date_create('now'),
                'claimCode' =>  $code
            ]);

        $result_id = DB::table('transresult_tbl')
            ->select('result_id')
            ->max('result_id');
        
        if(isset($_POST['payWhere']))
        {
            $charge = $_POST['payWhere'];
            $corppackage_id = $_POST['corppackage_id'];
            DB::table('transcorp_tbl')
                ->insert([
                    'trans_id'  =>  $trans_id,
                    'date'    =>  date_create('now'),
                    'corp_id'   => $_POST['corp_id'],
                    'charge'  =>  $charge

            ]);
            $corpPack_id = $_POST['corppackage_id'];
            $srv = DB::table('corp_packserv_tbl')
                ->leftjoin('service_tbl','service_tbl.service_id','=','corp_packserv_tbl.service_id')
                ->where('corpPack_id',$corpPack_id)
                ->where('status',1)
                ->pluck('corp_packserv_tbl.service_id');

            $srv_details = DB::table('service_tbl')
                ->whereIn('service_id',$srv)
                ->get();
            
            foreach($srv_details as $srv_details)
            {
                $corpservice_id = $srv_details->service_id;
                $corpgroup_id = $srv_details->service_group_id;
                $corpservice_name = $srv_details->service_name;
                DB::table('trans_result_service_tbl')
                    ->insert([
                        'service_id'    =>  $corpservice_id,
                        'service_name'  =>  $corpservice_name,
                        'date'          =>  date_create('now'),
                        'result_id'     =>  $result_id,
                        'service_group_id'  =>  $corpgroup_id
                    ]);

            }
            
           

        }
        if(isset($_POST['package_id']))
        {
            $comp_id = $_POST['package_id'];
            $companypackage_id = [];
            foreach ($comp_id as $comPack_id) {
             array_push($companypackage_id,$comPack_id * 1);    
            }
            
            $comPackageDetails = DB::table('package_tbl')
                ->whereIn('pack_id',$companypackage_id)->get();

            foreach($comPackageDetails as $compackaged)
            {
                $pprice = $compackaged->pack_price;
                $ppack_name = $compackaged->pack_name;
                $ppid = $compackaged->pack_id;
                DB::table('trans_pack_tbl')
                    ->insert([
                        'trans_id'  =>  $trans_id,
                        'pack_id'   =>  $ppid,
                        'pack_price'    =>  $pprice,
                        'pack_name' =>  $ppack_name
                    ]);

                $servicePackage = DB::table('package_service_tbl')
                    ->leftjoin('package_tbl','package_tbl.pack_id','=','package_service_tbl.pack_serv_package_id')
                    ->leftjoin('service_tbl','service_tbl.service_id','=','package_service_tbl.pack_serv_serv_id')
                    ->where('pack_serv_package_id',$ppid)
                    ->get();
                foreach($servicePackage as $packservice)
                {
                    DB::table('trans_result_service_tbl')
                        ->insert([
                            'service_id'    =>  $packservice->pack_serv_serv_id,
                            'service_name'  =>  $packservice->service_name,
                            'date'          =>  date_create('now'),
                            'result_id'     =>  $result_id,
                            'service_group_id'  =>  $packservice->service_group_id

                        ]);
                }
            }
            $companypackserv = DB::table('package_service_tbl')
                ->whereIn('pack_serv_package_id',$companypackage_id)
                ->get();

            foreach($companypackserv as $cps)
            {
                $companypackservice_id = $cps->pack_serv_serv_id;
                $companypackservicedetails = DB::table('service_tbl')->where('service_id',$companypackservice_id)->get();
                foreach($companypackservicedetails as $cpsdetails)
                {
                    $comservice_id = $cpsdetails->service_id;
                    $comservgroup_id = $cpsdetails->service_group_id;
                    $comservname = $cpsdetails->service_name;
                    DB::table('trans_result_service_tbl')
                        ->insert([
                            'service_id'    =>  $comservice_id,
                            'service_name'  =>  $comservname,
                            'date'          =>  date_create('now'),
                            'result_id'     =>  $result_id,
                            'service_group_id'  =>  $comservgroup_id
                        ]);
                }
            }
            
                
            

        }
        if(isset($_POST['medservice_id']))
        {
            $serv_id = $_POST['medservice_id'];
            $serv = DB::table('service_tbl')
                ->whereIn('service_id',$serv_id)
                ->where('status',1)
                ->get();
            foreach ($serv as $serv) {
                $serviceid = $serv->service_id;
                $groupid = $serv->service_group_id;
                $servicename = $serv->service_name;
                $serviceprice = $serv->service_price;
                DB::table('trans_result_service_tbl')
                    ->insert([
                        'service_id'    =>  $serviceid,
                        'service_name'  =>  $servicename,
                        'date'          =>  date_create('now'),
                        'result_id'     =>  $result_id,
                        'service_group_id'  =>  $groupid
                   ]);
                DB::table('trans_serv_tbl')
                     ->insert([
                            'trans_id'  =>  $trans_id,
                            'serv_id'   =>  $serviceid,
                            'serv_name' =>  $servicename,
                            'service_price' =>  $serviceprice
                        ]);
            }
        }
        
        Session::put('transaction','');
        $transactionDetails = DB::table('transaction_tbl')->get();
        $transaction_id=0;
        $employee_id = 0;
        $patient_id = 0;
        $payment = 0;
        $change = 0;
        $total = 0;
        $trans_date = "";
        foreach($transactionDetails as $t)
        {
            $transaction_id = $t->trans_id;
            $employee_id = $t->issuedBy_emp_id;
            $patient_id = $t->trans_patient_id;
            $payment = $t->trans_payment;
            $change = $t->trans_change;
            $total = $t->trans_total;
            $trans_date = $t->trans_date;
        }
        
        Session::put('trans_id',$transaction_id);
        // $servicesRendered = DB::table('trans_')
        
        return redirect('frontdeskdashboard');
        
        //return view('frontdesk.frontdeskdashboard');
        // return view('frontdesk.frontdesk_proceedPayment',['service'=>$service,'patient'=>$patientinfo,'gtotal'=>$gtotal,'code'=>$code,'date'=>$current_date,'name'=>$name,'patient_type_id'=>$patient_type_id,'emprebate_id'=>$emprebate_id,'package_details'=>$package_details,'servicePackage'=>$servicePackage,'package_id'=>$package_id]);
    }
    

}

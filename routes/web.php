<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');

});

Route::post('/doLogin', 'LoginController@login');
// DASHBOARD
Route::get('/dashboard','AdminController@dashboard');

// admin controller
Route::get('ServiceGroup', 'AdminController@servicegroup');
Route::get('ServiceType', 'AdminController@servicetype');
Route::get('Service', 'AdminController@service');

Route::get('/EmployeeType','AdminController@EmployeeType');
Route::get('/Employee', 'AdminController@employee');

Route::get('/Package', 'AdminController@package');

Route::get('/Corporate','AdminController@corporate');

Route::get('/Rebate','AdminController@rebate');
Route::get('/EmpRebate','AdminController@emprebate');


Route::get('/getServiceType', 'AdminController@getType');
Route::get('/getService', 'AdminController@getService');
Route::get('/getFields','AdminController@getFields');
Route::get('/viewEmpDetails','AdminController@viewEmpDetails');
Route::get('/updateEmpDetails','AdminController@updateEmpDetails');
// Show Values in Update Modal
Route::get('/updateServGroup','UpdateModalValues@updateServGroup');
Route::get('/updateEmployeeType','UpdateModalValues@updateEmployeeType');
Route::get('/updatePackage','UpdateModalValues@updatePackage');
Route::get('/updateServType','UpdateModalValues@updateServType');
Route::get('/updateCorporate','UpdateModalValues@updateCorporate');

// Save Buttons Modals
// UPDATE
Route::post('/update_empType','SaveUpdateModals@update_empType');
Route::post('/update_servType','SaveUpdateModals@update_servType');
Route::post('/update_servGroup','SaveUpdateModals@update_servGroup');
Route::post('/update_package','SaveUpdateModals@update_package');
Route::post('/update_Corporate','SaveUpdateModals@update_Corporate');
Route::post('/update_Service','SaveUpdateModals@update_service');
Route::post('/update_employee','SaveUpdateModals@update_employee');

// SAVE
Route::post('/save_empType', 'SaveUpdateModals@save_empType');
Route::post('/save_servType','SaveUpdateModals@save_servType');
Route::post('/save_servGroup','SaveUpdateModals@save_servGroup');
Route::post('/save_Service','SaveUpdateModals@save_Service');
Route::post('/save_employee','SaveUpdateModals@save_employee');
Route::post('/save_package','SaveUpdateModals@save_package');
Route::post('/save_corp','SaveUpdateModals@save_corp');
Route::post('/save_patient','SaveUpdateModals@save_patient');
Route::post('/save_rebatePercentage','SaveUpdateModals@save_rebatePercentage');
Route::post('/save_empRebate','SaveUpdateModals@save_empRebate');

//Transaction
Route::post('/save_Transaction','FrontDeskController@save_Transaction');

//Reports
Route::get('/Census','ReportsController@Census');
Route::get('/censusReportData','ReportsController@censusReportData');
Route::get('/censusServiceCount','ReportsController@censusServiceCount');
//Front desk

Route::get('/frontdeskdashboard','FrontDeskController@frontdeskdashboard');
Route::get('/frontdesk_trans','FrontDeskController@frontdesk_trans');
Route::get('/processMedicalService','FrontDeskController@processMedicalService');//send ng row_id to medicalservice
Route::get('/getDataService','FrontDeskController@getDataService');
Route::get('/getDataPackage', 'FrontDeskController@getDataPackage');
Route::get('/getCompanyPackage','FrontDeskController@getCompanyPackage');
Route::get('/retrieveReciept','FrontDeskController@retrieveReciept');
Route::post('/proceed_Payment','FrontDeskController@proceed_Payment');
Route::get('/retrieveServices','FrontDeskController@retrieveServices');
Route::get('/resultdashboard','TesterController@resultdashboard');
Route::get('/result_trans','TesterController@result_trans');
Route::get('/add_result','TesterController@add_result');
Route::get('/result_addlayout','TesterController@result_addlayout');

//Delete 
Route::post('/deleteEmployeeType','AdminController@deleteEmployeeType');
Route::post('/deleteEmployee','AdminController@deleteEmployee');
Route::post('/deleteServiceGroup','AdminController@deleteServiceGroup');
Route::post('/deleteServiceType','AdminController@deleteServiceType');
Route::post('/deleteService','AdminController@deleteService');
Route::post('/deletePackage','AdminController@deletePackage');
Route::post('/deleteCorporate','AdminController@deleteCorporate');
Route::post('/deleteRebate','AdminController@deleteRebate');

//Check
Route::post('/checkname', 'ValidationController@checkpackage');
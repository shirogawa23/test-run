@extends ('menubar.admin')

@section ('title','Employee| GH Management System')

@section ('headerTitle','Employee')

@section ('tabname','Maintenance')

@section ('pagename','Employee')

@section ('content')

<section class="content">
	<div class="box box-primary">
    <div class="box-body">
      <table class="table table-bordered table-hover dataTable" id="empTable">
      <thead>
        <tr>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Middle Name</th>
          <th>Employee Type</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($emp1 as $emp1)
        <tr>
          <td>{{ $emp1->emp_lname }}</td>
          <td>{{ $emp1->emp_fname }}</td>
          <td>{{ $emp1->emp_mname }}</td>
          <td>{{ $emp1->role_name }}</td>
          <td>
            <button class="btn btn-warning btn-xs empupdateModalbtn" data-target="#updateModal" data-id="{{ $emp1->emp_id }}" data-toggle="modal"><i class="fa fa-wrench" aria-hidden="true"></i></button>
            <button class="btn btn-info btn-xs empviewModalbtn" data-target="#viewModal"  data-id="{{ $emp1->emp_id }}" data-toggle="modal"><i class="fa fa-desktop" aria-hidden="true"></i></button>
            <button class="btn btn-danger btn-xs empdeleteModalbtn" data-id="{{ $emp1->emp_id }}" ><i class="fa fa-trash" aria-hidden="true"></i></button>
          </td>
        </tr>

       
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
</section>
<div class="modal fade" id = "updateModal">
  <div class="modal-dialog" style="width: 60%">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        
        <h4 class="modal-title"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Update</h4>
      </div>
      <form action="/update_employee" method="POST" class="form-horizontal">
      <input type="hidden" name="update_emp_type" id="update_emp_type">
      <input type="hidden" name="update_emp_id" id = "update_emp_id">
        <div class="modal-body">
          <div class="form-group">
          </div>        
          <fieldset class="geninfoupdate">
          </fieldset>
        </div>
        <div class="modal-footer">
          <button  class="btn btn-xs btn-warning"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Update</button>
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
        </div>
        {{ csrf_field() }}
      </form>
    </div>  
  </div>
</div>

<div class="modal fade" id = "viewModal">
  <div class="modal-dialog" style="width: 60%">
    <div class="modal-content">
      <div class="modal-header btn-info">
        <h4 class="modal-title"><i class="fa fa-info-circle" aria-hidden="true"></i> View Record</h4>
      </div>
      <form action="/save_employee" method="POST" class="form-horizontal">
        <div class="modal-body">
          <div class="form-group">
          </div>        
          <fieldset class="geninfoview">
          </fieldset>
          <fieldset class="accountinfoview">
        </fieldset> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
        </div>
        {{ csrf_field() }}
      </form>
    </div>  
  </div>
</div>

<div class="modal fade" id = "deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-danger">
        
        <h4 class="modal-title"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Delete Record</h4>
      </div>
      <form action="#" method="POST">
        <div class="modal-body">
          <h4></h4>
          <input type="text" class="hidden" name="id" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
          <button  class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</button>
        </div>
      </form>
    </div>  
  </div>
</div>

<div class="modal fade" id = "addModal">
  <div class="modal-dialog" style="width: 70%">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h4 class="modal-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Employee</h4>
      </div>
      <form action="/save_employee" method="POST" class="form-horizontal"  id="EmpAdd">
        <div class="modal-body">
          
          <div class="form-group">
            <label class="col-xs-2 control-label" for="emp_type">Employee Type</label>
            <div class="col-xs-9 input-group">
                <span class="input-group-addon"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                <select class="form-control select2 employeeTypeDropDown" name="emp_type" id="emp_type" style="width: 100%;">
                <option value="0">Select Employee Type</option>
                @foreach($empTypes as $empTypes)
                  <option value="{{ $empTypes->role_id }}">{{ $empTypes->role_name }}</option>
                @endforeach
                </select>
            </div>
          </div>  

          <fieldset class="geninfo">
          </fieldset>
          <fieldset class="accountinfo">
        </fieldset> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
          <button  class="btn btn-xs btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
        </div>
        {{ csrf_field() }}
      </form>
    </div>  
  </div>
</div>

<form method="post" action="/deleteEmployee" id="delform">
{{csrf_field()}}
<input type="hidden" name="id" class="id">
</form>
@endsection
@section('datatables')

<script>
$(function () {
$('#empTable').DataTable({
  'paging'      : true,
  'lengthChange': true,
  'searching'   : true,
  'ordering'    : true,
  'info'        : true,
  'autoWidth'   : true
});
$(' <a class="btn btn-primary btn-sm pull-right" href="#addModal" data-toggle="modal" ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; Add </a>').appendTo('div.dataTables_filter');
$('.employeeTypeDropDown').select2({
  placeholder: "Select employee type"
});


  $('.empdeleteModalbtn').click(function(){
    $('#delform .id').val($(this).data('id'));
    $('#delform').submit();
  });

$('.employeeTypeDropDown').on('change',function(){ // onchange function ng service group dropdown
      var address = ""; 
      var username = ""; 
      var formChanges = ""; 
      var password = ""; 
      var rank = ""; 
      var license = ""; 
      var contact = ""; 
      var name = "";

      $.ajax
      ({
        url: '/getFields', //eto ung route para makuha ung mga service type na may parehong service type id
        type: 'get',
        data: {ID:$(this).val()}, // value ng selected sa dropdown ng service group
        dataType : 'json',
        success:function(response) { //eto ung response na galing sa controller na kinquery
          response.forEach(function(data) { 
            address += data.address;
            username  += data.username;
            password  += data.password;
            rank  += data.rank;
            license += data.license;
            contact += data.contact;
            name += data.name;
          })
          $('.geninfo').empty(); 

          if(rank==1){
            $('.geninfo').append('<div class="form-group" id="medtechrank"> <label class="col-xs-3 control-label">Position</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-id-badge" aria-hidden="true"></i></div> <select class="form-control select2" name="rank_id" style="width: 100%;"> @php $ranks1 = $ranks @endphp  @foreach($ranks1 as $ranks1) <option value="{{ $ranks1->rank_id }}">{{ $ranks1->rank_name }}</option> @endforeach </select> </div> </div> </div>'); 
          }
          if(name==1){
            $('.geninfo').append('<form action="" method="POST" class="form-horizontal"  id="EmpAdd"><legend>General Information</legend><div class="form-group"> <label class="col-xs-3 control-label">First Name</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></div> <input type="text" class="form-control ff2" name="firstname" placeholder="e.g. Juan" required> </div> </div> </div> <div class="form-group"> <label class="col-xs-3 control-label">Middle Name</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></div> <input type="text" class="form-control mm2" name="middlename" placeholder="e.g. Martinez"> </div> </div> </div> <div class="form-group"> <label class="col-xs-3 control-label">Last Name</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></div> <input type="text" class="form-control ll2" name="lastname" placeholder="e.g. Dela Cruz"> </div> </div> </div></form>');
          }
          if(address==1){
            $('.geninfo').append('<div class="form-group"> <label class="col-xs-3 control-label">Address</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-address-card-o" aria-hidden="true"></i></div> <input type="text" class="form-control" name="address" placeholder="e.g. 173 L. Pascual Street, Q.C."> </div> </div> </div>');
          }
          if(contact==1){
            $('.geninfo').append('<div class="form-group"> <label class="col-xs-3 control-label">Contact Number</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></div> <input type="text" class="form-control" name="contact" placeholder="e.g. (63) 926 189 1291"> </div> </div> </div>');
          }
          if(license==1){
            $('.geninfo').append(' <div class="form-group"> <label class="col-xs-3 control-label">License Number</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></div> <input type="text" class="form-control" name="license" placeholder="e.g. HH-DH-8876"> </div> </div> </div>');
          }




          $('.accountinfo').empty();
          if((username==1)&&(password==1)){
          $('.accountinfo').append(' <legend>Account Information</legend><div class="form-group"><label class="col-xs-3 control-label">Username</label> <div class="col-md-7"><div class="input-group"><div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div><input type="text" class="form-control" name="username" placeholder="Username"></div></div></div><div class="form-group"><label class="col-xs-3 control-label">Password</label><div class="col-md-7"><div class="input-group"><div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div><input type="password" class="form-control" name="password" placeholder="Password"></div></div></div><div class="form-group"><label class="col-xs-3 control-label">Confirm Password</label><div class="col-md-7"><div class="input-group"><div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div><input type="password" class="form-control" name="confirmpass" placeholder="Confirm Password"></div></div></div>');
          }
        }
      });
    });


$('.empviewModalbtn').click(function(){
  var address     =     ""; 
  var username    =     ""; 
  var formChanges =     ""; 
  var password    =     ""; 
  var rank        =     ""; 
  var license     =     ""; 
  var contact     =     ""; 
  var name        =     "";
  var rank_name   =     "";
  var emp_fname   =     "";
  var emp_mname   =     "";
  var emp_lname   =     "";
  var emp_address =     "";
  var emp_contact =     "";
  var license_no  =     "";
  $.ajax
  ({
    url: 'viewEmpDetails',
    type: 'get',
    data:  { id:$(this).data('id')},
    dataType : 'json',

    success:function(response){

        response.forEach(function(data){
        address += data.address;
        username  += data.username;
        password  += data.password;
        rank  += data.rank;
        license += data.license;
        contact += data.contact;
        name += data.name;
        rank_name += data.rank_name;
        emp_fname +=  data.emp_fname;
        emp_mname +=  data.emp_mname;
        emp_lname +=  data.emp_lname;
        emp_address += data.emp_address;
        emp_contact += data.emp_contact;
        license_no  += data.license_no;
      })

      $('.geninfoview').empty(); 
          if(name==1){

            // var firstdiv = document.createElement('div');
            // firstdiv.setAttribute('class','form-group firstdiv');
            // $('.geninfoview').append(firstdiv);

            // var labelfname = document.createElement('label');
            // labelfname.setAttribute('class','col-xs-3 control-label fnamelabel');
            // $('.firstdiv').append(labelfname);

            

            $('.geninfoview').append('<legend>General Information</legend><div class="form-group"> <label class="col-xs-3 control-label">First Name</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></div> <input disabled value="'+emp_fname+'" type="text" class="form-control ff2" name="firstname"> </div> </div> </div> <div class="form-group"> <label class="col-xs-3 control-label">Middle Name</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></div> <input type="text" class="form-control mm2" disabled value="'+emp_mname+'"> </div> </div> </div> <div class="form-group"> <label class="col-xs-3 control-label">Last Name</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></div> <input type="text" class="form-control ll2" disabled value="'+emp_lname+'"> </div> </div> </div>');
          }

          if(rank==1){

            $('.geninfoview').append('<div class="form-group" id="medtechrank"> <label class="col-xs-3 control-label">Position</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-id-badge" aria-hidden="true"></i></div>  <input type="text" class="form-control rankNameView" value="'+rank_name+'" disabled> </div> </div> </div>'); 

          }
          

          
          if(address==1){
            $('.geninfoview').append('<div class="form-group"> <label class="col-xs-3 control-label">Address</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-address-card-o" aria-hidden="true"></i></div> <input type="text" class="form-control" disabled value="'+emp_address+'"> </div> </div> </div>');
          }
          if(contact==1){
            $('.geninfoview').append('<div class="form-group"> <label class="col-xs-3 control-label">Contact Number</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></div> <input type="text" class="form-control" disabled value="'+emp_contact+'"> </div> </div> </div>');
          }
          if(license==1){
            $('.geninfoview').append(' <div class="form-group"> <label class="col-xs-3 control-label">License Number</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></div> <input type="text" class="form-control" disabled value="'+license_no+'"> </div> </div> </div>');
          }


    }

  });
  return true;
});

$('.empupdateModalbtn').click(function(){
  var address     =     ""; 
  var username    =     ""; 
  var formChanges =     ""; 
  var password    =     ""; 
  var rank        =     ""; 
  var license     =     ""; 
  var contact     =     ""; 
  var name        =     "";
  var rank_name   =     "";
  var rank_id     =     "";
  var emp_fname   =     "";
  var emp_mname   =     "";
  var emp_lname   =     "";
  var emp_address =     "";
  var emp_contact =     "";
  var license_no  =     "";
  var emp_id      =     "";
  var emp_type_id =     "";
  $.ajax
  ({
    url: 'updateEmpDetails',
    type: 'get',
    data:  { id:$(this).data('id')},
    
    dataType : 'json',

    success:function(response){
        response.forEach(function(data){
        address += data.address;
        username  += data.username;
        password  += data.password;
        rank  += data.rank;
        license += data.license;
        contact += data.contact;
        name += data.name;
        rank_name += data.rank_name;
        rank_id += data.emp_medtech_rank_id;
        emp_fname +=  data.emp_fname;
        emp_mname +=  data.emp_mname;
        emp_lname +=  data.emp_lname;
        emp_address += data.emp_address;
        emp_contact += data.emp_contact;
        license_no  += data.license_no;
        emp_id += data.emp_id;
        emp_type_id += data.emp_type_id
        $('#update_emp_id').val(emp_id);
        $('#update_emp_type').val(emp_type_id);
      })
      $('.geninfoupdate').empty(); 
          if(rank==1){
            $('.geninfoupdate').append('<div class="form-group" id="medtechrank"> <label class="col-xs-3 control-label">Position</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-id-badge" aria-hidden="true"></i></div> <select class="form-control select2" id="selrank" name="rank_id" style="width: 100%;"> @php $ranks2 = $ranks @endphp @foreach($ranks2 as $ranks) <option value="{{ $ranks->rank_id }}">{{ $ranks->rank_name }}</option> @endforeach </select> </div> </div> </div>'); 
            $('#selrank').val(rank_id);
          }
          

          if(name==1){
            $('.geninfoupdate').append('<legend>General Information</legend><div class="form-group"> <label class="col-xs-3 control-label">First Name</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></div> <input  value="'+emp_fname+'" type="text" class="form-control ff2" name="firstname"> </div> </div> </div> <div class="form-group"> <label class="col-xs-3 control-label">Middle Name</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></div> <input type="text" class="form-control mm2"  value="'+emp_mname+'" name="middlename"> </div> </div> </div> <div class="form-group"> <label class="col-xs-3 control-label">Last Name</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></div> <input type="text" class="form-control ll2"  value="'+emp_lname+'" name="lastname"> </div> </div> </div>');
          }
          if(address==1){
            $('.geninfoupdate').append('<div class="form-group"> <label class="col-xs-3 control-label">Address</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-address-card-o" aria-hidden="true"></i></div> <input type="text" class="form-control"  value="'+emp_address+'" name="address"> </div> </div> </div>');
          }
          if(contact==1){
            $('.geninfoupdate').append('<div class="form-group"> <label class="col-xs-3 control-label">Contact Number</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></div> <input type="text" class="form-control"  value="'+emp_contact+'" name="contact"> </div> </div> </div>');
          }
          if(license==1){
            $('.geninfoupdate').append(' <div class="form-group"> <label class="col-xs-3 control-label">License Number</label> <div class="col-md-7"> <div class="input-group"> <div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></div> <input type="text" class="form-control"  value="'+license_no+'" name="license"> </div> </div> </div>');
          }


    }

  });
  return true;
});
});
</script>

@endsection

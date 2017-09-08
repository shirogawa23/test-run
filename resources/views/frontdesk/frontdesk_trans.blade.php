@extends ('menubar.admin')

@section ('title','Transaction')

@section ('headerTitle','Patient Information')

@section ('tabname','Home')

@section ('pagename','Transaction')

@section ('content')

<section class="content">
	<div class="box box-primary">
    <div class="box-body">
      <table class="table table-bordered table-hover dataTable" id="patientTbl">
      <thead>
        <tr>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Middle Name</th>
          <th>Patient Type</th>
          <th>Address</th>
          <th>Birthdate</th>
          <th>Age</th>
          <th>Contact</th>
          <th>Gender</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($table as $table)
        <tr>
          <td>{{ $table->patient_lname }}</td>
          <td>{{ $table->patient_fname }}</td>
          <td>{{ $table->patient_mname }}</td>
          <td>{{ $table->ptype_name }}</td>
          <td>{{ $table->patient_address }}</td>
          <td>{{ $table->patient_birthdate }}</td>
          <td>{{ $table->age }}</td>
          <td>{{ $table->patient_contact }}</td>
          <td>{{ $table->patient_gender }}</td>
          <td>
            <a class="btn btn-warning btn-xs upservtype" href="/processMedicalService?id={{ $table->patient_id }}"><i class="fa fa-wrench" aria-hidden="true"></i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
</section>

<div class="modal fade" id = "addModal">
  <div class="modal-dialog" style="width: 70%">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h4 class="modal-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Patient</h4>
      </div>
      <div class="modal-body">
        <form action="/save_patient" method="POST" class="form-horizontal">
        	<div class="form-group">
	            <label class="col-xs-4 control-label">Type of Patient</label>
            	<div class="col-md-5 input-group">
            	<span class="input-group-addon"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
              	<select class="form-control select2" onchange="showCorpadd();" id="addpatienttype" name="patienttype" style="width: 108%">
              		@foreach($patienttype as $patienttype)
	                <option value="{{ $patienttype->ptype_id }}">{{ $patienttype->ptype_name }}</option>
	                @endforeach
              	</select>
            	</div>
          	</div>
          	<div class="form-group hidden" id="addcorp">
            <label class="col-xs-4 control-label">Corporates</label>
            <div class="col-md-5 input-group">
            	<span class="input-group-addon"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
              	<select class="form-control select2" name="addcorpid" id="addcorpid" style="width: 108%">
              		@foreach($corps as $corps)
              		<option value="{{ $corps->corp_id }}">{{ $corps->corp_name }}</option>
              		@endforeach
              	</select>
            </div>
        </div>
         <div class="form-group" style="margin-right:3% ">
			<label class="col-xs-4 control-label">First Name</label>  
			<div class="col-md-6">
			    <div class="input-group">
			    	<div class="input-group-addon">
			    		<i class="fa fa-user-o"></i>
			    	</div>
			    	<input  name="patient_fname" type="text" placeholder="First Name" class="form-control input-md" required>
				</div>
			</div>  
		</div>      

		<div class="form-group" style="margin-right:3% ">
			<label class="col-xs-4 control-label">Middle Name</label>  
			<div class="col-md-6">
				<div class="input-group">
			    	<div class="input-group-addon">
			       		<i class="fa fa-user-o"></i>
			     	</div>
			    	<input  name="patient_mname" type="text" placeholder="Middle Name" class="form-control input-md">
			 	</div>
			</div>  
		</div> 
		
		<div class="form-group" style="margin-right:3% ">
			<label class="col-xs-4 control-label">Last Name</label>  
			<div class="col-md-6">
			    <div class="input-group">
			    	<div class="input-group-addon">
			       		<i class="fa fa-user-o"></i>
			     	</div>
			    	<input  name="patient_lname" type="text" placeholder="Last Name" class="form-control input-md" required>
			 	</div>
			</div>  
		</div> 

		<div class="form-group" style="margin-right:3% ">
			<label class="col-xs-4 control-label">Address</label>  
			<div class="col-md-6">
			    <div class="input-group">
			    	<div class="input-group-addon">
			     		<i class="fa fa-address-card-o"></i>
			     	</div>
			    	<input  name="patient_address" type="text" placeholder="Address" class="form-control input-md" required>
			 	</div>
			</div>  
		</div> 
		<div class="form-group" style="margin-right:3% ">
			<label class="col-xs-4 control-label">Contact Number</label>  
			<div class="col-md-6">
				<div class="input-group">
			     	<div class="input-group-addon">
			       		<i class="fa fa-address-book-o"></i>
			     	</div>
			   		<input  name="patient_contact" type="text" placeholder="Contact Number" class="form-control input-md" required>
			 	</div>
			</div>  
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-5">
			<div class="form-group" style="margin-right:-10% ">
				<label class="col-xs-4 control-label">Birthdate</label>  
				<div class="col-md-5">
				    <div class="input-group">
				    	<div class="input-group-addon">
				       		<i class="fa fa-birthday-cake" aria-hidden="true"></i>
				     	</div>
				    	<input  name="birthday" type="date" id="birthday" class="form-control" required onblur="getage()">
				 	</div>
				</div>  
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group" style="margin-left:-40% ">
			<label class="col-xs-4 control-label">Age</label>  
				<div class="col-md-5">
			    	<div class="input-group">
			      		<div class="input-group-addon">
			       			<i class="fa fa-birthday-cake" aria-hidden="true"></i>
			     		</div>
			    		<input  name="age" id="age" type="text"  class="form-control" required readonly="">
			 		</div>
				</div>  
			</div>
		</div>
		<div class="form-group">
            <label class="col-xs-4 control-label">Gender </label>
            <div class="col-md-5 input-group">
            	<span class="input-group-addon"><i class="fa fa-genderless" aria-hidden="true"></i></span>
              	<select class="form-control select2" name = "gender" style="width: 108%">
                	<option value="Male">Male</option>
                	<option value="Female">Female</option>
              	</select>
            </div>
        </div>
        
        {{ @csrf_field() }}
        <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
          <button  class="btn btn-xs btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
        </div>
        </form>
      </div>
    </div>  
  </div>
</div>
@endsection

@section('datatables')

<script>

$(function() {

$('#patientTbl').DataTable({
  'paging'      : true,
  'lengthChange': true,
  'searching'   : true,
  'ordering'    : true,
  'info'        : true,
  'autoWidth'   : true

});
$(' <a class="btn btn-info btn-sm pull-right" href="#addModal" data-toggle="modal" ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; Add </a>').appendTo('div.dataTables_filter');


});
</script>
<script type="text/javascript">
	function getage(){
      var dnow
      var bday
          var a 
          var checker
          var temp
          var yr
          var dt
          var gbday = document.getElementById("birthday").value

          bday = new Date(gbday)
          dnow = new Date()
          a = dnow.getFullYear() - bday.getFullYear()
          yr = bday.getFullYear() + a
          dt = (dnow.getMonth() + 1) + "/" + dnow.getDate() + "/" + dnow.getFullYear()
          checker = (bday.getMonth() + 1) + "/" + bday.getDate() + "/" + yr
         
          if(Date.parse(dt) < Date.parse(checker)){
       a = a - 1
          }
         if(a<0){
          a=0
         }

          document.getElementById("age").value=a;
  }
  function getage2(id){
      var dnow
      var bday
          var a 
          var checker
          var temp
          var yr
          var dt
          var gbday = document.getElementById("birthday"+id).value

          bday = new Date(gbday)
          dnow = new Date()
          a = dnow.getFullYear() - bday.getFullYear()
          yr = bday.getFullYear() + a
          dt = (dnow.getMonth() + 1) + "/" + dnow.getDate() + "/" + dnow.getFullYear()
          checker = (bday.getMonth() + 1) + "/" + bday.getDate() + "/" + yr
         
          if(Date.parse(dt) < Date.parse(checker)){
       a = a - 1
          }
         if(a<0){
          a=0
         }

          document.getElementById("age"+id).value=a;
  }
  function showCorpadd(){
  	var selectBox = document.getElementById('addpatienttype')
    var userInput = selectBox.options[selectBox.selectedIndex].value

    if(userInput == '2')
    {
      
      document.getElementById('addcorp').className = ('form-group')
      
    }
    else if(userInput == '1')
    {
     document.getElementById('addcorp').className = ('form-group hidden')
     
    }
  }
</script>
@endsection
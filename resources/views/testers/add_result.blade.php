@extends ('menubar.admin')

@section ('title','Dashboard')

@section ('headerTitle','Add Result')

@section ('tabname','Result')

@section ('pagename','Add Result')

@section ('content')

<section class="content">
<form action="" method="POST">
<div class="box box-primary">
	<div class="box-header">
		<center><h2>Company information</h2></center>
		<center><h4>{{ $group_name }}</h4></center>
		<hr>
	<div class="col-md-12">
	@foreach($patient_info as $patient_info)
		<div class="col-md-6">
			
			<h4>Transaction Date:&nbsp; <b>{{ $transDate }}</b></h4>
			<h4>Name:&nbsp; <b>{{ $patient_info->patient_fname }} {{ $patient_info->patient_mname }} {{ $patient_info->patient_lname }}</b></h4>
			<h4>Referring Employee:&nbsp; <b></b></h4>
			
		</div>
		<div class="col-md-6">
			<h4>Age: &nbsp;<b>{{ $patient_info->age }}</b></h4>
			<h4>Sex: &nbsp;<b>{{ $patient_info->patient_gender[0] }}</b></h4>
			<h4>Address: &nbsp;<b>{{ $patient_info->patient_address }}</b></h4>
		</div>
	@endforeach
	</div>
	
	<hr>

	</div>
	<div class="box-body">
			<table border="3" style="border-radius: 120px">
			  <tr>
			    <th width="200pt" rowspan="2" colspan="1">TEST</th>
			    <th width="400pt" colspan="3">SYSTEM INTERNATIONAL</th>
			    <th width="500pt" colspan="3">CONVENTIONAL</th>
			  </tr>
			  <tr>
			    <th>RESULT</th>
			    <th>UNIT</th>
			    <th>REFERENCE</th>
			    <th>RESULT</th>
			    <th>UNIT</th>
			    <th>REFERENCE</th>
			  </tr>
			  @foreach($services as $services)
			  <tr>
			    <td>{{ $services->service_name }}</td>
			    <td><input type="text" name="" value="{{ $services->SI_result }}"></td>
			    <td><input type="text" name="" value="{{ $services->SI_unit }}"></td>
			    <td><input type="text" name="" value="{{ $services->SI_reference }}"></td>
			    <td><input type="text" name="" value="{{ $services->CO_result }}"></td>
			    <td><input type="text" name="" value="{{ $services->CO_unit }}"></td>
			    <td><input type="text" name="" value="{{ $services->CO_reference }}"></td>
			  </tr>
			  @endforeach
			 </table>
			<br>
			<div class="col-md-12">
				<h4>Remarks</h4>
				<textarea rows="3" cols="100">{{ $remark }}</textarea>
			</div>

			<div class="col-md-12">
			<br><br>
				<div class="pull-left">
					<h5>Space for signature</h5>
					<h4>Empname</h4>
					<b>Employee Type</b>
				</div>
				<div class="pull-right">
				<h5>Space for signature</h5>
					<h4>Empname</h4>
					<b>Employee Type</b>
				</div>
			</div>
	</div>
	<div class="box-footer">
		<button class="btn btn-success pull-right">Save Result&nbsp;<i class="fa-floppy-o-right" aria-hidden="true"></i></button>
	</div>
</div>   
</form> 
</section>
@endsection
@section('datatables')
<script>
	$(function(){
		
		var t = $('#medicalRequest').DataTable({
		  'paging'      : false,
		  'lengthChange': false,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : false,
		  'autoWidth'   : true
		});
		$('.remove_service').click(function(){
			alert('dsds');
			// t.row($(this).parent('tr')).remove.draw();
			return true;
		});
		$('#addservice').click(function(){
		
		var service_name = "";
		var service_price="";
		var service_id = $('#srvc_id').val();
		// var option = 'ServiceOPTION'service_id;
	    $.ajax
	    ({

	      url: '/getDataService',
	      type: 'get',
	      data: { id: service_id }, 
	      dataType : 'json',
	      success:function(response) {
	        response.forEach(function(data) { 
	          	t.row.add([
	        		data.service_name,
					data.service_price,
					'<button class="btn btn-danger btn-xs remove_service'+service_id+'" data-id="'+service_id+'"><i class="fa fa-trash" aria-hidden="true"></i></button><input type="hidden" name="medservice_id[]" value="'+service_id+'">'
	        	]).draw(false);
	          	$("#ServiceOPTION"+service_id).attr("disabled","disabled");

	          	$('.remove_service'+service_id+'').click(function(){
	          		var remServ_id = $(this).data("id");
	          		console.log("Remove Service ID:" + remServ_id);
	          		$("#ServiceOPTION"+remServ_id).removeAttr("disabled","disabled");
	          		t.row($(this).parents('tr')).remove().draw();
					return true;
				});

	        })
	        console.log("Service ID :"+service_id);
	        
	        
	      }
	    });
	    
	    return true;
	  });

	});
</script>

<style type="text/css">
	th, input{text-align: center;}
	td{text-align: center;width: 100pt}
</style>

@endsection
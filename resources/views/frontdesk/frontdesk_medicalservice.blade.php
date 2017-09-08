@extends ('menubar.admin')

@section ('title','Medical Service')

@section ('headerTitle','Medical Request')

@section ('tabname','Transaction')

@section ('pagename','Medical Request')

@section ('content')


<section class="content">
<form action="/proceed_Payment" method="POST" >

<div class="modal fade" id = "myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-success">
        <h4 class="modal-title"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Confirmation</h4>
      </div>
        <div class="modal-body">
<pre id = "recieptDetails"></pre>
        

        </div>
        <div class="modal-footer">
          <button type="button" class="btn pull-left" data-dismiss="modal">Not yet</button>
          <button  class="btn btn-success" id="yesPrintBtn"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Yes, Print Reciept</button>
        </div>
    </div>  
  </div>
</div>

	<div class="row">
		<div class="col-md-12">
	    	<div class="col-md-6">
	    		<div class="col-md-12">
	      			<div class="box box-primary">        
	        			
	          			<div class="panel-body">
	          				<table style="font-size: 13px;">

	          				@foreach($patientinfo as $patientinfo)

	          					<tr>
	          					<input type="hidden" id="corporate_id" name="corp_id" value="{{ $patientinfo->patient_corp_id }}">
	          					<input type="hidden" name="patient_id" value="{{ $patientinfo->patient_id }}">
	          					<input type="hidden" name="patient_type_id" value="{{ $patientinfo->patient_type_id }}">
	          						<td>First Name:&nbsp;</td>
	          						<td><b>{{ $patientinfo->patient_fname }} {{ $patientinfo->patient_mname }} {{ $patientinfo->patient_lname }}</b></td>
	          					</tr>
	          					<tr>
	          						<td>Patient Type: &nbsp;</td>
	          						<td><b>{{ $patientinfo->ptype_name }}</b></td>
	          					</tr>
	          					<tr>
	          						<td>Contact Number: &nbsp;</td>
	          						<td><b>{{ $patientinfo->patient_contact }}</b></td>
	          					</tr>
	          					<tr>
	          						<td>Patient Address: &nbsp;</td>
	          						<td><b>{{ $patientinfo->patient_address }}</b></td>
	          					</tr>
	          					<tr>
	          						<td>Patient Birthday: &nbsp;</td>
	          						<td><b>{{ $patientinfo->patient_birthdate }}</b></td>
	          					</tr>
	          					<tr>
	          						<td>Age: &nbsp;</td>
	          						<td><b>{{ $patientinfo->age }}</b></td>
	          					</tr>
	          					<tr>
	          						<td>Gender: &nbsp;</td>
	          						<td><b>{{ $patientinfo->patient_gender }}</b></td>
	          					</tr>
	          					
	          				@endforeach
	          				</table>
				        </div>
	          
	      			</div>
	    		</div>       
	    	</div>
	    	<div class="col-md-6">
	    		<div class="col-md-12">
	      			<div class="box box-primary">
	          			<div class="panel-body">
	          				<div class="form-group">

	          					<div class="col-md-12">
						        	<div class="form-group" style="padding-top: 2%">
						            	<div class="col-md-12">
						            		<div class="col-md-12" >
												<div class="input-group" >
											    	<select class="form-control srvc_id select2" name="srvc_id" id="srvc_id" style="width: 100%">
										              @foreach($servicegroup as $s)
										              <optgroup label="{{ $s->servgroup_name }}">
										                  @foreach($service as $serviceoffer2)
										                    @if($s->servgroup_id == $serviceoffer2->service_group_id)
										                    <option id="ServiceOPTION{{ $serviceoffer2->service_id }}" value="{{ $serviceoffer2->service_id }}">{{ $serviceoffer2->service_name }}</option>
										                    @endif
										                  @endforeach              
										                </optgroup>
										              @endforeach
									               		<optgroup label="Others">
									              			@foreach($service as $servnogrp)
									              				@if($servnogrp->service_group_id == null)
									              					<option id="ServiceOPTION{{ $servnogrp->service_id }}" value="{{ $servnogrp->service_id }}">{{ $servnogrp->service_name }}</option>
									              				@endif
									              			@endforeach
									              		</optgroup>
									                </select>
											      <div class="input-group-btn">
											      	<a class="btn btn-default addservice btn-sm" id="addservice" style="border-radius: 10%">Add</a>
											      </div>
											    </div><!-- /input-group -->
							                </div>
						            	</div>
									</div>
						        </div>

					           
					        <div class="col-md-12">
					            <div class="form-group" style="padding-top: 2%">
					            	<div class="col-md-12">
					            		<div class="col-md-12">
											<select class="form-control emp_id select2" name="emp_id" id="emp_id" style="width: 100%" >
												<option value="null">Referred by (Optional)</option>
							                   @foreach($emp_rebates as $emp_rebates)
							                    <option value="{{$emp_rebates->emp_id}}">{{ $emp_rebates->emp_fname }} {{ $emp_rebates->emp_mname }} {{ $emp_rebates->emp_lname }}</option>
							                    @endforeach
							                </select>
						                </div>
					            	</div>
								</div>
					        </div>
					        
					      	<div class="col-md-12">
					        	<div class="form-group" style="padding-top: 2%">
					            	<div class="col-md-12">
					            		<div class="col-md-12" >
											<div class="input-group" >
										    	<select class="form-control package_id select2" name="package_id_dropdown" id="package_id" style="width: 100%" >
													@foreach($package as $pcknm)
														<option id="PackageID{{ $pcknm->pack_id }}" value="{{ $pcknm->pack_id }}">{{ $pcknm->pack_name }}</option>
													@endforeach
							                	</select>
										    	
										      <div class="input-group-btn">
										      	<a id="addpackageBtn" class="btn btn-default addpackageBtn btn-sm" style="border-radius: 10%">Add</a>
										      </div>
										    </div><!-- /input-group -->
						                </div>
					            	</div>
								</div>
					        </div>
					        @if($ptype_id == 2)
					        <div class="col-md-12">
					        	<div class="form-group" style="padding-top: 2%">
					            	<div class="col-md-12">
					            		<div class="col-md-12" >
										<a href="#OptionPackModal" id="activecorppack" data-toggle="modal" class="btn btn-info" style="width: 100%; ">Activate Corporate Package<i  aria-hidden="true"></i></a>
						                </div>
					            	</div>
								</div>
					        </div>
					        @endif
					        </div>
				        </div>
	      			</div>
	    		</div>   	
	    	</div>
    	</div>
    </div>
    <div class="row">
    	<div class="col-md-12">
    		<div class="col-md-12">
    			<div class="col-md-12">
	    		<div class="box box-primary">
	    			<div class="panel-body">
	    				<div class="col-md-12">
							<table class="table table-hover table-condensed dataTable" id="medicalRequest">
								<thead>
									<tr>
										<th style="width:40%">Service</th>
										<th style="width:30%">Service Group</th>
										<th style="width:20%">Price</th>
										<th style="width:10%">Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
	    			</div>
	    		</div>
    			</div>
    			
    		</div>
    	</div>
    </div>
    <div class="row">
    	<div class="col-md-12">
    		<div class="col-md-12">
    			<div class="col-md-4">
    				<div class="box box-primary">
    					<div class="panel-body">
    					 <div class="form-group">
                          <label >Total &nbsp;</label><input type="text" class="form-text" id="totalpriceinput"  name="totalpriceinput" value ="0"  readonly="">
                        </div>
                        <div class="form-group">
                          <label  >Payment &nbsp;</label><input type="text" class="form-text" id="paymentinput"  name="paymentinput">
                          
                        </div>
                         <!-- <div class="form-group form-animate-text">
                          <input type="text" class="form-text"  name="payment" required>
                          <span class="bar"></span>
                          <label>Payment</label>
                        </div> -->
                        <!-- href="#myModal" data-toggle="modal" -->
    						<a  class="btn btn-success btn-sm col-md-12" id="procpaymentmodal">Proceed to payment <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    
{{ csrf_field() }}
</form>    

<div class="modal fade" id = "OptionPackModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-primary">
      </div>
        <div class="modal-footer">
          <button type="button" class="btn pull-left btn-default" data-dismiss="modal" style="width: 48%" id="payDirect"><i class="fa fa-map-marker" aria-hidden="true" style="font-size: 100px"></i><br><h3>Pay Here</h3></button>
          <button type="button" class="btn pull-right btn-default" data-dismiss="modal" style="width: 48%" id="payCorp"><i class="fa fa-building-o" aria-hidden="true" style="font-size: 100px"></i><br><h3>Bill to Company</h3></button>
        </div>
    </div>  
  </div>
</div>
</section>
@endsection
@section('datatables')
<script type="text/javascript">
	$('#procpaymentmodal').click(function(){
		var payment = $('#paymentinput').val();
		var total = $('#totalpriceinput').val();
		total = total *1;
		payment = payment *1;
		if(total == 0 )
		{
			swal("Error", "You need to add service", "error")

		}

		if(total > payment && total > 0)
		{
			
			swal("Error", "Insufficient", "error")	
		}

		if( payment > 0 && payment >= total && total != 0)
		{
			$('#recieptDetails').empty();
			$('#recieptDetails').append('<center>Sales</center>');
			$('#recieptDetails').append('Total : '+total+'<br>Payment:'+payment+' <br>Change : '+(payment-total)+'')
			$('#myModal').modal('show');
		}
	});
</script>
<script>
	$(function(){
		
		var t = $('#medicalRequest').DataTable({
			'paging'      : false,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : false,
			'info'        : false,
			'autoWidth'   : true,
			
		});
		$('#payDirect').click(function(){
			$('#payWhere').val('0');
			var total = $('#totalpriceinput').val();
			var corp_id = $('#corporate_id').val();
			var addpackagebtn = document.getElementById('activecorppack');
			var price = 0*1;
			$.ajax
			({
				url: '/getDataPackage',
				type: 'get',
				data: { id: corp_id },
				dataType : 'json',
				success:function(response){
					response.forEach(function(data){
						t.row.add([
							'Corporate Package',
							'',
							data.price,
							'<button class="btn btn-danger btn-xs corpremove_package'+data.corpPack_id+'" data-id="'+data.corpPack_id+'"><i class="fa fa-trash" aria-hidden="true"></i></button><input type="hidden" name="corppackage_id" value="'+data.corpPack_id+'"><input type="hidden" name="payWhere" id="payWhere" value="0"><input type="hidden" name="corppackprice" id="corppackprice'+data.corpPack_id+'" value='+data.price+'>'
						]).draw(false);
						addpackagebtn.className = "btn btn-info disabled";
						total = total * 1;
						price = ($('#corppackprice'+data.corpPack_id).val()*1);
						total = total + price;
						$('#totalpriceinput').val(total);
						$('.corpremove_package'+data.corpPack_id+'').click(function(){
							addpackagebtn.className = "btn btn-info";
			          		var remPack_id = $(this).data("id");
			          		
			          		$('#totalpriceinput').val($('#totalpriceinput').val() - price);
			          	
			          		console.log("Remove Service ID:" + remPack_id);
			          		t.row($(this).parents('tr')).remove().draw();
							return true;
						});
					})
				}

			});
			return true;
		});
		$('#payCorp').click(function(){
			var total = $('#totalpriceinput').val();
			var addpackagebtn = document.getElementById('activecorppack');
			$('#payWhere').val('1');
			var corp_id = $('#corporate_id').val();
			var price = 0*1;
			$.ajax
			({
				url: '/getDataPackage',
				type: 'get',
				data: { id: corp_id },
				dataType : 'json',

				success:function(response){
					response.forEach(function(data){
						t.row.add([
							'Corporate Package',
							'',
							data.price + " (c/o Company)",
							'<button class="btn btn-danger btn-xs corpremove_package'+data.corpPack_id+'" data-id="'+data.corpPack_id+'"><i class="fa fa-trash" aria-hidden="true"></i></button><input type="hidden" name="corppackage_id" value="'+data.corpPack_id+'"><input type="hidden" name="payWhere" id="payWhere" value="1"><input type="hidden" name="corppackprice" id="corppackprice'+data.corpPack_id+'" value="0">'
						]).draw(false);
						addpackagebtn.className = "btn btn-info disabled";
						total = total*1;
						price = $('#corppackprice'+data.corpPack_id).val()*1;
						total = total + price;
						$('#totalpriceinput').val(total);
						$('.corpremove_package'+data.corpPack_id+'').click(function(){
			          		var remPack_id = $(this).data("id");
			          		addpackagebtn.className = "btn btn-info";
			          		$('#totalpriceinput').val($('#totalpriceinput').val() - price);
			          		console.log("Remove Service ID:" + remPack_id);
			          		t.row($(this).parents('tr')).remove().draw();
							return true;
						});
					})
				}

			});
			return true;
		});
		$('#addpackageBtn').click(function(){
			var package_id = $('#package_id').val();
			var total = $('#totalpriceinput').val();
			var price = 0*1;
			$.ajax
			({
				url: '/getCompanyPackage',
				type: 'get',
				data: { id: package_id },
				dataType : 'json',
				success:function(response){
					response.forEach(function(data){
						t.row.add([
							 data.pack_name + "(Package)" ,
							'',
							data.pack_price,
							'<button class="btn btn-danger btn-xs remove_package'+package_id+'" data-id="'+package_id+'"><i class="fa fa-trash" aria-hidden="true"></i></button><input type="hidden" name="package_id[]" value="'+package_id+'"><input type="hidden" name="packprice" id="packprice'+package_id+' value ='+data.pack_price+' ">'
						]).draw(false);
						$("#PackageID"+package_id).attr("disabled","disabled");
						total = total *1;
			          	price = data.pack_price;
			          	total = total + price;
			          	$('#totalpriceinput').val(total);
						$('.remove_package'+package_id+'').click(function(){
			          		var remPack_id = $(this).data("id");
			          		console.log("Remove Package ID:" + remPack_id);
			          		$('#totalpriceinput').val($('#totalpriceinput').val() - price);
			          		$("#PackageID"+package_id).removeAttr("disabled","disabled");
			          		t.row($(this).parents('tr')).remove().draw();
							return true;
						});
					})
				}
			});
			return true;
		});

		$('#addservice').click(function(){
		var total = $('#totalpriceinput').val();
		var service_name = "";
		var service_price="";
		var service_id = $('#srvc_id').val();
		// var option = 'ServiceOPTION'service_id;
		var price = 0*1;
	    $.ajax
	    ({

	      url: '/getDataService',
	      type: 'get',
	      data: { id: service_id }, 
	      dataType : 'json',
	      success:function(response) {
	        response.forEach(function(data) { 
	          	t.row.add([
	        		data.service_name ,
	        		data.servgroup_name,
					data.service_price,
					'<button class="btn btn-danger btn-xs remove_service'+service_id+'" data-id="'+service_id+'"><i class="fa fa-trash" aria-hidden="true"></i></button><input type="hidden" name="medservice_id[]" value="'+service_id+'"><input type="hidden" name="serviceprice" value='+data.service_price+' id="serviceprice'+service_id+'">'

	        	]).draw(false);
	          	$("#ServiceOPTION"+service_id).attr("disabled","disabled");
	          	total = total *1;
	          	price = ($('#serviceprice'+service_id+'').val()*1);
	          	total = total + price;
	          	$('#totalpriceinput').val(total);
	          	$('.remove_service'+service_id+'').click(function(){
	          		var remServ_id = $(this).data("id");
	          		$('#totalpriceinput').val($('#totalpriceinput').val() - price);
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
@endsection
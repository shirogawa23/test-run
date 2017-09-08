@extends ('menubar.admin')

@section ('title','Transaction')

@section ('headerTitle','Receipt')

@section ('tabname','Home')

@section ('pagename','Transaction')

@section ('content')

<section class="content">
<form action="/save_Transaction" method="POST">
	<div class="row">
		<div class="col-md-12">
		<div class="col-md-10 col-md-offset-1">
			<div class="box box-primary">      			
				<div class="box-header">
					<center><h4>Receipt</h4></center>
					<hr>
				</div>
				<div class="box-body">
					<div class="col-md-8 col-md-offset-1">
						<h5>Transaction Date: <b>{{ $date }}</b></h5>
						<h5>Patient Name: 
						@foreach($patient as $patient)
						<input type="hidden" name="patient_id" value="{{ $patient->patient_id }}">
						<input type="hidden" name="patient_type" value="{{ $patient->patient_type_id }}">
						<b>{{ $patient->patient_fname }} {{ $patient->patient_mname }} {{ $patient->patient_lname }}</b>
						@endforeach
						</h5>
						<h5>Referring Employee:	
						<b>
							{{ $name }}
						<input type="hidden" name="empRebate_id" value="{{ $emprebate_id }}">
						</b>
						</h5>
						<hr>
					</div>
					<div class="col-md-8 col-md-offset-2">
						<table style="width: 100%" class="table table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th style="text-align: right;">Price</th>
								</tr>
							</thead>
							<tbody>
								@foreach($package_details as $package_details)
								<input type="hidden" name="package_id" value="{{ $package_details->pack_id }}">
								<tr>
									<td>{{ $package_details->pack_name }}</td>
									<td style="text-align: right">{{ $package_details->pack_price }}</td>
								</tr>
								@endforeach
								@foreach($servicePackage as $servicePackage)
								<input type="hidden" name="service_id[]" value="{{ $servicePackage->pack_serv_serv_id }}">
								<tr>
									
									<td colspan="2">&emsp;&emsp;-{{ $servicePackage->service_name }}</td>

								</tr>
								@endforeach
								@foreach($service as $service)
									<input type="hidden" name="service_id[]" value="{{ $service->service_id }}">
										
								<tr>
									<td>{{ $service->service_name }}</td>
									<td style="text-align: right">{{ $service->service_price }}</td>
								</tr>
								@endforeach
							</tbody>
							<footer>
								<tr>
									<th></th>
									<th style="text-align: right;">
										<input type="hidden" name="total" value="{{ $gtotal }}">
										Total:&emsp; {{ $gtotal}}
										
									</th>
								</tr>
							</footer>
						</table>
					</div>
				</div>
				<div class="box-footer">
				<input type="hidden" name="claim_code" value ="{{ $code }}">
					<center><h3>Claiming Code:   <b>{{ $code }}</b> <sup style="color:red">*For online Claming</sup></h3></center>
				</div>
			</div>
		</div>
	</div>
	</div>
	<div class="row">
	
		<div class="col-md-12">
			<div class="col-md-5 col-md-offset-1"></div>
			<div class="col-md-5">
				<button class="btn btn-success pull-right" type="submit">Process</button>	
			</div>
		</div>
	</div>
	{{ csrf_field() }}
	</form>
</section>
@endsection
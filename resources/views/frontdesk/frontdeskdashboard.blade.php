@extends ('menubar.admin')

@section ('title','GlobalHealth Diagnostic Center')

@section ('headerTitle','Front Desk Dashboard')

@section ('tabname','Home')

@section ('pagename','Dashboard')

@section ('content')

<section class="content">
	<div class="row">
		<br>
		<div class="col-lg-3 col-xs-6">
	    	<div class="small-box bg-aqua">
	        	<div class="inner">
	        		<p><br></p>
	          		<h3>Result</h3>
					
	        	</div>
		        <div class="icon">
		        	<i class="fa fa-wpforms" aria-hidden="true"></i>
		    	</div>
	        	<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div>

	    <div class="col-lg-3 col-xs-6">
	    	<div class="small-box bg-red">
	        	<div class="inner">
	          		<p><br></p>
	          		<h3>Patient</h3>
	        	</div>
		        <div class="icon">
		        	<i class="fa fa-user" aria-hidden="true"></i>
		    	</div>
	        	<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div>

	    <div class="col-lg-3 col-xs-6">
	    	<div class="small-box bg-green">
	        	<div class="inner">
	          		<p><br></p>
	          		<h3>Census</h3>
	        	</div>
		        <div class="icon">
		        	<i class="fa fa-heartbeat" aria-hidden="true"></i>
		    	</div>
	        	<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div>

	    <div class="col-lg-3 col-xs-6">
	    	<div class="small-box bg-blue">
	        	<div class="inner">
	          		<h3> dsa</h3>
					<p> dsa</p>
	        	</div>
		        <div class="icon">
		        	<i class="ion ion-bag"></i>
		    	</div>
	        	<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div>

	</div>
</section>

@endsection
@section('datatables')
@if(Session::has('transaction'))
<input type="hidden" name="" value="{{ Session::get('trans_id') }}" id="transaction_id">
<script type="text/javascript">

$( document ).ready(function() {	
	var date="";
	var total="";
	var payment="";
	var change="";
	var trans_id = $('#transaction_id').val();
	var emp_name = "";
	var patient_name ="";
	var claimcode = '';
	var ref_name = "";
	$.ajax
      ({
        url: '/retrieveReciept', 
        type: 'get',
        data: {ID:trans_id}, 
        dataType : 'json',
        success:function(response) { 
          response[0].forEach(function(data){
          	date = data.trans_date;
          	total = data.trans_total;
          	payment = data.trans_payment;
          	change = data.trans_change;
          })
          response[1].forEach(function(data) { 
          	emp_name = data.Name;
	  	  })
	  	  response[2].forEach(function(data){
	  	  	patient_name = data.Name;
	  	  })
	  	  response[3].forEach(function(data){
	  	  	claimcode = data.claimCode;
	  	  })
	  	  response[4].forEach(function(data){
	  	  	ref_name=data.Name;
	  	  })
	  	  	var contents = $("#formdeposit").html();
			var custtype =$("#typeDr").html();
			var frame1 = $('<iframe />');
			frame1[0].name = "frame1";
			frame1.css({ "position": "absolute", "top": "-1000000px" });
			$("body").append(frame1);
			var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
			frameDoc.document.open();
			frameDoc.document.write('<html><head>');
			frameDoc.document.write('</head><body>');
			frameDoc.document.write('<style> .invoice-box{ max-width:800px; margin:auto; padding:30px; border:1px solid #eee; box-shadow:0 0 10px rgba(0, 0, 0, .15); font-size:16px; line-height:24px; font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; color:#555; } .invoice-box table{ width:100%; line-height:inherit; text-align:left; } .invoice-box table td{ padding:5px; vertical-align:top; } .invoice-box table tr td:nth-child(2){ text-align:right; } .invoice-box table tr.top table td{ padding-bottom:20px; } .invoice-box table tr.top table td.title{ font-size:45px; line-height:45px; color:#333; } .invoice-box table tr.information table td{ padding-bottom:40px; } .invoice-box table tr.heading td{ background:#eee; border-bottom:1px solid #ddd; font-weight:bold; } .invoice-box table tr.details td{ padding-bottom:20px; } .invoice-box table tr.item td{ border-bottom:1px solid #eee; } .invoice-box table tr.item.last td{ border-bottom:none; } .invoice-box table tr.total td:nth-child(2){ border-top:2px solid #eee; font-weight:bold; } @media only screen and (max-width: 600px) { .invoice-box table tr.top table td{ width:100%; display:block; text-align:center; } .invoice-box table tr.information table td{ width:100%; display:block; text-align:center; } } </style>');
			frameDoc.document.write('<html><body> <div class="invoice-box"> <table cellpadding="0" cellspacing="0"> <tr class="top"> <td colspan="2">   ');
			frameDoc.document.write('<table>');
			frameDoc.document.write('<tr> </td> <center><strong><strong>GLOBALHEALTH</strong></strong><br>Diagnostic Center, Inc.<br><small>Laboratory, Ultrasound, X-ray, ECG, Drug Test</small</center></tr>');
			frameDoc.document.write('</table>');
			frameDoc.document.write('<tr class="information"> <td colspan="2"> <table> <tr><td></td></tr>');
			frameDoc.document.write('<tr><td><strong>Patient Name:</strong> '+patient_name+' <br><strong>Claiming Code:</strong> '+claimcode+'<br><strong>Referring Employee: </strong> '+ref_name+' </td><td> <strong>Date:</strong> '+date+' <br><strong>Receptionist:</strong> '+emp_name+'</td></tr>');
			
			frameDoc.document.write('</table>');
			
			frameDoc.document.write('<tr class="heading"> <td> Service </td> <td> Fee </td></tr>');

			response[5].forEach(function(data){

				frameDoc.document.write('<tr><td>'+data.serv_name+'</td><td>Php '+data.service_price+'</td></tr>');
			})
			
			response[6].forEach(function(data){
				var charge = data.charge;
				if(charge == 0)
				{
					frameDoc.document.write('<tr class="item"><td>Corporate Package</td><td>Php '+data.price+'</td></tr>');
				}
				if(charge == 1)
				{
					frameDoc.document.write('<tr><td>Corporate Package (c/o '+data.corp_name+')</td><td>Php 0</td></tr>');	
				}
				response[7].forEach(function(data){
					frameDoc.document.write('<tr><td>&emsp;&emsp;&emsp; -'+data.service_name+'</td><td></td></tr>');
				})

			})
			response[8].forEach(function(data){
				frameDoc.document.write('<tr><td>'+data.pack_name+'</td><td>Php '+data.pack_price+'</td></tr>');
				response[9].forEach(function(data){
					frameDoc.document.write('<tr><td>&emsp;&emsp;&emsp; -'+data.service_name+'</td><td></td></tr>');
				})
			})
			frameDoc.document.write('<tr class="item last total"> <td></td> <td> Total: '+total+'</td></tr>');
			frameDoc.document.write('<tr> <td></td> <td> Payment:  '+payment+'</td></tr>');
			frameDoc.document.write('<tr> <td></td> <td> Change: '+change+'</td></tr>');
			frameDoc.document.write('</table>');
			frameDoc.document.write('</div></body></html>');
			frameDoc.document.close();
			setTimeout(function () {
				window.frames["frame1"].focus();
				window.frames["frame1"].print();
				frame1.remove();
			}, 500);
		}
     });
});
</script>
@endif
@endsection 
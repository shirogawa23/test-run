@extends ('menubar.admin')

@section ('title','Employee Types| GH Management System')

@section ('headerTitle','Employee Type')

@section ('tabname','Maintenance')

@section ('pagename','Employee Type')

@section ('content')

<section class="content">
	<div class="box box-primary">
		
      	<div class="box-body">
      		<table class="table table-bordered table-hover dataTable " id="emptype">
      		<thead>
      			<tr>
      				<th>Employee Types</th>
      			
      				<th>Action</th>
      			</tr>
      		</thead>
      		<tbody>
      			@foreach($emptype as $emptype)
      			<tr>
      				<td>{{ $emptype->role_name }}</td>
      				<td>
                  <input type="text" name="" value="" class="hidden">
                  <a class="btn btn-warning btn-xs upEtypebtn" data-toggle="modal" href="#EmployeeTypeedit" data-id="{{ $emptype->role_id }}"><i class="fa fa-wrench" aria-hidden="true"></i></a>
                  <button type="button" class="btn btn-danger btn-xs delEtypebtn" data-id="{{ $emptype->role_id }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
      				</td>
      			</tr>

      			@endforeach
      		</tbody>
      	</table>
      	</div>
    </div>
</section>
<!-- update modal -->
<div class="modal fade" id = "EmployeeTypeedit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h4 class="modal-title"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Update employee type</h4>
      </div>
      <form class="form-horizontal" id="EmployeeType2" method="POST" action="/update_empType">
        <div class="modal-body">
            <div class="form-group">
              <label  class="col-sm-3 control-label">Employee Type</label>
                <div class="col-sm-8">
                  <input type="hidden" name="upemptype_id" value="" id="typefield_id">
                  <input type="text" class="form-control" name="updateemptype" value = "" id="typefield_name">
                </div>
            </div>
          {{ csrf_field() }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-xs btn-warning"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Update</button>
        </div>
      </form>
    </div>  
  </div>
</div>
<!-- add modal -->
<div class="modal fade" id="addEmpType">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Employee Type</h4>
      </div>
      <div class="modal-body">
         	<form class="form-horizontal" id="EmployeeTypeadd" method="POST" action="/save_empType">
          		<div class="box-body">
            		<div class="form-group">
		             	<label  class="col-sm-3 control-label">Employee Type</label>
              			<div class="col-sm-8">
	                		<input type="text" class="form-control" id="emptype" name="emptype" >
              			</div>
            		</div>
            		<hr>
            		<h4>Attributes needed:</h4>
            		<div class="col-md-12">
            			
            			<div class="col-md-4">
            				<div class="form-group">
		              			<div class="checkbox">
		              				<label><input type="checkbox" name="number" value="1"> Contact Number</label>
		            			</div>
            				</div>
	            			<div class="form-group">
		              			<div class="checkbox">
		              				<label><input type="checkbox" name="account" value="2"> Account</label>
		            			</div>
	            			</div>
            			</div>
            			<div class="col-md-4">
            				<div class="form-group">
		              			<div class="checkbox">
		              				<label><input type="checkbox" name="license" value="3"> License Number</label>
		            			</div>
            				</div>
	            			<div class="form-group">
		              			<div class="checkbox">
		              				<label><input type="checkbox" name="rank" value="4"> Position/Rank</label>
		            			</div>
	            			</div>
            			</div>
            			<div class="col-md-4">
	            			<div class="form-group">
		              			<div class="checkbox">
		              				<label><input type="checkbox" name="address" value="5"> Address</label>
		            			</div>
	            			</div>
            			</div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <div class="checkbox">
                          <label><input type="checkbox" name="rebate" value="6"> Rebate</label>
                      </div>
                    </div>
                  </div>
            		</div>
          		</div>
          <div class="box-footer">
            <button  data-dismiss="modal" class="btn btn-default">Cancel</button>
            <button type="submit" class="btn btn-info pull-right">Save</button>
          </div>
          {{ csrf_field() }}
        </form>
      </div>
     
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<form method="post" action="/deleteEmployeeType" id="delform">
{{csrf_field()}}
<input type="hidden" name="id" class="id">
</form>
@endsection
@section('datatables')

<script>

$(function() {


$('#emptype').DataTable({
  'paging'      : true,
  'lengthChange': true,
  'searching'   : true,
  'ordering'    : true,
  'info'        : true,
  'autoWidth'   : true
});
$(' <a class="btn btn-info btn-sm pull-right" href="#addEmpType" data-toggle="modal" ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; Add </a>').appendTo('div.dataTables_filter');

  $('.delEtypebtn').click(function(){
    $('#delform .id').val($(this).data('id'));
    $('#delform').submit();
  });

  $('.upEtypebtn').click(function(){
    $.ajax
    ({
      url: '/updateEmployeeType',
      type: 'get',
      data: { id:$(this).data('id') }, 
      dataType : 'json',
      success:function(response) {
        response.forEach(function(data) { 
          $('#typefield_id').val(data.role_id);
          $('#typefield_name').val(data.role_name);
        })
      }
    });
    return true;
  });

});
</script>

 
@endsection

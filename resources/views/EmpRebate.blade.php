@extends('menubar.admin')

@section ('title','Employee Rebate| GH Management System')

@section ('headerTitle','Employee Rebate')

@section ('tabname','Maintenance')

@section ('pagename','Employee Rebate')

@section ('content')

<section class="content">
	<div class="box box-primary">
		<div class="box-body">
		  <table class="table table-bordered table-hover dataTable" id="rebateTbl">
		  <thead>
		    <tr>
		    	<th>Employee Name</th>
	          	<th>Employee Type</th>
		    	<th>Action</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($emp_rebates as $emp_rebates)
		    <tr>
		      <td>{{ $emp_rebates->emp_fname }} {{ $emp_rebates->emp_mname }} {{ $emp_rebates->emp_lname }}</td>
		      <td>{{ $emp_rebates->role_name }}</td>
		      <td><a class="btn btn-danger btn-xs delbtn" href="#deleteModal"  data-toggle="modal" data-id="{{$emp_rebates->emp_id}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
		</div>
	</div>
</section>

<div class="modal fade" id = "addModal">
  <div class="modal-dialog" style="width: 50%">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h4 class="modal-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Employee Rebate</h4>
      </div>
      <form action="/save_empRebate" method="POST" class="form-horizontal">
        <div class="modal-body">
        	<div class="form-group" style="padding: 5%">
	            <label class="col-xs-2 control-label" for="emp_type">Employee</label>
	            <div class="col-xs-9 input-group">
	                <span class="input-group-addon"><i class="fa fa-user-md" aria-hidden="true"></i></span>
	                <select class="form-control select2 employeeTypeDropDown" name="emp_id" id="emp_id" style="width: 100%; ">
	                @foreach($emp_worebates as $emp_worebates)
	                  <option value="{{ $emp_worebates->emp_id }}">{{ $emp_worebates->emp_fname }} {{ $emp_worebates->emp_mname }} {{ $emp_worebates->emp_lname }}</option>
	                @endforeach
	                </select>
	            </div>
	          </div> 

	        <div class="modal-footer">
	          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
	          <button  class="btn btn-xs btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
	        </div>
        </div>
        {{ csrf_field() }}
      </form>
    </div>  
  </div>
</div>

<form method="post" action="/deleteRebate" id="delform">
{{csrf_field()}}
<input type="hidden" name="id" class="id">
</form>

@endsection

@section('datatables')

<script>
$(function () {
$('#rebateTbl').DataTable({
  'paging'      : true,
  'lengthChange': true,
  'searching'   : true,
  'ordering'    : true,
  'info'        : true,
  'autoWidth'   : true
});
$('.delbtn').click(function(){
    $('#delform .id').val($(this).data('id'));
    $('#delform').submit();
    });
$(' <a class="btn btn-primary btn-sm pull-right" href="#addModal" data-toggle="modal" ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; Add</a>').appendTo('div.dataTables_filter');

})
</script>

@endsection
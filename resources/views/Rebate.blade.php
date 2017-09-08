@extends('menubar.admin')

@section ('title','Rebate| GH Management System')

@section ('headerTitle','Rebate')

@section ('tabname','Maintenance')

@section ('pagename','Rebate')

@section ('content')

<section class="content">
	<div class="box box-primary">
		<div class="box-body">
		  <table class="table table-bordered table-hover dataTable" id="rebateTbl">
		  <thead>
		    <tr>
		      <th>Percentage</th>
		      <th>Date Created</th>
		      
		    </tr>
		  </thead>
		  <tbody>
		   @foreach($rebate as $rebate)
		    <tr>
		      <td>{{ $rebate->percentage }}</td>
		      <td>{{ $rebate->created_at }}</td>
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
        <h4 class="modal-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Edit Rebate</h4>
      </div>
      <form action="/save_rebatePercentage" method="POST" class="form-horizontal" id="rebate">
        <div class="modal-body">
        	<div class="form-group" style="margin-right:3% ">
	            <label class="col-sm-4 control-label text-right">Percentage</label>  
	              <div class="col-sm-6">
	                 <div class="input-group">
	                  <div class="input-group-addon">
	                  <i class="fa fa-percent"></i>
	                 </div>
	                <input  name="rebatepercent" type="text"  class="form-control input-md" required>
	              </div>
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

<div class="modal fade" id = "updateModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        
        <h4 class="modal-title"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Update</h4>
      </div>
      <form action="#" method="POST">
        <div class="modal-body">
          <h4></h4>
          <input type="text" class="hidden" name="id" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
          <button  class="btn btn-xs btn-warning"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Update</button>
        </div>
      </form>
    </div>  
  </div>
</div>

<div class="modal fade" id = "viewModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-info">
        
        <h4 class="modal-title"><i class="fa fa-info-circle" aria-hidden="true"></i> View Record</h4>
      </div>
      <form action="#" method="POST">
        <div class="modal-body">
          <h4></h4>
          <input type="text" class="hidden" name="id" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
        </div>
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
@endsection

@section('datatables')

<script>
$(function () {
$('#rebateTbl').DataTable({
  'paging'      : true,
  'lengthChange': true,
  'searching'   : true,
  'ordering'    : false,
  'info'        : true,
  'autoWidth'   : true
});
$(' <a class="btn btn-primary btn-sm pull-right" href="#addModal" data-toggle="modal" ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; Edit Rebate </a>').appendTo('div.dataTables_filter');
})
</script>

<script type="text/javascript">
    $('#add').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {    
            rebatepercent: {
                validators: {
                        regexp: {
                            regexp: /^([1-9]|[1-9]\d)(?:\.\d{1,2})?$/,
                            message: 'Invalid Input.'
                    },
                    stringLength: {
                        max: 9,
                        message:'Rebate limit reached'
                    },
                        notEmpty: {
                        message: 'This field is required.'
                    }
                }
            },                  
            }
        })

        ;
 </script>

@endsection
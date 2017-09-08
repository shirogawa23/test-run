@extends ('menubar.admin')

@section ('title','Service Type| GH Management System')

@section ('headerTitle','Service Type')

@section ('tabname','Maintenance')

@section ('pagename','Service Type')

@section ('content')

<section class="content">
	<div class="box box-primary">
    <div class="box-body">
      <table class="table table-bordered table-hover dataTable" id="servtypetbl">
      <thead>
        <tr>
          <th>Service Type</th>
          <th>Service Group</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($serviceType as $serviceType)
        <tr>
          <td>{{ $serviceType->service_type_name }}</td>
          <td>{{ $serviceType->servgroup_name }}</td>
          <td>
            <a class="btn btn-warning btn-xs upservtype" href="#updateModal"  data-toggle="modal" data-id="{{ $serviceType->service_type_id }}"><i class="fa fa-wrench" aria-hidden="true"></i></a>
            <a class="btn btn-danger btn-xs delbtn" data-id="{{ $serviceType->service_type_id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
          </td>
        </tr>

        
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
</section>

<div class="modal fade" id = "updateModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h4 class="modal-title"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Update</h4>
      </div>
      <div class="modal-body">
        <form action="/update_servType" method="POST" class="form-horizontal" id="servtypeedit">
          <div class="form-group" style="margin-right:3% ">
            <label class="col-xs-4 control-label">Service Type Name</label>  
              <div class="col-md-7">
                 <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-briefcase"></i>
                 </div>
                 <input name="upservTypeId" type="hidden" id="upservTypeId">
                <input  name="upservTypeName"  id="upservTypeName" type="text" placeholder="Service Type Name" class="form-control input-md" required>
              </div>
            </div>  
         </div> 
        {{ @csrf_field() }}
        <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-xs btn-warning"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Update</button>
        </div>
        </form>
      </div> 
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
  <div class="modal-dialog" style="width: 50%">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h4 class="modal-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Service Type</h4>
      </div>
      <div class="modal-body">
        <form action="/save_servType" method="POST" class="form-horizontal" id="servtypeadd">
          <div class="form-group">
            <label class="col-xs-4 control-label" for="emp_type">Group</label>
            <div class="col-md-6 input-group">
                <span class="input-group-addon"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                <select class="form-control select2" name="servGroup_id" id="emp_type" style="width: 100%;">
                @foreach($serviceGroup as $serviceGroup)
                  <option value="{{ $serviceGroup->servgroup_id }}">{{ $serviceGroup->servgroup_name }}</option>
                @endforeach
                </select>
            </div>
          </div>
          <div class="form-group" style="margin-right:3% ">
            <label class="col-xs-4 control-label">Service Type Name</label>  
              <div class="col-md-7">
                 <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-briefcase"></i>
                 </div>
                <input  name="servTypeName" type="text" placeholder="Service Type Name" class="form-control input-md" required>
              </div>
            </div>  
         </div> 
        {{ @csrf_field() }}
        <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-xs btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
        </div>
        </form>
      </div>
    </div>  
  </div>
</div>

<form method="post" action="/deleteServiceType" id="delform">
{{csrf_field()}}
<input type="hidden" name="id" class="id">
</form>
@endsection
@section('datatables')

<script>
$(function () {
$('#servtypetbl').DataTable({
  'paging'      : true,
  'lengthChange': true,
  'searching'   : true,
  'ordering'    : true,
  'info'        : true,
  'autoWidth'   : true
});
$(' <a class="btn btn-primary btn-sm pull-right" href="#addModal" data-toggle="modal" ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; Add </a>').appendTo('div.dataTables_filter');

  $('.delbtn').click(function(){
    $('#delform .id').val($(this).data('id'));
    $('#delform').submit();
  });

  $('.upservtype').click(function(){
    $.ajax
    ({
      url: '/updateServType',
      type: 'get',
      data: { id:$(this).data('id') }, 
      dataType : 'json',
      success:function(response) {
        response.forEach(function(data) { 
          $('#upservTypeId').val(data.service_type_id);
          $('#upservTypeName').val(data.service_type_name);
        })
      }
    });
    return true;
  });

});
</script>

@endsection

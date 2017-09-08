@extends ('menubar.admin')

@section ('title','Service Group| GH Management System')

@section ('headerTitle','Service Group')

@section ('tabname','Maintenance')

@section ('pagename','Service Group')

@section ('content')

<section class="content">
	<div class="box box-primary">
    <div class="box-body">
      <table class="table table-bordered table-hover dataTable" id="servGroup">
      <thead>
        <tr>
          <th>Service Group</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($serviceGroups as $serviceGroups)
        <tr>
          <td>{{ $serviceGroups->servgroup_name }}</td>
          <td>
            <a class="btn btn-warning btn-xs servgroupupbtn" href="#updateModal" data-toggle="modal" data-id="{{ $serviceGroups->servgroup_id }}"><i class="fa fa-wrench" aria-hidden="true"></i></a>
            <a class="btn btn-danger btn-xs delbtn" data-id="{{ $serviceGroups->servgroup_id }}" ><i class="fa fa-trash" aria-hidden="true"></i></a>
          </td>
        </tr>

        

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
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
</section>

<!-- delete modal -->
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

<!-- update modal -->
<div class="modal fade" id = "updateModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        
        <h4 class="modal-title"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Update</h4>
      </div>
      <div class="modal-body">
        <form action="/update_servGroup" method="POST" class="form-horizontal" id="servgrpedit">
          <div class="form-group" style="margin-right:3% ">
             <label class="col-xs-4 control-label">Service Group Name</label>  
                <div class="col-md-6">
                   <div class="input-group">
                    <div class="input-group-addon">
                     <i class="fa fa-briefcase"></i>
                   </div>
                   <input name="upservice_id" type="hidden" id="upservice_id">
                  <input  name="upservicegroup" type="text" id="upservicegroup" placeholder="Service Group Name" class="form-control input-md" required>
               </div>
            </div>  
         </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
          <button  class="btn btn-xs btn-warning" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Update</button>
        </div>
        {{ @csrf_field() }}
        </form>
      </div>
    </div>  
  </div>
</div>

<!-- add modal -->
<div class="modal fade" id = "addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h4 class="modal-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Service Group</h4>
      </div>
      <div class="modal-body">
        <form action="/save_servGroup" method="POST" class="form-horizontal" id="servgrpadd">
          <div class="form-group" style="margin-right:3% ">
             <label class="col-xs-4 control-label">Service Group Name</label>  
                <div class="col-md-6">
                   <div class="input-group">
                    <div class="input-group-addon">
                     <i class="fa fa-briefcase"></i>
                   </div>
                  <input  name="servicegroup" type="text" placeholder="Service Group Name" class="form-control input-md" required>
               </div>
            </div>  
         </div>
         
        <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
          <button  class="btn btn-xs btn-success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
        </div>
        {{ @csrf_field() }}
        </form>
      </div>
    </div>  
  </div>
</div>

<form method="post" action="/deleteServiceGroup" id="delform">
{{csrf_field()}}
<input type="hidden" name="id" class="id">
</form>
@endsection
@section('datatables')

<script>
$(function () {
$('#servGroup').DataTable({
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

  $('.servgroupupbtn').click(function(){
    $.ajax
    ({
      url: '/updateServGroup',
      type: 'get',
      data: { id:$(this).data('id') }, 
      dataType : 'json',
      success:function(response) {
        response.forEach(function(data) { 
          $('#upservice_id').val(data.servgroup_id);
          $('#upservicegroup').val(data.servgroup_name);
        })
      }
    });
    return true;
  });

});
</script>



@endsection

@extends ('menubar.admin')

@section ('title','Package| GH Management System')

@section ('headerTitle','Package')

@section ('tabname','Maintenance')

@section ('pagename','Package')

@section ('content')

<section class="content">

  
	<div class="box box-primary">
    <div class="box-body">
      <table class="table table-bordered table-hover dataTable" id="empTable">
      <thead>
        <tr>
          <th>Package Name</th>
          <th>Price</th>

          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($packages as $packages)
        <tr>
          <td>{{ $packages->pack_name }}<div class="pull-right"><button class="btn btn-xs btn-default"><i class="fa fa-info-circle" aria-hidden="true"></i></button></div></td>
          <td>{{ $packages->pack_price }}</td>
          <td>
            <a class="btn btn-warning btn-xs  updateModal" href="#updateModal" data-toggle="modal" data-id="{{$packages->pack_id}}"><i class="fa fa-wrench" aria-hidden="true"></i></a>
            <a class="btn btn-danger btn-xs delbtn" data-id="{{$packages->pack_id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
        <form action="/update_package" method="POST" class="form-horizontal" id="packageedit">
        <input type="hidden" name="packid" id="packid">
        <div class="form-group" style="margin-right:3% ">
          <label class="col-xs-4 control-label">Pakage Name</label>  
              <div class="col-md-6">
                <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-dropbox"></i>
                </div>
                <input  name="packagename" type="text" id="packname" placeholder="Package Name" class="form-control input-md" required>
              </div>
          </div>  
        </div> 

        <div class="form-group">
          <label class="col-xs-4 control-label">Services Offered</label>
          <div class="col-md-5 input-group">
            <select class="form-control select2 updatepackservice" name="services[]" values="" style="width: 108%" multiple="multiple" required>
            
              @foreach($servicegroup as $s)
              <optgroup label="{{ $s->servgroup_name }}">
                  @foreach($serviceoffer as $serviceoffer2)
                    @if($s->servgroup_id == $serviceoffer2->service_group_id)
                    <option value="{{ $serviceoffer2->service_id }}">{{ $serviceoffer2->service_name }}</option>
                    @endif
                  @endforeach              
                </optgroup>
              @endforeach
            </select> 
          </div>
        </div>
        <div class="form-group" style="margin-right:3% ">
          <label class="col-xs-4 control-label">Pakage Price</label>  
            <div class="col-md-6">
              <div class="input-group">
                <div class="input-group-addon">
                   <i class="fa fa-rub"></i>
                 </div>
                <input  name="packageprice" type="text" id="packprice" placeholder="Price" class="form-control input-md" required>
             </div>
          </div>  
       </div> 
       <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-xs btn-warning" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Update</button>
        </div>
        {{ csrf_field() }}
      </form>
    </div>  
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

<div class="modal fade" id = "addModal">
  <div class="modal-dialog" style="width: 70%">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h4 class="modal-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Package</h4>
      </div>
      <div class="modal-body">
        <form action="/save_package" method="POST" class="form-horizontal" id="packageadd">
        <div class="form-group" style="margin-right:3% ">
          <label class="col-xs-4 control-label">Pakage Name</label>  
              <div class="col-md-6">
                <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-dropbox"></i>
                </div>
                <input  name="packagename" type="text" id="example-text-input" placeholder="Package Name" class="form-control input-md" required>
              </div>
          </div>  
        </div> 

        <div class="form-group">
          <label class="col-xs-4 control-label">Services Offered</label>
          <div class="col-md-5 input-group">
            <select class="form-control select2 packservice" name="services[]" values="" style="width: 108%" multiple="multiple" required>
            @php $serviceoffer2 = $serviceoffer @endphp
              @foreach($servicegroup as $s)
              <optgroup label="{{ $s->servgroup_name }}">
                  @foreach($serviceoffer as $serviceoffer2)
                    @if($s->servgroup_id == $serviceoffer2->service_group_id)
                    <option value="{{ $serviceoffer2->service_id }}">{{ $serviceoffer2->service_name }}</option>
                    @endif
                  @endforeach              
                </optgroup>
              @endforeach
            </select> 
          </div>
        </div>
        <div class="form-group" style="margin-right:3% ">
          <label class="col-xs-4 control-label">Pakage Price</label>  
            <div class="col-md-6">
              <div class="input-group">
                <div class="input-group-addon">
                   <i class="fa fa-rub"></i>
                 </div>
                <input  name="packageprice" type="text" id="example-number-input" placeholder="Price" class="form-control input-md" required>
             </div>
          </div>  
       </div> 
       <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-xs btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
        </div>
        {{ csrf_field() }}
      </form>
      </div>
    </div>  
  </div>
</div>

<form method="post" action="/deletePackage" id="delform">
{{csrf_field()}}
<input type="hidden" name="id" class="id">
</form>
@endsection
@section('datatables')


 
<script>
$(function () {
$('#empTable').DataTable({
  'paging'      : true,
  'lengthChange': true,
  'searching'   : true,
  'ordering'    : true,
  'info'        : true,
  'autoWidth'   : true
  
});
$(' <a class="btn btn-primary btn-sm pull-right" href="#addModal" data-toggle="modal" ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; Add </a>').appendTo('div.dataTables_filter');
$('.packservice').select2({
  placeholder: 'Services offered'
});


  $('.delbtn').click(function(){
    $('#delform .id').val($(this).data('id'));
    $('#delform').submit();
  });


  $('.updateModal').click(function(){
    $.ajax
    ({
      url: 'updatePackage',
      type: 'get',
      data:  { id:$(this).data('id')},
      dataType : 'json',

      success:function(response){
        response[0].forEach(function(data){
          $('#packid').val(data.pack_id);
          $('#packname').val(data.pack_name);
          $('#packprice').val(data.pack_price);
        })
        var selectedValues = new Array();
        var i = 0;
        response[1].forEach(function(data){
          selectedValues[i] = data.pack_serv_serv_id;
          i++;
        })
        $('.updatepackservice').val(selectedValues).trigger('change');
      }
    });
  });

})

</script>


@endsection

@extends ('menubar.admin')

@section ('title','Service| GH Management System')

@section ('headerTitle','Service')

@section ('tabname','Maintenance')

@section ('pagename','Service')

@section ('content')

<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      <table class="table table-bordered table-hover dataTable" id="servicesTbl">
      <thead>
        <tr>
          <th>Service Name</th>
          <th>Service Group</th>
          <th>Service Type</th>
          <th>Price</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($service as $service)
        <tr>
          <td>{{ $service->service_name }}</td>
          <td>{{ $service->servgroup_name }}</td>
          <td>{{ $service->service_type_name }}</td>
          <td>{{ $service->service_price }}</td>
          <td>
            <a class="btn btn-warning btn-xs editsrvc" href="#updateModal" data-id="{{ $service->service_id }}" data-toggle="modal"><i class="fa fa-wrench" aria-hidden="true"></i></a>
            <a class="btn btn-danger btn-xs delbtn"  data-id="{{$service->service_id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
          </td>
        </tr>
        @endforeach
        </tbody>
        <br>
      </table>
      <div id="controlPanel">
        <button>Import CSV</button>
      </div>
      </div>
      </div>


<div class="modal fade" id = "updateModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h4 class="modal-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Update Service</h4>
      </div>
      <div class="modal-body">
        <form action="/update_Service" method="POST" class="form-horizontal" id="servedit" >
        <input type="hidden" name="srvcid" id="srvcid">
         {{ csrf_field() }}
          <div class="form-group" style="margin-right:3% ">
            <label class="col-sm-4 control-label text-right">Service Name</label>  
              <div class="col-sm-6">
                 <div class="input-group">
                  <div class="input-group-addon">
                  <i class="fa fa-briefcase"></i>
                 </div>
                <input  name="srvcname" id="srvcname" type="text" placeholder="Service Name" class="form-control input-md" required>
              </div>
            </div>  
         </div>
         <div class="form-group" style="margin-right:3% ">
          <label class="col-sm-4 control-label text-right">Service Group</label>  
            <div class="col-sm-6">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-rub"></i>
                </div>
                  <select class="form-control srvcgrp" name="srvcgrp_id" id="srvcgrpid" disabled="">
                    <option value = "0">Service Group(Optional)</option> <!-- dito ididisplay lahat ng service group -->
                    @foreach($groupdropdown as $gd) 
                    <option value="{{$gd->servgroup_id}}">{{$gd->servgroup_name}}</option>
                    @endforeach
                  </select>
            </div>
          </div>  
        </div> 
         <div class="form-group" style="margin-right:3% ">
          <label class="col-sm-4 control-label text-right">Service Type</label>  
            <div class="col-sm-6">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-rub"></i>
                </div>
                  <select class="form-control" id="typesel" name="srvctyp_id" disabled=""> <!-- dito magaad ng service type everytime na mag onchange ung sa group -->
                    <option value = "0">Service Type(Optional)</option>
                  </select>
            </div>
          </div>  
        </div> 
         <div class="form-group" style="margin-right:3% ">
          <label class="col-sm-4 control-label text-right">Service Price</label>  
            <div class="col-sm-6">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-rub"></i>
                </div>
              <input  name="srvc_price" id="srvcprice" type="text" placeholder="Service Price" class="form-control input-md" required>
            </div>
          </div>  
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
          <button class="btn btn-xs btn-success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Update</button>
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
      </tbody>
    </table>
    </div>
  </div>
</section>


<div class="modal fade" id = "addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h4 class="modal-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Service</h4>
      </div>
      <div class="modal-body">
        <form action="/save_Service" method="POST" class="form-horizontal" id="servadd">
         {{ csrf_field() }}
          <div class="form-group" style="margin-right:3% ">
            <label class="col-sm-4 control-label text-right">Service Name</label>  
              <div class="col-sm-6">
                 <div class="input-group">
                  <div class="input-group-addon">
                  <i class="fa fa-briefcase"></i>
                 </div>
                <input  name="srvcname" type="text" placeholder="Service Name" class="form-control input-md" required>
              </div>
            </div>  
         </div>
         <div class="form-group" style="margin-right:3% ">
          <label class="col-sm-4 control-label text-right">Service Group</label>  
            <div class="col-sm-6">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-rub"></i>
                </div>
                  <select class="form-control srvcgrp" name="srvcgrp_id" id="servg" style="width: 100%">
                    <option value = "0">Service Group(Optional)</option> <!-- dito ididisplay lahat ng service group -->
                    @foreach($groupdropdown as $gd) 
                    <option value="{{$gd->servgroup_id}}">{{$gd->servgroup_name}}</option>
                    @endforeach
                  </select>
            </div>
          </div>  
        </div> 
         <div class="form-group" style="margin-right:3% ">
          <label class="col-sm-4 control-label text-right">Service Type</label>  
            <div class="col-sm-6">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-rub"></i>
                </div>
                  <select class="form-control"  name="srvctyp_id" id="servt" style="width: 100%"> <!-- dito magaad ng service type everytime na mag onchange ung sa group -->
                    <option value = "0">Service Type(Optional)</option>
                  </select>
            </div>
          </div>  
        </div> 
         <div class="form-group" style="margin-right:3% ">
          <label class="col-sm-4 control-label text-right">Service Price</label>  
            <div class="col-sm-6">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-rub"></i>
                </div>
              <input  name="srvc_price" type="text" placeholder="Service Price" class="form-control input-md" required>
            </div>
          </div>  
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
          <button class="btn btn-xs btn-success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
        </div>

        </form>
      </div>
    </div>  
  </div>
</div>

<form method="post" action="/deleteService" id="delform">
{{csrf_field()}}
<input type="hidden" name="id" class="id">
</form>
@endsection
@section('datatables')

<script>
$(function () {
$('#servicesTbl').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : true,
     
  });

  $(' <a class="btn btn-primary btn-sm pull-right" href="#addModal" data-toggle="modal" ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; Add </a>').appendTo('div.dataTables_filter');

  $('#servg').select2();
  $('#servt').select2();
  $('.delbtn').click(function(){
    $('#delform .id').val($(this).data('id'));
    $('#delform').submit();
  });

    $('.srvcgrp').on('change',function(){ // onchange function ng service group dropdown
      var optionSrvc = ""; 
      $.ajax
      ({
        url: '/getServiceType', //eto ung route para makuha ung mga service type na may parehong service type id
        type: 'get',
        data: {ID:$(this).val()}, // value ng selected sa dropdown ng service group
        dataType : 'json',
        success:function(response) { //eto ung response na galing sa controller na kinquery
          response.forEach(function(data) { 
            optionSrvc += '<option value="'+data.service_type_id+'">'+data.service_type_name+'</option>'; // then inistore sa isang variable 
          })
          $('#typesel').empty(); // inempty ung dropdown ng service type
          $('#typesel').append('<option value = "0">Service Type(Optional)</option>'); // default value
          $('#typesel').append(optionSrvc);  //inappend sa service type dropdown ung laman ng optionsrvc        
        }
      });
    });

    $('#servg').on('change',function(){ // onchange function ng service group dropdown
      var optionSrvc = ""; 
      $.ajax
      ({
        url: '/getServiceType', //eto ung route para makuha ung mga service type na may parehong service type id
        type: 'get',
        data: {ID:$(this).val()}, // value ng selected sa dropdown ng service group
        dataType : 'json',
        success:function(response) { //eto ung response na galing sa controller na kinquery
          response.forEach(function(data) { 
            optionSrvc += '<option value="'+data.service_type_id+'">'+data.service_type_name+'</option>'; // then inistore sa isang variable 
          })
          $('#servt').empty(); // inempty ung dropdown ng service type
          $('#servt').append('<option value = "0">Service Type(Optional)</option>'); // default value
          $('#servt').append(optionSrvc);  //inappend sa service type dropdown ung laman ng optionsrvc        
        }
      });
    });
    
});

</script>
<script type="text/javascript">
$('.editsrvc').on('click',function(){
  
      $.ajax
      ({
        url: '/getService', //eto ung route para makuha ung mga service type na may parehong service type id
        type: 'get',
        data: {ID:$(this).data('id')}, // value ng selected sa dropdown ng service group
        dataType : 'json',
        success:function(response) { //eto ung response na galing sa controller na kinquery
          response.forEach(function(data) {
            $('#srvcid').val(data.service_id);
            $('#srvcname').val(data.service_name);
            $('#srvcprice').val(data.service_price);
            $('#srvcgrpid').val(data.service_group_id);
            $('#typesel').val(data.service_type_id);

          })      
        }
      });
    });
  $('#servicesTbl').on("click",".editsrvc",function(){
  $('.editsrvc').on('click',function(){
 
      $.ajax
      ({
        url: '/getService', //eto ung route para makuha ung mga service type na may parehong service type id
        type: 'get',
        data: {ID:$(this).data('id')}, // value ng selected sa dropdown ng service group
        dataType : 'json',
        success:function(response) { //eto ung response na galing sa controller na kinquery
          response.forEach(function(data) {
            $('#srvcid').val(data.service_id);
            $('#srvcname').val(data.service_name);
            $('#srvcprice').val(data.service_price);
            $('#srvcgrpid').val(data.service_group_id);
            $('#typesel').val(data.service_type_id);

          })      
        }
      });
    });
});
  
</script>
@endsection
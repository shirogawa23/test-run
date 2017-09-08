@extends ('menubar.admin')

@section ('title','Census Report| GH Management System')

@section ('headerTitle','Census Report')

@section ('tabname','Reports')

@section ('pagename','Census Report')

@section ('content')

<section class="content">
<br>
    <div class="row">
      <div class="col-md-12">

        <div class="col-md-4">
          <div class="input-group">
          <label class="control-label">Service Group</label>&nbsp;
            <select style="width: 335px" class="form-control select2 group_dropdown" name="sg_id[]" id="sg_id"  multiple="multiple" required>
            @foreach($servgroup as $sg)
            <option value="{{ $sg->servgroup_id }}">{{ $sg->servgroup_name }}</option>
            @endforeach
            </select> 
          </div>
        
      
         <div>
            <label>Date range:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="reservation">
            </div>
          </div>

          <br>
        <div>
          <div class="input-group">
          <label class="control-label"><br></label>&nbsp;
             <a class="btn btn-primary btn-sm" id="generateBtn" style="width: 300px"><strong>Generate</strong></a>
          </div>
        </div>
       </div>

     <div class="col-md-8"></div>

 <div class="col-md-12"><hr>
  <div class="box box-solid box-primary">
    <div class="box-header" id="service_grpHead"><center><h4 class=""><strong>Service Report</strong></center></h4></div>
    <div class="box-body">
      <table class="table table-bordered table-hover dataTable" id="empTable">
      <thead>
        <tr>
          <th width="40%">Service Group</th>
          <th width="40%">Service Name</th>
          <th width="20%">Number of Transaction</th>
        </tr>
      </thead>
      <tbody id="table_body">
        
        

      </tbody>
    </table>
    </div>
  </div>
</div>

 </div>
    </div>
</section>

@endsection
@section('datatables')


 

<script type="text/javascript">
var count = 0;
  $('#generateBtn').click(function(){
    var sg_id = $('#sg_id').val();
    var id = sg_id.toString().split(',');
    var date = $('#reservation').val().toString().split(' - ');
    
    $('#table_body').empty();
    $.ajax
    ({
      url: '/censusReportData',
      type: 'get',
      data:  { id:id},
      dataType : 'json', 

        success:function(response){
        response[0].forEach(function(data){
          
          $('#table_body').empty();
          
          var servgroup_id = data.servgroup_id;
          var sg_name = data.servgroup_name;
          response[1].forEach(function(data){
            
            
            if(servgroup_id == data.service_group_id)
            {
              var serv_id = data.service_id;

              $.ajax
            ({
              url: 'censusServiceCount',
              type: 'get',
              data: {id:serv_id,date:date},
              dataType : 'json',
                success:function(response){
                    count = response.length;
                    $('#table_body').append('<tr><td>'+sg_name+'</td><td>'+data.service_name+'</td><td>'+count+'</td></tr>')  
                }
            });
              
            }
          })
        })
      }
    });
  });
</script>
<script>
  $(function () {
   
   $('#reservation').daterangepicker();

  });
  $('#empTable').DataTable({
  'paging'      : false,
  'lengthChange': true,
  'searching'   : false,
  'ordering'    : false,
  'info'        : false,
  'autoWidth'   : true
  });
</script> 

@endsection

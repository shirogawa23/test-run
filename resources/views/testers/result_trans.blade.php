@extends ('menubar.admin')

@section ('title','Result')

@section ('headerTitle','Result')

@section ('tabname','Home')

@section ('pagename','Result')

@section ('content')

<section class="content">
	<div class="box box-primary">
    <div class="box-body">
      <h3><center>{{ $servgroup_name }}</center></h3>
      <table class="table table-bordered table-hover dataTable" id="result_tbl">
      <thead>
        <tr>
          
          
          <th>Transaction Date</th>
          <th>Patient Last Name</th>
          <th>Patient Middle Name</th>
          <th>Patient First Name</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
      @foreach($trans_table as $trans_table) 
        <tr>
          
         
          <td>{{ $trans_table->date }}</td>
          <td>{{ $trans_table->patient_lname }}</td>
          <td>{{ $trans_table->patient_mname }}</td>
          <td>{{ $trans_table->patient_fname }}</td>
          <td>
            <a class="btn btn-primary btn-xs"><i class="fa fa-download" aria-hidden="true"></i></a>
            <a class="btn btn-warning btn-xs add_resultBtn" href="#LayoutModal" data-toggle="modal" data-id=""><i class="fa fa-plus" aria-hidden="true"></i></a>
          </td>
        </tr>

        @endforeach
      </tbody>
    </table>
    </div>
  </div>
</section>    
<div class="modal fade" id = "layoutModal{{ $trans_table->result_id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-info">
        <h4 class="modal-title"><i class="fa fa-info-circle" aria-hidden="true"></i> View Record</h4>
      </div>
      <form action="/add_result" method="POST">
        <div class="modal-body">
          <h4></h4>
          <input type="text" class="hidden" name="servgroup_id"  id="servgroup_idField">
          <input type="text" class="hidden" name="result_id"  id="result_idField">
          <input type="text" class="hidden" name="patient_id" id="patient_idField">
          <input type="text" class="hidden" name="trans_id" id="trans_idField">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>  
  </div>
</div>

<div class="modal fade" id = "LayoutModal">
  <div class="modal-dialog" style="width: 70%">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h4 class="modal-title"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Pick a Layout</h4>
      </div>
      <div class="modal-body">
      <form action="" method="POST" class="form-horizontal" id=""> 

          <div class="modal-footer">
            <button type="button" class="btn btn-xs pull-left" data-dismiss="modal">Back</button>
            <a href="/result_addlayout" class="btn btn-xs btn-success"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;Proceed</a>
          </div>
        {{ csrf_field() }}
      </form>
      </div>
    </div>  
  </div>
</div>

@endsection
@section('datatables')
<script type="text/javascript">
  $('#add_resultBtn').click(function(){
    var servgroup_idField = "";
    var result_idField = "";
    var patient_idField = "";
    var trans_idField = "";
    $.ajax
    ({
      url: '/retriveIDLayout',
      type: 'get',
      data:  { id:$(this).data('id')},
      dataType : 'json',
      success:function(response){
        response[0].forEach(function(data){
        })
      }
    });
    $('#layoutModal').modal('show');
  })
</script>
<script>
  $(function(){
    $('#result_tbl').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true

    });
  });
</script>
@endsection
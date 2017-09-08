@extends ('menubar.admin')

@section ('title','Result')

@section ('headerTitle','Result')

@section ('tabname','Result')

@section ('pagename','Add Result')

@section ('content')

<section class="content">
	<div class="box box-primary">
    <div class="box-body">

      <div class="col-md-12"><hr>

        <div class="col-md-3">

          <div class="input-group"">
          <label class="col-xs-2 control-label">Label</label>  
              <div class="col-md-6">
              
                <select style="width: 550%" class="form-control select2 group_dropdown" name="sg_id[]" id="sg_id"  multiple="multiple" required>
            </select> 
              
          </div> 
         </div><br>

          <div class="input-group"">
          <label class="col-xs-2 control-label">Label</label>  
              <div class="col-md-6">
                <div class="input-group">
                <input  name="" type="text" id="" placeholder="" class="" required>
              </div>
          </div> 
         </div><br>

         <div class="input-group"">
          <label class="col-xs-2 control-label">Label</label>  
              <div class="col-md-6">
                <div class="input-group">
                <input  name="" type="text" id="" placeholder="" class="" required>
              </div>
          </div> 
         </div><br>

         <div class="input-group"">
          <label class="col-xs-2 control-label">Label</label>  
              <div class="col-md-6">
                <div class="input-group">
                <input  name="" type="text" id="" placeholder="" class="" required>
              </div>
          </div> 
         </div><br>
        </div>

        <div class="col-md-9">
          (laman ng pdf)
        </div>

      </div>
    </div>
  </div>
</section>    

@endsection
@section('datatables')

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
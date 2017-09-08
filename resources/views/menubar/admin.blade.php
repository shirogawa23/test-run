<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('/plugins/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/bower_components/jvectormap/jquery-jvectormap.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/textfields.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="bootstrapvalidator/dist/css/bootstrapValidator.css"/>
  <link rel="stylesheet" href="{{ asset('/plugins/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/bower_components/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/alerts/dist/sweetalert.css') }}">
  <script src="{{ asset('/plugins/alerts/dist/sweetalert.min.js') }}"></script>
  
  <style type="text/css">
    
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a href="/dashboard" class="logo">
      <span class="logo-mini"><b>G</b>H</span>
      <span class="logo-lg"><b>Global</b>Health</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
     

    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="/dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Maintenance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Employee
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="/EmployeeType"><i class="fa fa-circle-o"></i> Employee Type</a></li>    
                <li><a href="/Employee"><i class="fa fa-circle-o"></i> Employee List</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Rebate
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="/Rebate"><i class="fa fa-circle-o"></i> Rebate Log</a></li>
                <li><a href="/EmpRebate"><i class="fa fa-circle-o"></i> Employee's Rebate</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Service
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="/ServiceGroup"><i class="fa fa-circle-o"></i> Service Group</a></li>
                <li><a href="/ServiceType"><i class="fa fa-circle-o"></i> Service Type</a></li>
                <li><a href="/Service"><i class="fa fa-circle-o"></i> Service List</a></li>
              </ul>
            </li>

           <!-- <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Result
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="/Result"><i class="fa fa-circle-o"></i> Fields</a></li>    
                <li><a href="#"><i class="fa fa-circle-o"></i> Layout</a></li>
              </ul>
            </li> -->


            <li><a href="/Package"><i class="fa fa-circle-o"></i> Package</a></li>
            <li><a href="/Corporate"><i class="fa fa-circle-o"></i> Corporate Account</a></li>

          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-handshake-o" aria-hidden="true"></i> <span>Transaction</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/frontdesk_trans"><i class="fa fa-circle-o"></i> Medical Services</a></li>
            <li><a href="/resultdashboard"><i class="fa fa-circle-o"></i> Result</a></li>
            
          </ul>
        </li>

        <li class="treeview">
          <a href="">
            <i class="fa fa-clipboard"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/Census"><i class="fa fa-circle-o"></i>Census</a></li>
            
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i> <span>Utilities</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Company Details</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Reactivation</a></li>
            
          </ul>
        </li>
    </section>
  </aside>
  
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          @yield('headerTitle')
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"> @yield('tabname')</a></li>
          <li class="active">@yield('pagename')</li>
        </ol>
      </section>
      @yield('content')
    </div>
    @if (Session::has('message'))
      <script>
        swal({   
          title: "{{ Session::get('title') }}",   
          text: "{{ Session::get('message') }}",   
          type: "{{ Session::get('type') }}",
          timer: 5000,
          confirmButtonText: "Okay" 
        });
        
      </script>
    @endif
</div>


<script src="{{ asset('/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('/plugins/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/plugins/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('/plugins/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('/plugins/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('/plugins/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('/plugins/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('/plugins/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('/plugins/bower_components/Chart.js/Chart.js') }}"></script>
<script src="{{ asset('/plugins/dist/js/pages/dashboard2.js') }}"></script>
<script src="{{ asset('/plugins/dist/js/demo.js') }}"></script>
<!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script> --><script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('/plugins/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/plugins/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script type="text/javascript" src="bootstrapvalidator/dist/js/bootstrapValidator.js"></script>
<script src="{{ asset('/plugins/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('/plugins/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('/plugins/dist/js/val.js') }}"></script>


<script>
  $(function(){
    $('.select2').select2();
    
  })

</script>
@yield('datatables')
</body>
</html>

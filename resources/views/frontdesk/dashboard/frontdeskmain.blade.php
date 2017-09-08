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
  <link rel="stylesheet" href="{{ asset('/plugins/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/bower_components/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a href="index2.html" class="logo">
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
          <a href="/frontdeskdashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="/frontdesk_trans">
            <i class="fa fa-stethoscope" aria-hidden="true"></i> <span>Transaction</span>
          </a>
        </li>
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
<script src="{{ asset('/plugins/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/plugins/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
  $(function(){
    $('.select2').select2();
    
  })

</script>
@yield('datatables')

</body>
</html>

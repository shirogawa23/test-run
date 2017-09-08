<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="stylesheet" href="{{ asset('/plugins/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/bower_components/jvectormap/jquery-jvectormap.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/plugins/dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 
</head>
    <body>
      <div class="container">
        <form class="form-signin" method="POST" action="/doLogin">
          <div class="panel">
              <div class="panel-body text-center">
                  <p class="atomic-mass">Log-in</p>
                  {{csrf_field()}}
                  <div class="form-group form-animate-text" ">
                    <input type="text" required name="user">
                  
                  </div>
                  <div class="form-group" ">
                    <input type="password" class="form-text" required name="password">
                  
                  </div>
                  
                  <input type="submit" class="btn btn-success btn-round col-md-12" value="Log-in"/>
              </div>
                
          </div>
        </form>

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
</body>
</html>
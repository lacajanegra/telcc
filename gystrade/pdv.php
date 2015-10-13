<?php

$idPdv = $_GET['idPdv'];
//echo $idPdv;

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GYS Trade | Punto de venta</title>
    <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>G</b>yS</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>GyS</b>Trade</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
             
              <!-- Notifications: style can be found in dropdown.less -->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs">GyS User Test</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                      GyS User Test - by CLO
                      <small>Septiembre 2015</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">op1</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">op2</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">op3</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
             
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <?php require('side-menu.php'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Panel de control
            <small>Version 1.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Panel de control</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="col-md-4">

              <div class="box box-success">
                  <div class="box-header">
                    <h3 class="box-title">Ventas por producto</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    <table class="table table-condensed">
                      <tbody id="sales-product">
                        <tr><th style="width: 5%">#</th><th style="width: 80%">Producto</th><th style="width: 15%">Ventas</th></tr>

                    </tbody></table>
                  </div><!-- /.box-body -->
                </div>
            </div>



          <div class="col-md-4">
          
               <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title ">Stock por producto</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    <table class="table table-condensed">
                      <tbody id="stock-product"><tr><th style="width: 5%">#</th><th style="width: 80%">Producto</th><th style="width: 15%">Stock</th></tr>

                    </tbody></table>
                  </div><!-- /.box-body -->
                </div>




              





            </div>


  <div class="col-md-4">

              <div class="box box-success">
                  <div class="box-header">
                    <h3 class="box-title">Pedidos por producto</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    <table class="table table-condensed">
                      <tbody id="order-product">
                        <tr><th style="width: 5%">#</th><th style="width: 80%">Producto</th><th style="width: 15%">Pedido</th></tr>

                    </tbody></table>
                  </div><!-- /.box-body -->
                </div>
            </div>

       

        </section>
















<div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Mapa de ubicaciones</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body" style="display: block;">
                  <div id="map" style="width: 100%; height: 400px;"></div>
            </div><!-- /.box-body -->
            <div class="box-footer" style="display: block;">
              Visita <a href="#">Detalle Ubicaciones</a> para obetener más información.
            </div>
</div>























































<section class="content">

          <!-- row -->
          <div class="row">
            <div class="col-md-12">
              <!-- The time line -->
              <ul class="timeline">
                <!-- timeline time label -->
               
                <!-- END timeline item -->
                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-green">
                    3 Jan. 2014
                  </span>
                </li>
                <!-- /.timeline-label -->

                <!--  timeline items from ajax -->
     
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div><!-- /.col -->
          </div><!-- /.row -->

       

        </section>











      
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2015 <a href="http://almsaeedstudio.com">CLO Consulting</a>.</strong> Todos los derechos reservados.
      </footer>

      
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js"></script>
    <script src="dist/js/demo.js"></script>
    <script type="text/javascript">

      var FSCampaigns = new Firebase('https://telegramcc.firebaseio.com/campaign');
      var FSRoot = new Firebase('https://telegramcc.firebaseio.com');
      var FSPdv = new Firebase('https://telegramcc.firebaseio.com/pdv/<?php echo $idPdv ?>');
     
      FSPdv.child('products').once('value',function(snapshot) {
        var cont = 0;
          snapshot.forEach(function(data){
            cont++;
            var product= data.val();
            composeSalesStock(product.name,product.stock,product.sales,product.order, cont);
            console.log(product.sales + cont);
          });
      }); 

    

  





function composeSalesStock(p_name,p_stock,p_ventas,p_order, cont){

  var salesDiv = '<tr><td>'+cont+'</td><td>'+p_name+'</td><td><span class="badge bg-green">'+p_ventas+'</span></td></tr>';
  var StocksDiv = '<tr><td>'+cont+'</td><td>'+p_name+'</td><td><span class="badge bg-blue">'+p_stock+'</span></td></tr>';
  var orderDiv = '<tr><td>'+cont+'</td><td>'+p_name+'</td><td><span class="badge bg-blue">'+p_order+'</span></td></tr>';

  $( "#sales-product" ).append( salesDiv ).fadeIn('slow');
  $( "#stock-product" ).append( StocksDiv ).fadeIn('slow');
  $( "#order-product" ).append( orderDiv ).fadeIn('slow');
}













    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 11,
      center: new google.maps.LatLng(-33.45, -70.65),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });


var FSLocations = new Firebase('https://telegramcc.firebaseio.com/locations');

      FSLocations.on('child_added', function(snapshot) { //Recibe mensaje

          var data =snapshot.val();
          console.log(data);
          placeMarker(data.lat,data.lng,data.chatId);
          
      });
var FSImages = new Firebase('https://telegramcc.firebaseio.com/images');



      FSImages.on('child_added', function(snapshot) { //Recibe mensaje
          var data =snapshot.val();
          $( ".timeline" ).prepend( '<li><i class="fa fa-camera bg-purple"></i><div class="timeline-item" style="max-width:400px; width:auto;"><span class="time"><i class="fa fa-clock-o"></i> Hace una hora</span><h3 class="timeline-header"><a href="#">'+ data.chatId +'</a> subió una nueva foto</h3><div class="timeline-body" style="width:auto"><img src="'+ data.img +'" alt="..." width=100% ></div></div></li>' ).fadeIn('slow');
          
      });

var FSComment = new Firebase('https://telegramcc.firebaseio.com/comments');
 FSComment.on('child_added', function(snapshot) { //Recibe mensaje
          var data =snapshot.val();
          $( ".timeline" ).prepend( '<li><i class="fa fa-comments bg-yellow"></i><div class="timeline-item"><span class="time"><i class="fa fa-clock-o"></i> Hace una hora</span><h3 class="timeline-header"><a href="#">'+ data.chatId +'</a> ha escrito un comentario</h3><div class="timeline-body" style="font-size:1.1em; margin-left:0.5em;color:#909090">"'+ data.comment +'"</div><div class="timeline-footer"></div></div></li>' ).fadeIn('slow');
          
      });



function placeMarker(latitude, longitude, title) {
        var infowindow = new google.maps.InfoWindow({
            content: "ID: " + String(title)
        });
        var marker = new google.maps.Marker({
            position: {lat: latitude, lng: longitude},
            map: map,
            title: "ID: " + String(title)
        });
        marker.addListener('mouseover', function() {
            infowindow.open(map, marker);
        });
        marker.addListener('mouseout', function() {
            infowindow.close(map, marker);
        });
}



    </script>
  </body>
</html>

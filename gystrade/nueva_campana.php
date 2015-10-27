<?php

$idPdv = $_GET['idPdv'];
$id_mandator="id1";
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

 <?php require('header.php'); ?>
      <!-- Left side column. contains the logo and sidebar -->
     <?php require('side-menu.php'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
                                        <div class="spinner" style=" overflow: hidden; text-align:center">
                                          <div class="wait"></div>
                                          <div class="ball"></div>
                                          <div class="ball"></div>
                                          <div class="ball"></div>
                                          <div class="ball"></div>
                                </div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Campañas
            <small>Nueva Campaña</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Nueva Campaña</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

              <div class="col-md-12">

                            <div class="box box-gys">

                                <div class="box-header with-border">
                                    <h3 class="box-title">General Elements</h3>
                                  </div><!-- /.box-header -->
                                  <div class="box-body">
                                        <div class="col-md-4">       
                                            <form role="form">
                                              <!-- text input -->
                                              <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" id="campaign-name" class="form-control" placeholder="Nombre de Campaña">
                                              </div>
                                            </form>
                                        </div>
                                        <div class="col-md-4">       
                                           <div class="form-group">
                                                        <div class="form-group">
                                                              <label>Marca</label>
                                                              <select id="brand-select" class="form-control select2" style="width: 100%;">
                                                             
                                                              </select>
                                                        </div><!-- /.form-group -->
                                          </div>
                                        </div>
                                        <div class="col-md-4">       
                                          <div class="form-group">
                                                              <label>Punto de Venta</label>
                                                              <select id="pdv-select" class="form-control select2" style="width: 100%;">
                                                         
                                                              </select>
                                            </div><!-- /.form-group -->
                                        </div>
                                        
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                          <button type="submit" class="btn btn-default">Limpiar</button>
                                          <button id="create-campaign" class="btn btn-info pull-right">Crear</button>
                                </div>
                            </div>
              </div>
              
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
      $(".spinner").css("visibility","hidden");

      var FSCampaigns = new Firebase('https://telegramcc.firebaseio.com/campaign');
      var FSRoot = new Firebase('https://telegramcc.firebaseio.com');
      var FSPdv = new Firebase('https://telegramcc.firebaseio.com/pdv/<?php echo $idPdv ?>');
     
      FSRoot.child("brand").on('child_added', function(snapshot) {
              data = snapshot.val();
              dataId = snapshot.key();
              var brandSel = '<option id ="brand-'+dataId +'" value="'+dataId +'">'+data.name +'</option>';
              composeSelect(brandSel,'brand-select'); 
        }); 
      FSRoot.child("pdv").on('child_added', function(snapshot) {
              data = snapshot.val();
              dataId = snapshot.key();
              console.log(data);
              var brandSel = '<option id ="pdv-'+dataId +'" value="'+dataId +'">'+data.nombre +'</option>';
              composeSelect(brandSel,'pdv-select'); 
        }); 

    


function composeSelect(brandSel,idSel){
  $( "#"+idSel ).append( brandSel );
}

$('#create-campaign').on('click',function(){
  $(".spinner").css("visibility","inherit");
  var e = document.getElementById("brand-select");
  var brand = e.options[e.selectedIndex].value;
  e = document.getElementById("pdv-select");
  var pdv = e.options[e.selectedIndex].value;
  var name= $('#campaign-name').val();
console.log({
  "brand_id": brand,
  "name": name,
  "pdv": {
    "pdv_id": pdv
  },
  "inspectors": {
    "<?php echo $id_mandator ?>": "true"
  }
});
 FSCampaigns.push({
  "brand_id": brand,
  "name": name,
  "pdv": {
    "pdv_id": pdv
  },
  "inspectors": {
    "<?php echo $id_mandator ?>": "true"
  }
}, function(){

$('.wait').html('Hecho');
setTimeout( function() {
$('#campaign-name').val('');
$(".spinner").css("visibility","hidden");
//window.location.replace("http://stackoverflow.com");
              }, 1000 );

});
});
    </script>
  </body>
</html>

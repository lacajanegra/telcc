<?php
session_start();

if($_SESSION['active-user']!='yes')
{
    header('Location: login.php');
}else{
  $_SESSION["check-status"]="no";
}


$id_mandator="id1";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GYS Trade | Dashboard</title>
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Piloto 
            <small>Version 1.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Panel de control</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="col-md-12">
              
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Vuestras Campañas</h3>
                </div><!-- /.box-header -->
                <div id="box-body" class="box-body">


               


                </div><!-- /.box-body -->
              </div><!-- /.box -->









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

      var FSCampaigns = new Firebase('https://telegramcc.firebaseio.com/campaign');
      var FSRoot = new Firebase('https://telegramcc.firebaseio.com');
      var FSPdv = new Firebase('https://telegramcc.firebaseio.com/pdv');
        FSCampaigns.on('child_added', function(snapshot) { //Recibe mensaje
            var data = snapshot.key();
            var cname = '';
            var idPdv = '';
            var nameBrand = ''; 
               //var data=3;
            FSCampaigns.child(data+"/inspectors").once('child_added', function(snapshot) {
              console.log(snapshot.exists())
                if (snapshot.key() == "<?php echo $id_mandator; ?>") //cambiar por id real
                {
                      var idRef = snapshot.ref().parent().parent().key();
                      FSCampaigns.child(idRef).on('value',function(snapshot) {
                            var data = snapshot.val();
                            //console.log(data);
                             FSRoot.child('brand/' + data.brand_id).once('value',function(snapshot) {
                                  var data = snapshot.val();
                                  nameBrand = data.name;
                            }); 

                            var data2 = snapshot.child('pdv').val();
                            idPdv = data2.pdv_id;
                            cname = data.name;
                            FSPdv.child(data2.pdv_id).once('value',function(snapshot) {
                                  var data = snapshot.val();
                                  composeCampaigns(idPdv,data.nombre,cname,nameBrand);
                            }); 

                       }); 
                };
            }); 
        });




function composeCampaigns(id_pdv,pdv_name,camp_name,name_brand){
  $( "#box-body" ).prepend( '<div class="box-group" id="accordion"><div class="panel "><div class="box-header with-border"><a data-toggle="collapse" data-parent="#accordion" href="#collapse'+camp_name+'" aria-expanded="false" class="collapsed"><div style="float:right"><h4 class="box-title" style="color:#B3B3B3; font-size:1em">'+ name_brand + '</h4></div> <h4 class="box-title"><i class="fa fa-fw fa-shopping-cart"> </i> ' +camp_name +'</h4></a></div><div id="collapse'+camp_name+'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"><div class="box-body"><a href="pdv.php?idPdv='+id_pdv+'">'+pdv_name+'</a></div></div></div></div>' ).fadeIn('slow');
}


    </script>
  </body>
</html>

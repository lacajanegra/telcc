<?php

session_start();
if($_SESSION['active-user']=='yes'){
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Plataforma Digital GySTrade - by CLO.CL</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
          <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  </head>
<script type="text/javascript">
$(document).ready(function(){

    $("#login-button").click(function(){ //textbox

                     var user = $("#user-usr").val();
                     var password = $("#user-pass").val();

                     var content;
                          $.ajax({
                                type: "POST",
                                url: "includes/login/chk.php",
                                data: "user=" + user + "&password=" + password,
                                dataType: "html",
                                beforeSend: function(){
                                  console.log("enviando");
                                      //imagen de carga
                                     
                                      $(".spinner").css("visibility", "inherit");
                                },
                                error: function(){
                                      console.log("error petición ajax");
                                },
                                success: function(data){       
                                      
                                if (data==1) {
                                
                                  location.href = "index.php";
            //                      
                                }else{
                                  console.log("error en login");
                                  $(".spinner").css("visibility", "hidden");
                                  alert("No te conozco ;)");
                                  //location.href = "login.php";
                                  };
                                   
                                   //$(".login-form").html("<div class='form-group'><a href='includes/login/select-mode.php?mode=modo1' class='select-mode btn btn-block btn-lg btn-primary ' id='modo1'>Modo 1</a><label class='login-field-icon fui-arrow-right for='login-name'></label></div><div class='form-group'><a href='includes/login/select-mode.php?mode=modo2' class='btn btn-block btn-lg btn-primary select-mode' id='modo2'>Modo 2</a><label class='login-field-icon fui-arrow-right' for='login-name'></label></div>");
                                     // $("#statistic-panel").html(data);
                                      
                                                                         
                                }
                          });
               

                  
        });

});

</script>           
  <body class="hold-transition login-page">

    <div class="login-box box" style="border-top-color: #E0E0E0; ">
       <div class="spinner" style=" overflow: hidden; text-align:center">
                <div class="wait">Cargando</div>
                <div class="ball"></div>
                <div class="ball"></div>
                <div class="ball"></div>
      </div>
      <div class="login-logo" style="margin-bottom:0">
        <img class="profile-user-img img-responsive img-circle" src="dist/img/gystrade_cuadrado.png" alt="GySTrade">
        <p class="text-muted text-center">Plataforma Digital</p>
       
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Inicio de sesión</p>
        
          <div class="form-group has-feedback">
            <input type="email" class="form-control" id="user-usr" placeholder="Usuario">
            <span class="fa fa-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="user-pass" placeholder="Contraseña">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Recordar
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <div id="login-button" class="btn btn-primary btn-block btn-flat">Ir</button>
            </div><!-- /.col -->
          </div>


    

        <a href="#">Recuperar Contraseñar</a><br>
        <a href="register.html" class="text-center">Registrar</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>

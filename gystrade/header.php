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
                  <img src="<?echo $_SESSION["user-logo"]?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?echo $_SESSION["user-name"] ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?echo $_SESSION["user-logo"]?>" class="img-circle" alt="User Image">
                    <p>
                      <?echo $_SESSION["user-name"] ?> - by CLO
                      <small>Octubre 2015</small>
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
                      <a href="includes/login/logout.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
             
            </ul>
          </div>
        </nav>
      </header>
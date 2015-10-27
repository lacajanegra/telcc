


<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="http://clo.cl/alice/telcc/gystrade/dist/img/userTilibra-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION["user-name"] ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Buscar...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Navegación</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Campañas</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php"><i class="fa fa-circle-o"></i> Ver Campañas</a></li>
                <li class=""><a href="nueva_campana.php"><i class="fa fa-circle-o"></i> Crear Campaña</a></li>
              </ul>
            </li>
            <!--<li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Puntos de Venta</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="campanas.php"><i class="fa fa-circle-o"></i> Ver Puntos de Venta</a></li>
                <li class=""><a href="nueva_campana.php"><i class="fa fa-circle-o"></i> Crear Punto de Venta</a></li>
              </ul>
            </li>-->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Operadores</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="operadores.php"><i class="fa fa-circle-o"></i> Ver Operadores</a></li>
                <!--<li class=""><a href="nueva_campana.php"><i class="fa fa-circle-o"></i> Crear Operador</a></li>-->
              </ul>
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

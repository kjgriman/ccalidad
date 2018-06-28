 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Bienvenido, <?php print($userRow['user_name']);  ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Enlinea</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU PRINCIPAL</li>
        <li class="treeview">
          <a href="dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Escritorio</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class=" treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Registro</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="ficha.php"><i class="fa fa-circle-o"></i> Inspecci&oacute;n</a></li>
            <li><a href="registertienda.php"><i class="fa fa-circle-o"></i> Tienda</a></li>
             
             <li><a href="registercategory.php"><i class="fa fa-circle-o"></i> Categoria</a></li>
             <li><a href="registeritems.php"><i class="fa fa-circle-o"></i> Items</a></li>
            <li><a href="reg_user.php"><i class="fa fa-circle-o"></i> Usuario</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Consultas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="data.php"><i class="fa fa-circle-o"></i> Historico de inspecciones</a></li>
            <li><a href="historico.php"><i class="fa fa-circle-o"></i> Historico por tienda</a></li>

          </ul>
        </li>
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

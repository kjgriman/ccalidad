<?php
require_once 'header.php';

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Control de Calidad | Listado</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="plugins/iCheck/all.css">
     <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
        button.btn.btn-primary {
    background: #61d582;
    margin-top: 5px;
    color: #fff!important;
}
input#reservation {
    background: #fff;
    border: 1px solid #ccc;
}
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

 
  <header class="main-header">
    <!-- Logo -->
    <a href="dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Control</b> de Calidad</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php print($userRow['user_name']); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                 <?php print($userRow['user_name']); ?>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                    <a href="logout.php" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
     <?php require_once('aside.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Historico por local
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Historico por local</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
            
              <div class="row">
         <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Listado de tiendas</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
        
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                    <?php
                    $result= $ficha->historicbylocal();
                    // print_r($result);
                    foreach ($result as $key => $value) {
                      print_r($value);
                      ?>
                    <tr>
                    <td class="mailbox-name"><a href="" onclick="showmodal()"><?php print_r($value['tienda']);?> | <?php print_r($value['pasillo']);?></a></td>
                    <td class="mailbox-subject"><b>Reporte de todas las inspecciones</b>
                    </td>
                    <td class="mailbox-attachment"></td>
                    </tr>

                      <?php
                    }
                    ?>

                  
                  
                  
                  
                  
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
       </div>
      <!-- /.row -->
      
      <!--modal-->
      
     <div class="modal fade" id="addBookDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Detalle Inspecci&oacute;n</h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                         <input type="hidden" name="id" id="id" class="form-control" >
                        <label for="recipient-name" class="control-label">Fecha Inspecci&oacute;n:</label>
                        <input name="fecha" id="fecha" class="form-control" disabled >
                      </div>
                   </div>
                   <div class="col-md-4">
                      <div class="form-group">
                        <label for="recipient-name" class="control-label">Local:</label>
                        <input name="tienda" id="tienda" class="form-control" disabled >
                      </div>
                   </div>
           <div class="col-md-4">
                         <div class="form-group">
                             <input type="hidden" name="id" id="id" class="form-control" >
                            <label for="recipient-name" class="control-label">Inspector:</label>
                            <input name="usuario" id="usuario" class="form-control" disabled >
                          </div>
                   </div>
            </div> 
            <div class="row">
                  
                   <div class="col-md-12">
                       <div class="form-group">
                         <input type="hidden" name="id" id="id" class="form-control" >
                        <label for="recipient-name" class="control-label">Observaciones:</label>
            <textarea name="observaciones" id="observaciones" class="form-control" rows="4" disabled></textarea>
                      
                      </div>
                   </div>
            </div> 
             <div class="row">
                           <div class="col-md-12" >
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
              <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Limpieza</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                   <div class="form-group">
                    <label>Pisos&nbsp;&nbsp;</label>
                    <label>
                      <input type="text" name="pisos" id="pisos"  value="No" disabled>
                    </label>
                  </div>
                                </div>
                <div class="col-md-4">
                                    <div class="form-group">
                    <label>Paredes&nbsp;&nbsp;</label>
                    <label>
                    <input type="text" name="paredes" id="paredes"  value="No" disabled>
                    </label>
                  </div>
                                </div>
                <div class="col-md-4">
                                    <div class="form-group">
                    <label>Inyectores de aire fresco&nbsp;&nbsp;</label>
                    <label>
                    <input type="text" id="inyectores"  value="No" disabled>
                    </label>
                  </div>
                                </div>
                
                            </div>
                             <div class="row">
                                <div class="col-md-4">
                                   <div class="form-group">
                    <label>Extractores de grasa&nbsp;&nbsp;</label>
                    <label>
                    <input type="text" id="extractores" value="No"  disabled>
                    </label>
                  </div>
                                </div>
                <div class="col-md-4">
                                    <div class="form-group">
                    <label>Trampa de grasa&nbsp;&nbsp;</label>
                    <label>
                    <input type="text" id="trampa"  value="No" disabled>
                    </label>
                  </div>
                                </div>
                <div class="col-md-4">
                                    <div class="form-group">
                    <label>Desagues&nbsp;&nbsp;</label>
                    <label>
                      <input type="text" id="desagues" value="No" disabled>
                    </label>
                  </div>
                                </div>
                
                            </div>
              <div class="row">
                                <div class="col-md-4">
                                   <div class="form-group">
                    <label>Fumigaci&oacute;n roedores/cucaracha&nbsp;&nbsp;</label>
                    <label>
                    <input type="text" id="fumigacion" value="No" disabled>
                    </label>
                  </div>
                                </div>
                <div class="col-md-4">
                                    <div class="form-group">
                    <label>Musica muy alta &nbsp;&nbsp;</label>
                    <label>
                    <input type="text" id="musica" value="No" disabled>
                    </label>
                  </div>
                                </div>
                <div class="col-md-4">
                                    &nbsp;
                                </div>
                
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
              <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Vitrinas</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                   <div class="form-group">
                    <label>Arreglo de exhibicion&nbsp;&nbsp;</label>
                    <label>
                      <input type="text" id="arreglo" value="No"  disabled>
                    </label>
                  </div>
                                </div>
                <div class="col-md-4">
                                    <div class="form-group">
                    <label>Limpieza&nbsp;&nbsp;</label>
                    <label>
                      <input type="text" id="limpieza"  value="No" disabled>
                    </label>
                  </div>
                                </div>
                <div class="col-md-4">
                                    <div class="form-group">
                    <label>Banner por cambio de vitrina&nbsp;&nbsp;</label>
                    <label>
                    <input type="text" id="banner" value="No"  disabled>
                    </label>
                  </div>
                                </div>
                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>     
            </div>     
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!--modal fotos-->
   
     <div class="modal fade" id="AddFotosDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Fotos Inspecci&oacute;n:</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
             <input type="hidden" name="nroFotoId" id="nroFotoId" class="form-control" >
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.o
    </div>
    <strong>Copyright &copy; 2017 <a href="#">Albrook Mall</a></strong>
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  
   //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
    
   
  
  });
  
  $(document).ready(function () {
       $(".open-AddBookDialog").click(function () {
        $('#nroId').val($(this).data('id'));
        $('#fecha').val($(this).data('fecha'));
        $('#usuario').val($(this).data('usuario'));
        $('#tienda').val($(this).data('tienda'));
        $('#observaciones').val($(this).data('observaciones'));
        resultado = $(this).data('resultado');
        //alert (resultado);
        var elem = resultado.split(',');
        //alert (elem[0]);
        $('#pisos').val("No");
        $('#paredes').val("No");
        $('#inyectores').val("No");
        $('#extractores').val("No");
        $('#trampa').val("No");
        $('#desagues').val("No");
        $('#fumigacion').val("No");
        $('#musica').val("No");
        $('#arreglo').val("No");
        $('#limpieza').val("No");
        $('#banner').val("No");
        
        
        if(elem[0]=="1"){
            $('#pisos').val("Si");
        }
        if(elem[1]=="1"){
            $('#paredes').val("Si");
        }
        if(elem[2]=="1"){
            $('#inyectores').val("Si");
        }
        if(elem[3]=="1"){
            $('#extractores').val("Si");
        }
        if(elem[4]=="1"){
            $('#trampa').val("Si");
        }
        if(elem[5]=="1"){
            $('#desagues').val("Si");
        }
        if(elem[6]=="1"){
            $('#fumigacion').val("Si");
        }
        if(elem[7]=="1"){
            $('#musica').val("Si");
        }
        if(elem[8]=="1"){
            $('#arreglo').val("Si");
        }
        if(elem[9]=="1"){
            $('#limpieza').val("Si");
        }
        if(elem[10]=="1"){
            $('#banner').val("Si");
        }
        
        $('#addBookDialog').modal('show');
        
    });
    
     $(".open-AddFotosDialog").click(function () {
        $('#nroFotoId').val($(this).data('id'));
        $('#AddFotosDialog').modal('show');
    });
    
  });   
</script>
</body>
</html>

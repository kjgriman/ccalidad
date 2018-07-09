<?php
require_once 'header.php';

/*if($user->is_loggedin()!="")
{
 $user->redirect('dashboard.php');
}*/
$msje="";
$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
$max_file_size = 1024*100; //100 kb
$path = "uploads/"; // Upload directory
$count = 0;

if(isset($_POST['btn-aceptar']))
{
 
    $idLocal = $_POST['txt_idlocal'];
    $fecha = $_POST['txt_fecha'];
    $obs = $_POST['obsv'];
	$plazo = $_POST['txt_plazo'];
	
    $idusuario = $user_id;
  
	$dia= substr($fecha, 0, 2);
	$mes= substr($fecha, 3, 2);
	$yyyy= substr($fecha, 6, 4);
  $mysqldate = $yyyy."-".$dia."-".$mes;
  //echo "Nro ".$mysqldate;
  
   $nro = $ficha->registerFicha($idLocal,$mysqldate,$obs,$plazo,$idusuario);
  // echo "Nro ".$nro;
   
   $totalItem1 = intval($_POST['totalItem']);
   $totalCategoria1 = intval($_POST['totalCategoria']);
   
   //Guardamos los item de la ficha
   for($i=1;$i<=$totalItem1;$i++){
    $valor = $_POST['item'.$i];
		$categoria = $_POST['categoria_'.$i];
		$resultado->addResultado($nro,$i,$categoria,$valor);
   }
   
   //Guardamos las observaciones de cada categoria
  
  
   for($j=1;$j<=$totalCategoria1;$j++){
		$valor = $_POST['obsv'.$j];
    $categoria = $_POST['categoria_'.$j];
    // var_dump($nro);
    // var_dump($categoria);
    // var_dump($valor);
    /*var_dump($j);
    var_dump($valor);*/
		$fichaobservacion->addFichaObservacion($nro,$categoria,$valor);
   }
   
   
   
   // Loop $_FILES to exeicute all files
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) {	           
	        if ($_FILES['files']['size'][$f] > $max_file_size) {
	            $message[] = "$name is too large!.";
	            continue; // Skip large files
	        }
			elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name is not a valid format";
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files 
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
	            $count++; // Number of successfully uploaded file
	            $archivo->addFile($name,$nro);
	        }
	    }
	}
   
   
   
   $msje="Registro guardado satisfactoriamente";
  // header('Location: ficha.php');
}
?>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Control de Calidad | Ficha</title>
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
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"hs></script>
  <![endif]-->
   <style>
.col-md-4 {
    border-right: 1px solid #ececec;
    height: 49px;
    padding: 10px;
    margin-bottom: 6px;
    font-size: 14px;
    background: #f9f9f9;
}

label {
    display: inline-table;
    max-width: 100%;
    margin-bottom: 20px;
    font-weight: 700;
    font-size: 12px;
    position: relative;
    top: -1px;
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
        Registro de inspecci&oacute;n
      </h1>
      <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Registro inspecci&oacute;n</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
       <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
                <?php
                if($msje!=""){ ?>
                    <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong><?php echo $msje; ?></strong>
</div>
            <?php    }
                ?>
              <h3 class="box-title">Ingreso de inspecci&oacute;n</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div class="row">
        
            <form role="form" method="post" enctype="multipart/form-data" action="ficha.php">

              <div class="box-body">
                   <div class="col-md-6">
                <div class="form-group">
                <label>Local</label>
                <select name="txt_idlocal" required="required" class="form-control select2" style="width: 100%;">
                <?php
                $result2 = $ficha->getAllTiendaPasillo();
                foreach ($result2 as $key2 => $value2) {
                ?>
                    <option value="<?php echo $result2[$key2]['id'] ?>" ><?php echo $result2[$key2]['tienda'] ?> | <?php echo $result2[$key2]['pasillo'] ?></option>
                  <?php
                  
                }
                ?>
              </select>
               
               </div>
                <div class="form-group">
                  
                </div>
                   </div>
                   <div class="col-md-6">
                <div class="form-group">
                    
                    <label for="exampleInputPassword1">Fecha inspecci&oacute;n</label>
					<div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="txt_fecha" class="form-control pull-right" id="datepicker"  required="required">
                </div>
                  
                  
                </div>
                
                       </div>
                       
                        <div class="col-md-12">
            <div class="panel-group" id="accordion">
			
				<?php

					$totalItem=0;
					$totalCategoria=0;
          $idareauserlog = $userRow['id_area']; 
					$result1 = $ficha->getAllCategorias($idareauserlog);
						foreach($result1 as $row){
							$totalCategoria++;
							$idCat = $row['id'];
							$nombreCat = $row['nombre'];
							echo "<div class='panel panel-default'>";
							echo "<div class='panel-heading'>";
							echo "<h4 class='panel-title'>";
							echo "<a data-toggle='collapse' data-parent='#accordion' href='#collapse".$idCat."'>";
							echo "<i class='fa fa-check-square-o' aria-hidden='true'></i>&nbsp;". $nombreCat ."</a>";
							echo "</h4>";
							echo "</div>";
							echo "<div id='collapse".$idCat."' class='panel-collapse collapse'>";
							echo "<div class='panel-body'>";
                            echo "<div class='row'>";
							$result2 = $ficha->getAllItems($idCat);
							foreach($result2 as $row2){
                
							   $idItem = $row2['id'];
							   $nombreItem = $row2['nombre'];
									$totalItem++;	
									echo "<div class='col-md-4'>";
									echo "<div class='form-group'>";
									echo "<label>". utf8_decode($nombreItem) ."&nbsp;&nbsp;</label>";
                  echo "<label>";
									echo "<input type='hidden' value='".$row2['id_categoria']."' id='categoria_".$totalItem."' name='categoria_".$totalItem."'>";
									echo "<input type='radio' name='item".$totalItem."' id='item".$idItem."' value='1' class='flat-red' required='required'>Si&nbsp;&nbsp;";
									echo "</label>";
									echo "<label>";
									echo "<input type='radio' name='item".$totalItem."' id='item".$idItem."' value='0' class='flat-red'>No";
									echo "</label>";
									echo "</div>";
									echo "</div>";
							}
							
							echo "</div>";
							echo "<div class='row'>";
							echo "<div class='col-md-12'>";
							echo "<div class='form-group'>";
							echo "<label>Observaciones</label>";
							echo "<textarea class='form-control' required='required' rows='2' name='obsv".$totalItem."' placeholder='Observaciones ...'></textarea>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
					}
				
				
				//

				?>
                
						<input type="hidden" name="totalItem" value="<?php echo $totalItem;?>">	
						<input type="hidden" name="totalCategoria" value="<?php echo $totalCategoria;?>">	
						
						<br><br>
                       
                          <div class="col-lg-6 col-sm-6 col-12">
                    <label>Subida de fotos</label>
           <input hidden id="file" name="file"/>

    <!-- You can add extra form fields here -->
    <input type="file" multiple="multiple" name="files[]" class="btn btn-primary">

    <!-- <div class="dropzone dropzone-file-area" id="fileUpload">
        <div class="dz-default dz-message">
            <h3 class="sbold">Arraste las imagenes aqui para subirlas</h3>
            <span>Tambien puede dar click para abrir el explorador de archivos</span>
        </div>
    </div> -->

            <span class="help-block">
                Intenta subir una o mas fotos para esta inspecci&oacute;n
            </span>
        </div>
                
                  <!--div class="col-md-6">
                     
                      <div class="form-group">
                    <div class="fileUpload btn btn-primary">
                        <span>Subir Fotos</span>
                  <input type="file" id="file"  class="upload" name="files[]" multiple="multiple" accept="image/*" required="required" />
				  </div>
				   </div>
                   </div-->
                  
				  <div class="col-md-6">
                <div class="form-group">
                    
                    <label>Observaciones</label>
                  <textarea class="form-control" required="required" rows="3" name="obsv" placeholder="Observaciones ..."></textarea>
                  
                  
                </div>
                
                       </div>
					   <div class="col-md-6">
                <div class="form-group">
                    
                    <label>Plazo para corregir anomalias a partir de la fecha del reporte</label>
                  <select name="txt_plazo" required="required" class="form-control select2" style="width: 100%;">
					<option value="1">1 dia</option>
                    <option value="2">2 dias</option>
					<option value="3">3 dias</option>
                   </select>
                </div>
                
                       </div>
                       
                  <div class="col-md-12">
					<div class="box-footer">
						<button type="submit" name="btn-aceptar" class="btn btn-primary btn-block">Guardar</button>
					  </div>
				  </div> 
                  
              </div>
              <!-- /.box-body -->

              
            </form>
          </div>
          <!-- /.box -->

  
       

          
             

        </div>
       
      </div>
      <!-- /.row (main row) -->

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
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>

  Dropzone.options.fileUpload = {
    url: 'ficha.php',
    addRemoveLinks: true,
    uploadMultiple: true,
    maxFilesize: 5,
    autoProcessQueue: false,
    maxFiles: 5,
    acceptedFiles: "image/*",
    dictInvalidFileType:"Archivo no permitido",
    dictRemoveFile: "<div style='background: red;color: white;width: 80%;left: 10%;position: absolute;top: 104%; border-radius: 10%;'><i class='fa fa-trash-o' aria-hidden='true'>  </i> Eliminar</div>",
    accept: function(file) {
        let fileReader = new FileReader();

        fileReader.readAsDataURL(file);
        fileReader.onloadend = function() {

            let content = fileReader.result;
            $('#file').val(content);
            file.previewElement.classList.add("dz-success");
        }
        file.previewElement.classList.add("dz-complete");
    }
}
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

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

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
  
  $(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });

  // if ($('input[name="item221"]').is(':checked')) {
  //       alert('Campo correcto');

  //   } else {
  //       alert('Debe seleccionar al menos un color');
  //   }
  
});


</script>
</body>
</html>

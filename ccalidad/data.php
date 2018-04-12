<?php
require_once 'header.php';


?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
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

  <link rel="stylesheet" href="dist/css/style.css">
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
    background: #61d582!important;
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
        Resultados
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Resultados</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	<form action="#" method="post" class="sidebar-form pad">
              <div class="row">
			  
          	<div class="col-md-4">
				 

              <div class="form-group">
                <label>Local</label>
                <select name="txt_idlocal" required="required" class="form-control select2" style="width: 100%;">
                  <option value="">Seleccione</option>
                  <option value="T">Todas las tiendas</option>
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
			   </div>
				   <div class="col-md-4">
				  <div class="form-group">
                <label>Fechas</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="rango" class="form-control pull-right" id="reservation" required="required">
                </div>
                <!-- /.input group -->
              </div>
			   </div>
			   <div class="col-md-4">
				   <div class="form-group">
				    <label>Inspector</label>
				  <select name="txt_idUsuario" required="required" class="form-control select24" style="width: 100%;">
										<option value="">Seleccione</option>
										<option value="T">Todos los inspectores</option>
										<?php
										   $result1 = $user->getAllInspectores();
											foreach($result1 as $row){
												echo "<option value='". $row['user_id'] ."'>". $row['user_name'] ."</option>";
											}
										?>
										
                </select>
				
				  </div>
          </div> 
		  </div>
		   <div class="row">
		   
  


<div class="col-md-4">
				   <div class="form-group">
                                <button type="submit" name="btn-aceptar"  class='btn btn-primary'>Buscar</button>
				 </div> 
</div> 
 <div class="row">

</div>


				  </div> </form>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Inspeciones realizadas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nro</th>
                  <th>Fecha inspecci&oacute;n</th>
                  <th>Local</th>
                  <th>Inspector</th>
                  <th>Acci&oacute;n</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if(isset($_POST['btn-aceptar']))
                        {
                            $idLocal = $_POST['txt_idlocal'];
                      //       $idCategoria = $_POST['txt_idGrupo'];
                            $inspector = $_POST['txt_idUsuario'];
							               // $item = $_POST['txt_idItem'];
							
                      //       $valor= $_POST['txt_valor'];
                            $rango = $_POST['rango'];
                            $fechas = explode(" - ", $rango);
                            
                           
                            $fecha1 = $fechas[0];
                            
                            $dia= substr($fecha1, 0, 2);
                        	$mes= substr($fecha1, 3, 2);
                        	$yyyy= substr($fecha1, 6, 4);
                            $fecha11 = $yyyy."-".$dia."-".$mes;
                          
                            $dia= substr($fechas[1], 0, 2);
                        	$mes= substr($fechas[1], 3, 2);
                        	$yyyy= substr($fechas[1], 6, 4);
                            $fecha2 = $yyyy."-".$dia."-".$mes;
                            
                        	//echo "Valores  ".$idLocal." - ". $inspector ." - ".   $idCategoria . " - ".$fecha11 . " - ".$fecha2 ;
                          
                        	
                        	$result1 = $ficha->searchByLocal1($idLocal,$fecha11,$fecha2,$inspector);
// print_r($result1);
                        	$nro=0;
                        	//echo  "Total". $stmt->rowCount() ."<br>";
                        	 
                        	    
                        	        // foreach($result1 as $row){
                                     
                                 //      $resultado = $ficha->searchResultadosFicha($row['id']);
                                      
                                 //      //echo $resultado;
                                 //        echo "<tr><td>". $nro."</td><td>". $row['fecha_inspeccion']."</td><td>"/*.$row['tienda'] .*/ " - "/*. $row['pasillo'].*/"</td><td>"./*$row['user_name'].*/"</td><td><button type='button' class='btn btn-primary open-AddBookDialog' data-toggle='modal' data-id='".$row['id']."' data-fecha='".$row['fecha_inspeccion']."'  data-usuario='"/*.$row['user_name'].*/"' data-resultado='".$resultado ."' data-tienda='"/*.$row['tienda'] .*/ " - "/*. $row['pasillo'].*/"' data-observaciones='".$row['observaciones']."' >Ver detalles</button>&nbsp;&nbsp;<!--button type='button' class='btn btn-info open-AddFotosDialog' data-toggle='modal' data-id='".$row['id']."' >Ver fotos</button--></td></tr>";
                                 //        $nro++;
                                 //    }
                                    foreach($result1 as $row){
                                      
                        	           
                                      $resultado = $ficha->searchResultadosFicha($row[0]);
                        	            $resultado2 = $ficha->querycategory($row[0]);
                                      // print_r($resultado2);
                                      if($resultado != null){

                                      $resultadojson= json_encode($resultado, JSON_FORCE_OBJECT);
                                      }
                                      else {
                                        $resultadojson  = '';
                                      }
                                      // print_r($resultadojson);
                                       if($resultado2 != null){

                                      $resultadojson2= json_encode($resultado2, JSON_FORCE_OBJECT);
                                      }
                                      else {
                                        $resultadojson2  = '';
                                      }
                                      ?>
                                       
                                      <tr>
                                        <td><input type="text" name="data_<?php echo $nro;?>" id="data_<?php echo $nro;?>" value='<?php print_r ($resultadojson); ?>'> <input type="text" name="resultado2_<?php echo $nro;?>" id="resultado2_<?php echo $nro;?>" value='<?php print_r ($resultadojson2); ?>'><?php echo $nro; ?></td>
                                        <td><?php echo $row['fecha_inspeccion'] ?></td>
                                        <td><?php echo $row['tienda'] ?></td>
                                        <td><?php echo $row['user_name'] ?></td>
                                        <td><button type="button" class="btn btn-primary " onclick="showmodaldetail('<?php echo $nro; ?>','<?php print_r($row['fecha_inspeccion'])  ;?>', '<?php print_r($row['tienda'])  ;?>','<?php print_r($row['user_name'])  ;?>','<?php print_r($row['pasillo'])  ;?>' ,'<?php print_r($row['observaciones'])  ;?>');"  >Ver detalles</button></td>
                                        
                                      <!--   data-toggle='modal' data-target="#addBookDialog" 
                                          data-fecha="<?php echo $row['fecha_inspeccion']; ?>"
                                          data-usuario="<?php echo $row['user_name']; ?>"
                                          data-tienda="<?php echo $row['tienda'].' - '.$row['pasillo']; ?>"
                                          data-observaciones="<?php echo $row['observaciones']; ?>"  -->
                                      </tr>

                                      <?php
                        	            
                                        /*print_r( "<tr><td>". $nro."</td><td>". $row['fecha_inspeccion']."</td><td>".$row['tienda'] . " - ". $row['pasillo']."</td><td>".$row['user_name']."</td><td><button type='button' class='btn btn-primary open-AddBookDialog' data-toggle='modal' data-id='".$row['id']."' data-fecha='".$row['fecha_inspeccion']."'  data-usuario='".$row['user_name']."' data-resultado='".$resultado ."' data-tienda='".$row['tienda'] . " - ". $row['pasillo']."' data-observaciones='".$row['observaciones']."' >Ver detalles</button>&nbsp;&nbsp;<!--button type='button' class='btn btn-info open-AddFotosDialog' data-toggle='modal' data-id='".$row['id']."' >Ver fotos</button--></td></tr>");*/
                                        $nro++;
                                    }
                                    
                                  
                        	
                        }
                ?>    
               
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
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
                


                            <?php
                            $idareauserlog = $userRow['id_area']; 
                            $categories = $ficha->getAllCategorias($idareauserlog);
                              foreach ($categories as $key => $value) {
                               
                              
                            ?>
                  <!-- <div class="panel panel-default">
                      <div class="panel-heading">
                          <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#codllapseTwo_<?php echo $key?>">
    							               <i class="fa fa-check-square-o" aria-hidden="true"></i><?php echo ucfirst($value['nombre'])?> 
                                 <span class="label label-danger">2</span>
                              </a>
                          </h4>
                      </div>
                      <div id="codllapseTwo_<?php echo $key?>" class="panel-collapse collapse">
                          <div class="panel-body">
                              <div class="row">
                            <?php
                          $idCat = $value['id'];
                          $resu = $ficha->getAllItems($idCat);
                              foreach($resu as $row2){
                               
                            ?>

                                  <div class="col-md-4">
                                     <div class="form-group">
                    										<label><?php echo $row2['nombre']?></label>
                    										<label>
                    											<input type="text" id="arreglo" value="No"  disabled>
                    										</label>
  									                 </div>
                                  </div>
                								  
  								              <?php 
                                  }
                                ?>
                              </div>
                          </div>
                      </div>
                  </div> -->
                              <?php 
                                  }
                              ?>

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
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
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

function showmodaldetail(nro,fecha, tienda, usuario, pasillo, observaciones, ficha){
  $('.modal-body .panel-group').html('')
$('#addBookDialog').modal();
$('#fecha').val(fecha);
$('#tienda').val(tienda + ' - ' + pasillo);
$('#usuario').val(usuario);
$('#observaciones').val(observaciones);
var dataResult = $('#data_'+nro).val();
var dataResult2 = $('#resultado2_'+nro).val();
// var dataResult = $('#data_'+nro).val();
// alert(dataResult);
// var test= JSON.stringify(dataResult, ['valor']);
if (dataResult != '') {

var obj = JSON.parse(dataResult);
Object.keys(obj).forEach(function(key){
  if (obj[key].id_ficha == 70) {
    console.log(obj[key])
  }
  // console.log(obj[key])
$('.modal-body .panel-body').append('<div class="col-md-4">  <div class="form-group"> <label>aaaaaa</label>   <label>    <input type="text" id="arreglo" value="No"  disabled>  </label>     </div>  </div>  ');
});
}
else{obj = ''}
if (dataResult2 != '') {

var obj2 = JSON.parse(dataResult2);
Object.keys(obj2).forEach(function (key) {
    // console.log(key, obj2[key])
    // console.log(key, obj[key])
    $('.modal-body .panel-group').append('<div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#codllapseTwo_'+key+'"><i class="fa fa-check-square-o" aria-hidden="true"></i>'+ obj2[key].nombre+' <span class="label label-danger">2</span></a></h4> </div> <div id="codllapseTwo_'+key+'" class="panel-collapse collapse">  <div class="panel-body"> <div class="row">       </div>    </div>   </div> </div>');


    
});
}
else{ obj2 = ''}
console.log(ficha)
console.log(obj);
// console.log(obj2[0].nombre);




}


  $(function () {
    $("#example1").DataTable( {
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "No se encontraron registros",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "sSearch": "Buscar aqui:"

        }
    } );
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

   //Initialize Select2 Elements
    $(".select2").select2();

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
  
  
   $("#txt_idGrupo").change(function () {
    //  alert("aaaa");
           $("#txt_idGrupo option:selected").each(function () {
            elegido=$(this).val();
            $.post("items.php", { elegido: elegido }, function(data){
            $("#txt_idItem").html(data);
            });            
        });
   })
   
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

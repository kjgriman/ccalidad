 
 <?php
require_once 'header.php';

/*if($user->is_loggedin()!="")
{
 $user->redirect('dashboard.php');
}*/
$msje="";


if(isset($_POST['btn-aceptar']))
{
  
    $nombreDoc = $_POST['name-document'];
    $ContentDoc = $_POST['textarea'];
    $autorDoc = $user_id;
    $fechaDoc = date('Y-m-d');
    // print_r($nombreDoc);
    // print_r( $ContentDoc);
    // print_r( $autorDoc);
    // print_r( $fechaDoc);
  
  if (!empty($nombreDoc) && !empty($ContentDoc) && !empty($autorDoc) && !empty($fechaDoc) ) {
    
   if ($ficha->registerDoc($nombreDoc,$ContentDoc,$autorDoc,$fechaDoc)) {
      # code...
      $msje="Registro guardado satisfactoriamente";
    } 
  //echo "Nro ".$nro;
  
}
header( "Refresh:2; document.php", true, 303);
}
if(isset($_POST['btn-editar']))
{
  $nombreDoc2 = $_POST['name-document2'];
  $iddoc2 = $_POST['id_doc_edit'];
    $ContentDoc2 = $_POST['textarea2'];
    if (!empty($nombreDoc2) && !empty($ContentDoc2) && !empty($iddoc2)) {
    
   if ($ficha->editDoc($nombreDoc2,$ContentDoc2,$iddoc2)) {
      # code...
      $msje="Registro guardado satisfactoriamente";
    } 
  //echo "Nro ".$nro;
  
}
header( "Refresh:2; document.php", true, 303);
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
   .wysihtml5-sandbox{
       width: 100% !important;
       height: auto !important;
   }
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
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registro de Categoria
      </h1>
      <ol class="breadcrumb">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Registro categoria</li>
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
              <h3 class="box-title">Registro de documentos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<div class="row">
            <form role="form" method="post" enctype="multipart/form-data">
              
              <div class="box-body">
              <div class="col-md-6">
					<div class="form-group">
                    <label for="name-document">Nombre del documento</label>
						<input type="text" placeholder="Ingrese el nombre del documento" name="name-document" class="form-control" required="required">
					  </div>
				  </div> 
                   <div class="col-md-12">
                        <div class="form-group">
                        <textarea id="summernote" name="textarea" class="textarea"></textarea>
                        </div>
                   </div>
                   <div class="col-md-12">
					<div class="box-footer">
						<button type="submit" name="btn-aceptar" class="btn btn-primary btn-block">Crear y Guardar</button>
					  </div>
				  </div> 
                  
              </div>
                   
            </div>
                  
              <!-- /.box-body -->

              
            </form>
            <div class="content">
            <div class="col-md-12">
					<div class="form-group">
                    <label><span class="glyphicon glyphicon-list"></span> Listado de documentos </label>
						 </div>
				  </div> 
            <?php
                $documets= $ficha->getAllDoc();
            foreach($documets as $doc){


echo '<form action="pdf.php" method="post">';
echo '<input type="hidden" name="nombreDoc" id="nombre'.$doc['id_document'].'" value="'.$doc['nombre_document'].'">';
echo '<input type="hidden" name="idDoc" value="'.$doc['id_document'].'">';
echo "<input type='hidden' name='contentDoc' id='content".$doc['id_document']."' value='".$doc['content_document']."'>";
echo '<span class="btn btn-info" style="width:300px; text-align:left">'.$doc['nombre_document'].'</span>';

echo'<input type="submit" value="Descargar PDF" class="btn btn-success" style="margin-left:5px;">';
echo'<input id="editDoc" onClick="editdoc('.$doc['id_document'].')" type="button" value="Editar PDF" class="btn btn-warning" style="margin-left:5px;">';
                echo '</form>';
                
            }
            ?>
            </div>
          </div>
          <!-- /.box -->

  
       

          
             

        </div>
       
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
<!-- Modal -->
<div id="editor" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
         <form role="form" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id_doc_edit" id="id_doc_edit">
              <div class="box-body">
              <div class="col-md-6">
          <div class="form-group">
                    <label for="name-document">Nombre del documento</label>
            <input type="text" id="name-document2" placeholder="Ingrese el nombre del documento" name="name-document2" class="form-control" required="required">
            </div>
          </div> 
                   <div class="col-md-12">
                        <div class="form-group">
                        <textarea id="summernote2" name="textarea2"  class="textarea"></textarea>
                        </div>
                   </div>
                   <div class="col-md-12">
          <div class="box-footer">
            <button type="submit" name="btn-editar" class="btn btn-primary btn-block">Guardar</button>
            </div>
          </div> 
                  
              </div>
                   
            </div>
                  
              <!-- /.box-body -->

              
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

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
<script src="dist/js/wysihtml5.min.js"></script>
<!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script> -->
<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script>
      function editdoc(id){
         $('#summernote2').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['table', ['table']],
    ['insert', ['link', 'picture', 'hr']],
    ['view', ['fullscreen', 'codeview']],
    ['help', ['help']]
  ]
});
        $('#editor').modal('show');
        var nombre= $('#nombre'+id).val();
       var content= $('#content'+id).val();
       $('#name-document2').val(nombre);
       $('#id_doc_edit').val(id);
       $('.note-editable').html('');
       $('.note-editable').append(content);
       $('#summernote2').val(content);

       
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
    /*$('#editDoc').on('click', function(){
        $('#editor').modal('show')
    })*/
  $(document).ready( function() {
    // $('textarea').wysihtml5();
    $('#summernote').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['table', ['table']],
    ['insert', ['link', 'picture', 'hr']],
    ['view', ['fullscreen', 'codeview']],
    ['help', ['help']]
  ]
});

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
  
});
</script>
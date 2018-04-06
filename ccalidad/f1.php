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
		$resultado->addResultado($nro,$i,$valor);
   }
   
   //Guardamos las observaciones de cada categoria
  
   for($j=1;$j<=$totalCategoria1;$j++){
		$valor = $_POST['obsv'.$j];
		$fichaobservacion->addFichaObservacion($nro,$j,$valor);
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

<link rel="stylesheet" href="bootstrap/css/jquery.fileupload.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="js/jquery.fileupload-validate.js"></script>
<script>
/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'http://albrookmall.com/ccalidad' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/',
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>



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
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Bienvenido, <?php print($userRow['user_name']); ?></p>
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
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Registro</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="ficha.php"><i class="fa fa-circle-o"></i> Inspecci&oacute;n</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Tienda</a></li>
             <li><a href="#"><i class="fa fa-circle-o"></i> Focos</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Usuario</a></li>
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
            <form role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">
                   <div class="col-md-6">
                <div class="form-group">
                <label>Local</label>
                <select name="txt_idlocal" required="required" class="form-control select2" style="width: 100%;">
                  <option value="1">Sol&eacute; | Dinosaurio</option>
                                        <option value="2">Panama Hats | Dinosaurio</option>
                                        <option value="3">Financiera Inverzon | Dinosaurio</option>
                                        <option value="4">Cueros V&eacute;lez | Dinosaurio</option>
                                        <option value="5">Shoes Action | Dinosaurio</option>
                                        <option value="6">Nello Rossi | Dinosaurio</option>
                                        <option value="7">Boltio | Dinosaurio</option>
                                        <option value="8">MPH | Dinosaurio</option>
                                        <option value="9">All Sport | Dinosaurio</option>
                                        <option value="10">Fantastic Casino | Dinosaurio</option>
                                        <option value="11">Cinemark | Dinosaurio</option>
                                        <option value="12">Muebles Bosuqe | Dinosaurio</option>
                                        <option value="13">Swaroski | Dinosaurio</option>
                                        <option value="14">JOCKEY | Dinosaurio</option>
                                        <option value="15">U.S Polo Association  | Dinosaurio</option>
                                        <option value="16">Converse | Dinosaurio</option>
                                        <option value="17">Regatta  | Dinosaurio</option>
                                        <option value="18">American Today  | Dinosaurio</option>
                                        <option value="19">Dorians | Dinosaurio</option>
                                        <option value="20">Giorgio&rsquo;s | Dinosaurio</option>
                                        <option value="21">El Trapiche | Dinosaurio</option>
                                        <option value="22">Kouzina | Dinosaurio</option>
                                        <option value="23">Leonardo&rsquo;s | Dinosaurio</option>
                                        <option value="24">Melo Pet & Garden | Dinosaurio</option>
                                        <option value="25">Farmacia Super 99 | Dinosaurio</option>
                                        <option value="26">Super 99 | Dinosaurio</option>
                                        <option value="27">Multivaciones Decameron | Dinosaurio</option>
                                        <option value="28">AudioFoto | Dinosaurio</option>
                                        <option value="29">Movistar | Dinosaurio</option>
                                        <option value="30">Play N trade | Dinosaurio</option>
                                        <option value="31">TimeVision | Cebra</option>
                                        <option value="32">KR Shoes | Cebra</option>
                                        <option value="33">Totto | Cebra</option>
                                        <option value="34">Divecity | Cebra</option>
                                        <option value="35">Doit Center | Cebra</option>
                                        <option value="36">SEVEN SEVEN | Cebra</option>
                                        <option value="37">Bonita | Cebra</option>
                                        <option value="38">Fashion Ten | Cebra</option>
                                        <option value="39">Danielle Collection | Cebra</option>
                                        <option value="40">Estampa | Cebra</option>
                                        <option value="41">Passarella | Cebra</option>
                                        <option value="42">DDP Ejecutivo | Cebra</option>
                                        <option value="43">Studio F | Cebra</option>
                                        <option value="44">CAT | Cebra</option>
                                        <option value="45">Guayaberas | Cebra</option>
                                        <option value="46">Mummy | Cebra</option>
                                        <option value="47">Hooters | Cebra</option>
                                        <option value="48">Crepes & Wafles | Cebra</option>
                                        <option value="49">Salvador Sala de Belleza | Cebra</option>
                                        <option value="50">Multimax | Cebra</option>
                                        <option value="51">Genius | Cebra</option>
                                        <option value="52">Complot | Le&oacute;n</option>
                                        <option value="53">HEM Store  | Le&oacute;n</option>
                                        <option value="54">Fashion Direct | Le&oacute;n</option>
                                        <option value="55">COOESAN | Le&oacute;n</option>
                                        <option value="56">Renato | Le&oacute;n</option>
                                        <option value="57">Sy & Co | Le&oacute;n</option>
                                        <option value="58">Via Uno | Le&oacute;n</option>
                                        <option value="59">Sports Plus | Le&oacute;n</option>
                                        <option value="60">OutDoors | Le&oacute;n</option>
                                        <option value="61">Caps Store | Le&oacute;n</option>
                                        <option value="62">Planetaruim | Le&oacute;n</option>
                                        <option value="63">Remel | Le&oacute;n</option>
                                        <option value="64">Polo Club | Le&oacute;n</option>
                                        <option value="65">Ms Boutique | Le&oacute;n</option>
                                        <option value="66">Stiloss Boutique | Le&oacute;n</option>
                                        <option value="67">Elegance | Le&oacute;n</option>
                                        <option value="68">Samantha | Le&oacute;n</option>
                                        <option value="69">Sugar Cane | Le&oacute;n</option>
                                        <option value="70">Cubavera | Le&oacute;n</option>
                                        <option value="71">Nenas | Le&oacute;n</option>
                                        <option value="72">Wendy&rsquo;s Kids | Le&oacute;n</option>
                                        <option value="73">Boys & Girls  | Le&oacute;n</option>
                                        <option value="74">La Oca Loca | Le&oacute;n</option>
                                        <option value="75">McDonald&rsquo;s | Le&oacute;n</option>
                                        <option value="76">Maria Bonita | Le&oacute;n</option>
                                        <option value="77">Paris | Le&oacute;n</option>
                                        <option value="78">La Esmeralda | Le&oacute;n</option>
                                        <option value="79">La Esmeralda | Le&oacute;n</option>
                                        <option value="80">Christian Salon | Le&oacute;n</option>
                                        <option value="81">Spa Manos | Le&oacute;n</option>
                                        <option value="82">Chocolatisimo | Le&oacute;n</option>
                                        <option value="83">Chocolatisimo | Le&oacute;n</option>
                                        <option value="84">Zodiak&rsquo;s | Le&oacute;n</option>
                                        <option value="85">Sonam&rsquo;s | Le&oacute;n</option>
                                        <option value="86">Tecnicell | Le&oacute;n</option>
                                        <option value="87">Smart Phone Service | Le&oacute;n</option>
                                        <option value="88">Banistmo | Hipop&oacute;tamo</option>
                                        <option value="89">Multibank | Hipop&oacute;tamo</option>
                                        <option value="90">Crediships | Hipop&oacute;tamo</option>
                                        <option value="91">Mr. Jones | Hipop&oacute;tamo</option>
                                        <option value="92">Spring Step | Hipop&oacute;tamo</option>
                                        <option value="93">Big Bag | Hipop&oacute;tamo</option>
                                        <option value="94">Sport Line America | Hipop&oacute;tamo</option>
                                        <option value="95">Adidas | Hipop&oacute;tamo</option>
                                        <option value="96">Novey | Hipop&oacute;tamo</option>
                                        <option value="97">Relojin | Hipop&oacute;tamo</option>
                                        <option value="98">Hummer Store | Hipop&oacute;tamo</option>
                                        <option value="99">Lee Cooper | Hipop&oacute;tamo</option>
                                        <option value="100">Picara | Hipop&oacute;tamo</option>
                                        <option value="101">Zara | Hipop&oacute;tamo</option>
                                        <option value="102">La Lola | Hipop&oacute;tamo</option>
                                        <option value="103">Gloss | Hipop&oacute;tamo</option>
                                        <option value="104">Ben Betesh | Hipop&oacute;tamo</option>
                                        <option value="105">Kids Republic | Hipop&oacute;tamo</option>
                                        <option value="106">Poppy&rsquo;s | Hipop&oacute;tamo</option>
                                        <option value="107">Boulevard Albrook | Hipop&oacute;tamo</option>
                                        <option value="108">Le&ntilde;os y Carbon  | Hipop&oacute;tamo</option>
                                        <option value="109">Le&ntilde;os y Carbon  | Hipop&oacute;tamo</option>
                                        <option value="110">Gelarti | Hipop&oacute;tamo</option>
                                        <option value="111">Health & Beauty | Hipop&oacute;tamo</option>
                                        <option value="112">Diciotto Optica | Hipop&oacute;tamo</option>
                                        <option value="113">So Nice Perfumes | Hipop&oacute;tamo</option>
                                        <option value="114">The Make Up Factory | Hipop&oacute;tamo</option>
                                        <option value="115">Avon Centro de Venta | Hipop&oacute;tamo</option>
                                        <option value="116">MG Joyeros | Hipop&oacute;tamo</option>
                                        <option value="117">CandyLand | Hipop&oacute;tamo</option>
                                        <option value="118">El Hombre de la Mancha | Hipop&oacute;tamo</option>
                                        <option value="119">Librer&iacute;a Vida Abundante | Hipop&oacute;tamo</option>
                                        <option value="120">PanaFoto | Hipop&oacute;tamo</option>
                                        <option value="121">Rock City | Hipop&oacute;tamo</option>
                                        <option value="122">Complot | Rinoceronte</option>
                                        <option value="123">Shinning Sophie | Rinoceronte</option>
                                        <option value="124">RB Originals | Rinoceronte</option>
                                        <option value="125">Coopeve | Rinoceronte</option>
                                        <option value="126">BBB Boots & Shoes | Rinoceronte</option>
                                        <option value="127">Bellini | Rinoceronte</option>
                                        <option value="128">Payless Shoes | Rinoceronte</option>
                                        <option value="129">Super Deportes | Rinoceronte</option>
                                        <option value="130">Sport Factory | Rinoceronte</option>
                                        <option value="131">Planetarium | Rinoceronte</option>
                                        <option value="132">Creditos Mundiales | Rinoceronte</option>
                                        <option value="133">Todo a D&oacute;lar | Rinoceronte</option>
                                        <option value="134">Helios | Rinoceronte</option>
                                        <option value="135">Joyeria Venecia | Rinoceronte</option>
                                        <option value="136">Plenitud | Rinoceronte</option>
                                        <option value="137">Momentos Metales Preciosos | Rinoceronte</option>
                                        <option value="138">Calvin Klein Underwear | Rinoceronte</option>
                                        <option value="139">Beverly Hills Polo Club | Rinoceronte</option>
                                        <option value="140">Adams | Rinoceronte</option>
                                        <option value="141">DDP | Rinoceronte</option>
                                        <option value="142">Hilfiguer Denim | Rinoceronte</option>
                                        <option value="143">Elemento | Rinoceronte</option>
                                        <option value="144">Bonage | Rinoceronte</option>
                                        <option value="145">The Shop | Rinoceronte</option>
                                        <option value="146">Moose | Rinoceronte</option>
                                        <option value="147">Campus University | Rinoceronte</option>
                                        <option value="148">U.S Polo Assciation | Rinoceronte</option>
                                        <option value="149">Mini Clover | Rinoceronte</option>
                                        <option value="150">Ibiza | Rinoceronte</option>
                                        <option value="151">Farmacias Arrochas | Rinoceronte</option>
                                        <option value="152">Optica Sosa Y Arango | Rinoceronte</option>
                                        <option value="153">Optica Lopez | Rinoceronte</option>
                                        <option value="154">Fit Lab | Rinoceronte</option>
                                        <option value="155">Only Nails | Rinoceronte</option>
                                        <option value="156">Dental Solution | Rinoceronte</option>
                                        <option value="157">RBK Salon & Spa | Rinoceronte</option>
                                        <option value="158">Rostro Perfecto  | Rinoceronte</option>
                                        <option value="159">Westerm Union | Rinoceronte</option>
                                        <option value="160">Music Planet | Rinoceronte</option>
                                        <option value="161">Cyber Studio | Rinoceronte</option>
                                        <option value="162">Con Classe Sastreria | Rinoceronte</option>
                                        <option value="163">Corp. Hotelera de Panama | Rinoceronte</option>
                                        <option value="164">Movicel | Rinoceronte</option>
                                        <option value="165">Hometek | Rinoceronte</option>
                                        <option value="166">Visara | Elefante</option>
                                        <option value="167">Recuerdos de Panama | Elefante</option>
                                        <option value="168">Necty  | Elefante</option>
                                        <option value="169">Crass | Elefante</option>
                                        <option value="170">Sy & Co. | Elefante</option>
                                        <option value="171">Sy & Co. | Elefante</option>
                                        <option value="172">Puma | Elefante</option>
                                        <option value="173">July Sport Center | Elefante</option>
                                        <option value="174">Core Surf & Skate | Elefante</option>
                                        <option value="175">Concepts Life | Elefante</option>
                                        <option value="176">Top Time | Elefante</option>
                                        <option value="177">Fedi Joyeria | Elefante</option>
                                        <option value="178">Gustavo Salazar Joyeros | Elefante</option>
                                        <option value="179">Up Date Shop | Elefante</option>
                                        <option value="180">Across | Elefante</option>
                                        <option value="181">Metro Hip | Elefante</option>
                                        <option value="182">Very Sexy  | Elefante</option>
                                        <option value="183">Impacto | Elefante</option>
                                        <option value="184">Scape | Elefante</option>
                                        <option value="185">D&rsquo;Mario | Elefante</option>
                                        <option value="186">Dark Stage | Elefante</option>
                                        <option value="187">Pipolos Shoes | Elefante</option>
                                        <option value="188">St. Jacks | Elefante</option>
                                        <option value="189">Steven&rsquo;s | Elefante</option>
                                        <option value="190">Conway | Elefante</option>
                                        <option value="191">Pollo Tropical | Elefante</option>
                                        <option value="192">Manolo Churreria | Elefante</option>
                                        <option value="193">Friday&rsquo;s | Elefante</option>
                                        <option value="194">Optica Chevalier | Elefante</option>
                                        <option value="195">Fragance | Elefante</option>
                                        <option value="196">Tv Shooping | Elefante</option>
                                        <option value="197">Primor Perfums | Elefante</option>
                                        <option value="198">Krisana Salon | Elefante</option>
                                        <option value="199">Mi Dentista | Elefante</option>
                                        <option value="200">Electro House | Elefante</option>
                                        <option value="201">Candyland | Elefante</option>
                                        <option value="202">Esti Games | Elefante</option>
                                        <option value="203">Premier Universe | Elefante</option>
                                        <option value="204">Mstore | Elefante</option>
                                        <option value="205">Xtreme Mobile | Elefante</option>
                                        <option value="206">Picante | Tigre</option>
                                        <option value="207">Burbujas | Tigre</option>
                                        <option value="208">Unibank | Tigre</option>
                                        <option value="209">Shoe Box | Tigre</option>
                                        <option value="210">Cueros Velez | Tigre</option>
                                        <option value="211">City Moda | Tigre</option>
                                        <option value="212">Aurosport | Tigre</option>
                                        <option value="213">Sportline World | Tigre</option>
                                        <option value="214">Nike | Tigre</option>
                                        <option value="215">Everlast | Tigre</option>
                                        <option value="216">Station Planet | Tigre</option>
                                        <option value="217">Fire Combat | Tigre</option>
                                        <option value="218">Basilea Orfebres | Tigre</option>
                                        <option value="219">Platinium Joyeros | Tigre</option>
                                        <option value="220">Palladium | Tigre</option>
                                        <option value="221">Relojin | Tigre</option>
                                        <option value="222">Flexis | Tigre</option>
                                        <option value="223">Moda India | Tigre</option>
                                        <option value="224">Johnny Cotton | Tigre</option>
                                        <option value="225">Brooklyn | Tigre</option>
                                        <option value="226">Tommy Hilfiguer Kids | Tigre</option>
                                        <option value="227">Anime World | Tigre</option>
                                        <option value="228">El Costo | Tigre</option>
                                        <option value="229">Titan | Tigre</option>
                                        <option value="230">Gelarti | Tigre</option>
                                        <option value="231">Cinnabon | Tigre</option>
                                        <option value="232">Top Fitness | Tigre</option>
                                        <option value="233">Quo Vadis Peluqueria | Tigre</option>
                                        <option value="234">Ibiza | Tigre</option>
                                        <option value="235">Hand&rsquo;s & Foot | Tigre</option>
                                        <option value="236">Christian Salon | Tigre</option>
                                        <option value="237">Tv Offer | Tigre</option>
                                        <option value="238">Tabaco y Ron  | Tigre</option>
                                        <option value="239">Seder&iacute;a Don Chicho | Tigre</option>
                                        <option value="240">Mas me Dan | Tigre</option>
                                        <option value="241">Galapago Express | Tigre</option>
                                        <option value="242">El Contenedor | Tigre</option>
                                        <option value="243">Lynn&rsquo;s Hallmark | Tigre</option>
                                        <option value="244">Farma Plus | Tigre</option>
                                        <option value="245">CLC Panama | Tigre</option>
                                        <option value="246">Copy Red | Tigre</option>
                                        <option value="247">Dragon Cell | Tigre</option>
                                        <option value="248">Claro | Tigre</option>
                                        <option value="249">Game Master | Tigre</option>
                                        <option value="250">GIGA | Tigre</option>
                                        <option value="251">Claro | Tigre</option>
                                        <option value="252">Banco General | Kanguro</option>
                                        <option value="253">Credicorp Bank | Kanguro</option>
                                        <option value="254">Caja de Ahorros | Kanguro</option>
                                        <option value="255">Alls Sport | Kanguro</option>
                                        <option value="256">July Sport | Kanguro</option>
                                        <option value="257">Albrook Bowling | Kanguro</option>
                                        <option value="258">Lumicentro | Kanguro</option>
                                        <option value="259">Muebles Jamar | Kanguro</option>
                                        <option value="260">Orloff Joyeros | Kanguro</option>
                                        <option value="261">Sussan Miller | Kanguro</option>
                                        <option value="262">Levi&rsquo;s Store | Kanguro</option>
                                        <option value="263">Kenneth Cole | Kanguro</option>
                                        <option value="264">Lacoste | Kanguro</option>
                                        <option value="265">Plenitud | Kanguro</option>
                                        <option value="266">Canastilla Ideal | Kanguro</option>
                                        <option value="267">Bath and Body Works | Kanguro</option>
                                        <option value="268">Victoria Secret | Kanguro</option>
                                        <option value="269">Photura | Kanguro</option>
                                        <option value="270">Route 66 | Panda</option>
                                        <option value="271">Tactical Army | Panda</option>
                                        <option value="272">Bac Panama | Panda</option>
                                        <option value="273">Banesco | Panda</option>
                                        <option value="274">Sketchers | Panda</option>
                                        <option value="275">Columbia Sportwaer | Panda</option>
                                        <option value="276">Sea&Sun | Panda</option>
                                        <option value="277">Tommy Hilfiguer | Panda</option>
                                        <option value="278">Nautica | Panda</option>
                                        <option value="279">Polo Royal C. Berkshire | Panda</option>
                                        <option value="280">Mundo Kids | Panda</option>
                                        <option value="281">La Riviera | Panda</option>
                                        <option value="282">Clinica Ortodoncia | Panda</option>
                                        <option value="283">Biosalud Centro Medico Integral | Panda</option>
                                        <option value="284">Mi Princesa | Panda</option>
                                        <option value="285">AudioFoto | Panda</option>
                                        <option value="286">The Box Cross Shop  | Gorila</option>
                                        <option value="287">New Balance | Gorila</option>
                                        <option value="288">Full Sport | Gorila</option>
                                        <option value="289">5D Extreme | Gorila</option>
                                        <option value="290">Kids Playground | Gorila</option>
                                        <option value="291">Platinum Joyeros | Gorila</option>
                                        <option value="292">DDP Men | Gorila</option>
                                        <option value="293">Eko Unltd | Gorila</option>
                                        <option value="294">U.S Polo Association | Gorila</option>
                                        <option value="295">Jonathan Z | Gorila</option>
                                        <option value="296">Su Casa | Gorila</option>
                                        <option value="297">Body Buildling | Gorila</option>
                                        <option value="298">Perfumes Factory | Gorila</option>
                                        <option value="299">Game Masters | Gorila</option>
                                        <option value="300">Samsung | Gorila</option>
                                        <option value="301">Global Mobile | Gorila</option>
                                        <option value="302">Jabra | Gorila</option>
                                        <option value="303">Claires | Pinguino</option>
                                        <option value="304">Chehabi | Pinguino</option>
                                        <option value="305">Parfois | Pinguino</option>
                                        <option value="306">Mario Hernandez | Pinguino</option>
                                        <option value="307">Souvenirs Shops | Pinguino</option>
                                        <option value="308">Banistmo | Pinguino</option>
                                        <option value="309">Mr. Jones | Pinguino</option>
                                        <option value="310">Cases | Pinguino</option>
                                        <option value="311">Renato | Pinguino</option>
                                        <option value="312">Sophistic | Pinguino</option>
                                        <option value="313">Totto | Pinguino</option>
                                        <option value="314">RS21 | Pinguino</option>
                                        <option value="315">Whoop&rsquo;s! | Pinguino</option>
                                        <option value="316">Elemento | Pinguino</option>
                                        <option value="317">Colchones Ramguiflex | Pinguino</option>
                                        <option value="318">Cotton Breeze | Pinguino</option>
                                        <option value="319">Casiolandia | Pinguino</option>
                                        <option value="320">Kilates | Pinguino</option>
                                        <option value="321">Converse | Pinguino</option>
                                        <option value="322">Ela | Pinguino</option>
                                        <option value="323">Urbanfly | Pinguino</option>
                                        <option value="324">Tatali Beach | Pinguino</option>
                                        <option value="325">Moose | Pinguino</option>
                                        <option value="326">La Senza | Pinguino</option>
                                        <option value="327">Taxi | Pinguino</option>
                                        <option value="328">Calvin Kleins Jeans | Pinguino</option>
                                        <option value="329">Mia Store | Pinguino</option>
                                        <option value="330">Enacaje Ju | Pinguino</option>
                                        <option value="331">Color Clouds | Pinguino</option>
                                        <option value="332">Vergara | Pinguino</option>
                                        <option value="333">Monicas Boutique | Pinguino</option>
                                        <option value="334">Madison Store | Pinguino</option>
                                        <option value="335">Collins | Pinguino</option>
                                        <option value="336">Tomato | Pinguino</option>
                                        <option value="337">MultiOpticas | Pinguino</option>
                                        <option value="338">Premier | Pinguino</option>
                                        <option value="339">GNC | Pinguino</option>
                                        <option value="340">BBS Beauty Supply | Pinguino</option>
                                        <option value="341">Charlie&rsquo;s Place | Pinguino</option>
                                        <option value="342">Centro Odontologico Y Belleza | Pinguino</option>
                                        <option value="343">Tortuga Bay | Pinguino</option>
                                        <option value="344">Le Perfum | Pinguino</option>
                                        <option value="345">Tecnicell | Pinguino</option>
                                        <option value="346">Circuit City | Pinguino</option>
                                        <option value="347">GIGA | Pinguino</option>
                                        <option value="348">Multimax | Pinguino</option>
                                        <option value="349">Play N Trade | Pinguino</option>
                                        <option value="350">Digicel | Pinguino</option>
                                        <option value="351">E-Vision | Pinguino</option>
                                        <option value="352">MAC Store | Pinguino</option>
                                        <option value="353">Hi Sky | Pinguino</option>
                                        <option value="354">Ego Collection | Delf&iacute;n</option>
                                        <option value="355">Complot | Delf&iacute;n</option>
                                        <option value="356">Depi Xpress | Delf&iacute;n</option>
                                        <option value="357">Helios | Delf&iacute;n</option>
                                        <option value="358">Punto de Oro | Delf&iacute;n</option>
                                        <option value="359">Hush Puppy | Delf&iacute;n</option>
                                        <option value="360">Boltio | Delf&iacute;n</option>
                                        <option value="361">Zona Industrial | Delf&iacute;n</option>
                                        <option value="362">Totto Tu | Delf&iacute;n</option>
                                        <option value="363">Cases | Delf&iacute;n</option>
                                        <option value="364">Wnners | Delf&iacute;n</option>
                                        <option value="365">Crocs | Delf&iacute;n</option>
                                        <option value="366">El Deportista y La Nota | Delf&iacute;n</option>
                                        <option value="367">Nike | Delf&iacute;n</option>
                                        <option value="368">Sik Rides | Delf&iacute;n</option>
                                        <option value="369">New Balance | Delf&iacute;n</option>
                                        <option value="370">Running Balboa | Delf&iacute;n</option>
                                        <option value="371">Creditos Mundiales | Delf&iacute;n</option>
                                        <option value="372">Techno Marine | Delf&iacute;n</option>
                                        <option value="373">Oro Italia | Delf&iacute;n</option>
                                        <option value="374">Eurochronos | Delf&iacute;n</option>
                                        <option value="375">Pandora | Delf&iacute;n</option>
                                        <option value="376">Tiempo | Delf&iacute;n</option>
                                        <option value="377">Mundo Casio | Delf&iacute;n</option>
                                        <option value="378">Thomas Sabo | Delf&iacute;n</option>
                                        <option value="379">DG Joyero | Delf&iacute;n</option>
                                        <option value="380">Swatch | Delf&iacute;n</option>
                                        <option value="381">World Time | Delf&iacute;n</option>
                                        <option value="382">Citzen | Delf&iacute;n</option>
                                        <option value="383">Guayaberas a la Medida | Delf&iacute;n</option>
                                        <option value="384">Levi&rsquo;s | Delf&iacute;n</option>
                                        <option value="385">Gloss | Delf&iacute;n</option>
                                        <option value="386">JOCKEY | Delf&iacute;n</option>
                                        <option value="387">Camicissma | Delf&iacute;n</option>
                                        <option value="388">Sugar Cane | Delf&iacute;n</option>
                                        <option value="389">Desigual | Delf&iacute;n</option>
                                        <option value="390">Arena y mar | Delf&iacute;n</option>
                                        <option value="391">Frenzy Style | Delf&iacute;n</option>
                                        <option value="392">Guess | Delf&iacute;n</option>
                                        <option value="393">Quicksilver | Delf&iacute;n</option>
                                        <option value="394">Piruetas | Delf&iacute;n</option>
                                        <option value="395">Felix Juguetes | Delf&iacute;n</option>
                                        <option value="396">Kids The Shoe Store | Delf&iacute;n</option>
                                        <option value="397">Nickelodeon | Delf&iacute;n</option>
                                        <option value="398">Froots | Delf&iacute;n</option>
                                        <option value="399">Paris | Delf&iacute;n</option>
                                        <option value="400">Tv Shooping | Delf&iacute;n</option>
                                        <option value="401">Fraiche | Delf&iacute;n</option>
                                        <option value="402">Opti Express | Delf&iacute;n</option>
                                        <option value="403">L&rsquo;Occitane | Delf&iacute;n</option>
                                        <option value="404">Farmacia Arrocha | Delf&iacute;n</option>
                                        <option value="405">CandyLand | Delf&iacute;n</option>
                                        <option value="406">Pop Party | Delf&iacute;n</option>
                                        <option value="407">Happy Color | Delf&iacute;n</option>
                                        <option value="408">APC | Delf&iacute;n</option>
                                        <option value="409">Esti Games | Delf&iacute;n</option>
                                        <option value="410">Games Spot | Delf&iacute;n</option>
                                        <option value="411">Multimax | Delf&iacute;n</option>
                                        <option value="412">Movicell | Delf&iacute;n</option>
                                        <option value="413">Cable & Wireless + Movil | Delf&iacute;n</option>
                                        <option value="414">Curious | Delf&iacute;n</option>
                                        <option value="415">Details-dts | Koala</option>
                                        <option value="416">Sun Couture | Koala</option>
                                        <option value="417">Alex and Ani | Koala</option>
                                        <option value="418">Bellagio | Koala</option>
                                        <option value="419">Clarks | Koala</option>
                                        <option value="420">Palladium | Koala</option>
                                        <option value="421">Crocs | Koala</option>
                                        <option value="422">Vince Camuto | Koala</option>
                                        <option value="423">Naturalizer | Koala</option>
                                        <option value="424">Flow | Koala</option>
                                        <option value="425">Reef | Koala</option>
                                        <option value="426">Speedo | Koala</option>
                                        <option value="427">La Hora | Koala</option>
                                        <option value="428">Fossil | Koala</option>
                                        <option value="429">Armani Express | Koala</option>
                                        <option value="430">Bebe | Koala</option>
                                        <option value="431">Keneth Cole | Koala</option>
                                        <option value="432">Adidas | Koala</option>
                                        <option value="433">Vivian Design Boutique | Koala</option>
                                        <option value="434">Oscar de la Renta | Koala</option>
                                        <option value="435">Hilfiguer Denim | Koala</option>
                                        <option value="436">Converse | Koala</option>
                                        <option value="437">Studio F | Koala</option>
                                        <option value="438">Perry Ellis | Koala</option>
                                        <option value="439">Lacoste | Koala</option>
                                        <option value="440">Estampa | Koala</option>
                                        <option value="441">Carolina Gomez | Koala</option>
                                        <option value="442">EPK | Koala</option>
                                        <option value="443">Mothercare | Koala</option>
                                        <option value="444">Felix B. Maduro | Koala</option>
                                        <option value="445">Caf&eacute; Met | Koala</option>
                                        <option value="446">Juan Valdez Caf&eacute; | Koala</option>
                                        <option value="447">Hasaki Sushi Lounge | Koala</option>
                                        <option value="448">Adore | Koala</option>
                                        <option value="449">M.A.C. | Koala</option>
                                        <option value="450">Bayside Brush | Koala</option>
                                        <option value="451">Preciosa | Koala</option>
                                        <option value="452">Hotel Wyndham | Koala</option>
                                        <option value="453">El Hombre de La Mancha | Koala</option>
                                        <option value="454">Mac Store | Koala</option>
                                        <option value="455">Blackstore | Koala</option>
                                        <option value="456">Piquadro | Orca</option>
                                        <option value="457">Harley Davidson | Orca</option>
                                        <option value="458">Los nanas | Food Court</option>
                                        <option value="459">Carbon Guacho | Food Court</option>
                                        <option value="460">Chicken Factory | Food Court</option>
                                        <option value="461">Chiuahua | Food Court</option>
                                        <option value="462">Cinnabon | Food Court</option>
                                        <option value="463">Creeps & Wafles | Food Court</option>
                                        <option value="464">Full Pizza | Food Court</option>
                                        <option value="465">Helados La Italiana | Food Court</option>
                                        <option value="466">Ke Chido | Food Court</option>
                                        <option value="467">McDonald&rsquo;s | Food Court</option>
                                        <option value="468">Parrillada Estancia | Food Court</option>
                                        <option value="469">Subway | Food Court</option>
                                        <option value="470">Sandwich Qbano | Food Court</option>
                                        <option value="471">Tango Grill | Food Court</option>
                                        <option value="472">Asados Gaby Dana | Food Court Carrusel</option>
                                        <option value="473">Burguer King | Food Court Carrusel</option>
                                        <option value="474">Carb&oacute;n de Palo | Food Court Carrusel</option>
                                        <option value="475">Carl&rsquo;s Jr. | Food Court Carrusel</option>
                                        <option value="476">Chicken Factory | Food Court Carrusel</option>
                                        <option value="477">China Wok | Food Court Carrusel</option>
                                        <option value="478">Churromania | Food Court Carrusel</option>
                                        <option value="479">Dominos Pizza | Food Court Carrusel</option>
                                        <option value="480">Dunkin&rsquo;Donuts | Food Court Carrusel</option>
                                        <option value="481">Dragon Chino | Food Court Carrusel</option>
                                        <option value="482">Don Triton | Food Court Carrusel</option>
                                        <option value="483">El Asador | Food Court Carrusel</option>
                                        <option value="484">Felicidad Express | Food Court Carrusel</option>
                                        <option value="485">Full Pizza | Food Court Carrusel</option>
                                        <option value="486">Frutti Jugo | Food Court Carrusel</option>
                                        <option value="487">Gelarti | Food Court Carrusel</option>
                                        <option value="488">Helados La Italiana | Food Court Carrusel</option>
                                        <option value="489">ICEE | Food Court Carrusel</option>
                                        <option value="490">KFC | Food Court Carrusel</option>
                                        <option value="491">Las Brasas | Food Court Carrusel</option>
                                        <option value="492">La Caba&ntilde;a | Food Court Carrusel</option>
                                        <option value="493">La Casa del Helado | Food Court Carrusel</option>
                                        <option value="494">Le&ntilde;os y Carb&oacute;n | Food Court Carrusel</option>
                                        <option value="495">McDonald&rsquo;s | Food Court Carrusel</option>
                                        <option value="496">Mr.Pretzels | Food Court Carrusel</option>
                                        <option value="497">Parrillada La Estancia | Food Court Carrusel</option>
                                        <option value="498">Pio Pio | Food Court Carrusel</option>
                                        <option value="499">Pizza Cero | Food Court Carrusel</option>
                                        <option value="500">Pizza Hut | Food Court Carrusel</option>
                                        <option value="501">Popeyes | Food Court Carrusel</option>
                                        <option value="502">Rico Burrito | Food Court Carrusel</option>
                                        <option value="503">Asados Gaby Dana | Food Court Magic Zone</option>
                                        <option value="504">Burguer King | Food Court Magic Zone</option>
                                        <option value="505">Cake Factory | Food Court Magic Zone</option>
                                        <option value="506">Charley&rsquo;s Grilled Subs | Food Court Magic Zone</option>
                                        <option value="507">Chicken Factory | Food Court Magic Zone</option>
                                        <option value="508">Cinnabon | Food Court Magic Zone</option>
                                        <option value="509">Dairy Queen | Food Court Magic Zone</option>
                                        <option value="510">Dominos Pizza | Food Court Magic Zone</option>
                                        <option value="511">Don Pan | Food Court Magic Zone</option>
                                        <option value="512">Duran Coffe Store | Food Court Magic Zone</option>
                                        <option value="513">Expresso Americano | Food Court Magic Zone</option>
                                        <option value="514">Fitness Food | Food Court Magic Zone</option>
                                        <option value="515">Full Pizza | Food Court Magic Zone</option>
                                        <option value="516">Gelarti | Food Court Magic Zone</option>
                                        <option value="517">Johnny Rockets | Food Court Magic Zone</option>
                                        <option value="518">KFC | Food Court Magic Zone</option>
                                        <option value="519">Le&ntilde;os y Carb&oacute;n | Food Court Magic Zone</option>
                                        <option value="520">Lomitos Beto | Food Court Magic Zone</option>
                                        <option value="521">Meditterrane Crunchies | Food Court Magic Zone</option>
                                        <option value="522">McDonald&rsquo;s | Food Court Magic Zone</option>
                                        <option value="523">Ni Hao | Food Court Magic Zone</option>
                                        <option value="524">Parrillada La Estancia | Food Court Magic Zone</option>
                                        <option value="525">Rico Burrito | Food Court Magic Zone</option>
                                        <option value="526">Smoothies | Food Court Magic Zone</option>
                                        <option value="527">Subway | Food Court Magic Zone</option>
                                        <option value="528">Taco Bell | Food Court Magic Zone</option>
                                        <option value="529">Tamburelli | Food Court Magic Zone</option>
                                        <option value="530">Which Which | Food Court Magic Zone</option>
                                        <option value="531">Wing Zone | Food Court Magic Zone</option>
                                        <option value="532">Yogen Fruz | Food Court Magic Zone</option>
                                        <option value="533">Grecha | Kioskos</option>
                                        <option value="534">NYS | Kioskos</option>
                                        <option value="535">Jade&rsquo;s Jewerly | Kioskos</option>
                                        <option value="536">Quality Leather | Kioskos</option>
                                        <option value="537">Caesar Pearl | Kioskos</option>
                                        <option value="538">Silver Collection  | Kioskos</option>
                                        <option value="539">Kaspet  | Kioskos</option>
                                        <option value="540">Gift # Stop | Kioskos</option>
                                        <option value="541">Cueroz Velaez | Kioskos</option>
                                        <option value="542">Maros Holy Land | Kioskos</option>
                                        <option value="543">Jungle Lamps | Kioskos</option>
                                        <option value="544">Mystic Planet | Kioskos</option>
                                        <option value="545">Art Kitchen | Kioskos</option>
                                        <option value="546">Dark Stage | Kioskos</option>
                                        <option value="547">Maros Tierra Santa | Kioskos</option>
                                        <option value="548">Kakkoii Tech & Gift | Kioskos</option>
                                        <option value="549">Cute Paws | Kioskos</option>
                                        <option value="550">Oliver Weber | Kioskos</option>
                                        <option value="551">Quality Leather | Kioskos</option>
                                        <option value="552">Little Princess | Kioskos</option>
                                        <option value="553">McDonald&rsquo;s | Kioskos</option>
                                        <option value="554">Candies Place | Kioskos</option>
                                        <option value="555">Candy&rsquo;s Island | Kioskos</option>
                                        <option value="556">Brigadeiro | Kioskos</option>
                                        <option value="557">Candy&rsquo;s World | Kioskos</option>
                                        <option value="558">Fiestas Candies | Kioskos</option>
                                        <option value="559">Planet Soccer | Kioskos</option>
                                        <option value="560">Watch Me | Kioskos</option>
                                        <option value="561">Golden Moda | Kioskos</option>
                                        <option value="562">Zik Zok | Kioskos</option>
                                        <option value="563">Shia Joyas & Gemas | Kioskos</option>
                                        <option value="564">Spazio Argento | Kioskos</option>
                                        <option value="565">Filgrana Paname&ntilde;a | Kioskos</option>
                                        <option value="566">TWO sen 2 senses | Kioskos</option>
                                        <option value="567">Confetti Crush | Kioskos</option>
                                        <option value="568">Mica Beauty | Kioskos</option>
                                        <option value="569">Perfume Factory | Kioskos</option>
                                        <option value="570">Evalectric | Kioskos</option>
                                        <option value="571">GNC | Kioskos</option>
                                        <option value="572">La Tienda Gio | Kioskos</option>
                                        <option value="573">Foodie Hair | Kioskos</option>
                                        <option value="574">Vine Vera | Kioskos</option>
                                        <option value="575">Golden Rose | Kioskos</option>
                                        <option value="576">Incoco | Kioskos</option>
                                        <option value="577">Maria Bonita | Kioskos</option>
                                        <option value="578">Bamboo Hotel Comfort | Kioskos</option>
                                        <option value="579">Ko-I-Noor | Kioskos</option>
                                        <option value="580">Premier | Kioskos</option>
                                        <option value="581">Corioliss | Kioskos</option>
                                        <option value="582">Premier | Kioskos</option>
                                        <option value="583">Artesanias & Souvenirs | Kioskos</option>
                                        <option value="584">Panamall | Kioskos</option>
                                        <option value="585">Curiosidades Latinas | Kioskos</option>
                                        <option value="586">Bichos | Kioskos</option>
                                        <option value="587">Artesanias y Recuerdos | Kioskos</option>
                                        <option value="588">Souvenirs Paraiso Paname&ntilde | Kioskos</option>
                                        <option value="589">Servicios & Otros | Kioskos</option>
                                        <option value="590">Red Plus | Kioskos</option>
                                        <option value="591">Sky | Kioskos</option>
                                        <option value="592">Magnolia | Kioskos</option>
                                        <option value="593">detalle INUSUAL | Kioskos</option>
                                        <option value="594">gp | Kioskos</option>
                                        <option value="595">BTTERRIES | Kioskos</option>
                                        <option value="596">sKY | Kioskos</option>
                                        <option value="597">Stops Sings | Kioskos</option>
                                        <option value="598">Sea Pearl Ferry | Kioskos</option>
                                        <option value="599">Foto Porcelana Vip | Kioskos</option>
                                        <option value="600">Sky Agent | Kioskos</option>
                                        <option value="601">San Blas Experience | Kioskos</option>
                                        <option value="602">Massage Express | Kioskos</option>
                                        <option value="603">Pon Tu Marca | Kioskos</option>
                                        <option value="604">Stop Signs | Kioskos</option>
                                        <option value="605">Sillas de Masajes | Kioskos</option>
                                        <option value="606">MAgnolia | Kioskos</option>
                                        <option value="607">Mr. Blunt | Kioskos</option>
                                        <option value="608">U&ntilde;as y dise&ntilde;os Ex | Kioskos</option>
                                        <option value="609">Sea Pearl Ferry | Kioskos</option>
                                        <option value="610">Depi Express | Kioskos</option>
                                        <option value="611">Sillas de Masajes | Kioskos</option>
                                        <option value="612">Italtransfer | Kioskos</option>
                                        <option value="613">Panama Games | Kioskos</option>
                                        <option value="614">Claro | Kioskos</option>
                                        <option value="615">Cable & Wireless-Sonicel | Kioskos</option>
                                        <option value="616">Advance Cell Shop | Kioskos</option>
                                        <option value="617">Todo Celular | Kioskos</option>
                                        <option value="618">Dr. Computer | Kioskos</option>
                                        <option value="619">Comando | Kioskos</option>
                                        <option value="620">Genius | Kioskos</option>
                                        <option value="621">Cable & Wireless-Sonicel | Kioskos</option>
                                        <option value="622">Claro | Kioskos</option>
                                        <option value="623">Claro | Kioskos</option>
                                        <option value="624">Movistar | Kioskos</option>
                                        <option value="625">Digicel | Kioskos</option>
                                        <option value="626">Sonicel | Kioskos</option>
                                        <option value="627">LG Electronics | Kioskos</option>
                                        <option value="628">Digicel | Kioskos</option>
                                        <option value="629">Todo Celular | Kioskos</option>
                                        <option value="630">El K.G.B | Kioskos</option>
                                        <option value="631">Movistar | Kioskos</option>
                                        <option value="632">PTY Cell Shop | Kioskos</option>
                                        <option value="633">Dr. SmartPhone | Kioskos</option>
                                        <option value="634">Todo Celular | Kioskos</option>
                                        <option value="635">Dr. Computer | Kioskos</option>
                                        <option value="636">Domino Cell | Kioskos</option>
                                        <option value="637">Mobile Pro | Kioskos</option>
                                        <option value="638">Claro | Kioskos</option>
                                        <option value="639">Panama Games | Kioskos</option>
                                        <option value="640">Cicuit City | Kioskos</option>
                                        <option value="641">Control Games | Kioskos</option>
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
					$result1 = $ficha->getAllCategorias();
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
									echo "<input type='radio' name='item".$idItem."' value='1' class='flat-red' required='required'>Si&nbsp;&nbsp;";
									echo "</label>";
									echo "<label>";
									echo "<input type='radio' name='item".$idItem."' value='0' class='flat-red'>No";
									echo "</label>";
									echo "</div>";
									echo "</div>";
							}
							
							echo "</div>";
							echo "<div class='row'>";
							echo "<div class='col-md-12'>";
							echo "<div class='form-group'>";
							echo "<label>Observaciones</label>";
							echo "<textarea class='form-control' required='required' rows='2' name='obsv".$idCat."' placeholder='Observaciones ...'></textarea>";
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
             <div class="col-md-6">
                     
                      <div class="form-group">
                    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Add files...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
 <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>
    <br>
				   </div>
        </div>
                
                 
                   </div>
                  
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
  
});
</script>
</body>
</html>

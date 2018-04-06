<?php
require_once 'config/database.php';

if($user->is_loggedin()!="")
{
 $user->redirect('dashboard.php');
}

if(isset($_POST['btn-login']))
{
 $uname = $_POST['txt_uname_email'];
 $upass = $_POST['txt_password'];
  
 if($user->login($uname,$upass))
 {
  $user->redirect('dashboard.php');
 }
 else
 {
  $error = "Error en credenciales, intente de nuevo.";
 } 
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Control de Calidad</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/style.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
 <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="logo-top">
<center><img src='http://albrookmall.com/ccalidad/dist/img/user2-160x160.jpg' width="100"></center></div>

<div class="login-box">
<?php
 if(isset($_GET['newuser']))
            {
                 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Ya puedes ingresar con el usuario que haz creado.
                 </div>
                 <?php
            }
?>
  <div class="login-logo">
        <a href="#"><b>Control </b>de Calidad</a>

  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
<center><img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" /></center><br>
    <p class="login-box-msg">Por favor, escribe tu nombre de usuario o tu correo electrónico. Recibirás un enlace para crear la contraseña nueva por correo electrónico.</p>

    <form method="post">
            <?php
            if(isset($error))
            {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                  </div>
                  <?php
            }
            ?>
      <div class="form-group has-feedback">
        <input type="text" name="txt_uname_email" class="form-control" placeholder="Usuario" autofocus required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          &nbsp;
        </div>
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" name="btn-login" class="btn btn-primary btn-block btn-flat" id="load" data-loading-text="Validando...">Obtener una contraseña nueva</button>
        </div>
        <!-- /.col -->
      </div>
    </form>



  </div>
<div class="min-footer"><div class="col-left">    
    <a href="index.php">← Volver al login</a><br>
© 2017 Albrook Mall. Todos los derechos reservados.											</div></div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
$('.btn').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 4000);
});


</script>
</body>
</html>

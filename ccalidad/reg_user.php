<?php
require_once 'config/database.php';

/*require_once 'header.php';*/


/*if($user->is_loggedin()!="")
{
    $user->redirect('home.php');
}*/

if(isset($_POST['btn-signup']))
{
   $uname = trim($_POST['txt_uname']);
   $umail = trim($_POST['txt_umail']);
   $upass = trim($_POST['txt_upass']); 
   $id_area = trim($_POST['id_area']); 
 
   if($uname=="") {
      $error[] = "Usuario obligatorio!"; 
   }
   else if($umail=="") {
      $error[] = "Email obligatorio!"; 
   }
   else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Por favor ingresa un email v√°lido';
   }
   else if($upass=="") {
      $error[] = "Cotraseè´–a obligatoria";
   }
   else if(strlen($upass) < 6){
      $error[] = "Su contraseè´–a debe ser mayor a 6 digitos"; 
   }
   else
   {
      try
      {
         $stmt = $DB_con->prepare("SELECT user_name,user_email FROM tbl_users WHERE user_name=:uname OR user_email=:umail");
         $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['user_name']==$uname) {
            $error[] = "Lo sentimos, este usuario ya ha sido registrado";
         }
         else if($row['user_email']==$umail) {
            $error[] = "Lo sentimos esta email ya ha sido registrado";
         }
         else
         {
            if($user->register($fname,$lname,$uname,$umail,$upass,$id_area)) 
            {
                $user->redirect('logout.php?newuser');
            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  } 
}

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
  
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
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Ya puedes ingresar con el usuario cread
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
    <p class="login-box-msg">Crear tu cuenta de usuario</p>
        <form method="post">
            <?php
            if(isset($error))
            {
               foreach($error as $error)
               {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                  </div>
                  <?php
               }
            }
            else if(isset($_GET['joined']))
            {
                 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                 </div>
                 <?php
            }
            ?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_uname" placeholder="Ingrese el usuario" value="<?php if(isset($error)){echo $uname;}?>" required/>
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_umail" placeholder="Ingrese el email" value="<?php if(isset($error)){echo $umail;}?>" required/>
            </div>
            <div class="form-group">
             <input type="password" class="form-control" name="txt_upass" placeholder="Ingrese la contraseè´–a" required/>
            </div>
            <div class="form-group">
              <label>Seleccione Area de trabajo</label>
             <select name="id_area" required="required" class="form-control select2" style="width: 100%;" required>
                  
                    <?php 
                    $area = $ficha->getAllArea();
                    foreach ($area as $ke3 => $value3) {
                        ?>

                    <option value="<?php echo $area[$ke3]['id_area']?>"><?php echo $area[$ke3]['name_area']?></option>
                        <?php
                      } 
                    ?>
                  </select>
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup" id="load" data-loading-text="Guardando...">
                 <i class="glyphicon glyphicon-open-file"></i>&nbsp;CREAR USUARIO
                </button>
            </div>
            <br />
        </form>


  </div>
<div class="min-footer"><div class="col-left">
<a href="index.php">¢´ Volver al login</a><br>
è¢Ì 2017 Albrook Mall. Todos los derechos reservados.											</div></div>
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
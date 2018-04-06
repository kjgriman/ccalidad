<?php
    session_start();

    $DB_host = "localhost";
    $DB_user = "root";
    $DB_pass = "";
    $DB_name = "cewmhgho_ccalidad";
    
    try
    {
         $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
         $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


       //  echo "Conexion exitosa";
    }
    catch(PDOException $e)
    {
         echo $e->getMessage();
    }

    
    include_once 'class.user.php';
    $user = new USER($DB_con);
    
    include_once 'class.ficha.php';
    $ficha = new FICHA($DB_con);

    include_once 'class.ficha_observacion.php';
    $fichaobservacion = new FICHAOBSERVACION($DB_con);
    
    include_once 'class.resultado.php';
    $resultado = new RESULTADO($DB_con);
    
    include_once 'class.archivo.php';
    $archivo = new ARCHIVO($DB_con);


    
    
?>
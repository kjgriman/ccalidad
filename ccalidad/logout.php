<?php
require_once 'config/database.php';




 if(isset($_GET['newuser']))
   {
        session_destroy();
        unset($_SESSION['user_session']);
        if(!$user->is_loggedin())
        {
        $user->redirect('index.php?newuser');
        }
    }else{

        session_destroy();
        unset($_SESSION['user_session']);
        if(!$user->is_loggedin())
        {
        $user->redirect('index.php');
        }
    }
?>
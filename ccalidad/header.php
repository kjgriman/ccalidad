<link rel="stylesheet" href="dist/css/dropzone.min.css">
<script src="dist/js/dropzone.js"></script>

<?php
include_once 'config/database.php';

if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM tbl_users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>

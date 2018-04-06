<?php
class USER
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
    public function register($fname,$lname,$uname,$umail,$upass,$id_area)
    {
       try
       {
           $new_password = md5($upass);
   
           $stmt = $this->db->prepare("INSERT INTO tbl_users(user_name,user_email,user_pass,id_area) 
                                                       VALUES(:uname, :umail, :upass, :id_area)");
              
           $stmt->bindparam(":uname", $uname);
           $stmt->bindparam(":umail", $umail);
           $stmt->bindparam(":upass", $new_password);            
           $stmt->bindparam(":id_area", $id_area);            
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
    

     public function getAllInspectores()
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM tbl_users order by user_name");
          // var_dump($stmt);
          
          $stmt->execute();
          
          $result = $stmt->fetchAll();

          return $result;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
    
    

    public function login($uname,$umail,$upass)
    {
       try
       {
          $current_password = md5($upass);

          $stmt = $this->db->prepare("SELECT * FROM tbl_users WHERE user_name=:uname AND user_pass=:upass LIMIT 1");
          //var_dump($stmt);
          $stmt->execute(array(':uname'=>$uname, ':uname'=>$umail, ':upass'=>$current_password));            
           $stmt->execute(); 
           $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
            {
                $_SESSION['user_session'] = $userRow['user_id'];
                return true;
             }
             else
             {
                return false;
             }
          
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
}
?>
<?php
class ARCHIVO
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
 
    public function addFile($url,$idFicha)
    {
       try
       {
          
   
           $stmt = $this->db->prepare("INSERT INTO tbl_fotos (url,id_ficha) 
                                                       VALUES(:url, :idFicha)");
           $stmt->bindparam(":url", $url);
           $stmt->bindparam(":idFicha", $idFicha);       
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 
  
 
}
?>
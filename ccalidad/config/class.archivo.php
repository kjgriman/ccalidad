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
          $fecha_registro = date('Y-m-d');
   
           $stmt = $this->db->prepare("INSERT INTO tbl_fotos (url, id_ficha, fecha_registro) VALUES(:url, :idFicha, :fecha_registro)");
           $stmt->bindparam(":url", $url);
           $stmt->bindparam(":idFicha", $idFicha);       
           $stmt->bindparam(":fecha_registro", $fecha_registro);       
           $stmt->execute(); 
   
           return $this->db->lastInsertId();; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 
  
 
}
?>
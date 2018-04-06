<?php
class FICHAOBSERVACION
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
 


    public function addFichaObservacion($idFicha,$idCategoria,$descripcion)
    {
       try
       {
          
           $stmt = $this->db->prepare("INSERT INTO  tbl_ficha_observacion (id_ficha,id_categoria,observacion) 
                                                       VALUES(:idFicha, :idCategoria, :descripcion)");
           $stmt->bindparam(":idFicha", $idFicha);
           $stmt->bindparam(":idCategoria", $idCategoria);
           $stmt->bindparam(":descripcion", $descripcion);           
           $stmt->execute(); 
           
           return $this->db->lastInsertId().'<br />';
          
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 
   
   
   
   
 
}
?>
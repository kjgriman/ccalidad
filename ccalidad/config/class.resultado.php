<?php
class RESULTADO
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
 
    public function addResultado($idficha,$iditem,$categoria,$valor)
    {
       try
       {
          
   
           $stmt = $this->db->prepare("INSERT INTO  tbl_resultado (	id_ficha,id_item,id_categoria,valor) 
                                                       VALUES(:idFicha, :idItem, :idcategoria, :valor)");
           $stmt->bindparam(":idFicha", $idficha);
           $stmt->bindparam(":idItem", $iditem);
           $stmt->bindparam(":idcategoria", $categoria);
           $stmt->bindparam(":valor", $valor);           
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
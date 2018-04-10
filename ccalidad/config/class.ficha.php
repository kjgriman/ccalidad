<?php
class FICHA
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
 
  
    public function getAllArea()
    {
       try
       {
          $stmt = $this->db->prepare("SELECT id_area, name_area FROM tbl_area ORDER BY name_area ASC");
          
          $stmt->execute();
          
          $result = $stmt->fetchAll();

          return $result;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
  public function getAllTiendaPasillo()
    {
       try
       {
          $stmt = $this->db->prepare("SELECT tienda, pasillo,id FROM tbl_tiendas ORDER BY tienda ASC");
          
          $stmt->execute();
          
          $result = $stmt->fetchAll();

          return $result;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
   public function getAllCategorias($idareauserlog)
    {
       try
       { 
          $stmt = $this->db->prepare("SELECT * FROM tbl_categoria where id_area = ".$idareauserlog ." ");
          
          $stmt->execute();
          
          $result = $stmt->fetchAll();

          return $result;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
   public function getAllCategoriasjouinarea()
    {
       try
       {
          $stmt = $this->db->prepare("SELECT tbl_categoria.id, tbl_categoria.nombre, tbl_area.name_area FROM tbl_categoria INNER JOIN tbl_area ON tbl_categoria.id_area = tbl_area.id_area;");
          
          $stmt->execute();
          
          $result = $stmt->fetchAll();

          return $result;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }



public function getAllItems($categoria)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM tbl_items WHERE id_categoria=". $categoria ." ORDER BY id");
          
          $stmt->execute();
          
          $result = $stmt->fetchAll();

          return $result;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }


    public function registerFicha($idLocal,$fecha,$obs,$plazo,$idusuario)
    {
       try
       {
          
           $stmt = $this->db->prepare("INSERT INTO  tbl_ficha ( id_tienda,fecha_inspeccion,plazo,observaciones,id_usuario) 
                                                       VALUES(:idlocal, :fecha, :plazo,:obs,:idusuario)");
           $stmt->bindparam(":idlocal", $idLocal);
           $stmt->bindparam(":fecha", $fecha);
           $stmt->bindparam(":plazo", $plazo);
           $stmt->bindparam(":obs", $obs);
           $stmt->bindparam(":idusuario", $idusuario);            
           $stmt->execute(); 
           
           return $this->db->lastInsertId().'<br />';
          
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
    
    public function registecategory($idarea,$name_category)
    {
       try
       {
          
           $stmt = $this->db->prepare("INSERT INTO  tbl_categoria ( nombre,id_area) 
                                                       VALUES( :nombre ,:id_area)");
         
           $stmt->bindparam(":nombre", $name_category);
           $stmt->bindparam(":id_area", $idarea);         
           $stmt->execute(); 
           
           return $this->db->lastInsertId().'<br />';
          
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }

    public function registeritem($idcategory,$name_item)
    {
       try
       {
          
           $stmt = $this->db->prepare("INSERT INTO  tbl_items ( id_categoria,nombre) 
                                                       VALUES( :id_categoria ,:nombre)");
         
           $stmt->bindparam(":id_categoria", $idcategory);
           $stmt->bindparam(":nombre", $name_item);         
           $stmt->execute(); 
           
           return $this->db->lastInsertId().'<br />';
          
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 
    public function registertienda($tienda,$pasillo,$encargado,$email_tienda)
    {
       try
       {
          
           $stmt = $this->db->prepare("INSERT INTO  tbl_tiendas (	tienda, pasillo, encargado, email_tienda) 
                                                       VALUES( :tienda, :pasillo ,:encargado, :email_tienda)");
         
           $stmt->bindparam(":tienda", $tienda);         
           $stmt->bindparam(":pasillo", $pasillo);
           $stmt->bindparam(":encargado", $encargado);
           $stmt->bindparam(":email_tienda", $email_tienda);
           $stmt->execute(); 
           
           return $this->db->lastInsertId().'<br />';
          
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 
    public function searchByLocal1($idLocal,$fecha1,$fecha2,$inspector)
    {

      try
       {
        if ($idLocal!='T') {
         
          $sql1= "id_tienda=". $idLocal ." AND";
        }
        else{
          $sql1=" ";
        }
        if ($inspector!='T') {
         
        $sql2= "AND tbl_ficha.id_usuario =".$inspector."";
        }
        else{
          $sql2=" ";
        }


          $stmt = $this->db->prepare("SELECT * FROM tbl_ficha INNER JOIN tbl_tiendas ON tbl_ficha.id_tienda = tbl_tiendas.id INNER JOIN tbl_users ON tbl_ficha.id_usuario = tbl_users.user_id WHERE " .$sql1 ."  tbl_ficha.fecha_inspeccion BETWEEN '".$fecha1."' AND '".$fecha2 ."' ". $sql2." ORDER BY tbl_ficha.id DESC ");
          
          
          $stmt->execute();
          
          $result = $stmt->fetchAll();
            if ($result==0){
              return'no se encontro algun registro que cumpla estos parametros';

            }
            else{
                             
          return $result;
            }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }

       }
     public function searchByLocal($idLocal,$inspector,$idCategoria,$item,$valor,$fechaInicio,$fechaFin)
    {
       try
       {

	      $local = "";
  		  $categoria = "";
  		  $valor1="";
        $item1="";
  		  $inspector1="";
		  
          if($idLocal!="T"){
				$local = " ficha.id_tienda = ".$idLocal ." AND ";
	       }
	   
	      if($idCategoria!="T"){
				$categoria =" id_categoria = ". $idCategoria ." AND ";
	      }
		  
		  if($valor!="T"){
				$valor1 =" valor = ". $valor ." AND ";
	      }
		  
		  if($inspector!="T"){
				$inspector1 = " user.user_id =" . $inspector ." AND ";
	      }
		 
 if($item!="T"){
				$item1= " id_item =" . $item." AND ";
	      } 
		  




		  $sql = "SELECT ficha.id,ficha.fecha_inspeccion,ficha.observaciones, tienda.tienda,tienda.pasillo, user.user_name ,id_item,id_categoria,valor ";
		  $sql .= " FROM tbl_ficha as ficha INNER JOIN tbl_tiendas as tienda ON ficha.id_tienda = tienda.id INNER JOIN tbl_users as user ON ";
		  $sql .= " ficha.id_usuario = user.user_id INNER JOIN tbl_resultado as resultado ON ficha.id = resultado.id_ficha WHERE ". $local ;
		  $sql .= $categoria . "  ". $valor1 ." ". $inspector1 ." ". $item1 ." ficha.fecha_inspeccion BETWEEN :start_date AND :end_date";
      
		  
		  $stmt = $this->db->prepare($sql);

           //echo "Valor ".$idLocal."-".$idCategoria."-".$valor."-". $inspector ." - ". $fechaInicio."-".$fechaFin . "<br>";

           //var_dump($stmt);
          
          $stmt->execute(array(':start_date'=>$fechaInicio, ':end_date'=>$fechaFin));
          
          $result = $stmt->fetchAll();

          return $result;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
   
   public function querycategory($value)
   {
     $valor="";
       try
       {
          $stmt = $this->db->prepare("SELECT DISTINCT tbl_resultado.id_categoria, tbl_categoria.nombre FROM tbl_resultado INNER JOIN tbl_categoria ON tbl_resultado.id_categoria = tbl_categoria.id  WHERE id_ficha=".$value." ");

         
          $stmt->execute();
          $result = $stmt->fetchAll();
                        
          // var_dump($result);     
          return $result;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
    public function searchResultadosFicha($idFicha)
    {  $valor="";
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM tbl_resultado WHERE id_ficha=".$idFicha." ORDER BY id ASC");
          
          $stmt->execute(array(':idficha'=>$idFicha));
          $result = $stmt->fetchAll();
          foreach($result as $row){
                $valor.=$row['valor'].",";
              
          }              	
          // var_dump($result);     
          return $result;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

   /*public function notificacionFicha($idFicha,$idCat)
    {  $valor="";
       try
       {
          $stmt = $this->db->prepare("SELECT Count(valor) AS Number FROM tbl_resultado WHERE id_ficha = :idficha AND id_categoria = :id_cat AND valor=0");
           //var_dump($stmt);
          
          $stmt->execute(array(':idficha'=>$idFicha, :idcat'=>$idCat));
          $stmt->fetch(PDO::FETCH_ASSOC);
          $result = $stmt->fetchAll();
          foreach($result as $row){
                $valor.=$row['valor'].",";
              
          }              	       
          return $valor;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }*/
   
   
   
   
   
   
 
}
?>
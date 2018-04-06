<?php
$options="";
if ($_POST["elegido"]==1) {
    $options= '
    <option value="T">Todos los items</option>
    <option value="1">Pisos</option>
    <option value="2">Paredes</option>
    <option value="3">Inyectores de aire fresco</option>
    <option value="4">Extractores de grasa</option>
    <option value="5">Trampa de grasa</option>
    <option value="6">Desagues</option>
    <option value="7">Fumigaci&oacute;n roedores/cucaracha</option>
    <option value="8">Musica muy alta</option>
    ';    
}
if ($_POST["elegido"]==2) {
    $options= '
    <option value="T">Todos los items</option>
    <option value="9">Arreglo de exhibicion</option>
    <option value="10">Limpieza</option>
    <option value="11">Banner por cambio de vitrina</option>
    ';    
}
if ($_POST["elegido"]=="T") {
    $options= '
    <option value="T">Todos los items</option>
    ';    
}
echo $options;    
?>
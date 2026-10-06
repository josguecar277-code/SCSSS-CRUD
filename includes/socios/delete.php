<?php
include "../../db/conexion.php";

$idCedula= $_GET ['cedula'];
$query =  " DELETE FROM socio WHERE cedula = '" .$idCedula. "';" ;
$resultado = mysqli_query($conex, $query);



$state = ($resultado) ? 4 : 5;
header("Location: ../../pag/socios.php?state=$state");
exit;

?>
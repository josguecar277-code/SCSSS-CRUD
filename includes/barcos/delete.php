<?php
include "../../db/conexion.php";

$matricula = $_GET ['matricula'];
$query = "DELETE FROM barcos WHERE matricula = '".$matricula."';";
$resultado = mysqli_query($conex, $query);

$state = ($resultado) ? 4 : 5;
header("Location: ../../pag/barcos.php?state=$state");
exit;
?>

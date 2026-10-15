<?php

function obtener_salidas (){
    try{
        require __DIR__ . '/../../db/conexion.php';

        $sql = "SELECT salidas.*, barcos.nombre
         FROM salidas
         INNER JOIN barcos ON salidas.barcos_matricula = barco.matricula;";
        
        $query = mysqli_query($conex, $sql);

        return $query;
    } catch (\Throwable $th) {
        var_dump($th);
    }
    
}
function create_salidas (){
    require __DIR__ . '/../../db/conexion.php';

    $errores = [];
    $fecha = "";
    $hora = "";
    $destino = "";
    $barco = "";

     if (isset($_POST['agregar'])){
        $fecha = mysqli_real_escape_string($conex,$_POST['fecha']);
        $hora = mysqli_real_escape_string($conex,$_POST['hora']);
        $destino = mysqli_real_escape_string($conex,$_POST['destino']);
        $barco = mysqli_real_escape_string($conex,$_POST['barco']);
        
     if (!$fecha) {
        $errores [] = "Ingrese una Fecha";
    }
    if (!$hora) {
        $errores [] = "Ingrese una Hora Correspondiente";
    }
    if (!$destino) {
        $errores [] = "Ingrese un Destino";
    }
    if (!$barco) {
        $errores []= "Seleccione un Barco";
    }else {
         $query = " SELECT * FROM barcos WHERE matricula = '".$barco."'; ";
         $resultado = mysqli_query($conex, $query);

        if (!$resultado->num_rows){
        $errores[] = "El Barco no existe";
        }
    }
    if(!$errores) {
        $query  = " INSERT INTO salidas (fecha, hora, destino, barcos_matricula) VALUES ('".$fecha."', '".$hora."', '".$destino."', '".$barco."')";

        $resultado = mysqli_query($conex, $query);
        $message = ($resultado) ? 0 : 1;

        header("Location: ../pag/salidas.php?state=$message");
        exit;
    }
}
return $errores;
}

?>
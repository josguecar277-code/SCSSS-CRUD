<?php

function obtener_barcos (){
    try{
        require __DIR__ . '/../../db/conexion.php';

        $sql = "SELECT barcos.*, socio.nombres, socio.apellidos
        FROM barcos
        INNER JOIN socio ON barcos.socio_cedula = socio.cedula;";
        
        $query = mysqli_query($conex, $sql);

        return $query;
    } catch (\Throwable $th) {
        var_dump($th);
    }
}

function create_barcos (){
    require __DIR__ . '/../../db/conexion.php';

    $errores = [];
    $matricula = "";
    $name = "";
    $n_amarre = "";     
    $c_amarre = "";
    $socio = "";

    if (isset($_POST['agregar'])){
        $matricula = mysqli_real_escape_string($conex,$_POST['matricula']);
        $name = mysqli_real_escape_string($conex,$_POST['name']);
        $n_amarre = mysqli_real_escape_string($conex,$_POST['n_amarre']);
        $c_amarre = mysqli_real_escape_string($conex,$_POST['c_amarre']);
        $socio = mysqli_real_escape_string($conex,$_POST['socio']);

    if (!$matricula) {
        $errores [] = "Ingrese una Matricula";
    } elseif (strlen($matricula) > 15) {
    $errores[] = "La matricula no puede tener mas de 15 caracteres";
    } 
    if (!$name) {
        $errores [] = "Ingrese un Nombre";
    }
    if (!$n_amarre) {
        $errores [] = "Ingrese un Numero de Amarre";
    }
    if (!$c_amarre) {
        $errores [] = "Ingresa la Cuota de Amarre";
    }else if(!is_numeric($c_amarre)){
        $errores [] = "La Cuota debe ser un numero";
    }
    if (!$socio) {
        $errores []= "Seleccione un Socio";
    } else {
        $query = " SELECT * FROM socio WHERE cedula = '".$socio."'; ";
        $resultado = mysqli_query($conex, $query);
        if (!$resultado->num_rows){
        $errores[] = "El Socio no existe";
        }
    }

    if(!$errores) {
        $query  = " INSERT INTO barcos (matricula, nombre, n_amarre, cuota_amarre, socio_cedula) VALUES ('".$matricula."', '".$name."', '".$n_amarre."', '".$c_amarre."', '".$socio."')";

        $resultado = mysqli_query($conex, $query);
        $message = ($resultado) ? 0 : 1;

        header("Location: ../pag/barcos.php?state=$message");
        exit;
    }
        
    }
    return $errores;
    
}       


    

?>
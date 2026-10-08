<?php
include __DIR__ . '/../../db/conexion.php';

$idCedula = mysqli_real_escape_string($conex, $_GET['cedula']);
$errores = [];

$query = " SELECT * FROM socio WHERE cedula = '" .$idCedula. "';";
$resultado = mysqli_query($conex, $query);
$socio = mysqli_fetch_assoc($resultado);

if (isset($_POST['editar'])){
    $name = mysqli_real_escape_string($conex, $_POST['name']);
    $last_name = mysqli_real_escape_string($conex, $_POST['last_name']);
    $address = mysqli_real_escape_string($conex, $_POST['address']);
    // $cedula = mysqli_real_escape_string($conex, $_POST['cedula']);
    $phone = mysqli_real_escape_string($conex, $_POST['phone']);
    

    if (!$name || !$last_name || !$address  || !$phone){
         $errores[] = "Todos los campos son obligatorios";
    }
    
    if (!$errores) {
        $query = "UPDATE socio SET nombres = '$name', apellidos = '$last_name', direccion = '$address', numero = '$phone' WHERE cedula = '$idCedula';";
    // $query = "WHERE id = ". $idCedula . ";";
    $resultado = mysqli_query($conex, $query);
    $state = ($resultado) ? 2 : 3;
    header("Location: ../../pag/socios.php?state=$state");
    exit;
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Clientes</title>
</head>
<body>
    <h2>Editar Clientes</h2>
 
    <?php
    foreach ($errores as $error) {
        echo "<p>" . $error . "</p>";
    }
    ?>
 
    <form action="" method="post">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="<?php echo $socio['nombres']; ?>"> <br>
 
        <label for="last_name">Apellido:</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $socio['apellidos']; ?>"> <br>
 
        <label for="address">Direccion</label>
        <input type="text" name="address" id="address" value="<?php echo $socio['direccion']; ?>"> <br>
 
        <label for="phone">Numero</label>
        <input type="text" name="phone" id="phone" value="<?php echo $socio['numero']; ?>"> <br>

        <button type="submit" name="editar">Guardar cambios</button>
    </form>

    <a href="../../pag/socios.php">Volver a Clientes</a>
</body>
</html>
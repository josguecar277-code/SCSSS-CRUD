<?php
require __DIR__ .'/../db/conexion.php';
require __DIR__ . '/../includes/salidas/create.php';

$errores = "";
if (isset($_POST['agregar'])){
    $errores = create_salidas();
}

$barcos = mysqli_query($conex, "SELECT matricula, nombre FROM barcos;");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regitro de Salidas</title>
</head>
<body>
    <h2>Registro de Salidas</h2>
<?php

if($errores) {
    foreach ($errores as $error) {
        echo "<p>" . $error . "</p>";
    }   
}
?>
<form action="" method="post">
    
    <label for="fecha">Fecha</label>
    <input type="date" name="fecha" id="fecha"><br>  

    <label for="hora">Hora</label>
    <input type="time" name="hora" id="hora"><br>

    <label for="destino">Destino</label>
    <input type="text" name="destino" id="destino"><br>


     <label for="barco">Barcos</label>
     <select name="barco" id="barco">
        <option value="">Seleccione un Barco</option>

         <?php while ($b = mysqli_fetch_assoc($barcos)) { ?>
        <option value= "<?php echo $b['matricula']; ?>">
            <?php echo $b['matricula'] ."  ". $b['nombre']; ?>
        </option>
    <?php } ?>
</select><br>

    <button type="submit" name="agregar">Guardar Salida</button>
</form>

<a href="../pag/salidas.php">Volver a Salidas</a>
</body>
</html>
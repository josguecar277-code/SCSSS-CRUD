<?php
require __DIR__ .'/../db/conexion.php';
require __DIR__ . '/../includes/barcos/create.php';

$errores = "";
if (isset($_POST['agregar'])){
    $errores = create_barcos();
}

$socios = mysqli_query($conex, "SELECT cedula, nombres, apellidos FROM socio;");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regitro de Barcos</title>
</head>
<body>
    <h2>Registro de Barcos</h2>
<?php

if($errores) {
    foreach ($errores as $error) {
        echo "<p>" . $error . "</p>";
    }   
}
?>
<form action="" method="post">
    
    <label for="matricula">Matricula</label>
    <input type="text" name="matricula" id="matricula"><br>  

    <label for="name">Nombre</label>
    <input type="text" name="name" id="name"><br>

    <label for="n_amarre">Numero de Amarre</label>
    <input type="text" name="n_amarre" id="n_amarre"><br>

    <label for="c_amarre">Cuota de Amarre</label>
    <input type="text" name="c_amarre" id="c_amarre"><br>

    <!-- <label for="soc-cedula">Socio Cedula</label>
   <input type="text" name="soc-cedula" id="soc-cedula"><br> -->

     <label for="socio">Socio</label>
     <select name="socio" id="socio">
        <option value="">Seleccione un Dato</option>

         <?php while ($s = mysqli_fetch_assoc($socios)) { ?>
        <option value= "<?php echo $s['cedula']; ?>">
            <?php echo $s['nombres'] ."  ". $s['apellidos']; ?>
        </option>
    <?php } ?>
</select><br>

    <button type="submit" name="agregar">Guardar Barco</button>
</form>

<a href="../pag/barcos.php">Volver a Barcos</a>
</body>
</html>
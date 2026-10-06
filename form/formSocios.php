<?php
require __DIR__ . '/../includes/socios/create.php';

$errores = "";
if (isset($_POST['agregar'])){
    $errores = create_socio();
}

$socios = obtener_socios();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Socios</title>
</head>
<body>
    <h2>Registro de Socios</h2>
      <?php

if($errores) {
    foreach ($errores as $error) {
        echo "<p>" . $error . "<p>";
    }   
}
    ?>

    <form action="" method="post">
 <label for="cedula">Cedula</label>
 <input type="text" name="cedula" id="cedula"> <br>

<label for= "name">Nombres:</label>
<input type="text" name="name" id="name"> <br>

<label for= "last_name">Apellidos:</label>
<input type="text" name="last_name" id="last_name"> <br>

 <label for="email">Direccion</label>
<input type="text" name="address" id="address"> <br>

<label for="phone">Numero</label>
  <input type="text" name="phone" id="phone"> <br>



<button type="submit" name="agregar">Guardar Socio</button>
</form>

<a href="../pag/socios.php">Volver a socios</a>
</body>
</html>
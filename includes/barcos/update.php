<?php
include __DIR__ . '/../../db/conexion.php';

$matricula = mysqli_real_escape_string($conex, $_GET['matricula']);
$errores = [];

$query = "SELECT * FROM barcos WHERE matricula = '".$matricula."';";
$resultado = mysqli_query($conex, $query);
$barco = mysqli_fetch_assoc($resultado);

$socios = mysqli_query($conex, " SELECT cedula, nombres, apellidos FROM socio;");

if(isset($_POST['editar'])){
    $name = mysqli_real_escape_string($conex,$_POST['name']);
    $n_amarre = mysqli_real_escape_string($conex,$_POST['n_amarre']);
    $c_amarre = mysqli_real_escape_string($conex,$_POST['c_amarre']);
    $socio = mysqli_real_escape_string($conex,$_POST['socio']);

    if(!$name || !$n_amarre || !$c_amarre || !$socio){
        $errores[] = "Todos los campos son obligatorios";
    }
    if ($c_amarre && !is_numeric($c_amarre)){
    $errores[] = "La cuota debe ser un numero";
}

    if(!$errores){
        $query = " UPDATE barcos SET nombre = '$name', n_amarre = '$n_amarre', cuota_amarre = '$c_amarre', socio_cedula = '$socio' WHERE matricula = '$matricula'; ";
    $resultado = mysqli_query($conex, $query);
    $state = ($resultado) ? 2 : 3;
    header("Location: ../../pag/barcos.php?state=$state");
    exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Barcos</title>
</head>
<body>
    <h2>Editar Barcos</h2>

    <?php
    foreach ($errores as $error){
        echo "<p>" . $error . "</p>";
    }
    ?>

<form action="" method="post">
    <label for="name">Nombre</label>
    <input type="text" name="name" id="name" value="<?php echo $barco ['nombre'];?>"><br>

    <label for="n_amarre">Numero Amarre</label>
    <input type="text" name="n_amarre" id="n_amarre" value="<?php echo $barco ['n_amarre'];?>"><br>

    <label for="c_amarre">Cuota Amarre</label>
    <input type="text" name="c_amarre" id="c_amarre" value="<?php echo $barco ['cuota_amarre'];?>"><br>

    <label for="socio">Socio</label>
    <select name="socio" id="socio">
        <option value="">Seleccione un Dato</option>

         <?php while($s= mysqli_fetch_assoc($socios)){ ?>
        <option value= "<?php echo $s['cedula']; ?>">
        <?php if ($s['cedula'] == $barco['socio_cedula']) echo '-->'; ?>

         <?php echo $s['nombres'] ." ". $s['apellidos']; ?>
    </option>
    <?php  } ?>
    </select>

    <button type="submit" name="editar">Guardar Cambios</button>
</form>


<a href="../../pag/barcos.php">Volver a Barcos</a>
</body>
</html>
<?php
require __DIR__ . '/../includes/socios/create.php';
session_start();
// if(!isset($_SESSION['nombres'])){
//     header("Location: ../index.php");
//     exit;
// }

$socios = obtener_socios();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socios</title>
</head>
<body>
    
<tbody>
<table>
    <thead>
        <tr>
        <th>Cedula</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Opciones</th>
    </tr>
</thead>
    
</tbody>
<?php
while ($socio = $socios->fetch_assoc()) {

?>

<tr>
    <td><?php echo $socio['cedula']; ?></td>
    <td><?php echo $socio['nombres']; ?></td>
    <td><?php echo $socio['apellidos']; ?></td>
    <td><?php echo $socio['direccion']; ?></td>
    <td><?php echo $socio['numero']; ?></td>
    
    <td>
        <a href="../includes/socios/update.php?id=<?php echo $socio['id']; ?>">Actualizar</a>
        <a href="../includes/socios/delete.php?id=<?php echo $socio['id']; ?>"onclick = "return confirmar()">Eliminar</a>
    </td>
</tr>

<?php
}
?>
</body>
</html>
<?php
require __DIR__ . '/../includes/socios/create.php';
session_start();
// if(!isset($_SESSION['nombre'])){
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
    <h1>Clientes</h1>

    <a href="../form/formSocios.php">+ Nuevo Socio</a><br>
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
        <a href="../includes/socios/update.php?id=<?php echo $socio['cedula']; ?>">Actualizar</a>
        <a href="../includes/socios/delete.php?cedula=<?php echo $socio['cedula']; ?>"onclick = "return confirmar()">Eliminar</a>
    </td>
</tr>

<?php
}
?>
</tbody>
</table>
<?php
echo '<a href = "dashboard.php">Volver al panel Principal </a>';
?>
<script> 
function  confirmar(){
    return confirm('Seguro de eliminar los datos?');
}
</script>
</body>
</html>
<?php
require __DIR__ . '/../includes/salidas/create.php';

session_start();

if(!isset($_SESSION['nombre'])){
    header("Location: ../login.php");
    exit;
}
$salidas = obtener_salidas();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salidas</title>
</head>
<body>
    <h1>Salidas</h1>
    <a href="../form/formSalidas.php">+ Nueva Salida</a>
    
<table>
    <thead>
        <tr>
            <th>ID_salida</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Destino</th>
            <th>Barcos_matricula</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>

<?php
while ($salida = $salidas->fetch_assoc()){

?>
<tr>
    <td><?php echo $salida['id_salida']; ?></td>
    <td><?php echo $salida['fecha']; ?></td>
    <td><?php echo $salida['n_amarre']; ?></td>
    <td><?php echo $salida['cuota_amarre']; ?></td>
    <td><?php echo $salida['nombres'] ." ". $salida['apellidos']; ?></td>

    <td>
        <a href="../includes/barcos/update.php?matricula=<?php echo $barco['matricula']; ?>">Actualizar</a>
         <a href="../includes/barcos/delete.php?matricula=<?php echo $barco['matricula']; ?>" onclick = "return confirmar()">Eliminar</a>
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
</body>
</html>
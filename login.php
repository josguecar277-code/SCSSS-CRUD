    <?php
    
    require './includes/users/create.php';
    require './db/conexion.php';
    // require './db/obtenerUsuarios.php';

    // $usuarios = obtener_usuarios();
    // $addUser= obtener_usuarios();

    if (isset($_POST['agregar'])){
        $userForm = $_POST['name-form'];
        $pwForm =$_POST['pw-form'];
        $userDB = "";
        $pwDB = "";

    
        // $query = "SELECT * FROM usuarios WHERE nombre = '{$userForm}';";
        $query = "SELECT * FROM usuarios WHERE nombre = '" . mysqli_real_escape_string($conex, $userForm) . "';";
        $resultado = mysqli_query($conex, $query); 

        if ($resultado->num_rows > 0) {
            foreach ( $resultado as $usuario) {
                $userDB = $usuario['nombre'];
                $pwDB = $usuario['contrasena'];
            }
            $autenticado = password_verify($pwForm, $pwDB);
            // var_dump($pwForm, $pwDB, $autenticado);
            if ($userForm === $userDB && $autenticado) {
                session_start();
                $_SESSION['nombre'] = $userDB;
                header ("location: pag/dashboard.php");
                exit;
            
            }else {
                echo"Usuario o contraseña errada";
            }

        }else{
            echo "Usuario o contraseña errada";
        }
    
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="build/css/app.css">
        <title>Ejemplo conexion DB</title>
    </head>
    <body>
        <main class="login">
            
        
    <form class="formulario" action="" method="post">
        <h1 class="titulo">Login</h1>

    <div class="panel-campos">

        <div class="campos">
        <label for = "name-form">Nombre de Usuario</label>
        <input type="text" name="name-form">
        </div>

        <div class="campos">
    <label for = "pw-form">Contraseña</label>
    <input type="password" name="pw-form">

    </div>
    </div>
    <input class ="boton" type="submit" value="Enviar" name="agregar"> 
     
     

</form>
</main>

</body>
</html>










 
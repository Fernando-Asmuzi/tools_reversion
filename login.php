<!doctype html>
<html lang="en" data-bs-theme="auto">

<?php

    include 'head.php';
    include ('conexion/conexion.php');
    session_start();

    //---------------------------- Código de Inicio de Sesión ---------------------------//
    if (isset($_POST['login'])) {
        $username = $_POST['usuario'];
        $password = $_POST['password'];
        //$password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = $conexion->prepare("SELECT * FROM usuario WHERE nombre=:usuario or email=:usuario");
        $query->bindParam("usuario", $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '<script language="javascript">alert("El usuario o email ingresado es incorrecto");</script>';
        } else {
            $hash=$result['password'];
            if (password_verify($password, $hash)) {
                $_SESSION['id'] = $result['id'];
                Header("Location: index.php");
            } else {
                echo '<script language="javascript">alert("La contraseña es incorrecta");</script>';
            }
        }
    }
?>

<body class="text-center">
    <div class="ancho40">
    <main class="form-signin w-100 m-auto">
        <form method="POST" action="" id="login" name="login">
            <h1 class="h3 mb-3 fw-normal">Ingreso</h1>
            <div class="form-floating">
                <input type="text" class="form-control" name="usuario" id="floatingInput" placeholder="Usuario o correo electrónico" required>
                <label for="floatingInput">Usuario o correo electrónico</label>
            </div> <br>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Contraseña" required>
                <label for="floatingPassword">Contraseña</label>
            </div> <br>
            <!-- <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Recordarme
                </label>
            </div> -->
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="login" value="login">Ingresar</button>
            <a href="registro.php">Registrar nuevo usuario</a> <br>
            <a href="">¿Olvidaste tu contraseña?</a>
        </form>
    </main>
    </div>
</body>
</html>
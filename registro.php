<!doctype html>
<html lang="en" data-bs-theme="auto">
<?php
    include 'head.php';
    include('conexion/conexion.php');
    session_start();

    // Código para registro de nuevo usuario REVISAR BIEN LAS VARIABLES
    
    if (isset($_POST['registrar'])) {
        
        $username = $_POST['user'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = $conexion->prepare("SELECT * FROM usuario WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            echo '<script language="javascript">alert("El email ya se encuentra registrado");</script>';
        }
        if ($query->rowCount() == 0) {
            $query = $conexion->prepare("INSERT INTO usuario(nombre,PASSWORD,email) VALUES (:username,:password_hash,:email)");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $result = $query->execute();
            if ($result) {
                echo '<script language="javascript">alert("El usuario se registró correctamente");</script>';
                Header("Location: login.php");
            } else {
                echo '<script language="javascript">alert("Se generó un error inesperado, intente nuevamente");</script>';
            }
        }
    } 
?>

<body class="text-center">
    <div class="ancho30" style="text-align: center; margin:auto;">
    <main class="form-signin w-100 m-auto">
        <form method="POST" action="" id="registrar" name="registrar">
            <!-- 
            <img class="mb-4" src="/tools_reversion/tools_reversion/assets/img/lo.png" alt="" width="150" height="100"> 
            -->
            <h1 class="h3 mb-3 fw-normal">Registro de usuario</h1>
            <div class="form-floating">
                <input type="text" class="form-control" name="user" id="floatingInput" placeholder="Usuario" required>
                <label for="floatingInput">Nombre de usuario</label>
            </div> <br>
            <div class="form-floating">
                <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="Email" required>
                <label for="floatingEmail">Correo electrónico</label>
            </div> <br>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Contraseña" required>
                <label for="floatingPassword">Contraseña</label>
            </div> <br>
            <div class="justify-content-between" style="display: flex;">
                <button class="w-100 btn btn-primary" type="submit" name="registrar" value="registrar" style="margin-right: 2px;">Registrar usuario</button>
                <a class="w-100 btn btn-danger" href="login.php" role="button" style="margin-left: 2px;">Cancelar</a>
            </div>      
        </form>
    </main>
    </div>
</body>
</html>
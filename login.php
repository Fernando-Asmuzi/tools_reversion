<!doctype html>
<html lang="en" data-bs-theme="auto">

<?php
    include 'head.php';
    include('conexion/conexion.php');
    session_start();

    // Código para registro de nuevo usuario REVISAR BIEN LAS VARIABLES
    /*
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = $connection->prepare("SELECT * FROM users WHERE EMAIL=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            echo '<p class="error">The email address is already registered!</p>';
        }
        if ($query->rowCount() == 0) {
            $query = $connection->prepare("INSERT INTO users(USERNAME,PASSWORD,EMAIL) VALUES (:username,:password_hash,:email)");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $result = $query->execute();
            if ($result) {
                echo '<p class="success">Your registration was successful!</p>';
            } else {
                echo '<p class="error">Something went wrong!</p>';
            }
        }
    } */

    //---------------------------- Código de Inicio de Sesión ---------------------------//
    if (isset($_POST['login'])) {
        $username = $_POST['usuario'];
        $password = $_POST['password'];
        $query = $conexion->prepare("SELECT * FROM usuario WHERE nombre=:usuario");
        $query->bindParam("usuario", $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '<p class="error">Usuario incorrecto</p>';
        } else {
            
            echo $password;
            echo ' ';
            echo $result['password'];

            if (password_verify(sha1($password), $result['PASSWORD'])) {
                $_SESSION['id'] = $result['id'];
                echo '<p class="success">Congratulations, you are logged in!</p>';
            } else {
                echo '<p class="error">Contraseña incorrecta</p>';
            }
        }
    }
?>

<body class="text-center">
    <main class="form-signin w-100 m-auto">
        <form method="POST" action="" id="login" name="login">
            <!-- 
            <img class="mb-4" src="/tools_reversion/tools_reversion/assets/img/lo.png" alt="" width="150" height="100"> 
            -->
            <h1 class="h3 mb-3 fw-normal">Ingreso</h1>
            <div class="form-floating">
                <input type="text" class="form-control" name="usuario" id="floatingInput" placeholder="Usuario" required>
                <label for="floatingInput">Usuario</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Contraseña" required>
                <label for="floatingPassword">Contraseña</label>
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Recordarme
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="login" value="login">Ingresar</button>
        </form>
    </main>

    <!-- <script>
    $(document).ready(function() {
    event.preventDefault();
    $('#login').submit(function(event) {
        $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        })
    });
    });
    </script> -->

</body>
</html>
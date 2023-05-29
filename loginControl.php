<?php
    include('conexion/conexion.php');
    session_start();
    echo 'hola';
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

    //Código para inicio de sesión
    if (isset($_POST['login'])){
        $username = $_POST['usuario'];
        $password = $_POST['password'];
        $query = $connection->prepare("SELECT * FROM usuario WHERE nombre=:usuario");
        $query->bindParam("usuario", $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            //echo '<p class="error">Usuario inexistente</p>';
            echo 'NO';
        } else {
            echo 'SI';
            //if (password_verify($password, $result['PASSWORD'])) {
              
              //  $_SESSION['id'] = $result['ID'];
               // header('Location: http://localhost/tools_reversion/tools_reversion/index.php');
                //die();
            //} else {
             //   echo '<p class="error">La contraseña es incorrecta</p>';
            //}
        }
    }
?>
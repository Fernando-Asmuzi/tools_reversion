<?php
  include 'conexion/conexion.php';

  // -------------------------------------------------------------------------------- //
  // Codigo que Genera verificar usuario
  $email = $_POST['email'];
  $password = SHA1($_POST['password']);
  $registros = 0;

  // Consulta de email y password
  // Hecho sobre la tabla personal, pero se puede cambiar por cualquier otra
  // En caso de cambiar por otra tabal cambiar los campos email y password si es que no existen
  $consulta = "SELECT * FROM personal WHERE email ='$email' AND password = '$password' LIMIT 1";
  $resultado = $conexion->query($consulta);
  $registros = $resultado->rowCount();
  $resultado->execute();

  if($registros != 0){
    $resul_array = [];
    while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
     array_push($resul_array, $row);
    }
    echo json_encode($resul_array);
    exit();
  }else{
    echo 'NO1';
  }


?>
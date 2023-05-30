<?php

$file_handle = fopen('tmp.txt', 'r');
$contents = fread($file_handle, filesize('tmp.txt'));
fclose($file_handle);

$array_proyec = explode("-", $contents);

//print_r($array_proyec);

$proyecto0 = $array_proyec[0];
$proyecto = $array_proyec[1];
$base = $array_proyec[2];


if (!empty($proyecto)) {
    $tabla = $_POST['tabla'];
    $carpeta = $proyecto0 . '/' . trim(strtolower($tabla));
    // $proyec = $_COOKIE['proyec'];
    // $base = $_COOKIE['base'];
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'admin123');
    define('DB_NAME', $base);
    try {
        $conexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        $conexion->exec("set names utf8");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("ERROR: No se pudo conectar. " . $e->getMessage());
    }
    //----- Consulta de la Estructura de la Tabla pasada como Paramentro -----//
    $consulta = "SELECT COLUMN_NAME AS columna, ORDINAL_POSITION AS posicion, DATA_TYPE AS tipo FROM information_schema.columns WHERE table_schema = '" . $base . "' AND table_name = '" . $tabla . "' ORDER BY ORDINAL_POSITION";
    $resultado = $conexion->query($consulta);
    $campos = $resultado->rowCount();
    $resultado->execute();
    if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777, true);
    }
    //----- Input Hidden -----//
    if ($_POST['radio'] == 'radio6') {
        $devu = '';
        // For que Arma los Input Hidden
        $devu .= "<!-- Input de Campos Hidden -->\r";
        $devu .= "<!-- Estos campos deben usarse en caso de necesidad de pasar valores fijos de algunos de los campos. -->\r\r";
        $array_campos = [];
        for ($counter = 0; $counter < $campos; $counter++) {
            $row = $resultado->fetch(PDO::FETCH_ASSOC);
            if ($row['columna'] != 'id') {
                array_push($array_campos, $row['columna']);
            }
        }
        print_r($array_campos);
        // Crea los Input hidden para Insert
        $devu .= "<!-- Campos Hidden para Insert -->\r";
        for ($counter = 0; $counter < count($array_campos); $counter++) {
            $devu .= "<!-- Input de " . $array_campos[$counter] . " -->\r";
            $devu .= "<input type='hidden' id='" . $array_campos[$counter] . '_i' . "' name ='" . $array_campos[$counter] . '_i' . "' value=''/>\r";
        }
        $devu .= "\r";
        // Crea los Input hidden para Update
        $devu .= "<!-- Campos Hidden para Update -->\r";
        for ($counter = 0; $counter < count($array_campos); $counter++) {
            $devu .= "<!-- Input de " . $array_campos[$counter] . " -->\r";
            $devu .= "<input type='hidden' id='" . $array_campos[$counter] . '_u' . "' name ='" . $array_campos[$counter] . '_u' . "' value=''/>\r";
        }
        $devu .= "\r";
        // Crea los Input hidden para Deletee
        $devu .= "<!-- Campos Hidden para Delete -->\r";
        for ($counter = 0; $counter < count($array_campos); $counter++) {
            $devu .= "<!-- Input de " . $array_campos[$counter] . " -->\r";
            $devu .= "<input type='hidden' id='" . $array_campos[$counter] . '_d' . "' name ='" . $array_campos[$counter] . '_d' . "' value=''/>\r";
        }
        $devu .= "\r";
        echo $devu;
    }
    //----- Select Option -----//
    if ($_POST['radio'] == 'radio7') {
        $devu .= '<!-- Select Option -->' . "\r";
        $devu .= '<!-- Para archivo add.php -->' . "\r";
        $devu .= "<div class='row text-center'>" . "\r";
        $devu .= "<div class='col-md-12'>" . "\r";
        $devu .= "<div class='input-group input-group mb-2'>" . "\r";
        $devu .= "<span class='input-group-text' id='inputGroup-sizing-sm'><i title='Stock' class='bi bi-record-fill color10'></i></span>" . "\r";
        $devu .= '<!-- Cambiar el Atributo name por el campo que se desee que se guarde -->' . "\r";
        $devu .= "<select class='form-select letra-normal' id='selector1' name='area_i'>" . "\r";
        $devu .= '</select>' . "\r";
        $devu .= '</div>' . "\r";
        $devu .= '</div>' . "\r";
        $devu .= '</div>' . "\r";
        $devu .= "\r\r";
        echo $devu;
        $devu1 .= '<!-- Select Option -->' . "\r";
        $devu1 .= '<!-- Para archivo edit.php -->' . "\r";
        $devu1 .= "<div class='row text-center'>" . "\r";
        $devu1 .= "<div class='col-md-12'>" . "\r";
        $devu1 .= "<div class='input-group input-group mb-2'>" . "\r";
        $devu1 .= "<span class='input-group-text' id='inputGroup-sizing-sm'><i title='Stock' class='bi bi-record-fill color3'></i></span>" . "\r";
        $devu1 .= '<!-- Cambiar el Atributo name por el campo que se desee que se guarde -->' . "\r";
        $devu1 .= "<select class='form-select letra-normal' id='selector2' name='area_u'>" . "\r";
        $devu1 .= '</select>' . "\r";
        $devu1 .= '</div>' . "\r";
        $devu1 .= '</div>' . "\r";
        $devu1 .= '</div>' . "\r";
        $devu1 .= "\r\r";
        echo $devu1;
        $devu2 .= '<!-- Select Option -->' . "\r";
        $devu2 .= '<!-- Para archivo delete.php -->' . "\r";
        $devu2 .= "<div class='row text-center'>" . "\r";
        $devu2 .= "<div class='col-md-12'>" . "\r";
        $devu2 .= "<div class='input-group input-group mb-2'>" . "\r";
        $devu2 .= "<span class='input-group-text' id='inputGroup-sizing-sm'><i title='Stock' class='bi bi-record-fill color2'></i></span>" . "\r";
        $devu2 .= '<!-- Cambiar el Atributo name por el campo que se desee que se guarde -->' . "\r";
        $devu2 .= "<select class='form-select letra-normal' id='selector3' name='area_d'>" . "\r";
        $devu2 .= '</select>' . "\r";
        $devu2 .= '</div>' . "\r";
        $devu2 .= '</div>' . "\r";
        $devu2 .= '</div>' . "\r";
        $devu2 .= "\r\r";
        echo $devu2;
    }
    //----- Rutina Cambios a Realizar -----//
    if ($_POST['radio'] == 'radio9') {
        $devu = '';
        $devu .= '// Cambios a Realizar antes de usar el Proyecto' . "\r\r";
        $devu .= '// 1) Archivo conexion.php' . "\r";
        $devu .= '// en la linea Nº 7 cambiar la contraseña del Servidor' . "\r\r";
        $devu .= '// 2) En el archivo de CRUD o sea el que tiene el nombre de la tabla .php' . "\r";
        $devu .= '// En la linea Nº 18 y 119 en el WHERE y en el ORDER BY cambiar el campo id por el campo que desee usar para la busqueda' . "\r";
        $devu .= '// En la linea Nº 46 y 47 campo id por el campo que desee usar como filtro' . "\r\r";
        $devu .= '// 3) Select Option' . "\r";
        $devu .= '// En el archivo de add.php y edit.php' . "\r";
        $devu .= '// Copiar el codigo generado, en el campo que se quiere que valla un select option cambiar' . "\r";
        $devu .= '// el Atributo name por el campo que se desee que se guarde ya sea con _i, _u' . "\r";
        $devu .= '// En el archivo de CRUD en la linea 138 cambiar la tabla y los campos considiendo con modificado en la linea anterior' . "\r";
        $devu .= '// En el archivo JavaScript .js en la linea Nº 135 activar la propiedad disabled de Selec3 ' . "\r\r";
        $devu .= '// 4) En el archivo search.php a partir de linea Nº 27' . "\r";
        $devu .= '// Se puede agregar los campos que se desee para la tabla de busqueda' . "\r";
        $devu .= '// y en el archivo JavaScript .js cambiar el nombre de los campos o agregar nuevos' . "\r";
        $devu .= "\r";
        echo $devu;
    }
} else {
    echo 'No se ha creado el proyecto';
}
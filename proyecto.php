<?php

$raiz0 = $_SERVER['DOCUMENT_ROOT'];
$proyecto = $_POST['proyecto'];
$base = $_POST['base'];
$tabla = $_POST['tabla'];
$pass = $_POST['pass'];
$proyecto0 = $raiz0 . '/' . $proyecto;

$temporal = fopen("tmp.txt", "w");

fwrite($temporal, $proyecto0.'-');
fwrite($temporal, $proyecto.'-');
fwrite($temporal, $base.'-');
fwrite($temporal, $pass);
fflush($temporal);
fclose($temporal);

// setcookie("proyec", $proyecto);
// setcookie("base", $base);
// setcookie("galleta", $proyecto0);

function recursiveCopy($source, $destination)
{
    if (!file_exists($destination)) {
        mkdir($destination);
    }
    $splFileInfoArr = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($splFileInfoArr as $fullPath => $splFileinfo) {
        if (in_array($splFileinfo->getBasename(), [".", ".."])) {
            continue;
        }
        $path = str_replace($source, "", $splFileinfo->getPathname());
        if ($splFileinfo->isDir()) {
            mkdir($destination . "/" . $path);
        } else {
            copy($fullPath, $destination . "/" . $path);
        }
    }
}

if (!file_exists($proyecto0)) {
    mkdir($proyecto0, 0777, true);
    recursiveCopy(__DIR__ . "/assets", $proyecto0 . '/assets');

    // Genero archivo de conexion
    $devu = '';
    $devu .= "// CONEXION // \r";
    $devu .= "// Nombre del archivo ( conexion.php ) \r";
    $devu .= "// Archivo de Conexion a la Base " . ucfirst($base) . " \r";
    $devu .= "define('DB_SERVER', 'localhost');\r";
    $devu .= "define('DB_USERNAME', 'root');\r";
    $devu .= "define('DB_PASSWORD', '" . $pass . "');\r";
    $devu .= "define('DB_NAME', '" . strtolower($base) . "');\r";
    $devu .= "try{\r";
    $devu .= '$conexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);' . "\r";
    $devu .= '$conexion->exec("set names utf8");' . "\r";
    $devu .= '$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);' . "\r";
    $devu .= '} catch(PDOException $e){' . "\r";
    $devu .= 'die("ERROR: No se pudo conectar. " . $e->getMessage());' . "\r";
    $devu .= "}" . "\r";
    $archivo = fopen($proyecto0 . "/conexion.php", "w+b");
    fwrite($archivo, '<?php' . "\r");
    fwrite($archivo, $devu);
    fwrite($archivo, '?>' . "\r");
    fflush($archivo);
    fclose($archivo);

    // Genero archivo de head
    $devu1 = '';
    $devu1 .= '<head>' . "\r";
    $devu1 .= '<meta charset="UTF-8">' . "\r";
    $devu1 .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">' . "\r";
    $devu1 .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\r";
    $devu1 .= '<!-- Metas para Limpiar el Cache del Navegador -->' . "\r";
    $devu1 .= '<meta http-equiv="cache-control" content="no-cache" />' . "\r";
    $devu1 .= '<meta http-equiv="Pragma" content="no-cache" />' . "\r";
    $devu1 .= '<meta http-equiv="Expires" content="-1" />' . "\r";
    $devu1 .= '<!-- Incluir Bootstrap v5.1.3 -->' . "\r";
    $devu1 .= '<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />' . "\r";
    $devu1 .= '<link href="../assets/css/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />' . "\r";
    $devu1 .= '<!-- Incluir Font Awesome -->' . "\r";
    $devu1 .= '<link href="../assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />' . "\r";
    $devu1 .= '<!-- Incluir Iconos de Bootstrap -->' . "\r";
    $devu1 .= '<link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">' . "\r";
    $devu1 .= '<!-- Incluir Estilos Personalizados -->' . "\r";
    $devu1 .= '<link rel="stylesheet" href="../assets/css/style.css" type="text/css" />' . "\r";
    $devu1 .= '<!-- Titulo de la Pagina -->' . "\r";
    $devu1 .= '<title>Herramientas de Desarrollo</title>' . "\r";
    $devu1 .= '</head>' . "\r";
    $archivo1 = fopen($proyecto0 . "/head.php", "w+b");

    fwrite($archivo1, $devu1);

    fflush($archivo1);
    fclose($archivo1);

    // Genero archivo de footer
    $devu2 = '';
    $devu2 .= '<script src="../assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>' . "\r";
    $devu2 .= '<script src="../assets/js/popper.min.js" type="text/javascript"></script>' . "\r";
    $devu2 .= '<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>' . "\r";
    $devu2 .= '<script src="../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>' . "\r";
    $devu2 .= '<script src="../assets/js/funciones1.js"></script>' . "\r";
    $archivo2 = fopen($proyecto0 . "/footer.php", "w+b");

    fwrite($archivo2, $devu2);

    fflush($archivo2);
    fclose($archivo2);

    echo 'Proyecto creado con exito!.' . "\r";
    echo 'http://localhost/' . $proyecto;
} else {
    echo 'Ya existe el Proyecto!';
}

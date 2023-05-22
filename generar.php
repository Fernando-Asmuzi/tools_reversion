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
    //----- Archivo Index -----//
    //if ($_POST['radio'] == 'radio1') {
        $devu .= '';
        $devu .= "<!-- INDEX --> \r";
        $devu .= "<!-- Nombre del archivo ( index.php ) -->\r";
        $devu .= "<!-- Archivo index.php para la carpeta " . strtolower($tabla) . " -->\r";
        $devu .= "
        <!DOCTYPE html>
        <html lang='es'>
        <?php include '../head.php'; ?>
            <body>
                <div style='display: block;' id='agregar'>
                    <?php include 'add.php'; ?>
                </div>
                <div style='display: none;' id='modificar'>
                    <?php include 'edit.php'; ?>
                </div>
                <div style='display: none;' id='eliminar'>
                    <?php include 'delete.php'; ?>
                </div>
                <div style='display: block;' id='buscar1'>
                    <?php include 'search.php'; ?>
                </div>
                <!-- ----- Rutina de Tostada de Avisos ----- -->
                <!-- Cartel de Anuncios Verde, Azul o Rojo -->
                <div class='position-fixed bottom-0 end-0 p-3' style='z-index: 11'>
                    <div id='toast' class='toast' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='5000'>
                        <div class='toast-header fondo9 color5' id='toas0'>
                            <i class='bi bi-exclamation-circle'></i>&nbsp;
                            <strong class='me-auto' id='toas1'>-</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
                        </div>
                        <div class='toast-body color5' id='toas2'>-</div>
                    </div>
                </div>
                    <?php include '../footer.php'; ?>
                    <script src='" . strtolower($tabla) . ".js' type='text/javascript' ></script>
            </body>
        </html>\r";
        $archivo = fopen($carpeta . "/index.php", "w+b");
        fwrite($archivo, $devu);
        fflush($archivo);
        fclose($archivo);
        // Muestro el codigo
        echo $devu;
    //}
    //----- Archivo para Insert -----//
    //if ($_POST['radio'] == 'radio2') {
        $devu = '';
        $devu .= "<!-- INSERT --> \r";
        $devu .= "<!-- Nombre del archivo ( add.php ) -->\r";
        $devu .= "<!-- Rutina de alta de la tabla " . ucfirst($tabla) . " -->\r";
        $devu .= "<!-- Comienzo del Card -->\r";
        $devu .=
        "<div class='card pt-2 pb-2 ps-2 pe-2 paracard shadow-sm fondo4' id='agregar'>
            <div class='row text-center'>
                <div class='col-12'>
                    <span class='input-group-text letra-normal negrita alto1 mb-2 text-white boton1' id='inputGroup-sizing-sm'><i class='bi bi-record-circle'></i>&nbsp;ALTA DE " . strtoupper($tabla) . "</span>
                </div>
            </div> \r\r";
            $devu .= "<!-- Comienzo del formulario para insert tabla " . ucfirst($tabla) . " -->\r";
            $devu .= "<form method='POST' id='" . strtolower($tabla) . "_i' action='" . strtolower($tabla) . ".php'>\r\r";
            // For que Arma los Input del Formulario
            for ($counter = 0; $counter < $campos; $counter++) {
                $row = $resultado->fetch(PDO::FETCH_ASSOC);
                $devu .= "<!-- Input de " . $row['columna'] . " -->\r";
                $devu .= "<div class='row text-center'>\r";
                $devu .= "<div class='col-md-12'>\r";
                $devu .= "<div class='input-group input-group mb-2'>\r";
                $devu .= "<span class='input-group-text' id='inputGroup-sizing-sm'><i title='" . ucwords($row['columna']) . "' class='bi bi-record-fill color10'></i></span>\r";
                if ($row['tipo'] == 'int') {
                        $devu .= "<input type='number' id='" . $row['columna'] . "_i' name ='" . $row['columna'] . "_i' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "' value='' />\r";
                }elseif ($row['tipo'] == 'varchar') {
                        $devu .= "<input type='text' id='" . $row['columna'] . "_i' name ='" . $row['columna'] . "_i' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "' value='' />\r";
                }elseif ($row['tipo'] == 'decimal') {
                        $devu .= "<input type='number' step='0.50' id='" . $row['columna'] . "_i' name ='" . $row['columna'] . "_i' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "_i' value='' />\r";
                }elseif ($row['tipo'] == 'date') {
                        $devu .= "<input type='date' id='" . $row['columna'] . "_i' name ='" . $row['columna'] . "_i' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "' value='' />\r";
                }elseif ($row['tipo'] == 'datetime') {
                        $devu .= "<input type='datetime' id='" . $row['columna'] . "_i' name ='" . $row['columna'] . "_i' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "' value='' />\r";
                }elseif ($row['tipo'] == 'text') {
                        $devu .= "<textarea id='" . $row['columna'] . "_i' name ='" . $row['columna'] . "_i' class='form-control letra-normal' placeholder='Escriba aqui...' value='' ></textarea>\r";
                }elseif ($row['tipo'] == 'tinyint') {
                        $devu .= "<input type='checkbox' id='" . $row['columna'] . "_i' name ='" . $row['columna'] . "_i' value='0'/> " . ucwords($row['columna']) . "\r";
                }
                    $devu .= "</div>\r";
                    $devu .= "</div>\r";
                    $devu .= "</div>\r";
            }
            $devu .= "\r";
            $devu .=
                "<!-- Input Hidden Requerimiento para Insert -->
            <input type='hidden' id='requerimiento' name ='requerimiento' value='insert'/>\r\r";
            $devu .=
                "<!-- Linea divisora entre ingresos y botones -->
            <div class='row text-center'>
                <div class='col-md-12'>
                    <hr>
                </div>
            </div>\r\r";
            $devu .=
                "<!-- Boton Guardar -->
            <div class='row'>
                <div class='col-12 derecha'>
                    <button type='submit' id='guardar_i' class='btn boton1 color7 letra-normal'><i class='bi bi-plus-circle'></i>&nbsp;Guardar</button>
                </div>
            </div>
            </form>
            <!-- Fin del Formulario -->
            <!-- Fin del Card -->
        </div>\r";
        $archivo = fopen($carpeta . "/add.php", "w+b");
        fwrite($archivo, $devu);
        fflush($archivo);
        fclose($archivo);
     // Muestro el codigo
        echo $devu;
    //}
    //----- Archivo para Edit -----//
    //if ($_POST['radio'] == 'radio3') {
        $devu = '';
        $devu .= "<!-- EDIT --> \r";
        $devu .= "<!-- Nombre del archivo ( edit.php ) -->\r";
        $devu .= "<!-- Rutina de modificacion de la tabla " . ucfirst($tabla) . " -->\r";
        $devu .= "<!-- Comienzo del Card -->\r";
        $devu .= 
    "<div class='card pt-2 pb-2 ps-2 pe-2 paracard shadow-sm fondo4' id='modificar'>
        <div class='row text-center'>
            <div class='col-12'>
                <span class='input-group-text letra-normal negrita alto1 mb-2 text-white boton3' id='inputGroup-sizing-sm'><i class='bi bi-record-circle'></i>&nbsp;MODIFICACION DE " . strtoupper($tabla) . "</span>
            </div>
        </div>
        <!-- Comienzo del Formulario para Update " . ucfirst($tabla) . " -->
        <form method='POST' id='" . strtolower($tabla) . "_u' action='" . strtolower($tabla) . ".php'>\r\r";
            // For que Arma los Input del Formulario
            for ($counter = 0; $counter < $campos; $counter++) {
                $row = $resultado->fetch(PDO::FETCH_ASSOC);
                $devu .= "<!-- Input de " . $row['columna'] . " -->\r";
                $devu .= "<div class='row text-center'>\r";
                $devu .= "<div class='col-md-12'>\r";
                $devu .= "<div class='input-group input-group mb-2'>\r";
                $devu .= "<span class='input-group-text' id='inputGroup-sizing-sm'><i title='" . ucwords($row['columna']) . "' class='bi bi-record-fill color3'></i></span>\r";
                if ($row['tipo'] == 'int') {
                    $devu .= "<input type='number' id='" . $row['columna'] . "_u' name ='" . $row['columna'] . "_u' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "' value='' />\r";
                } elseif ($row['tipo'] == 'varchar') {
                    $devu .= "<input type='text' id='" . $row['columna'] . "_u' name ='" . $row['columna'] . "_u' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "' value='' />\r";
                } elseif ($row['tipo'] == 'decimal') {
                    $devu .= "<input type='number' step='0.50' id='" . $row['columna'] . "_u' name ='" . $row['columna'] . "_u' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "' value='' />\r";
                } elseif ($row['tipo'] == 'date') {
                    $devu .= "<input type='date' id='" . $row['columna'] . "_u' name ='" . $row['columna'] . "_u' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "' value='' />\r";
                } elseif ($row['tipo'] == 'datetime') {
                    $devu .= "<input type='datetime' id='" . $row['columna'] . "_u' name ='" . $row['columna'] . "_u' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "' value='' />\r";
                } elseif ($row['tipo'] == 'text') {
                    $devu .= "<textarea id='" . $row['columna'] . "_u' name ='" . $row['columna'] . "_u' class='form-control letra-normal' placeholder='Escriba aqui..." . "' value='' ></textarea>\r";
                } elseif ($row['tipo'] == 'tinyint') {
                    $devu .= "<input type='checkbox' id='" . $row['columna'] . "_u' name ='" . $row['columna'] . "_u' class='form-control letra-normal' value=''/>" . "<label for='" . $row['columna'] . "_u'>Texto del checkbox</label>\r";
                }
                $devu .= "</div>\r";
                $devu .= "</div>\r";
                $devu .= "</div>\r";
            }
            $devu .= "\r";
            $devu .=
            "<!-- Input Hidden Requerimiento para Update -->
            <input type='hidden' id='requerimiento' name ='requerimiento' value='update'/>\r\r";
            $devu .=
            "<!-- Linea divisora entre ingresos y botones -->
            <div class='row text-center'>
                <div class='col-md-12'>
                    <hr>
                </div>
            </div>\r\r";
            $devu .=
            "<!-- Boton Modificar -->
            <div class='row'>
                <div class='col-12 derecha'>
                    <button type='reset' id='cancelar_u' class='btn btn-secondary letra-normal'><i class='bi bi-x-circle'></i> Cancelar</button>
                    <button type='submit' id='guardar_u' class='btn boton3 color7 letra-normal'><i class='bi bi-pencil-square'></i> Modificar</button>
                </div>
            </div>
        </form>
        <!-- Fin del Formulario " . ucfirst($tabla) . " -->
        <!-- Fin del Card -->
    </div>\r";
        $archivo = fopen($carpeta . "/edit.php", "w+b");
        fwrite($archivo, $devu);
        fflush($archivo);
        fclose($archivo);
        // Muestro el codigo
        echo $devu;
    //}
    //----- Archivo para Delete -----//
    //if ($_POST['radio'] == 'radio4') {
        $devu = '';
        $devu .= "<!-- DELETE --> \r";
        $devu .= "<!-- Nombre del archivo ( delete.php ) -->\r";
        $devu .= "<!-- Rutina de borrar de la tabla " . ucfirst($tabla) . " -->\r";
        $devu .= "<!-- Comienzo del Card -->\r";
        $devu .= "<div class='card pt-2 pb-2 ps-2 pe-2 paracard shadow-sm fondo4' id='eliminar'>\r";
        $devu .= "
    <div class='row text-center'>
        <div class='col-12'>
            <span class='input-group-text letra-normal negrita alto1 mb-2 text-white boton2' id='inputGroup-sizing-sm'><i class='bi bi-record-circle'></i>&nbsp;ELIMINAR " . strtoupper($tabla) . "</span>
        </div>
    </div>\r";
        $devu .= "
    <!-- Comienzo del Formulario para Delete " . ucfirst($tabla) . " -->
    <form method='POST' id='" . strtolower($tabla) . "_d' action='" . strtolower($tabla) . ".php'>\r\r";
        // For que Arma los Input del Formulario
        for ($counter = 0; $counter < $campos; $counter++) {
            $row = $resultado->fetch(PDO::FETCH_ASSOC);
            $devu .= "<!-- Input de " . $row['columna'] . " -->\r";
            $devu .= "<div class='row text-center'>\r";
            $devu .= "<div class='col-md-12'>\r";
            $devu .= "<div class='input-group input-group mb-2'>\r";
            $devu .= "<span class='input-group-text' id='inputGroup-sizing-sm'><i title='" . ucwords($row['columna']) . "' class='bi bi-record-fill color2'></i></span>\r";
            if ($row['tipo'] == 'int') {
                $devu .= "<input type='number' id='" . $row['columna'] . "_d' name ='" . $row['columna'] . "_d' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "' value='' />\r";
            } elseif ($row['tipo'] == 'varchar') {
                $devu .= "<input type='text' id='" . $row['columna'] . "_d' name ='" . $row['columna'] . "_d' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "' value='' />\r";
            } elseif ($row['tipo'] == 'decimal') {
                $devu .= "<input type='number' step='0.50' id='" . $row['columna'] . "_d' name ='" . $row['columna'] . "_d' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "' value='' />\r";
            } elseif ($row['tipo'] == 'date') {
                $devu .= "<input type='date' id='" . $row['columna'] . "_d' name ='" . $row['columna'] . "_d' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "' value='' />\r";
            } elseif ($row['tipo'] == 'datetime') {
                $devu .= "<input type='datetime' id='" . $row['columna'] . "_d' name ='" . $row['columna'] . "_d' class='form-control letra-normal' placeholder='" . ucwords($row['columna']) . "' value='' />\r";
            } elseif ($row['tipo'] == 'text') {
                $devu .= "<textarea id='" . $row['columna'] . "_d' name ='" . $row['columna'] . "_d' class='form-control letra-normal' placeholder='Escriba aqui..." . "' value='' ></textarea>\r";
            } elseif ($row['tipo'] == 'tinyint') {
                $devu .= "<input type='checkbox' id='" . $row['columna'] . "_d' name ='" . $row['columna'] . "_d' class='form-control letra-normal' value=''/>" . "<label for='" . $row['columna'] . "_u'>Texto del checkbox</label>\r";
            }
            $devu .= "</div>\r";
            $devu .= "</div>\r";
            $devu .= "</div>\r";
        }
        $devu .= "\r";
        $devu .=
        "<!-- Input Hidden Requerimiento para Delete -->
        <input type='hidden' id='requerimiento' name ='requerimiento' value='delete'/>\r\r";
        $devu .=
        "<!-- Linea divisora entre ingresos y botones -->
        <div class='row text-center'>
            <div class='col-md-12'>
                <hr>
            </div>
        </div>\r\r";
        $devu .=
        "<!-- Boton Eliminar -->
        <div class='row'>
            <div class='col-12 derecha'>
                <button  type='reset' id='cancelar_d' class='btn btn-secondary letra-normal'><i class='bi bi-x-circle'></i> Cancelar</button>
                <button type='submit' id='guardar_d' class='btn boton2 color7 letra-normal'><i class='bi bi-trash'></i> Eliminar</button>
            </div>
        </div>
    </form>
    <!-- Fin del Formulario " . ucfirst($tabla) . " -->
    <!-- Fin del Card -->
    </div>\r";
        $archivo = fopen($carpeta . "/delete.php", "w+b");
        fwrite($archivo, $devu);
        fflush($archivo);
        fclose($archivo);
        // Muestro el codigo
        echo $devu;
    //}
    //----- Archivo para Search -----//
    //if ($_POST['radio'] == 'radio5') {
        $devu = '';
        $devu .= "<!-- SEARCH --> \r";
        $devu .= "<!-- Nombre del archivo ( search.php ) -->\r";
        $devu .= "<!-- Rutina de buscar de la tabla " . ucfirst($tabla) . " -->\r";
        $devu .= "<!-- Comienzo del Card del DataTable -->\r";
        $devu .= 
    "<div class='card pt-2 pb-2 ps-2 pe-2 paracard shadow-sm fondo4' id='search'>\r\r";
        $devu .=
            "<!-- Titulo Data Table-->
        <div class='row text-center'>
            <div class='col-sm-7 col-md-9'>
                <span class='input-group-text letra-normal negrita w-100 alto1 mb-2 fondo7' style='float: left;' id='inputGroup-sizing-sm'><i class='bi bi-search'></i>&nbsp;BUSCAR REGISTROS</span>
            </div>
            <div class='col-sm-5 mb-2 col-md-3'>
                <form class='d-flex w-100' method='POST' id='formbuscar' action='" . strtolower($tabla) . ".php' style='float: right;' >
                    <input class='form-control me-2 alto1' type='search' id='buscar' name='buscar' placeholder='Ingrese su busqueda...' aria-label='Buscar'>
                    <!-- Input Hidden requerimiento -->
                    <input type='hidden' id='requerimiento' name ='requerimiento' value='select'/>
                </form>
            </div>
        </div>
        <!-- Comienzo de la Grid Datatable -->
        <table class='table table-bordered table-hover table-condensed letra-normal' id='" . strtolower($tabla) . "'>
            <thead>
                <tr class='fondo5 color1'>
                    <th scope='col' class='ancho5'>#</th>
                    <th scope='col' class='ancho15'>Codigo</th>
                    <th scope='col' class='ancho50'>Nombre</th>
                    <th scope='col' class='ancho20'>Stock</th>
                    <th scope='col' class='ancho5'></th>
                    <th scope='col' class='ancho5'></th>
                </tr>
            </thead>
            <tbody id='contenido'>
                <!-- Aqui va el contenido de la Tabla -->
            </tbody>
        </table>
        <!-- Fin de la Tabla Data Table -->
        <!-- Cartel de Anuncios ó Spinner -->
        <div class='color8 negrita letra-media' id='cartelito' style='display: block;'>Ingrese su busqueda...</div>
        <div class='color9 negrita letra-media' id='alerta' style='display: none;'></div>
        <!-- Fin del Card del Data Table-->
    </div>\r";
        $archivo = fopen($carpeta . "/search.php", "w+b");
        fwrite($archivo, $devu);
        fflush($archivo);
        fclose($archivo);
        // Muestro el codigo
        echo $devu;
    //} 
    //----- Archivo para CRUD -----//
    //if ($_POST['radio'] == 'radio6') {
        $devu = '';
        $devu .= "// CRUD // \r";
        $devu .= "// Nombre del archivo ( " . strtolower($tabla) . ".php ) \r";
        $devu .= "// Rutina de CRUD y Select para Buscar y Select Option \r\r";
        $devu .= "include '../conexion.php';\r";
        $devu .= '$requerimiento = $_POST["requerimiento"];' . "\r\r";
        $devu .= "// -------------------------------------------------------------------------------- //\r";
        $devu .= "// Codigo que Genera la Rutina para Select para Buscar y cargar la tablita\r";
        $devu .= 'if($requerimiento == "select"){' . "\r";
        $devu .= '$registros = 0;' . "\r";
        $devu .= '$buscar = $_POST["buscar"];' . "\r";
        $devu .= '// Consulta y ordenado por campo clave' . "\r";
        $devu .= '// ********** IMPORTANTE ********** //' . "\r";
        $devu .= "// Aqui se pone el campo ID, pero se debe colocar cualquiera para su busqueda. \r";
        $devu .= "// Por ejemplo, Nº documento, Nombre, Codigo etc. \r";
        $devu .= '$consulta = "SELECT * FROM ' . strtolower($tabla) . " WHERE id LIKE '$" . "buscar%' " . 'ORDER BY id LIMIT 10";' . "\r";
        $devu .= '$resultado = $conexion->query($consulta);' . "\r";
        $devu .= '$registros = $resultado->rowCount();' . "\r";
        $devu .= '$resultado->execute();' . "\r";
        $devu .= 'if($registros != 0){' . "\r";
        $devu .= '$resul_array = [];' . "\r";
        $devu .= 'while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {' . "\r";
        $devu .= 'array_push($resul_array, $row);' . "\r";
        $devu .= '}' . "\r";
        $devu .= 'echo json_encode($resul_array);' . "\r";
        $devu .= 'exit();' . "\r";
        $devu .= '}else{' . "\r";
        $devu .= 'echo $registros;' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}' . "\r\r";
        $devu .= "// -------------------------------------------------------------------------------- //\r";
        $devu .= "// Codigo que Genera la Rutina para Insert \r";
        $devu .= 'if($requerimiento == "insert"){' . "\r";
        $devu .= '$input = $_POST;' . "\r";
        $devu .= '// Elimina del POST' . "\r";
        $devu .= 'unset($input["requerimiento"]);' . "\r";
        $devu .= '// Habilitar el unset de abajo cuando se cambie el campo clave' . "\r";
        $devu .= 'unset($input["id_i"]);' . "\r";
        $devu .= '// Rutina que busca repetidos antes del insert' . "\r";
        $devu .= '// Nuevamente se coloca el id pero se debe cambiar por cualquier otro' . "\r";
        $devu .= "// Por ejemplo, Nº documento, Nombre, Codigo etc. \r";
        $devu .= '// Seleccionar campo clave' . "\r";
        $devu .= '$id_i = $_POST["id_i"];' . "\r";
        $devu .= '$consulta = "SELECT * FROM ' . strtolower($tabla) . " WHERE id = '$" . "id_i'" . '";' . "\r";
        $devu .= '$resultado = $conexion->query($consulta);' . "\r";
        $devu .= '$registros = $resultado->rowCount();' . "\r";
        $devu .= '$resultado->execute();' . "\r";
        $devu .= '// Fin de Rutina que busca repetidos antes del insert' . "\r";
        $devu .= 'if($registros == 0){' . "\r";
        $campos1 = '';
        $valores1 = '';
        $actualizar = '';
        for ($counter = 0; $counter < $campos; $counter++) {
            $row = $resultado->fetch(PDO::FETCH_ASSOC);
            // Preparo Condicion para el Where
            if ($counter == 0) {
                $condicion_id = $row['columna'] . ' = :' . $row['columna'] . '_u';
            }
            // Preparo Campos para Insert
            if ($counter != 0) {
                $campos1 = $campos1 . $row['columna'] . ',';
                $valores1 = $valores1 . ':' . $row['columna'] . '_i,';
            }
            // Preparo Campos para Update
            if ($counter != 0) {
                $actualizar = $actualizar . $row['columna'] . ' = :' . $row['columna'] . '_u,';
            }
        }
        $devu .= "$" . "sql = 'INSERT INTO " . strtolower($tabla) . " (" . substr($campos1, 0, -1) . ") VALUES (" . substr($valores1, 0, -1) . ")';" . "\r";
        $devu .= '$statement = $conexion->prepare($sql);' . "\r";
        $devu .= 'if($statement->execute($input)){' . "\r";
        $devu .= '$id = $conexion->lastInsertId();' . "\r";
        $devu .= '// Consulta de Todos los Campos para crear el JSon' . "\r";
        $devu .= '$consulta = "SELECT * FROM ' . strtolower($tabla) . " WHERE id = '$" . "id' limit 1" . '";' . "\r";
        $devu .= '$resultado = $conexion->query($consulta);' . "\r";
        $devu .= '$resultado->execute();' . "\r";
        $devu .= '$resul_array = [];' . "\r";
        $devu .= 'while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {' . "\r";
        $devu .= 'array_push($resul_array, $row);' . "\r";
        $devu .= 'echo json_encode($resul_array);' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}else{' . "\r";
        $devu .= 'echo "NO1";' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}else{' . "\r";
        $devu .= 'echo "NO2";' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}' . "\r\r";
        $devu .= '// -------------------------------------------------------------------------------- //' . "\r";
        $devu .= '// Codigo que Genera la Rutina para Update' . "\r";
        $devu .= 'if($requerimiento == "update"){' . "\r";
        $devu .= '$input = $_POST;' . "\r";
        $devu .= 'if(isset($_POST["id_u"])){' . "\r";
        $devu .= '$id_u = $_POST["id_u"];' . "\r";
        $devu .= '}' . "\r";
        $devu .= '// Elimina del POST' . "\r";
        $devu .= 'unset($input["requerimiento"]);' . "\r";
        $devu .= "$" . "sql = 'UPDATE " . strtolower($tabla) . " SET " . substr($actualizar, 0, -1) . " WHERE " . $condicion_id . "';" . "\r";
        $devu .= '$statement = $conexion->prepare($sql);' . "\r";
        $devu .= 'if($statement->execute($input)){' . "\r";
        $devu .= '// Consulta de todos los campos y Nº de documento' . "\r";
        $devu .= '$consulta = "SELECT * FROM ' . strtolower($tabla) . " WHERE id = '$" . "id_u' limit 1" . '";' . "\r";
        $devu .= '$resultado = $conexion->query($consulta);' . "\r";
        $devu .= '$registros = $resultado->rowCount();' . "\r";
        $devu .= '$resultado->execute();' . "\r";
        $devu .= '$resul_array = [];' . "\r";
        $devu .= 'while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {' . "\r";
        $devu .= 'array_push($resul_array, $row);' . "\r";
        $devu .= 'echo json_encode($resul_array);' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}else{' . "\r";
        $devu .= 'echo "NO1";' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}' . "\r";
        $devu .= '// -------------------------------------------------------------------------------- //' . "\r";
        $devu .= '// Codigo que Genera la Rutina para Delete' . "\r";
        $devu .= 'if($requerimiento == "delete"){' . "\r";
        $devu .= '$input = $_POST;' . "\r";
        $devu .= 'if(isset($_POST[' . "'id_d'" . '])){' . "\r";
        $devu .= '$id_d = $_POST[' . "'id_d'" . '];' . "\r";
        $devu .= '// Elegir el campo clave para la busqueda' . "\r";
        $devu .= '// Nuevamente se coloca el id pero se debe cambiar por cualquier otro' . "\r";
        $devu .= "// Por ejemplo, Nº documento, Nombre, Codigo etc. \r";
        $devu .= '//$id_d = substr($_POST[' . "'id_d'" . '], 0, 1); ' . "\r";
        $devu .= '}' . "\r";
        $devu .= '// Elimina del POST' . "\r";
        $devu .= 'unset($input["requerimiento"]);' . "\r";
        $devu .= '$sql = "DELETE FROM ' . strtolower($tabla) . " WHERE id = '$" . "id_d'" . '";' . "\r";
        $devu .= '$statement = $conexion->prepare($sql);' . "\r";
        $devu .= 'if($statement->execute()){' . "\r";
        $devu .= '// Consulta de todos los campos' . "\r";
        $devu .= '// Nuevamente se coloca el id pero se debe cambiar por cualquier otro' . "\r";
        $devu .= "// Por ejemplo, Nº documento, Nombre, Codigo etc. \r";
        $devu .= '$consulta = "SELECT * FROM ' . strtolower($tabla) . ' WHERE id LIKE ' . "'$" . "id_d%' limit 10" . '";' . "\r";
        $devu .= '$resultado = $conexion->query($consulta);' . "\r";
        $devu .= '$registros = $resultado->rowCount();' . "\r";
        $devu .= '$resultado->execute();' . "\r";
        $devu .= '$resul_array = [];' . "\r";
        $devu .= 'while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {' . "\r";
        $devu .= 'array_push($resul_array, $row);' . "\r";
        $devu .= '}' . "\r";
        $devu .= 'echo json_encode($resul_array);  ' . "\r";
        $devu .= '}else{' . "\r";
        $devu .= 'echo "NO";' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}' . "\r\r";
        $devu .= '// -------------------------------------------------------------------------------- //' . "\r";
        $devu .= '// Codigo que Genera la Rutina para Select Option' . "\r";
        $devu .= 'if($requerimiento == "option"){' . "\r";
        $devu .= '$tabla_option = $_POST[' . "'tabla_option'" . '];' . "\r";
        $devu .= '$campo_option = $_POST[' . "'campo_option'" . '];' . "\r";
        $devu .= '// Consulta del campo especifico para armar el select option' . "\r";
        $devu .= '// El ejemplo esta echo con la tabla area pero se puede cambiar por cualquier otra' . "\r";
        $devu .= '$consulta = "SELECT DISTINCT(id), "' . '.$campo_option.' . '" FROM "' . '.$tabla_option.' . '" ORDER BY "' . '.$campo_option' . ';' . "\r";
        // $devu .= '$consulta = "SELECT DISTINCT(id), .'.$campo_option.'. FROM .'.$tabla_option.'. ORDER BY .'.$campo_option.'";' . "\r";
        $devu .= '$resultado = $conexion->query($consulta);' . "\r";
        $devu .= '$registros = $resultado->rowCount();' . "\r";
        $devu .= '$resultado->execute();' . "\r";
        $devu .= 'if($registros > 0){' . "\r";
        $devu .= 'echo ' . "'<option value=" . '"0">' . "</option>';" . "\r";
        $devu .= 'while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {' . "\r";
        $devu .= 'echo ' . "'<option value=" . '"' . "'" . '.$' . 'row["id"]' . ".'" . '">' . "'" . '.$' . 'row[' . '$campo_option' . '].' . "'</option>'" . ";\r";
        $devu .= '}' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}' . "\r";
        $archivo = fopen($carpeta . "/" . strtolower($tabla) . ".php", "w+b");
        fwrite($archivo, '<?php' . "\r");
        fwrite($archivo, $devu);
        fwrite($archivo, '?>' . "\r");
        fflush($archivo);
        fclose($archivo);
        // Muestro el codigo
        echo $devu;
    //} 
    //----- Rutina JavaScript -----//
    //if ($_POST['radio'] == 'radio9') {
        $devu = '';
        $devu .= '// -------------------- Rutinas Codigo JavaScript -------------------- //' . "\r";
        $devu .= '// -------------------- Funcion Tablita -------------------- //' . "\r";
        $devu .= '// Carga en una tabla los resultado y agrega botones editar y eliminar' . "\r";
        $devu .= 'function tablita(data){' . "\r";
        $devu .= 'var peticion = JSON.parse(data);' . "\r";
        $devu .= "var ta = '';" . "\r";
        $devu .= '// Arma la Tabla de Resultado de la Busqueda' . "\r";
        $devu .= 'for (x of peticion) {' . "\r";
        $devu .= 'var elec1 = ' . "'<td align=" . '"center"><a class="edit-reg" title="Modificar" ' . 'id="u' . "'" . '+x.id+' . "'" . '"><i class="bi bi-pencil-square text-success"></i></a> </td>' . "'\r";
        $devu .= 'var elec2 = ' . "'<td align=" . '"center"><a class="delete-reg" title="Eliminar" ' . 'id="d' . "'" . '+x.id+' . "'" . '"><i class="bi bi-trash text-danger"></i></a> </td>' . "'\r";
        $array_campos = [];
        for ($counter = 0; $counter < $campos; $counter++) {
            $row = $resultado->fetch(PDO::FETCH_ASSOC);
            array_push($array_campos, $row['columna']);
        } 
        $devu .= "var ta = ta + '<tr><td>'+x." . $array_campos[0] . "+'</td><td>'+x." . $array_campos[1] . "+'</td><td>'+x." . $array_campos[2] . "+'</td><td>'+x." . $array_campos[3] . "+'</td>'" . '+elec1+elec2+' . "'</tr>'" . "\r";
        $devu .= '}' . "\r";
        $devu .= 'document.getElementById("contenido").innerHTML = ta;' . "\r\r";
        // Capturo seleccion de modificar
        $devu .= '// Capturo todos los click del boton Editar' . "\r";
        $devu .= 'var test =document.querySelectorAll(' . "'.edit-reg')" . "\r";
        $devu .= 'for(var i=0;i<test.length;i++) {' . "\r";
        $devu .= 'test[i].addEventListener("click", function() {' . "\r";
        $devu .= '// Le quito la letra para que quede el Id' . "\r";
        $devu .= 'var valor_u = this.id.slice(1);' . "\r";
        $devu .= '// Oculto Formularios Agregar, Eliminar y Muestro Modificar' . "\r";
        $devu .= '$("#agregar").hide();' . "\r";
        $devu .= '$("#eliminar").hide();' . "\r";
        $devu .= '$("#modificar").show();' . "\r";
        $devu .= '// Muestro valores de los campos en el formulario' . "\r";
        $devu .= 'for(x of peticion){' . "\r";
        $devu .= 'if(valor_u == x.id){' . "\r";
        $devu .= '$("#id_u").val(x.id);' . "\r";
        for ($contar = 1; $contar < count($array_campos); $contar++) {
            $devu .= '$("#' . $array_campos[$contar] . '_u' . '").val(x.' . $array_campos[$contar] . ');' . "\r";
        }
        $devu .= '//******** IMPORTANTE ********//' . "\r";
        $devu .= '// Aqui se compara el campo area por que esa es la tabla que se eligio para cargar el Combo' . "\r";
        $devu .= '// x.area seria el campo en la tabla que se esta trabajando' . "\r";
        $devu .= 'if(x.area == " "){' . "\r";
        $devu .= 'combito("#selector2","0","areas","area");' . "\r";
        $devu .= '}else{' . "\r";
        $devu .= 'combito("#selector2",x.area,"areas","area");' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}' . "\r";
        $devu .= '});' . "\r";
        $devu .= '}' . "\r";
        // Capturo seleccion de eliminar
        $devu .= '// Capturo todos los click del boton Eliminar' . "\r";
        $devu .= 'var test =document.querySelectorAll(' . "'.delete-reg')" . "\r";
        $devu .= 'for(var i=0;i<test.length;i++) {' . "\r";
        $devu .= 'test[i].addEventListener("click", function() {' . "\r";
        $devu .= '// Le quito la letra para que quede el Id' . "\r";
        $devu .= 'var valor_d = this.id.slice(1);' . "\r";
        $devu .= '// Oculto Formularios Agregar, Eliminar y Muestro Modificar' . "\r";
        $devu .= '$("#agregar").hide();' . "\r";
        $devu .= '$("#eliminar").show();' . "\r";
        $devu .= '$("#modificar").hide();' . "\r";
        $devu .= '// Muestro valores de los campos en el formulario' . "\r";
        $devu .= 'for(x of peticion){' . "\r";
        $devu .= 'if(valor_d == x.id){' . "\r";
        $devu .= '$("#id_d").val(x.id);' . "\r";
        for ($contar = 1; $contar < count($array_campos); $contar++) {
            $devu .= '$("#' . $array_campos[$contar] . '_d' . '").val(x.' . $array_campos[$contar] . ');' . "\r";
        }
        $devu .= '//******** IMPORTANTE ********//' . "\r";
        $devu .= '// Aqui se compara el campo area por que esa es la tabla que se eligio para cargar el Combo' . "\r";
        $devu .= '// x.area seria el campo en la tabla que se esta trabajando' . "\r";
        $devu .= 'if(x.area == " "){' . "\r";
        $devu .= 'combito("#selector3","0","areas","area");' . "\r";
        $devu .= '}else{' . "\r";
        $devu .= 'combito("#selector3",x.area,"areas","area");' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}' . "\r";
        $devu .= '});' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}' . "\r";
        // Funcion que activa las tostadas
        $devu .= '// -------------------- Funcion Tostada -------------------- //' . "\r";
        $devu .= '// Muestra los avisos de Correcto, Aviso, Alerta y Error esquina inferior derecha' . "\r";
        $devu .= 'function tostada(tostada0,tostada1,tostada2){' . "\r";
        $devu .= 'var toastLiveExample = document.getElementById("toast")' . "\r";
        $devu .= 'var toast = new bootstrap.Toast(toastLiveExample)' . "\r";
        $devu .= 'var l = document.getElementById("toas0");' . "\r";
        $devu .= 'l.className = tostada0;' . "\r";
        $devu .= '$("#toas1").text(tostada1);' . "\r";
        $devu .= '$("#toas2").text(tostada2);' . "\r";
        $devu .= 'toast.show()' . "\r";
        $devu .= '}' . "\r";
        $devu .= '// -------------------- Funcion ColorError -------------------- //' . "\r";
        $devu .= '// Pone en rojo clarito las etiquetas que estan vacias' . "\r";
        $devu .= 'function colorerror(){' . "\r";
        $devu .= 'var a = 0;' . "\r";
        $devu .= '// Chequea si los campos estan vacios' . "\r";
        $devu .= '// Si estan vacios se muestra la tostada de alerta y cambia el color de la etiqueta' . "\r";
        // $array_campos = [];
        for ($counter = 1; $counter < count($array_campos); $counter++) {
            $devu .= "if ($('#" . $array_campos[$counter] . "_i').val() == null ||  $('#" . $array_campos[$counter] . "_i').val() == undefined  || $('#" . $array_campos[$counter] . "_i').val() == '') {" . "\r";
            $devu .= "$('#" . $array_campos[$counter] . "_i').css(" . '"background-color", "#F9EBEA");' . "\r";
            $devu .= 'a = 1;' . "\r";
            $devu .= '}' . "\r";
        }
        $devu .= 'return a;' . "\r";
        $devu .= '}' . "\r";
        $devu .= '// -------------------- Funcion Combito -------------------- //' . "\r";
        $devu .= '// Carga un select option con datos de la tabla elegida' . "\r";
        $devu .= 'function combito(queselector,valor,t_option,c_option){' . "\r";
        $devu .= '//Carga el Select Option de la Tabla' . "\r";
        $devu .= '$.post("' . strtolower($tabla) . '.php", { requerimiento : ' . "'option', campo_option : c_option, tabla_option : t_option}, function(data){" . "\r";
        $devu .= '$(queselector).html(data);' . "\r";
        $devu .= '$(queselector).val(valor);' . "\r";
        $devu .= '});' . "\r";
        $devu .= '}' . "\r";
        $devu .= '// -------------------- Cuando todo el documento se cargo -------------------- //' . "\r";
        $devu .= '// Cuando el Documento esta Cargado' . "\r";
        $devu .= '$(document).ready(function() {' . "\r\r";
        $devu .= '// Aqui se puede agregar combitos pasando como parametro el nombre de la tabla y el campo' . "\r";
        $devu .= '// Los combitos para Insert sera 1,4,7,10 y asi sucecivamente' . "\r";
        $devu .= '// Los combitos para Edit sera 2,5,8,11 y asi sucecivamente' . "\r";
        $devu .= '// Los combitos para Delete sera 3,6,9,12 y asi sucecivamente' . "\r";
        $devu .= "combito('#selector1',' ','areas','area');" . "\r";
        $devu .= '// Deshabilito Input de ID de Insert  ' . "\r";
        $devu .= '$("#id_i").prop("readonly", true);' . "\r";
        $devu .= '// Deshabilito Input de ID de Update' . "\r";
        $devu .= '$("#id_u").prop("readonly", true);' . "\r";
        $devu .= '// Deshabilito todos los Input de Delete' . "\r";
        for ($contar = 0; $contar < count($array_campos); $contar++) {
            $devu .= '$("#' . $array_campos[$contar] . '_d").prop("readonly", true);' . "\r";
        }
        $devu .= '// La linea de abajo se utiliza cuando el formulario tiene combo' . "\r";
        $devu .= "//$('#selector3').prop('disabled', 'disabled');" . "\r";
        $devu .= '// Boton Cancelar de Update' . "\r";
        $devu .= '$("#cancelar_u").click(function() {' . "\r";
        $devu .= '$("#eliminar").hide();' . "\r";
        $devu .= '$("#modificar").hide();' . "\r";
        $devu .= '$("#agregar").show();' . "\r";
        $devu .= '$("#buscar").val("");' . "\r";
        $devu .= 'document.getElementById("contenido").innerHTML = "";' . "\r";
        $devu .= '});' . "\r";
        $devu .= '// Boton Cancelar de Delete' . "\r";
        $devu .= '$("#cancelar_d").click(function() {' . "\r";
        $devu .= '$("#eliminar").hide();  ' . "\r";
        $devu .= '$("#modificar").hide();' . "\r";
        $devu .= '$("#agregar").show();' . "\r";
        $devu .= '$("#buscar").val("");' . "\r";
        $devu .= 'document.getElementById("contenido").innerHTML = "";' . "\r";
        $devu .= '});' . "\r";
        $devu .= '// Boton para guardar nuevo registro' . "\r";
        $devu .= '$("#guardar_i").click(function() {' . "\r";
        $devu .= '// Evita el Comportamiento del Submit por defecto.' . "\r";
        $devu .= 'event.preventDefault();' . "\r";
        $devu .= '// Recibe el valor de la funcion' . "\r";
        $devu .= 'var b = colorerror();' . "\r";
        $devu .= 'if( b == 1 ){' . "\r";
        $devu .= '// Si tiene campos obligatorios vacios.' . "\r";
        $devu .= "tostada('toast-header fondo-rojo','ALERTA','Existen campos vacios.');" . "\r";
        $devu .= 'document.getElementById("contenido").innerHTML = "";' . "\r";
        $devu .= '}else{' . "\r";
        $devu .= '// Si se ingresaron los campos obligatorios' . "\r";
        $devu .= '// Ajax de Consulta ' . "\r";
        $devu .= '$.ajax({' . "\r";
        $devu .= "type: 'POST'," . "\r";
        $devu .= "url: $('#" . strtolower($tabla) . "_i').attr('action')," . "\r";
        $devu .= "data: $('#" . strtolower($tabla) . "_i').serialize()," . "\r";
        $devu .= 'success: function(data) {' . "\r";
        $devu .= 'if(data == "NO1"){' . "\r";
        $devu .= '// Cuando no se pudo guardar.' . "\r";
        $devu .= "tostada('toast-header fondo-rojo','ERROR','No se pudo guardar.');" . "\r";
        $devu .= 'document.getElementById("contenido").innerHTML = "";' . "\r";
        $devu .= '}else if(data == "NO2"){' . "\r";
        $devu .= '// Cuando registro repetido.' . "\r";
        $devu .= "tostada('toast-header fondo-azul','AVISO','Registro repetido, Verifique.');" . "\r";
        $devu .= 'document.getElementById("contenido").innerHTML = "";' . "\r";
        $devu .= '}else{' . "\r";
        $devu .= '// Cuando se guardo con exito. ' . "\r";
        $devu .= 'document.getElementById("' . strtolower($tabla) . '_i").reset();' . "\r";
        $devu .= "tostada('toast-header fondo-verde','CORRECTO','Se guardo con exito.');" . "\r";
        $devu .= 'tablita(data)' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}' . "\r";
        $devu .= '});' . "\r";
        $devu .= '}' . "\r";
        $devu .= '});' . "\r";
        $devu .= '// Boton para modificar registro' . "\r";
        $devu .= '$("#guardar_u").click(function() {' . "\r";
        $devu .= '// Ajax de Consulta Evitando el Comportamiento del Submit' . "\r";
        $devu .= 'event.preventDefault();' . "\r";
        $devu .= '$.ajax({' . "\r";
        $devu .= "type: 'POST'," . "\r";
        $devu .= "url: $('#" . strtolower($tabla) . "_u').attr('action')," . "\r";
        $devu .= "data: $('#" . strtolower($tabla) . "_u').serialize()," . "\r";
        $devu .= 'success: function(data) {' . "\r";
        $devu .= 'if(data == "NO1"){' . "\r";
        $devu .= '// Cuando no se pudo guardar.' . "\r";
        $devu .= "tostada('toast-header fondo-rojo','ERROR','No se pudo modificar.');" . "\r";
        $devu .= '}else if(data == "NO2"){' . "\r";
        $devu .= '// Cuando la clave ya existe' . "\r";
        $devu .= "tostada('toast-header fondo-azul','AVISO','Algunos datos se repiten, Verifique.');" . "\r";
        $devu .= '}else{' . "\r";
        $devu .= '// Cuando se guardo con exito.' . "\r";
        $devu .= "tostada('toast-header fondo-verde','CORRECTO','Se modifico con exito.');" . "\r";
        $devu .= 'tablita(data)' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}' . "\r";
        $devu .= '});' . "\r";
        $devu .= '});' . "\r";
        $devu .= '// Boton para borrar registro' . "\r";
        $devu .= '$("#guardar_d").click(function() {' . "\r";
        $devu .= '// Ajax de Consulta Evitando el Comportamiento del Submit' . "\r";
        $devu .= 'event.preventDefault();' . "\r";
        $devu .= '$.ajax({' . "\r";
        $devu .= "type: 'POST'," . "\r";
        $devu .= "url: $('#" . strtolower($tabla) . "_d').attr('action')," . "\r";
        $devu .= "data: $('#" . strtolower($tabla) . "_d').serialize()," . "\r";
        $devu .= 'success: function(data) {' . "\r";
        $devu .= 'if(data == "NO"){' . "\r";
        $devu .= '// Cuando no se pudo eliminar.' . "\r";
        $devu .= "tostada('toast-header fondo-rojo','ERROR','No se pudo eliminar.');" . "\r";
        $devu .= 'document.getElementById("contenido").innerHTML = "";' . "\r";
        $devu .= '}else{' . "\r";
        $devu .= "$('#guardar_d').prop('disabled', true);" . "\r";
        $devu .= '// Cuando se elimino con exito.' . "\r";
        $devu .= "tostada('toast-header fondo-verde','CORRECTO','Se elimino con exito.');" . "\r";
        $devu .= 'tablita(data)' . "\r";
        $devu .= '}' . "\r";
        $devu .= '}' . "\r";
        $devu .= '});' . "\r";
        $devu .= '});' . "\r";
        $devu .= '// -------------------- Cuando una etiqueta toma el foco -------------------- //' . "\r";
        $devu .= '// Cuando hace foco en un input se limpian los carteles' . "\r";
        $devu .= "$('input').focus(function() {" . "\r";
        $devu .= "$('input').css('background-color', '');" . "\r";
        $devu .= '});' . "\r";
        $devu .= '// -------------------- Comienza la rutina para buscar y llenar la tabal -------------------- //' . "\r";
        $devu .= '// Comienzo de rutina JS para buscar' . "\r";
        $devu .= '$("#buscar").on("keyup", function(){' . "\r";
        $devu .= '// var buscar;' . "\r";
        $devu .= '// Si no Ingreso un Numero' . "\r";
        $devu .= '// buscar = document.getElementById("buscar").value;' . "\r";
        $devu .= '// if(isNaN(buscar)){' . "\r";
        $devu .= '// $("#cartelito").hide();' . "\r";
        $devu .= '// $("#alerta").show();' . "\r";
        $devu .= '// document.getElementById("alerta").innerHTML = "Debe ingresar un número...";' . "\r";
        $devu .= '// return false;' . "\r";
        $devu .= '// }' . "\r";
        $devu .= '// Si no se Ingreso Nada' . "\r";
        $devu .= 'if(document.getElementById("buscar").value.length === 0){' . "\r";
        $devu .= 'document.getElementById("contenido").innerHTML = "";' . "\r";
        $devu .= '$("#alerta").hide();' . "\r";
        $devu .= '$("#cartelito").show();' . "\r";
        $devu .= 'document.getElementById("cartelito").innerHTML = "Ingrese su busqueda...";' . "\r";
        $devu .= 'return false;' . "\r";
        $devu .= '}else{' . "\r";
        $devu .= '// Si se Ingreso un Valor Cartel Buscando...' . "\r";
        $devu .= '$("#cartelito").show();' . "\r";
        $devu .= '$("#alerta").hide();' . "\r";
        $devu .= 'document.getElementById("cartelito").innerHTML = "Buscando...";' . "\r";
        $devu .= '// Ajax de Consulta Evitando el Comportamiento del Submit' . "\r";
        $devu .= 'event.preventDefault();' . "\r";
        $devu .= '$.ajax({' . "\r";
        $devu .= "type: 'POST'," . "\r";
        $devu .= "url: $('#formbuscar').attr('action')," . "\r";
        $devu .= "data: $('#formbuscar').serialize()," . "\r";
        $devu .= 'success: function(data) {' . "\r";
        $devu .= '// Cuando la interacción sea exitosa, se ejecutará esto.' . "\r";
        $devu .= 'if(data == 0){' . "\r";
        $devu .= 'document.getElementById("contenido").innerHTML = "";' . "\r";
        $devu .= 'document.getElementById("alerta").innerHTML = "Sin coincidencias...";' . "\r";
        $devu .= "$('#alerta').show();" . "\r";
        $devu .= "$('#cartelito').hide();" . "\r";
        $devu .= '}else{' . "\r";
        $devu .= 'tablita(data)' . "\r";
        $devu .= '// Oculto Cartelito y Alerta JS' . "\r";
        $devu .= "$('#cartelito').hide();" . "\r";
        $devu .= "$('#alerta').hide();" . "\r";
        $devu .= '}' . "\r";
        $devu .= '},' . "\r";
        $devu .= 'error: function(data){' . "\r";
        $devu .= '//Cuando la interacción retorne un error, se ejecutará esto.' . "\r";
        $devu .= 'document.getElementById("alerta").innerHTML = "Error critico!";' . "\r";
        $devu .= "$('#alerta').show();" . "\r";
        $devu .= '}' . "\r";
        $devu .= '})' . "\r";
        $devu .= '}' . "\r";
        $devu .= '});' . "\r";
        $devu .= '// Fin de busqueda de la tabla' . "\r";
        $devu .= '// Fin de cuando el documento esta cargado' . "\r";
        $devu .= '});' . "\r";
        $archivo = fopen($carpeta . "/" . strtolower($tabla) . ".js", "w+b");
        fwrite($archivo, $devu);
        fflush($archivo);
        fclose($archivo);
        $devu .= "\r";
        echo $devu;
    //}  
} else {
    echo 'No se ha creado el proyecto';
}

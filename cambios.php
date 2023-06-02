<?php
session_start();

if(!isset($_SESSION['id'])){
    header('Location: login.php');
    exit;
} else { ?>
    <?php
    include 'head.php';
    include('conexion/conexion.php');
    $ruta = $_SERVER['DOCUMENT_ROOT'];

    //---------------------------- Código de Inicio de Sesión ---------------------------//
    if (isset($_POST['nuevoCambio'])) {
        $title = $_POST['titulo'];
        $descrip = $_POST['descripcion'];
        $priority = $_POST['prioridad'];
        echo 'llego aca';
        echo $title;
        echo $descrip;
        echo $priority; 
        $query = $conexion->prepare("INSERT INTO cambios(titulo,descripcion,prioridad,realizado,usuario_id) VALUES (:titulo,:descripcion,:prioridad,0,6)");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '<script language="javascript">alert("Algo salió mal, intente nuevamente");</script>';
        } else {
            echo '<script language="javascript">alert("Cambio registrado exitosamente");</script>';
            
        }
    }
    ?>

    <!DOCTYPE html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <html lang="en">
            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir cambio a realizar</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" name="nuevoCambio" id="nuevoCambio" action="">
                            <div class="modal-body">
                                <label for="titulo">Título</label>
                                <input type="text" name="titulo" class="form-control fondo3 form-control-sm mb-1" placeholder="Título del cambio" maxlength="50" required>
                                <label for="descripcion">Descripción</label>
                                <textarea name="descripcion" class="form-control fondo3 form-control-sm mb-1" placeholder="Descripción del cambio" required></textarea>
                                <label for="prioridad">Prioridad</label>
                                <select name="prioridad" class="form-select" aria-label="Default select example">
                                    <option value="1">Baja</option>
                                    <option value="2">Media</option>
                                    <option value="3">Alta</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" name="nuevoCambio"  class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <nav class="navbar-expand-sm bg-danger navbar-light navbar-fixed-top" style="padding: 10px;">
            <div class=".d-flex, justify-content-between" style="display: flex;">
                <div class="tittle">
                    <a class="navbar-brand" href="#">
                    <!-- <div class="rounded-pill"><i class="bi bi-tools"></i></div> -->
                    <img src="assets/img/logo.png" alt="Avatar Logo">
                    <a class="navbar-brand letra-normal" href="#" style="color: #f8f9fa;"><strong>HERRAMIENTA PARA DESARROLLO WEB</strong></a>
                    </a>
                </div>
                <div class="opciones" style="text-align: end;">
                    <form method="POST" name="redireccion" id="redireccion" action="">
                        <button type="submit" name="principal" class="btn btn-outline-dark">Principal</button>
                        <button type="submit" name="cambios" class="btn btn-outline-dark">Cambios</button>
                    </form>
                    <?php
	                    if(isset($_POST["principal"])){
		                    header('Location: index.php'); 
	                    }else if(isset($_POST["cambios"])){
		                    header('Location: cambios.php');    
                        }	
                    ?>
                </div>
            </div>
        </nav>

        <body>
            <br>
            <div class="container-fluid" style="width: 95%;">
                <div class=".d-flex, justify-content-between" style="display:flex;">
                    <h1>Cambios a realizar</h1><br>          
                    <button type="button" class="btn btn-primary" style="align-items:center" data-bs-toggle="modal" data-bs-target="#modal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg> Añadir cambio </button> 
                </div><br>
                <div class="cards" style="width: 95%; text-align: center;">
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </html>
<?php  
    }
?>


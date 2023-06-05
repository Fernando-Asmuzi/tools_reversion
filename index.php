<?php
//session_start();

//if(!isset($_SESSION['id'])){
  //  header('Location: login.php');
   // exit;
//} else { ?> 
      <?php
      include 'head.php';
      $ruta = $_SERVER['DOCUMENT_ROOT'];
      ?>

    <!DOCTYPE html>
    <html lang="es">
      <!-- <nav class="navbar navbar-default navbar-fixed-top"> -->
    <nav class="navbar-expand-sm bg-danger navbar-light navbar-fixed-top" style="padding: 5px;">
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

    <body id="top">
      <!-- Contenedor principal del Archivo -->
      <div class="col-12 col-centrada container" style="max-width: 98% !important;">

        <!-- Linea Nº 1 -->
        <br>
        <div class="row">
          <!-- Columna de la Izquierda -->
          <div class="col-sm-12 col-md-2 borde-derecho">
            <button title="Limpiar Campos" type="button" class="btn letra-media btn-sm boton9 color7 bg-danger btn-sm w-100" onclick="limpiar_formulario('pruebas')"><i class="bi bi-menu-button-wide-fill"></i><b> PROYECTO - BASE
                DATOS</b></button>
            <hr>
          </div>
          <!-- Columna de la Derecha -->
          <div class="col-sm-12 col-md-10">
            <button id="generado" title="Copiar al Portapapeles" type="button" class="btn btn-success izquierda letra-media btn-sm bg-primary  btn-sm w-100" onclick="clipboard('text1')"><b>CODIGO
                GENERADO</b></button>
            <hr>
          </div>
        </div>

        <!-- Linea Nº 2 -->
        <div class="row">
          <!-- Columna de la Izquierda -->
          <div class="col-sm-12 col-md-2 borde-derecho">
            <form method="POST" name="proyecto" id="proyecto" action="proyecto.php">
              <div class="col-sm-12 col-md-12">
                <input type="text" name="proyecto" class="form-control fondo3 form-control-sm mb-1" placeholder="Carpeta Proyecto" required>
              </div>
              <div class="col-sm-12 col-md-12">
                <input type="text" name="base" class="form-control fondo3 form-control-sm mb-1" placeholder="Base de Datos" required>
              </div>
              <div class="col-sm-12 col-md-12">
                <input type="text" name="pass" class="form-control fondo2 form-control-sm mb-1" placeholder="Contraseña" required>
              </div>
              <!-- Input Hidden Requerimiento para Update -->
              <input type='hidden' id='ruta' name='ruta' value=<?php $ruta; ?> />
              <div class="col-sm-12 col-md-12 mt-2">
                <button title="Generar Proyecto" type="submit" name="submit" class="btn mb-2 btn-sm letra-media boton9 color7 bg-primary btn-sm w-100"><i class="bi bi-menu-button-wide-fill"></i><b>
                    GENERAR PROYECTO</b></button>
              </div>
              <hr>
            </form>
            <div class="col-12 borde-derecho">
              <button title="Limpiar Campos" type="button" class="btn letra-media btn-sm boton9 color7 bg-success btn-sm w-100" onclick="limpiar_formulario('pruebas')"><i class=""></i><b> LIMPIAR CODIGO </b></button>
            </div>
            <hr>
            <form method="POST" name="pruebas" id="pruebas" action="generar.php">
                <input type="text" name="tabla" class="form-control fondo12 form-control-sm mb-1 W-100" placeholder="Tabla">
                <div class="col-sm-12 col-md-12 letra-media">
                  <div class="form-check mt-2 color11">
                    <input type="radio" class="form-check-input" id="radio1" name="radio" value="radio1" checked>Archivo Index
                  </div>
                  <div class="form-check color11">
                    <input type="radio" class="form-check-input " id="radio2" name="radio" value="radio2">Formulario ABM
                  </div>
                  <div class="form-check color11">
                    <input type="radio" class="form-check-input" id="radio3" name="radio" value="radio3">Formulario para
                    Buscar
                  </div>
                  <div class="form-check color11">
                    <input type="radio" class="form-check-input" id="radio4" name="radio" value="radio4">CRUD para Tabla
                  </div>
                  <div class="form-check color11">
                    <input type="radio" class="form-check-input" id="radio5" name="radio" value="radio5">Archivo JavaScript
                  </div>
                </div>
                <br>
                <button title="Generar Codigo" id="botoncodigo" type="submit" name="submit" class="btn boton10 mb-2 letra-media w-100"><i
                    class="bi bi-code-square"></i><b> GENERAR CODIGO</b></button>
            </form>
            <form method="POST" name="radios" id="radios" action="generarRadio.php">
              <div class="col-sm-12 col-md-12 letra-media">
                <hr>
                <div class="form-check color5">
                  <input type="radio" class="form-check-input" id="radio6" name="radio" value="radio6">Input Hidden
                </div>
                <div class="form-check color5">
                  <input type="radio" class="form-check-input" id="radio7" name="radio" value="radio7">Select Option
                </div>
                <div class="form-check color5">
                  <input type="radio" class="form-check-input" id="radio8" name="radio" value="radio8">Radio Option
                </div>
                <hr>
                <div class="form-check">
                  <input type="radio" class="form-check-input" id="radio9" name="radio" value="radio"><b>Cambios a Realizar</b>
                </div>
              </div>
              <button title="Generar Codigo" id="botonradio" type="submit" name="submit" class="btn letra-media btn-sm boton9 color7 bg-primary btn-sm w-100" onclick="limpiar_formulario('pruebas')"><i class="bi bi-code-square"></i><b> GENERAR CODIGO</b></button>
            </form>
          </div>

          <!-- Columna de la Derecha -->
          <div class="col-sm-12 col-md-10 text-success letra-media" id="denueve">
            <div id="text1">
              <div id="spiner">
                <div class="d-flex justify-content-center">
                  <div class="spinner-border" role="status">
                  </div>
                </div>
                <p class="centro">Generando el código. Espere...</p>
              </div>
            </div>
            <br>
            <div><a title="Arriba" href="#top"><i class="bi bi-arrow-up-square letra-grande"></i></a></div>
          </div>
        </div>
      </div>
      <?php
      include 'footer.php';
      ?>
      <script>
        $(document).ready(function() {
          $('#spiner').hide();
          //
          $('#pruebas').submit(function(event) {
            $('#spiner').show();
            event.preventDefault();
            $.ajax({
              type: 'POST',
              url: $(this).attr('action'),
              data: $(this).serialize(),
              success: function(data) {
                //Cuando la interacción sea exitosa, se ejecutará esto.
                document.getElementById("text1").innerText = data;
              },
              // error: function(data){
              // 	//Cuando la interacción retorne un error, se ejecutará esto.
              //   alert('No');
              // }
            })
          });
          $('#radios').submit(function(event) {
            $('#spiner').show();
            event.preventDefault();
            $.ajax({
              type: 'POST',
              url: $(this).attr('action'),
              data: $(this).serialize(),
              success: function(data) {
                //Cuando la interacción sea exitosa, se ejecutará esto.
                document.getElementById("text1").innerText = data;
              },
              // error: function(data){
              // 	//Cuando la interacción retorne un error, se ejecutará esto.
              //   alert('No');
              // }
            })
          });
          $('#proyecto').submit(function(event) {
            $('#spiner').show();
            event.preventDefault();
            $.ajax({
              type: 'POST',
              url: $(this).attr('action'),
              data: $(this).serialize(),
              success: function(data) {
                //Cuando la interacción sea exitosa, se ejecutará esto.
                $('#spiner').hide();
                document.getElementById("text1").innerText = data;
              },
              // error: function(data){
              // 	//Cuando la interacción retorne un error, se ejecutará esto.
              //   alert('No');
              // }
            })
          });
        });
      </script>
    </body>
    </html>
 
  <?php   
  //}
  ?>



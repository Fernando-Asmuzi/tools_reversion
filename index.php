<!DOCTYPE html>
<html lang="es">

<?php
include 'head.php';

$ruta = $_SERVER['DOCUMENT_ROOT'];

?>

<body id="top">
  <!-- <nav class="navbar navbar-default navbar-fixed-top"> -->
  <nav class="navbar navbar-expand-sm bg-danger navbar-light navbar-fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <!-- <div class="rounded-pill"><i class="bi bi-tools"></i></div> -->
        <img src="assets/img/logo.png" alt="Avatar Logo">
        <a class="navbar-brand letra-normal" href="#" style="color: #f8f9fa;">HERRAMIENTA PARA DESARROLLO WEB</a>
      </a>
    </div>
  </nav>
  <!-- Contenedor principal del Archivo -->
  <div class="col-12 col-centrada container" style="max-width: 98% !important;">
    <!-- Linea Nº 1 -->
    <br>
    <div class="row">
      <!-- Columna de la Izquierda -->
      <div class="col-sm-12 col-md-2 borde-derecho">
        <button title="Limpiar Campos" type="button" class="btn letra-media btn-sm boton7 color7 bg-danger btn-sm w-100" onclick="limpiar_formulario('pruebas')"><i class="bi bi-menu-button-wide-fill"></i><b> PROYECTO - BASE
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
            <input type="text" name="proyecto" class="form-control fondo2 form-control-sm mb-1" placeholder="Carpeta Proyecto" required>
          </div>
          <div class="col-sm-12 col-md-12">
            <input type="text" name="base" class="form-control fondo2 form-control-sm mb-1" placeholder="Base de Datos" required>
          </div>
          <div class="col-sm-12 col-md-12">
            <input type="text" name="pass" class="form-control fondo2 form-control-sm mb-1" placeholder="Contraseña" required>
          </div>
          <!-- Input Hidden Requerimiento para Update -->
          <input type='hidden' id='ruta' name='ruta' value=<?php $ruta; ?> />
          <div class="col-sm-12 col-md-12 mt-2">
            <button title="Generar Proyecto" type="submit" name="submit" class="btn mb-2 btn-sm letra-media boton8 color7 bg-primary btn-sm w-100"><i class="bi bi-menu-button-wide-fill"></i><b>
                GENERAR PROYECTO</b></button>
          </div>
          <hr>
        </form>

        <div class="col-12 borde-derecho">
          <button title="Limpiar Campos" type="button" class="btn letra-media btn-sm boton9 color7 bg-success btn-sm w-100" onclick="limpiar_formulario('pruebas')"><i class="bi bi-table"></i><b> LIMPIAR </b></button>
        </div>
        <hr>
        <form method="POST" name="pruebas" id="pruebas" action="generar.php">
          <!-- <div class="col-sm-12 col-md-12"> -->
          <input type="text" name="tabla" class="form-control fondo2 form-control-sm mb-1 W-100" placeholder="Tabla">
          <!-- </div> -->
          <!-- <hr> -->
          <br>
          <button title="Generar Codigo" id="botoncodigo" type="submit" name="submit" class="btn letra-media btn-sm boton9 color7 bg-primary btn-sm w-100"><i class="bi bi-code-square"></i><b> GENERAR CODIGO COMPLETO</b></button>
        </form>

        <form method="POST" name="radios" id="radios" action="generarRadio.php">
          <div class="col-sm-12 col-md-12 letra-media">
            <hr>
            <div class="form-check color5">
              <input type="radio" class="form-check-input" id="radio7" name="radio" value="radio7">Input Hidden
            </div>
            <div class="form-check color5">
              <input type="radio" class="form-check-input" id="radio8" name="radio" value="radio8">Select Option
            </div>
            <div class="form-check color5">
              <input type="radio" class="form-check-input" id="radio11" name="radio" value="radio11">Radio Option
            </div>
            <hr>
            <div class="form-check">
              <input type="radio" class="form-check-input" id="radio10" name="radio" value="radio10"><b>Cambios a Realizar</b>
            </div>
          </div>
          <button title="Generar Codigo" id="botonradio" type="submit" name="submit" class="btn letra-media btn-sm boton9 color7 bg-primary btn-sm w-100"><i class="bi bi-code-square"></i><b> GENERAR CODIGO</b></button>
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
            <p class="centro">Generando el proyecto. Espere...</p>
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
      $('#pruebas').submit(function(event) {
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
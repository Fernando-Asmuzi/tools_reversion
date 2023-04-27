<!DOCTYPE html>
<html lang="es">

<?php
include 'head.php';
// include "../conexion/conexion.php";
?>

<body id="top">

  <!-- ======= Header ======= -->
  <div class="container-fluid mt-2 mb-2 text-center">
    <a href="/hospitales" class="logo mr-auto"><img src="assets/img/head.png" alt="" /></a>
  </div>
  <!-- Fin Header -->

  <div class="row d-flex justify-content-center align-items-center portada" style="height: 700px; width: 100%;">

    <!-- Comienzo del Formulario para Insert Pruebas -->
    <div class="d-none d-md-block col-md-4"></div>

    <div class="col-sm-12 col-md-4">
      <!-- Comienzo del Card -->
      <div class="card pt-4 pb-1 ps-4 pe-4 w-100 fondo2">

        <!-- Titulo -->
        <div class='row text-center'>
          <div class='col-12'>
            <div class="alert alert-secondary" role="alert"> <h6>AUTENTICACION</h6> </div>
          </div>
        </div>

        <!-- Inicio del Formulario Pruebas -->
        <form method='POST' id='personal' action='personal.php'>

          <!-- Input de email -->
          <div class='row text-center'>
            <div class='col-12'>
              <div class='input-group input-group mb-3'>
                <span class='input-group-text' id='inputGroup-sizing-sm'><i
                    class='bi bi-record-fill text-secondary'></i></span>
                <input type='text' id='usuario' name='usuario' class='form-control letra-normal' placeholder='Email'
                  value='' required />
              </div>
            </div>
          </div>

          <!-- Input de password -->
          <!-- <div class='row d-flex justify-content-center align-items-center'>
            <div class='col-12'>
              <div class='input-group input-group mb-3'>
                <span class='input-group-text' id='inputGroup-sizing-sm'><i
                    class='bi bi-record-fill text-secondary'></i></span>
                <input type='password' id='pas_usuario' name='pas_usuario' class='form-control letra-normal'
                  placeholder='Contraseña' value='' required />
              </div>
            </div>
            <hr class="color7 ancho90 centro">
          </div> -->

          <!-- Botones del Formulario -->
          <div class='row text-center'>
            <div class='col-12'>
              <!-- Boton Guardar -->
              <button type='submit' id="ingresar" class='btn btn-primary w-100 mb-3 letra-normal'><i
                  class='icofont-save'></i> Ingresar</button>
            </div>
          </div>

          <!-- Botones del Formulario -->
          <div class='row text-center'>
            <div class='col-12'>
              <!-- Boton Guardar -->
              <button type='button' id="nar" class='btn btn-primary w-100 mb-3 letra-normal'><i
                  class='icofont-save'></i> NIngresar</button>
            </div>
          </div>

        </form>
        <!-- Fin del Formulario Pruebas -->

        <!-- Mensajes para Respuesta del Ajax -->
        <!-- Mensajes Guardado con exito -->
        <div class='row text-right'>
          <div class='col-md-12'>
            <div class="alert alert-success" style="display: none;" id="guardado" role="alert">
              <strong>Guardado exitoso! </strong>
            </div>
          </div>
        </div>

        <!-- Mensajes Guardado fallido o registro repetido -->
        <div class='row text-right'>
          <div class='col-md-12'>
            <div class="alert alert-danger" style="display: none;" id="noguardado" role="alert">
              <strong>Guardado fallido! </strong>
            </div>
          </div>
        </div>

      <!-- Fin del Card -->
      </div>

    </div>

    <div class="d-none d-md-block col-md-4"></div>

  </div>

  <!-- ======= Footer ======= -->
  <div class="container-fluid mt-3 mb-1 text-center">
    <p>Sistema Gestión Hospitales - 2022</p>
  </div>
  <!-- Fin Footer -->

  <?php
  include 'footer.php';
  ?>

  <script>
  $(document).ready(function() {

    // var myCarousel = document.querySelector('#myCarousel')
    // var carousel = new bootstrap.Carousel(myCarousel, {
    //   interval: 700,
    //   wrap: false
    // })

    // $('#usuarios').submit(function(event) {
    //   event.preventDefault();
    //   $.ajax({
    //     type: 'POST',
    //     url: $(this).attr('action'),
    //     data: $(this).serialize(),
    //     success: function(data) {


    //       if(data == 'Hola') { 
    //         $("#guardado").show('slow');
    //       }else{
    //         $("#noguardado").show('slow'); 
    //       }

                      //Cuando la interacción sea exitosa, se ejecutará esto.
                      //document.getElementById("text1").innerText = data;
        // },
                      // error: function(data){
                      // 	//Cuando la interacción retorne un error, se ejecutará esto.
                      //   alert('No');
                      // }
    //   })
    // });

    $("#limpiar").click(function(){
      $("#guardado").hide('slow');
      $("#noguardado").hide('slow');    
    });

    $('input').focus(function() {
      $("#guardado").hide('slow');
      $("#noguardado").hide('slow');    
    });

    // $("#nar").click(function(){
      // $("#nar").on('click', function() {
      // alert('Hola');
      // $('#guardado').css("visibility", "visible");
      //document.querySelector("#guardado").style.display = "block";
      // $("#guardado").show('slow');
      // $("#noguardado").show('slow');
      // return false;      
    // });




  });


    // Puro JavaScript
    // const boton = document.querySelector("#nar");
    // boton.addEventListener("click", function(evento){
    // document.querySelector("#guardado").style.display = "block";
    // });

  </script>

</body>

</html>
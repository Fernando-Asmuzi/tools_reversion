<div class="card pt-4 pb-1 ps-4 pe-4 w-100 fondo2">

<!-- Titulo -->  
<div class='row text-center'>
    <div class='col-12'>
      <div class="alert alert-secondary" role="alert"> <strong>LOGIN DE USUARIO</strong> </div>
    </div>
</div>

<!-- Inicio del Formulario Pruebas -->
<form method='POST' id='pruebas' action='pruebas.php'>
  <!-- Input de nombre -->
  <div class='row text-center'>
    <div class='col-12'>
      <div class='input-group input-group mb-3'>
        <span class='input-group-text' id='inputGroup-sizing-sm'><i class='bi bi-record-fill text-secondary'></i></span>
        <input type='text' id='nombre' name='nombre' class='form-control letra-normal' placeholder='Nombre' value=''
          required />
      </div>
    </div>
  </div>
  <!-- Input de email -->
  <div class='row d-flex justify-content-center align-items-center'>
    <div class='col-12'>
      <div class='input-group input-group mb-3'>
        <span class='input-group-text' id='inputGroup-sizing-sm'><i class='bi bi-record-fill text-secondary'></i></span>
        <input type='text' id='email' name='email' class='form-control letra-normal' placeholder='Email' value=''
          required />
      </div>
    </div>
    <hr class="color7 ancho90 centro">              
  </div>

  <!-- Botones del Formulario -->
  <div class='row text-center'>
    <div class='col-12'>
      <!-- <div class='modal-footer'> -->
        <!-- Boton Cancelar -->
        <button style='font-size: 13px' type='reset' class='btn btn-light w-100 mb-2' id="limpiar"><i
            class='icofont-close'></i> Limpiar</button>
        <!-- Boton Guardar -->
        <button style='font-size: 13px' type='submit' class='btn btn-primary w-100 mb-3'><i class='icofont-save'></i> Guardar
          Registro</button>
      <!-- </div> -->
    </div>
  </div>
</form>
<!-- Fin del Formulario Pruebas -->





          <!-- Mensajes para Respuesta del Ajax -->
          <!-- Mensajes Guardado con exito -->  
          <div class='row text-right'>
            <div class='col-md-1'></div>
              <div class='col-md-12'>
                <div class="alert alert-success alert-dismissible fade show" id="guardado" role="alert">
                  <strong>GUARDADO EXITOSO! </strong> Todos los datos fueron guardados.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            <div class='col-md-1'></div>
          </div>
          <!-- Mensajes Guardado fallo o registro repetido -->  
          <div class='row text-right'>
            <div class='col-md-1'></div>
              <div class='col-md-12'>
                <div class="alert alert-danger alert-dismissible fade show" id="noguardado" role="alert">
                  <strong>GUARDADO FALLIDO! </strong> Ocurrio un problema, o registro repetido.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            <div class='col-md-1'></div>
          </div>



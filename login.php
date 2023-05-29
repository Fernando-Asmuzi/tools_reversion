<!doctype html>
<html lang="en" data-bs-theme="auto">

<?php
include 'head.php';
?>

<body class="text-center">
    <main class="form-signin w-100 m-auto">
        <form method="POST" action="loginControl.php" id="login" name="login">
            <!-- 
            <img class="mb-4" src="/tools_reversion/tools_reversion/assets/img/lo.png" alt="" width="150" height="100"> 
            -->
            <h1 class="h3 mb-3 fw-normal">Ingreso</h1>
            <div class="form-floating">
                <input type="text" class="form-control" name="usuario" id="floatingInput" placeholder="Usuario" required>
                <label for="floatingInput">Usuario</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Contraseña" required>
                <label for="floatingPassword">Contraseña</label>
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Recordarme
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Ingresar</button>
        </form>
    </main>

    <script>
    $(document).ready(function() {
    event.preventDefault();
    $('#login').submit(function(event) {
        $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        })
    });
    });
    </script>
</body>
</html>
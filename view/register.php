<div class="d-flex flex-column mb-3 justify-content-center align-items-center bg-info-subtle">
    <form action="../controller/controllerRegister.php" method="post">
        <div class="mb-3 mt-3 d-flex flex-column align-items-center ">

            <div class="mb-2 border d-flex flex-column align-items-center ">
                    <?php
                    if(isset($errores['usr']))
                    echo '<p style="color: red;"><strong>'. $errores['usr']. '</strong></p>';
                    if(isset($errores['psw']))
                    echo '<p style="color: red;"><strong>'. $errores['psw']. '</strong></p>';
                    ?>
                <label for="nombreUsuario" class="form-label" style="margin-bottom: 0;"> Nombre de Usuario</label>
                <p style="font-size: small; color: blue; margin: 0;">Este es el nombre con el que iniciarás sesión</p>
                <input type="text" name="nombreUsuario" id="nombreUsuario" required>
            </div>
            <div class="mb-2 border d-flex flex-column align-items-center ">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>
            <div class="mb-2 border d-flex flex-column align-items-center ">
                <label for="mail" class="form-label">Email</label>
                <input type="mail" name="mail" id="mail" required>
            </div>
            <div class="mb-2 border d-flex flex-column align-items-center ">

                <label for="password" class="form-label">Constraseña</label>
                <input type="password" class="form-control" name="password1" id="password" required>
            </div>

            <div class="mb-2 border d-flex flex-column align-items-center ">
                <label for="password" class="form-label">Repite la contraseña</label>
                <input type="password" class="form-control" name="password2" id="password" required>
            </div>
            <div>
                <input type="submit" name="registrarse" class="btn btn-primary" value="Añadir">
            </div>
        </div>
    </form>
</div>
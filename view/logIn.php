<form action="../controller/controllerLogIn.php" method="post">
    <label for="nombre">Nombre Usuario</label><br>
    <input type="text" name="nombre" id="nombre"><br>
    <label for="nombre">Contraseña</label><br>
    <input type="password" name="password" id="password"><br>
    <input type="submit" name="login" value="Login">
    <a href="../controller/controllerIndex.php?opcion=registrarse">Registrarse</a>
</form>

<?php

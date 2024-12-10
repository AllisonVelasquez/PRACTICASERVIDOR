<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
</head>

<body>
    <form action="../controller/controllerLogIn.php" method="post">
        <label for="nombre">Nombre Usuario</label><br>
        <input type="text" name="nombre" id="nombre" required><br>
        <label for="password">Contraseña</label><br>
        <input type="password" name="password" id="password" required minlength="8"><br>
        <input type="submit" name="login" value="Login">
        <a href="../controller/controllerIndex.php?opcion=registrarse">Registrarse</a>
    </form>
</body>

</html>
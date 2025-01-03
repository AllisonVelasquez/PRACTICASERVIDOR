<form action="../controller/controllerLogIn.php" method="post" class="p-4 border bg-primary rounded shadow-sm">
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre Usuario</label>
    <input type="text" name="nombre" id="nombre" class="form-control" required>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Contraseña</label>
    <input type="password" name="password" id="password" class="form-control" required>
  </div>
  <div class="d-flex justify-content-between align-items-center">
    <input type="submit" name="login" class="btn btn-primary" value="Login">
    <a href="../controller/controllerIndex.php?opcion=registrarse" class="btn btn-link">Registrarse</a>
  </div>
</form>

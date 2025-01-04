<div class="container my-5">
    <?php if (!isset($modificar)) { ?>
            <h1 class="text-center mb-4">Registro de Libro</h1>

        <form method="POST" action='./../controller/controllerRegistroLibros.php?accion=add' enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Libro</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" required>
            </div>

            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" required>
            </div>

            <div class="mb-3">
                <label for="genero" class="form-label">Género</label>
                <input type="text" class="form-control" id="genero" name="genero" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Cargar Imagen del Libro</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
            </div>

            <input type="submit" name="addLibro" class="btn btn-primary" value="Guardar Libro">
        </form>
    <?php } else if (isset($modificar)) {?>      
            <h1 class="text-center mb-4">Modificar Libro</h1>

              <form method="POST" action='./../controller/controllerRegistroLibros.php?accion=modificar'
                enctype="multipart/form-data">

                <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ; ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Libro</label>
                    <input type="text" class="form-control" id="nombre" name="nombre"
                        placeholder="<?php echo $modificar['nombre']; ?>">
                </div>
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad actual en stock</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" min="1"
                        placeholder="<?php echo $modificar['cantidad']; ?>">
                    <label for="cantidad" class="form-label">Cantidad De Ejemplares</label>
                    <input type="number" class="form-control" id="cantidadTotal" name="cantidad" min="1"
                        placeholder="<?php echo $modificar['cantidadTotal']; ?>">
                </div>

                <div class="mb-3">
                    <label for="autor" class="form-label">Autor</label>
                    <input type="text" class="form-control" id="autor" name="autor"
                        placeholder="<?php echo $modificar['autor']; ?>">
                </div>

                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <input type="text" class="form-control" id="genero" name="genero"
                        placeholder="<?php echo $modificar['genero']; ?>">
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                        placeholder="<?php echo $modificar['descripcion']; ?>"></textarea>
                </div>

                <div class="mb-3">
                    <img src="<?php echo '../img/' . $modificar['url']; ?>" class="img-fluid rounded" style="max-width: 200px;"
                        alt="Imagen del libro <?php echo '(' . $modificar['nombre'] . ')'; ?>">
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                </div>

                <input type="submit" name="modificarLibro" class="btn btn-primary" value="Modificar Libro">
            </form>
    <?php }
    ?>
</div>
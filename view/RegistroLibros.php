<?php
if (isset($_SESSION['usuario']) && $_SESSION['admin']) { ?>

    <div class="container my-5">
        <h1 class="text-center mb-4">Ingreso de Libro</h1>

        <form method="POST" action="../controller/controllerRegistroLibros.php" enctype="multipart/form-data">
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

            <button type="submit" name="addLibro" class="btn btn-primary">Guardar Libro</button>
        </form>
    </div>
<?php }
header('Location:../controller/controllerIndex.php');
?>
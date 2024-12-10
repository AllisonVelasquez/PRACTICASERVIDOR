<div class="container my-5">
    <h1 class="text-center mb-4">Filtrar Libros</h1>

    <?php
    // Extrae opciones únicas para los selects
    $nombres = array_unique(array_column($books, 'nombre'));
    $autores = array_unique(array_column($books, 'autor'));
    $generos = array_unique(array_column($books, 'genero'));

    ?>

    <!-- Formulario -->
    <form method="POST" action="" class="mb-5">
        <div class="row">
            <div class="col-md-4">
                <label for="nombre" class="form-label">Nombre del libro:</label>
                <select name="nombre" id="nombre" class="form-select">

                    <!--Aqui hayq eu dejar que la opcion de filtro permanezca y añadir un boton de quitar filtros-->
                    <option value="">Todos
                        <?php ?>
                    </option>
                    <?php foreach ($nombres as $nombre) { ?>
                        <option value="<?php echo $nombre; ?>" <?php echo (isset($_POST['nombre']) && $_POST['nombre'] === $nombre) ? 'selected' : ''; ?>>
                            <?php echo $nombre; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- Filtrar por Autor -->
            <div class="col-md-4">
                <label for="autor" class="form-label">Autor:</label>
                <select name="autor" id="autor" class="form-select">
                    <option value="">Todos</option>
                    <?php foreach ($autores as $autor) { ?>
                        <option value="<?php echo $autor; ?>" <?php echo (isset($_POST['autor']) && $_POST['autor'] === $autor) ? 'selected' : ''; ?>>
                            <?php echo $autor; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- Filtrar por Género -->
            <div class="col-md-4">
                <label for="genero" class="form-label">Género:</label>
                <select name="genero" id="genero" class="form-select">
                    <option value="">Todos</option>
                    <?php foreach ($generos as $genero) { ?>
                        <option value="<?php echo $genero; ?>" <?php echo (isset($_POST['genero']) && $_POST['genero'] === $genero) ? 'selected' : ''; ?>>
                            <?php echo $genero; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
    </form>

    <hr>

    <?php
    // Obtiene los valores seleccionados del formulario
    $nombre = $_POST['nombre'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $genero = $_POST['genero'] ?? '';

    // Filtra los libros según los valores seleccionados
    $filteredBooks = array_filter($books, function ($book) use ($nombre, $autor, $genero) {
        return (!$nombre || $book['nombre'] === $nombre) &&
            (!$autor || $book['autor'] === $autor) &&
            (!$genero || $book['genero'] === $genero);
    });

    // Muestra los resultados filtrados
    if (!empty($filteredBooks)) { ?>
        <div class="container my-4">
            <div class="row g-4">
                <?php foreach ($filteredBooks as $key =>  $book) { ?>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="card h-100">
                            <div class="ratio " style="--bs-aspect-ratio: 160%;">
                                <img src="<?php echo $book['url']; ?>" class="img-fluid rounded" alt="Imagen del libro">
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <p class="card-text"><strong>Autor:</strong> <?php echo $book['autor']; ?></p>
                                <p class="card-text"><strong>Género:</strong> <?php echo $book['genero']; ?></p>
                                <p class="card-text"><strong>Descripción:</strong> <?php echo $book['descripcion']; ?></p>
                                <?php
                                if (isset($_SESSION['usuario'] )&& !empty($_SESSION['usuario'])) {
                                    echo '<a href="../controller/controllerIndex.php?prestar='.$key.'">Sacar libro</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php
    } else {
        echo '<p class="text-center">No se encontraron libros con los criterios proporcionados.</p>';
    }
    ?>
</div>
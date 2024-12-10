<?php require_once('header.php') ?>
<div class="container my-5">
    <h1 class="text-center mb-4">Filtrar Libros</h1>

    <?php
    require_once('../cargador.php');
    // Obtiene todos los libros
    $books = Book::getAll();
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
                    <option value="">Todos </option>
                    <?php foreach ($nombres as $nombre) { ?>
                        <option value="<?php echo htmlspecialchars($nombre) ?>"
                            <?php (isset($_GET['nombre']) && $_GET['nombre'] === $nombre) ? 'selected' : '' ?>>
                            <?php echo htmlspecialchars($nombre); ?>
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
                        <option value="<?php echo htmlspecialchars($autor) ?>" <?php (isset($_GET['autor']) && $_GET['autor'] === $autor) ? 'selected' : '' ?>>
                            <?php echo htmlspecialchars($autor); ?>
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
                        <option value="<?php echo htmlspecialchars($genero) ?>" <?php (isset($_GET['genero']) && $_GET['genero'] === $genero) ? 'selected' : '' ?>>
                            <?php echo htmlspecialchars($genero); ?>
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
        <div class="flex-column"><?php
                                    foreach ($filteredBooks as $book) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo $book['url']; ?>" class="card-img-top" alt="Imagen del libro">
                        <div class="card-body d-flex flex-direction:rows justify-center align-items">
                            <p class="card-text"><strong>Autor:</strong> <?php echo $book['autor']; ?></p>
                            <p class="card-text"><strong>Género:</strong> <?php echo $book['genero']; ?></p>
                            <p class="card-text"><strong>Descripcion:</strong> <?php echo $book['descripcion']; ?></p>

                        </div>
                    </div>
                </div>
            <?php  }
            ?>
        </div>
    <?php
    } else {
        echo '<p class="text-center">No se encontraron libros con los criterios proporcionados.</p>';
    }
    ?>
</div>
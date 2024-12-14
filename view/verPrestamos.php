<?php
if (isset($_SESSION['usuario']) && $_SESSION['admin']) {
    // Extrae opciones únicas para los selects
    $idUsers = array_unique(array_column($prestamos, 'idUser'));
    $idBooks = array_unique(array_column($prestamos, 'idBook'));
    $devueltos = array_unique(array_column($prestamos, 'devuelto'));

    // Filtrar los préstamos según los valores seleccionados
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        if ($accion === 'filtrar') {
            // Lógica de filtrado
            $filtroUsuario = $_POST['filtro_usuario'] ?? '';
            $filtroLibro = $_POST['filtro_libro'] ?? '';
            $filtroDevuelto = $_POST['filtro_devuelto'] ?? '';

            // Aplicar el filtro en la lista de préstamos (código de filtrado)
        } elseif ($accion === 'restablecer') {
            // Lógica para restablecer los filtros
            // Aquí puedes limpiar los valores del filtro o redirigir al formulario en blanco
            $filtroUsuario = '';
            $filtroLibro = '';
            $filtroDevuelto = '';
        }
    } else {
        $filtroUsuario = $_POST['filtro_usuario'] ?? '';
        $filtroLibro = $_POST['filtro_libro'] ?? '';
        $filtroDevuelto = $_POST['filtro_devuelto'] ?? '';
    }
    // Filtra los préstamos según los valores seleccionados
    $prestamosFiltrados = array_filter($prestamos, function ($prestamo) use ($filtroUsuario, $filtroLibro, $filtroDevuelto) {
        return (!$filtroUsuario || $prestamo['idUser'] === $filtroUsuario) &&
            (!$filtroLibro || $prestamo['idBook'] === $filtroLibro) &&
            ($filtroDevuelto === '' || $prestamo['devuelto'] == $filtroDevuelto);
    });
    ?>

    <!-- Formulario de Filtro -->
    <div class="container my-5">
        <h1 class="text-center mb-4">Filtrar Libros</h1>

        <form method="POST" action="" class="mb-5">
            <div class="row">
                <div class="col-md-4">
                    <label for="filtro_usuario" class="form-label">Nombre de Usuario:</label>
                    <select name="filtro_usuario" id="filtro_usuario" class="form-select">
                        <option value="">Todos</option>
                        <?php foreach ($idUsers as $usuarioOption) { ?>
                            <option value="<?php echo $usuarioOption; ?>" <?php echo ($filtroUsuario === $usuarioOption) ? 'selected' : ''; ?>>
                                <?php echo $usuarioOption; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="filtro_libro" class="form-label">ID Libro:</label>
                    <select name="filtro_libro" id="filtro_libro" class="form-select">
                        <option value="">Todos</option>
                        <?php foreach ($idBooks as $libroOption) { ?>
                            <option value="<?php echo $libroOption; ?>" <?php echo ($filtroLibro === $libroOption) ? 'selected' : ''; ?>>
                                <?php echo $libroOption; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="filtro_devuelto" class="form-label">Devuelto:</label>
                    <select name="filtro_devuelto" id="filtro_devuelto" class="form-select">
                        <option value="">Todos</option>
                        <option value="1" <?php echo ($filtroDevuelto === '1') ? 'selected' : ''; ?>>Sí</option>
                        <option value="0" <?php echo ($filtroDevuelto === '0') ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3" name="accion" value="filtrar">Filtrar</button>
            <button type="submit" class="btn btn-secondary mt-3" name="accion" value="restablecer">Restablecer</button>

        </form>
        <!-- Crear tabla con los prestamos filtrados -->
        <div class="container my-4">
            <h2 class="mb-4">Listado de Préstamos</h2>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>ID Usuario</th>
                        <th>ID Libro</th>
                        <th>Fecha de Préstamo</th>
                        <th>Fecha de Devolución</th>
                        <th>Devuelto</th>
                        <th>Ampliar Plazo (Días)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prestamosFiltrados as $id => $prestamo) { ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $prestamo['idUser']; ?></td>
                            <td><?php echo $prestamo['idBook']; ?></td>
                            <td><?php echo date("d-m-Y", $prestamo['dateP']); ?></td>
                            <td><?php echo date("d-m-Y", $prestamo['dateD']); ?></td>
                            <td>
                                <form action="../controller/controllerIndex.php?opcion=verPrestamos" method="POST">
                                    <input type="hidden" name="prestamo" value="<?php echo $id; ?>">
                                    <select name="devuelto" class="form-select" onchange="this.form.submit()"
                                        style="color: <?php echo ($prestamo['devuelto']) ? 'green' : 'red'; ?>">
                                        <option value="1" <?php echo ($prestamo['devuelto']) ? 'selected' : ''; ?>
                                            style="color: green;">Sí</option>
                                        <option value="0" <?php echo (!$prestamo['devuelto']) ? 'selected' : ''; ?>
                                            style="color: red;">No</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <?php if (!$prestamo['devuelto']) { ?>
                                    <form action="../controller/controllerIndex.php?opcion=verPrestamos" method="POST">
                                        <input type="hidden" name="prestamo" value="<?php echo $id; ?>">
                                        <input type="number" id="dias" name="dias" min="0" style="width: 60px;" required>
                                        <button type="submit" class="btn btn-success btn-sm">Modificar</button>
                                    </form>
                                <?php } else { ?>
                                    <button class="btn btn-primary btn-sm">Devuelto</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php }
header('Location:../controller/controllerIndex.php');
?>
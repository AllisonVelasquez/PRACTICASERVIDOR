

<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th scope="col">Nombre de Usuario</th>
<th scope="col">Nombre</th>
<th scope="col">Correo</th>
<th scope="col">Admin</th>
<th scope="col">Bloqueado</th>
<th scope="col">Ver Prestamos</th>
</tr>
</thead>
<tbody>
<?php
foreach ($users as $key => $value) { ?>
    <tr>
        <td><?php echo $key; ?></td>
        <td><?php echo $value['nombre']; ?></td>
        <td><?php echo $value['correo']; ?></td>
        <td>
            <!-- Formulario para el campo "Admin" -->
            <form action="../controller/controllerUsuarios.php" method="GET">
                <input type="hidden" name="user" value="<?php echo $key; ?>">
                <select name="admin" class="form-select" onchange="this.form.submit()">
                    <option value="1" <?php echo ($value['admin']) ? 'selected' : ''; ?>>Admin</option>
                    <option value="0" <?php echo (!$value['admin']) ? 'selected' : ''; ?>>User</option>
                </select>
            </form>
        </td>
        <td>
            <!-- Formulario para el campo "Bloqueado" -->
            <form action="../controller/controllerUsuarios.php" method="GET">
                <input type="hidden" name="user" value="<?php echo $key; ?>">
                <select name="blocked" class="form-select" onchange="this.form.submit()"
                    style="color: <?php echo ($value['blocked']) ? 'red' : 'green'; ?>">
                    <option value="1" <?php echo ($value['blocked']) ? 'selected' : ''; ?> style="color: red;">Bloqueado</option>
                    <option value="0" <?php echo (!$value['blocked']) ? 'selected' : ''; ?> style="color: green;">Activo</option>
                </select>
            </form>
        </td>
        <td>
            <!-- Botón para ver los préstamos -->
            <form action="../controller/controllerIndex.php?opcion=misPrestamos" method="POST">
                <input type="hidden" name="usuario" value="<?php echo $key ;?>">
                <button type="submit" class="btn btn-success btn-sm">Ver Prestamos</button>
            </form>
        </td>
    </tr>
<?php } ?>

</tbody>
</table>

<?php

echo '<table class="table table-striped table-bordered">';
echo '<th scope="col"> Nombre de Usuario</th>';
echo '<th scope="col"> Nombre</th>';
echo '<th scope="col"> Correo</th>';
echo '<th scope="col">Admin </th>';
echo '<th scope="col"> Blokeado</th>';



foreach ($users as $key => $value) { ?>
    <tr>
        <th scope="col"><?php echo $key; ?></th>
        <td><?php echo $value['nombre']; ?></td>
        <td><?php echo $value['correo']; ?></td>
        <td>
            <!-- A continuación tenemos dos formularios para la columna Admin y Bloqueado
Se pasa por un campo hidden el nombre Usuario. Para mostrar si un usuario es admin o no, o si esta bloqueado o no, se hace un ternario en cada opción
En ese ternario comprobamos el estado del usuario, y si es el que corresponde se marca la opcion como selected para que ese sea el texto que aparezca en el desplegable

-->
            <form action="../controller/controllerUsuarios.php" method="GET">
                <input type="hidden" name="user" value="<?php echo $key; ?>">
                <select name="admin" onchange="this.form.submit()">
                    <option value="1" <?php echo ($value['admin']) ? 'selected' : ''; ?>>Admin</option>
                    <option value="0" <?php echo (!$value['admin']) ? 'selected' : ''; ?>>User</option>
                </select>
            </form>
        </td>
        <td>

            <form action="../controller/controllerUsuarios.php" method="GET">
                <input type="hidden" name="user" value="<?php echo $key; ?>">
                <select name="blocked" onchange="this.form.submit()" style="color: <?php echo ($value['blocked']) ? 'red' : 'green'; ?>">
                    <option value="0" <?php echo ($value['blocked']) ? 'selected' : ''; ?> style="color: red;">Bloqueado</option>

                    <option value="1" <?php echo (!$value['blocked']) ? 'selected' : ''; ?> style="color: green;">Activo</option>
                </select>
            </form>
        </td>

    </tr>



<?php }  ?>
</table>
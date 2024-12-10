<?php

/* meter la cookie de prefererncias con
modificar class a table-dark o ''  */
echo '<table class="table table-striped table-bordered">';
echo '<th scope="col"> Nombre de Usuario</th>';
echo '<th scope="col"> Nombre</th>';
echo '<th scope="col"> Correo</th>';
echo '<th scope="col"> Blokeado</th>';


foreach ($users as $key => $value) { ?>
    <tr>
        <th scope="col"><?php echo $key; ?></th>
        <td><?php echo $value['nombre']; ?></td>
        <td><?php echo $value['correo']; ?></td>
        <td>
            <a href="../controller/controllerRegistroLibros.php?blocked=<?php echo $value['blocked']; ?>" style="color: <?php echo ($value['blocked']) ? 'red' : 'green'; ?>"> <?php echo ($value['blocked']) ? 'blokeado' : 'activo'; ?></a>
        </td>
    </tr>



<?php }  ?>
</table>
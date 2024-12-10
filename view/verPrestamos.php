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
            </tr>
        </thead>
        <tbody>
            <!-- FALTA AÑADIR EL METODO ADDDAYS DE CHECKOUT PARA AMPLIAR EL PLAZO DE DEVOLUCION -->
            <?php foreach ($prestamos as $id => $prestamo) { ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $prestamo['idUser']; ?></td>
                        <td><?php echo $prestamo['idBook']; ?></td>
                        <td><?php echo date("d-m-Y", $prestamo['dateP']); ?></td>
                        <td><?php echo date("d-m-Y", $prestamo['dateD']); ?>
                    </td>
                        <td>
                            <?php echo $prestamo['devuelto'] ? 'Sí' : 'No'; ?>
                        </td>
                        <td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
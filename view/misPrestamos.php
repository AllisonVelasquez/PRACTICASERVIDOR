

<div class="container my-4">
    <h2 class="mb-4">Listado de Préstamos de <?php echo $usuario; ?> </h2>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Libro</th>
                <th>Fecha de Préstamo</th>
                <th>Fecha de Devolución</th>
                <th>Devuelto</th>
            </tr>
        </thead>
        <tbody>
           <?php foreach ($prestamos as $prestamo) { 
            if($prestamo['idUser']===$usuario){?>
                <tr>
                    <td><?php echo Book::getDato($prestamo['idBook'],'nombre'); ?></td>
                    <td><?php echo date("d-m-Y", $prestamo['dateP']); ?></td>
                    <td><?php echo date("d-m-Y", $prestamo['dateD']); ?></td>
                    <td>
                        <?php echo $prestamo['devuelto'] ? 'Sí' : 'No'; ?>
                    </td>
                </tr> 
            <?php }} ?>
        </tbody>
    </table>
</div>
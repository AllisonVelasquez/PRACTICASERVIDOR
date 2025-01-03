<div class="container my-4">
    <h2 class="mb-4">Listado de Préstamos de <?php echo $usuario; ?> </h2>
    <table class="table table-sm table-bordered text-center">
  <thead class="thead-light">
    <tr>
      <th class="table-danger">Rojo: Pasados de fecha</th>
      <th class="table-success">Verde: Devueltos</th>
      <th class="table-primary">Azul: Aún en fecha</th>
    </tr>
  </thead>
</table>
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
            <?php
            $hoy = new DateTime();
            foreach ($prestamos as $prestamo) {
                if ($prestamo['idUser'] === $usuario) {
                    $dateDevolucion = new DateTime(date('Y-m-d', $prestamo['dateD'])); // Convierte el timestamp a formato Y-m-d
                    $diferencia = $hoy->diff($dateDevolucion);


                    if ($diferencia->invert && $prestamo['devuelto'] === false) {

                        ?>
                        <tr class="bg-danger-subtle border-danger">

                            <?php
                    } else if ($prestamo['devuelto'] === true) {
                        ?>
                            <tr class="bg-success-subtle border-success">

                            <?php
                    } else {
                        ?>
                            <tr class="bg-primary-subtle border-primary">
                        <?php } ?>
                        <td><?php echo Book::getDato($prestamo['idBook'], 'nombre'); ?></td>
                        <td><?php echo date("d-m-Y", $prestamo['dateP']); ?></td>
                        <td><?php echo date("d-m-Y", $prestamo['dateD']); ?></td>
                        <td>
                            <?php echo $prestamo['devuelto'] ? 'Sí' : 'No'; ?>
                        </td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>
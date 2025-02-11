<div class="container my-4">
    <h2 class="mb-4">Listado de Préstamos de <?php echo $_SESSION['usuario']; ?> </h2>
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
                <th>Ampliación</th>
            </tr>
        </thead>
        <tbody>
            <?php
/*             $hoy = new DateTime();
 */            foreach ($prestamos as $id => $prestamo) {
                if ($prestamo['idUser'] === $usuario) {
/*                     $dateDevolucion = new DateTime(date('Y-m-d', $prestamo['dateD'])); // Convierte el timestamp a formato Y-m-d
 */    /*                 $diferencia = $hoy->diff($dateDevolucion); */


                    if (/* $diferencia->invert && */ $prestamo['devuelto'] === false) {

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
                        <td><?php echo Book::getDato($prestamo['idBook'], 'nombre')[0]['nombre']; ?></td>
                        <td><?php echo  $prestamo['dateP']; ?></td>
                        <td><?php echo  $prestamo['dateD']; ?></td>
                        <td>
                            <?php echo $prestamo['devuelto'] ? 'Sí' : 'No'; ?>
                        </td>
                        <td>
                            <?php
                            //falta que el admin haga el addDays, se ha puesto como valor predefinido 7 dias para que solo instroduzca el id si quiere
                            if ($prestamo['solicitudAmpliacion'] == true) {
                                echo 'Ya se realizó la solicitud de ampliacion permitida';
                            } else if ((isset($_POST['solicitar'])) && $_POST['solicitar'] == $id) {
                                Checkout::ampliar($id);
                                echo 'Solicitud realizada';
                            } else {
                                echo '<form method="post">
                                <input type="hidden" name="solicitar" value="' . $id . '">
                                <button type="submit" class="btn btn-outline-primary">Solicitar 7 días más</button>
                            </form>';
                            }

                            ?>

                        </td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>
<?php
require(__DIR__ . '/config.php');

function conectar()
{
    try {
        
            $con = new PDO(dsn, dbuser, dbpass, [
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            ]);
        
        return $con;
    } catch (PDOException $e) {
        echo 'error ' + $e->getMessage() + '<br>';
    }
}
function getAllByTable($tabla)
{
    try {
        //code...

        $con = conectar();
        $sql = "SELECT * FROM $tabla";
        $data = $con->query($sql);

        return $data->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        echo 'error ' + $e->getMessage() + '<br>';
    }
}

function getAllByParam($tabla, $param, $value)
{
    try {
        $con = conectar();
        $sql = "SELECT * FROM $tabla WHERE $param='$value'";
        $data = $con->query($sql);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {

        echo 'error ' + $e->getMessage() + '<br>';
    }
}
function getDataById($tabla, $param, $id)
{
    try {
        $con = conectar(); // Asegúrate de que la función conectar() esté definida correctamente.

        // Validamos que el parámetro $param sea válido (es decir, que sea un nombre de columna)
        // Este paso es opcional y depende de cómo se gestionen las columnas en tu base de datos.
        $sql = "SELECT $param FROM $tabla WHERE id = :id"; // Usamos un marcador de posición para el ID
        $stmt = $con->prepare($sql);
        
        // Vinculamos el valor de $id, el cual puede ser tanto un int como un string.
        if (is_int($id)) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        } else {
            $stmt->bindParam(':id', $id, PDO::PARAM_STR); // Para cadenas
        }

        // Ejecutamos la consulta
        $stmt->execute();

        // Retornamos los resultados como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Concatenación de cadenas con el operador correcto
        echo 'Error: ' . $e->getMessage() . '<br>';
    }
}


function deleteById($tabla, $id)
{
    try {
        $con = conectar();
        $con->beginTransaction();
        $consulta = "DELETE FROM $tabla WHERE id='$id'";
        $resultado = $con->exec($consulta);
        if ($resultado == 0) $con->rollback();
        if ($resultado != 0) {
            $con->commit();
            return $resultado;
        }
    } catch (PDOException $e) {
        echo 'Error ' + $e->getMessage() + '<br>';
    }
}

function updateDatabyParam($tabla, $paramsYvalues, $condicion, $valueCondicion)
{

    try {
        $con = conectar();
        $con->beginTransaction();
        $newData = [];
        foreach ($paramsYvalues as $key => $value) {
            (is_string($value) ? $newData[] = "$key= '$value'" : $newData[] = "$key= $value");
        };
        $string = implode(',', $newData);
        $consulta = "UPDATE $tabla SET $string WHERE $condicion=$valueCondicion";
        $resultado = $con->exec($consulta);
        if ($resultado == 0) $con->rollback();
        if ($resultado != 0) {
            $con->commit();
            return true;
        } else
            return false;
    } catch (PDOException $e) {
        echo 'Error ' + $e->getMessage() + '<br>';
    }
}

function insert($tabla, $paramsYvalues)
{
    try {
        $con = conectar();
        $con->beginTransaction();

        $valores = array_values($paramsYvalues);
        $colum = implode(',', array_keys($paramsYvalues));

        $placeholders = implode(',', array_fill(0, count($valores), '?'));
        $senetencia = "INSERT INTO $tabla ($colum) VALUES ($placeholders)";

        $stmt = $con->prepare($senetencia);
        $stmt->execute($valores);
        $con->commit();
    } catch (PDOException $e) {

        echo 'ERRRO' . $e->getMessage() . '<br>';
    }
}
/* 
 insert('checkouts', [
    'idUser' => 'alexy',
    'idBook' => 1,
    'dateP' => Date('Y-m-d',time()),
    'dateD' => Date('Y-m-d',time() + 1296000),
    'devuelto' => 0,
    'solicitudAmpliacion' => 0,
]);  */

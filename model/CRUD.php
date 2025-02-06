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
        $sql = "SELECT * FROM $tabla WHERE $param=$value";
        $data = $con->query($sql);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {

        echo 'error ' + $e->getMessage() + '<br>';
    }
}
function getDataById($tabla, $param, $id)
{
    try {
        $con = conectar();
        $sql = "SELECT $param FROM $tabla WHERE id=$id";
        $data = $con->query($sql);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {

        echo 'error ' + $e->getMessage() + '<br>';
    }
}

function deleteById($tabla, $id)
{
    try {
        $con = conectar();
        $con->beginTransaction();
        $consulta = "DELETE FROM $tabla WHERE id=$id";
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
        }
    } catch (PDOException $e) {
        echo 'Error ' + $e->getMessage() + '<br>';
    }
}

// function updateSingleDatabyParam($tabla, $paramsYvalues, $condicion, $valueCondicion)
// {

//     try {
//         $con = conectar();
//         $con->beginTransaction();
//         $newData = [];
//         foreach ($paramsYvalues as $key => $value) {
//             (is_string($value) ? $newData[] = "$key= '$value'" : $newData[] = "$key= $value");
//         };
//         $string = implode(',', $newData);
//         $consulta = "UPDATE $tabla SET $string WHERE $condicion=$valueCondicion";
//         $resultado = $con->exec($consulta);
//         if ($resultado == 0) $con->rollback();
//         if ($resultado != 0) {
//             $con->commit();
//             return true;
//         }
//     } catch (PDOException $e) {
//         echo 'Error ' + $e->getMessage() + '<br>';
//     }
// }

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

<?php
session_start();


require_once "config.php";

/** verificamos a que departamento pertenece la nota, */
$sql_querydep = "SELECT `id_departament`
                FROM `notas`  WHERE id = ".$_GET["id"];

$result_dept = mysqli_fetch_row(mysqli_query($conn,$sql_querydep));
$iddepartam = $result_dept[0];

if($iddepartam==$_SESSION['id_departam'])
{

    $query = "UPDATE `notas` SET reactiva_date=now() WHERE id = ".$_GET["id"];

    if (mysqli_query($conn, $query)) {

        header("location: read.php");
    } else {
         echo "No se pudo activar la nota.";
    }
}
else{
    echo "Usted no tiene permisos para activar la nota.<br><br><br>";
            ?>
        <a href="read.php">
            <input type="submit" class="btn btn-primary btn-block" value="Regresar">
        </a>
        <?php
}
?>
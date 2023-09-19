<?php
session_start();


require_once "config.php";

/** se busca el code para validar el permiso del departamento */
$sql_query = "SELECT code FROM `department` WHERE id=".$_SESSION['id_departam']."";
//echo $sql_query;
                            
$result = mysqli_fetch_row(mysqli_query($conn,$sql_query));
$code_departam = $result[0];

/** se busca el code para validar el permiso del ROL */
$sql_query_rol = "SELECT code FROM `roles` WHERE id=".$_SESSION['id_rol']."";
//echo $sql_query;                     
$result_rol = mysqli_fetch_row(mysqli_query($conn,$sql_query_rol));
$code_roles = $result_rol[0];

if($code_departam=='AC' && ($code_roles=='JF' || $code_roles=='RE')){

    $id = $_GET["id"];

    $sql_reactivar="SELECT reactiva_date FROM `notas` WHERE id = '$id'";
    $result_REACTIVE = mysqli_fetch_row(mysqli_query($conn,$sql_reactivar));
    $reactive_date = $result_REACTIVE[0];

    if($reactive_date!="")
    {
        $query = "UPDATE `notas` SET deleted_date=now(),reactiva_date=null WHERE id = '$id'";

    }
    else{
        $query = "UPDATE `notas` SET deleted_date=now() WHERE id = '$id'";

    }

    if (mysqli_query($conn, $query)) {

        header("location: read.php");
    } else {
         echo "No se pudo eliminar la nota.";
    }

}
else{
    echo "Usted no tiene permisos para eliminar la nota.<br><br><br>";
            ?>
        <a href="read.php">
            <input type="submit" class="btn btn-primary btn-block" value="Regresar">
        </a>
        <?php
}
?>
<?php
    session_start();

    require_once "config.php";
    if(isset($_POST['submit'])){

        $departamento = strtoupper($_POST['departamento']);
        $description = strtoupper(trim($_POST['description']));
        $name_cliente = strtoupper(trim($_POST['name_cliente']));
        $company = strtoupper(trim($_POST['company']));
        $phone = trim($_POST['phone']);
        //$marks = $_POST['marks'];

        if($departamento != "" && $description != "" && $name_cliente != "" && $company != ""  && $phone != "" ){

            $sql_query = "SELECT id FROM `status` WHERE code='PD'";
            //echo $sql_query
                            
            $result = mysqli_fetch_row(mysqli_query($conn,$sql_query));
            $idestatus = $result[0];


            $sql = "INSERT INTO `notas` (`id_departament`, `description`, `name_cliente`, `company`, `phone`, `id_users`
            , `status`)
            VALUES ($departamento,'$description','$name_cliente','$company','$phone',".$_SESSION['id_user'].",$idestatus)";
            //echo $sql; die();

            if (mysqli_query($conn, $sql)) {

                header("location: create.php");
            } else {
                 echo "No se pudo carhar la nota.";
            }
        }else{
            $error="Departamento, la descripción, o el nombre del cliente, o la compañia o el telefono no pueden estar vacios!";
        }
    }
?>
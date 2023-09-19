<?php include 'header.php' ?>

<?php

    // Activa las sesiones
    session_start();
    // Comprueba si existe la sesión 'email', en caso contrario vuelve a la página de login
    if (!isset($_SESSION['email'])) header('Location: login.php');

    include_once "config.php";
    //$sentencia = $conn -> query("select * from notas order by id");

    $sql_query = "SELECT d.name, n.description,n.name_cliente,n.company,n.phone, u.name as nombre_usu
                  FROM `notas` as n
                  INNER JOIN `department` as d ON n.id_departament=d.id
                  INNER JOIN `users` as u ON n.id_users=u.id
                  order by n.id";
    //echo $sql_query;

    $results = mysqli_query($conn,$sql_query);
            
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

        <h2>Bienvenido(a): <?php echo ($_SESSION['name_user']); ?> </h2>
           
        </div>
    </div>
</div>

<?php include 'footer.php' ?>

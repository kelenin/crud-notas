
<?php 

session_start();

require_once "config.php";

/** se busca el code para validar el permiso del departamento */
$sql_query = "SELECT code FROM `department` WHERE id=".$_SESSION['id_departam']."";
//echo $sql_query;
                            
$result = mysqli_fetch_row(mysqli_query($conn,$sql_query));
$code_departam = $result[0];

if($code_departam=='AC'){

include 'header.php' ;

?>

    <section>
        <h1 style="text-align: center;margin: 50px 0;">NOTAS</h1>
        <div class="container">
            <form action="adddata.php" method="post">
            <?php
            if (isset($error)) {
              echo  '<div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>'.$error. '</strong>
                     </div>' ;
            }
           ?>   
               <div class="row">
                    <div class="form-group  col-lg-3">
                        <label for="departamento">Departamento</label>
                        <select name="departamento" id="departamento" class="form-control" required>
                            <option value="">Selecciona</option>
                            <?php
                            require_once "config.php";

                            $sql_query = "SELECT * FROM `department` order by name";
                            if ($result = $conn ->query($sql_query)) {
                                while ($row = $result -> fetch_assoc()) { 
                                    $Id = $row['id'];
                                    $Name = $row['name'];

                                    echo "<option value=".$Id.">".$Name."</option>";

                                }

                            }

                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="description">Descripción</label>
                        <input type="text" name="description" id="description" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="name_cliente">Nombre del Cliente</label>
                        <input type="text" name="name_cliente" id="name_cliente" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="company">Empresa</label>
                        <input type="text" name="company" id="company" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="phone">Telefóno</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>
                    
               </div>
               <div class="form-group col-lg-2" style="display: grid;align-items:  flex-end;">
                        <input type="submit" name="submit" id="submit" class="btn btn-primary" value="GUARDAR">
                </div>
            </form>
        </div>
    </section>
<?php include 'footer.php' ;
}
else{
    echo "Usted no tiene permiso para realizar la carga de las notas.<br><br><br>";
    
    ?>

    <a href="index.php">
        <input type="submit" class="btn btn-primary btn-block" value="Regresar">

    </a>
<?php
}

?>

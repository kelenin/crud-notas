
<?php
session_start();

require_once "config.php";

/** verificamos a que departamento pertenece la nota, para validarlo con el departamento del usuario */
$sql_query = "SELECT `id_departament`
                FROM `notas`  WHERE id = ".$_GET["id"];
//echo $sql_query;

/** se busca el code para validar el permiso del ROL */
$sql_query_rol = "SELECT code FROM `roles` WHERE id=".$_SESSION['id_rol']."";
//echo $sql_query;                     
$result_rol = mysqli_fetch_row(mysqli_query($conn,$sql_query_rol));
$code_roles = $result_rol[0];

if ($result = $conn ->query($sql_query)) 
{
    while ($row = $result -> fetch_assoc()) 
    { 
        $iddepartup = $row['id_departament'];

        if(($_SESSION['id_departam']==$iddepartup) && ($code_roles=='JF' || $code_roles=='RE'))
        {

            include 'header.php' ;
              
            ?>
            <section>
                <h1 style="text-align: center;margin: 50px 0;">Actualizar Notas</h1>
                    <div class="container">
                        <?php 
                        

                        if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
                            $descrip = strtoupper(trim($_POST['descrip']));
                            $statusupd = $_POST['statusupd'];
                            $observacionup = strtoupper(trim($_POST['observacionup']));

                            if($observacionup=='')
                            {
                                $observacionup="";
                            }

                            $sql = "UPDATE `notas` SET `description`= '$descrip', `status`= $statusupd, `observation`= '$observacionup',
                                    `update_date`=now()  
                                    WHERE id= ".$_GET["id"];

                            //echo $sql; die();
                            if (mysqli_query($conn, $sql)) {
                                $errors= "Se actualizaron los datos con exito.";
                                header("location: read.php");
                            } else {
                                $error= "No se pudo actualizar los datos.";
                            }
                        }

                            //require_once "config.php";
                            $sql_query = "SELECT n.id,n.description, s.name as name_status,n.observation,n.status
                                        FROM `notas` as n
                                        INNER JOIN `status` AS s ON n.status=s.id
                                        WHERE n.id = ".$_GET["id"];
                            //echo $sql_query;

                            if ($result = $conn ->query($sql_query)) 
                            {
                                while ($row = $result -> fetch_assoc()) { 
                                    $idup = $row['id'];
                                    $description = $row['description'];
                                    $name_status = $row['name_status'];
                                    $observation = $row['observation'];
                                    $id_status = $row['status'];

                        ?>
                            <form action="" method="post">
                                <div class="row">
                                        <div class="form-group col-lg-4">
                                            <label for="descrip">Descripción</label>
                                            <input type="text" name="descrip" id="descrip" class="form-control" value="<?php echo $description ?>" required>
                                        </div>
                                        <div class="form-group  col-lg-3">
                                            <label for="statusupd">Estado</label>
                                            <select name="statusupd" id="statusupd" class="form-control"  required >
                                                <option value="">Seleccione</option>
                                                <?php
                                                    $sql_query = "SELECT * FROM `status` WHERE code in ('PC','TM') order by name";
                                                    if ($result = $conn ->query($sql_query)) {
                                                        while ($row = $result -> fetch_assoc()) { 
                                                            $Id = $row['id'];
                                                            $Name = $row['name'];

                                                            if($id_status==$Id){
                                                                $selected=" selected";
                                                            }
                                                            else{
                                                                $selected="";
                                                            }

                                                            echo "<option value=".$Id." $selected>".$Name."</option>";



                                                        }

                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="observacionup">Observación</label>
                                            <input type="text" name="observacionup" id="observacionup" class="form-control" value="<?php echo $observation ?>">
                                        </div>
                                        <div class="form-group col-lg-2" style="display: grid;align-items:  flex-end;">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Actualizar Notas">
                                        </div>
                                </div>
                            </form>
                        <?php 
                                }
                            }
                        ?>
                    </div>
            </section>
            <?php include 'footer.php';


        }
        else{
            echo "Usted no tiene permisos para actualizar la nota, ya que no pertenece al departamento o al rol que esta 
            asociado a la nota.<br><br><br>";
            ?>
        <a href="read.php">
            <input type="submit" class="btn btn-primary btn-block" value="Regresar">
        </a>
        <?php
        }
    }
}

?>
 

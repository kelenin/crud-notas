<?php include 'header.php' ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Lista de Notas
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre del Empleado</th>
                            <th scope="col">Nombre del Cliente</th>
                            <th scope="col">Empresa del Cliente</th>
                            <th scope="col">Telefono del Cliente</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Descripción</th>
                            <th scope="col" colspan="2">Opciones</th>

                        </tr>
                        </thead>
                        <tbody>
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

                                //echo $code_departam." ".$code_roles; die();
                                if($code_departam=='AC' && $code_roles=='JF'){

                                    $sql_query = "SELECT n.id,d.name, n.description,n.name_cliente,n.company,n.phone, u.name as nombre_usu,
                                                s.name as name_status, s.code as codestatus,coalesce(n.observation,'') as observ,
                                                n.deleted_date,n.reactiva_date
                                                FROM `notas` as n
                                                INNER JOIN `department` as d ON n.id_departament=d.id
                                                INNER JOIN `users` as u ON n.id_users=u.id
                                                INNER JOIN `status` as s ON n.status=s.id
                                                order by n.id";

                                }
                                else{
                                    

                                    $sql_query = "SELECT n.id,d.name, n.description,n.name_cliente,n.company,n.phone, 
                                                    u.name as nombre_usu,s.name as name_status,s.code as codestatus,
                                                    coalesce(n.observation,'') as observ,n.deleted_date,n.reactiva_date
                                                    FROM `notas` as n
                                                    INNER JOIN `department` as d ON n.id_departament=d.id
                                                    INNER JOIN `users` as u ON n.id_users=u.id
                                                    INNER JOIN `status` as s ON n.status=s.id
                                                    WHERE n.id_departament=".$_SESSION['id_departam']." 
                                                    order by n.id";

                                }
                                //echo $sql_query;
                            
                               if ($result = $conn ->query($sql_query)) {

                                while ($fila = $result -> fetch_assoc()) { 
                                        $Id = $fila['id'];
                                        $name = $fila['name'];
                                        $description = substr($fila['description'],0,10);
                                        $name_cliente = $fila['name_cliente'];
                                        $company = $fila['company'];
                                        $phone = $fila['phone'];
                                        $nombre_usu = $fila['nombre_usu'];
                                        $name_status = $fila['name_status'];
                                        $codestatus = $fila['codestatus'];
                                        $observation = $fila['observ'];
                                        $deleted_date = $fila['deleted_date'];
                                        $reactiva_date = $fila['reactiva_date'];


                            ?>
                            
                            <tr class="trow">
                                <td><?php if($observation!=""){ ?><i class="fa-solid fa-file-contract"></i>&nbsp; <?php echo $Id; } else{ echo $Id; } ?></td>
                                <td><?php echo $nombre_usu; ?></td>
                                <td><?php echo $name_cliente; ?></td>
                                <td><?php echo $company; ?></td>
                                <td><?php echo $phone; ?></td>
                                <td><?php 

                                    if($deleted_date=="" || $reactiva_date!="")
                                    {
                                        if($codestatus=='PD'){ echo '<span style="color:blue">'. $name_status.'</span>';}
                                        elseif($codestatus=='PC'){  echo '<span style="color:Orange">'. $name_status.'</span>';} 
                                        elseif($codestatus=='TM'){  echo '<span style="color:Green">'. $name_status.'</span>';}

                                    }
                                    else
                                    {
                                        echo '<span style="color:red">ELIMINADO</span>';

                                    }
                                    ?>
                                </td>
                                <td><?php echo $description; ?></td>
                                <?php
                                    if($deleted_date=="" || $reactiva_date!="")
                                    {
                                        if($codestatus=='PD' || $codestatus=='PC' || $codestatus=='TM')
                                        { ?>
                                        <td><a href="update.php?id=<?php echo $Id; ?>" class="btn btn-primary">Edit</a></td>
                                        <td><a href="delete.php?id=<?php echo $Id; ?>" onclick="return confirm('Estás seguro que deseas eliminar el registro?');" 
                                             class="btn btn-danger">Delete</a><?php }
                                        else {  echo '<span style="color:red">'. $name_status.'</span>'; } ?></td>
                                    <?php
                                    }
                                    else
                                    { ?>
                                        <td colspan="2" style="background-color:red"><a href="reactivar.php?id=<?php echo $Id; ?>" class="btn btn-danger"
                                        onclick="return confirm('Estás seguro que deseas activar nuevamente la nota?');">Activar</a></td>
                                    <?php
                                    }  ?>
                            </tr>
                            <?php
                                
                                }

                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>

<!doctype html>
<html lang="es">
  <head>
    <title>SISTEMA DE RECICLADOS</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  </head>

<body>

    <?php 
            // Comprobamos que nos llega los datos del formulario
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                // Variables del formulario
                $emails = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
                $contrasenya = isset($_REQUEST['contrasenya']) ? $_REQUEST['contrasenya'] : null;

                if($emails==null || $contrasenya=='')
                {
                   $error="El email y la contraseña no pueden estar vacios";

                }
                else{
                    $emails=strtoupper($emails);

                    require_once "config.php";
                    
                    // buscar el usuario
                    $sql_query = "SELECT * FROM `users` WHERE username='$emails'";
                    //echo $sql_query;

                    $result = mysqli_fetch_row(mysqli_query($conn,$sql_query));
                
                    if ($result) 
                    {

                        // Variables de la base de datos
                        $IdUser = $result[0];
                        $nameuser = $result[1];
                        $correouser = strtoupper($result[2]);
                        $passworduser = password_hash($result[3],PASSWORD_BCRYPT);
                        $iddepart = $result[4];
                        $idrol = $result[5];                        
    
                        // Comprobamos si los datos son correctos
                        if ($correouser == $emails && password_verify($contrasenya,$passworduser)) {
                            // Si son correctos, creamos la sesión
                            session_start();
                            $_SESSION['id_user'] = $IdUser;
                            $_SESSION['email'] = $_REQUEST['email'];
                            $_SESSION['name_user'] = $nameuser;
                            $_SESSION['id_departam'] = $iddepart;
                            $_SESSION['id_rol'] = $idrol;

                            // Redireccionamos a la página segura
                            header('Location: index.php');
                            die();
                        } else {
                            // Si no son correctos, informamos al usuario
                            //echo '<p style="color: red">El email o la contraseña es incorrecta.</p>';
                            $error="El email o la contraseña es incorrecta.";
                        }

                    }
                    else{
                        $error="El correo no se encuentra registrado. Por favor verifique.";
                    }

                    
                }

                
            }
    ?>
     <!-- Formulario Login -->
     <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
          <!-- Margen superior (css personalizado )-->
          <div class="spacing-1"></div>

          <?php
            if (isset($error)) {
              echo  '<div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>'.$error. '</strong>
                     </div>' ;
            }
           ?>    

          <!-- Estructura del formulario -->
            <form method="post">

                <fieldset>

                    <legend class="center">Login</legend>

                    <!-- Caja de texto para usuario -->
                    <label class="sr-only" for="email">Usuario</label>
                    <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    <input type="email" class="form-control" name="email" placeholder="Ingresa tu email">
                    </div>

                    <!-- Div espaciador -->
                    <div class="spacing-2"></div>

                    <!-- Caja de texto para la clave-->
                    <label class="sr-only" for="contrasenya">Contraseña</label>
                    <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                    <input type="password" autocomplete="off" class="form-control" name="contrasenya" placeholder="Ingresa tu usuario">
                    </div>
                    <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <div class="spacing-2"></div>
                        <input type="submit" class="btn btn-primary btn-block" value="Iniciar sesion">
                    </div>
                    </div>

                </fieldset>
            </form>

        </div>
      </div>
    </div>

<footer class="container-fluid bg-blue fixed-bottom">
        <div class="row">
            <div class="col-md text-light text-center py-3">
                Desarrollado por Katheren Salom
            </div>
        </div>
    </footer>
      
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>
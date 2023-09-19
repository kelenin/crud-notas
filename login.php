<!doctype html>
<html lang="es">
  <head>
    <title>SISTEMA DE RECICLADOS</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="bootstrap/css/login.css">
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
     <div class="login">
      <?php
            if (isset($error)) {
              echo  '<div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>'.$error. '</strong>
                     </div>' ;
            }
           ?>  
        <h1>Sistema de Reciclados</h1>

        <form action="" method="post">
            <label for="email">
              <i class="fa fa-user"></i>

            </label>
            <input type="email" name="email"
            placeholder="Usuario"  required>
            <br>
            <label for="contrasenya">
              <i class="fa fa-lock"></i>
            </label>
            <input type="password" name="contrasenya"
            placeholder="Contraseña" required>
            <input type="submit" value="Acceder">
        </form>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
   <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>-->
  </body>
</html>
<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

include "includes/dbconection.php";

   if(isset($_POST['enviarv'])){
       $errors = array();

   if(!ctype_alpha($_POST['nombre']) || empty($_POST['nombre']) ){ 
        $errors[]="Valor invalido nombre";
   }
   if(!ctype_alpha($_POST['paterno']) || empty($_POST['paterno']) ){ 
        $errors[]="Valor invalida apellido paterno";
   }
   if(!ctype_alpha($_POST['materno']) || empty($_POST['materno']) ){ 
        $errors[]="Valor invalido para Apellido materno";
   }
   if(!ctype_alpha($_POST['identificacion']) || empty($_POST['identificacion']) ){ 
        $errors[]="Valor invalido empresa";
   }
   if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)  || empty($_POST['email']) ) {
      $errors[]="Correo no valido";
   }
        
      

   if(count($errors) == 0 ){
        $nombre= $_POST['nombre'];
        $apaterno= $_POST['paterno'];
        $amaterno= $_POST['materno'];
        $evisitantes= $_POST['identificacion'];
        $email= $_POST['email'];
     

$busquedaVisitante=$conexion->query("select email from visitantes where email='".$email."'");
    if($busquedaVisitante->num_rows > 0){
        $errors[] = "El usuario ya existe";

    }else{

       $nva_visitantes=$conexion->query("INSERT INTO visitantes (nombre,a_paterno,a_materno,email,empresa_origen) VALUES ('".$nombre."','".$apaterno."','".$amaterno."','".$email."','".$evisitantes."')");
       header("Location: validarVisitante.php");
        die();  
    }


      unset($_POST['enviarv']);
      unset($_POST['paterno']);
      unset($_POST['materno']);
      unset($_POST['identificacion']);
      unset($_POST['email']);
}
    }

      

 
?>




<!DOCTYPE html>
    <html>
        <head>
            <title>Registro</title>
            <link rel="stylesheet" href="css/bootstrap.min.css">
             <script src="js/jquery/jquery-3.2.1.min.js"></script>
        </head>
        <body>
        <?php

            if(isset($errors) and count($errors) > 0 ){
                foreach($errors as $error){
                    echo '<div style="background:red; font-size:15px; color:white;">'.$error.'</div>';
                    echo"<br>";
                }
            }

        ?>
        <?php include "includes/menu.php"; ?>
            <div class="row">
                <form action="" method="POST">
                    <div class="col-md-6 col-md-push-3">
                    <h3>Registro nuevo visitante</h3>

                    <div class="input-group">
                        <span class="input-group-addon">
                        </span>
                        <input type="text" class="form-control" placeholder="Nombre" id="textNombre" name="nombre">
                    </div>

                     <div class="input-group">
                        <span class="input-group-addon">
                        </span>
                        <input type="text" class="form-control" placeholder="Apellido Paterno" id="textApp" name="paterno">
                    </div>

                     <div class="input-group">
                        <span class="input-group-addon">
                        </span>
                        <input type="text" class="form-control" placeholder="Apellido Materno" id="textApm" name="materno">
                    </div>

                     <div class="input-group">
                        <span class="input-group-addon">
                        </span>
                        <input type="text" class="form-control" placeholder="Email" id="textmail" name="email">
                    </div>

                     <div class="input-group">
                        <span class="input-group-addon">
                        </span>
                        <input type="text" class="form-control" placeholder="De que empresa nos visitas?" id="textempresa" name="identificacion">
                    </div>
                      
                     <input class="input-group"  type="submit" name="enviarv"  value="Registrar" />
                </form>
            </div>
        </body>
    </html>

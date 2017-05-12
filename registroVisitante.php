<?php
include "includes/dbconection.php";

if(isset($_POST['enviarv'])){
    $errors = array();

    if(!ctype_alpha($_POST['nombre']) || empty($_POST['nombre']) ){ 
        $errors[]="Valor invalido para nombre";
    }
    if(!ctype_alpha($_POST['paterno']) || empty($_POST['paterno']) ){ 
        $errors[]="Valor invalido para apellido paterno";
    }
    if(!ctype_alpha($_POST['materno']) || empty($_POST['materno']) ){ 
        $errors[]="Valor invalido para Apellido materno";
    }
    if(!ctype_alpha($_POST['origen']) || empty($_POST['origen']) ){ 
        $errors[]="Valor invalido para Origen";
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)  || empty($_POST['email']) ) {
        $errors[]="correo no valido";
    }



    if(count($errors) == 0 ){
        $nombre= $_POST['nombre'];
        $apaterno= $_POST['paterno'];
        $amaterno= $_POST['materno'];

        $email= $_POST['email'];
        $origen=$_POST['origen'];


        $busquedaVisitante=$conexion->query("select email from visitantes where email='$email'   ");
        if($busquedaVisitante->num_rows > 0){
            echo"el usuario ya existe";

        }else{
            $nva_visitantes=$conexion->query("insert into visitantes(nombre,a_paterno,a_materno,email,empresa_origen) values ('$nombre','$apaterno','$amaterno','$email','$origen')");

            if($nva_visitantes){
            
                $mensaje="¡Visitante registrado!";
            }else{

                $mensaje="Ups algo fallo, no se registro";
            }

            ?> 

            <script type="text/javascript">
                var mensaje = "<?php echo $mensaje ?>"
     
                 window.onload = ver_mensaje;
     
                 function ver_mensaje(){
                    if(mensaje != ""){
                    alert(mensaje)
                    }
                }

            </script>

            <?php

        }




    }


}

?>


<html>
<head>
  
  <title>Registro de Visitante</title>
  
  
  
           <link rel="stylesheet" href="css/formulario.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="estilos-index.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link href="https://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="css/estilos-index.css">
    <link rel="stylesheet" href="css/fontello.css">


  
</head>

<body background="images/bt.png">

<header>
      <?php
          include("includes/menu.html");
        ?>
    </header><br><br>



<?php

        if(isset($errors) and count($errors) > 0 ){
            foreach($errors as $error){
                
               
                echo"<div class='alert alert-info' role='alert' style='height:4px; width:40%; margin:0 auto;'>";
                echo"<strong>¡Cuidado!</strong> ".$error."</div>";

            }
        }
?> 




<br><br>
<div class="form1"> <p><h3>REGISTRO</h3><p>
<form method="POST" ACTION="">
  <div class="form-group">
    <label>Nombre</label>
    <input type="text" class="form-control"  placeholder="Nombre" name="nombre">
  </div>
  <div class="form-group">
    <label>Apellido Paterno</label>
    <input type="text" class="form-control"  placeholder="Apellido Paterno" name="paterno">
  </div>
  <div class="form-group">
    <label>Apellido Materno</label>
    <input type="text" class="form-control"  placeholder="Apellido Materno" name="materno">
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control"  placeholder="Email" name="email">
  </div>
  <div class="form-group">
    <label>Empresa/Origen</label>
    <input type="text" class="form-control"  placeholder="Empresa de Origen" name="origen">
  </div>
 
  <br>
  <br><input type="submit" class="btn-group btn-group-lg" role="group" name="enviarv" value="Registrar" />

      

</form>

</div>






</body>
</html>

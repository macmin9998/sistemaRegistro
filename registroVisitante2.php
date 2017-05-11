<?php
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
   if(!ctype_digit($_POST['identificacion']) || empty($_POST['identificacion']) ){ 
        $errors[]="Valor invalido para Ifentificacion";
   }
   if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)  || empty($_POST['email']) ) {
       $errors[]="correo no valido";
   }
        
      

   if(count($errors) == 0 ){
        $nombre= $_POST['nombre'];
        $apaterno= $_POST['paterno'];
        $amaterno= $_POST['materno'];
        $identificacion= $_POST['identificacion'];
        $email= $_POST['email'];
     

$busquedaVisitante=$conexion->query("select email from visitantes where email='$email'   ");
    if($busquedaVisitante->num_rows > 0){
  echo"el usuario ya existe";

    }else{

       $nva_visitantes=$conexion->query("insert into visitantes(nombre,a_paterno,a_materno,identificacion,email) values ('$nombre','$apaterno','$amaterno','$identificacion','$email')");

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
<html >
<head>
  <meta charset="UTF-8">
  <title>Registro de Visitas</title>
  
  
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body background="images/bt.png">

<?php

                if(isset($errors) and count($errors) > 0 ){
                    foreach($errors as $error){
                        echo $error;
                        echo"<br>";
                    }
                }



?> 



  <h1>Sistema de Visitas Semillero</h1>
<div class="box">
	<a class="button" href="#popup2">Registrarse</a>
</div>

<div id="popup1" class="overlay">





   <div class="popup">
		<h2>Registrar nuevo Usuario</h2>
        




		<a class="close" href="#popup1">&times;</a>
		<div class="content">
			
			 <form class="col s6" method="POST" ACTION="">
      <div class="row">
        <div class="input-field col s3">
          <input placeholder="Nombre" name="nombre" type="text" class="validate">
          <label for="first_name"></label>
        </div>
       <div class="row">
        <div class="input-field col s4">
          <input placeholder="Apellido paterno" name="paterno" type="text" class="validate">
          <label for="first_name"></label>
        </div>
        <div class="row">
        <div class="input-field col s3">
          <input placeholder="Apellido materno" name="materno" type="text" class="validate">
          <label for="first_name"></label>
        </div>
        
        <div class="row">
        <div class="input-field col s3">
          <input placeholder="email" name="email" type="text" class="validate">
          <label for="first_name"></label>
        </div>

        <div class="row">
        <div class="input-field col s3">
          <input placeholder="Numero de identificacion" name="identificacion" type="text" class="validate" >
          <label for="first_name"></label>
        </div>
 	     <input  class="waves-effect waves-light btn" type="submit" name="enviarv" value="Registrar"   />
      
    </form>

		</div>
	</div>


</div>

  
  
</body>
</html>

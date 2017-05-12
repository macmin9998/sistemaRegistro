

<?php

include "includes/dbconection.php";
error_reporting(E_ALL);
ini_set('display_errors', '1');

$empresan=$conexion->query("select id_empresa,nombre as nombre_empresa from Empresa;");

$errors = array();



if(isset($_POST['enviarc'])){
	if(!ctype_alpha($_POST['nombre']) || empty($_POST['nombre']) ){ 

		$errors[]="nombre no valido";
	}
	if(!ctype_alpha($_POST['paterno']) || empty($_POST['paterno'])   ){ 
		$errors[]="apellido paterno no valido";
	}
	if(!ctype_alpha($_POST['materno']) || empty($_POST['materno']) ){ 
		$errors[]="apellido materno no valido";
	}

	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)  || empty($_POST['email'])  )     {
		$errors[]="correo no valido";
	}

	if(!ctype_digit($_POST['empresa']) || empty(  $_POST['empresa']) ){
		$errors[]="empresa no valida";
	}



//inicio de validacion de contrasena

	if(!empty($_POST['contra']) || ctype_alnum($_POST['contra']) ){

        if(strlen($_POST['contra']) < 6){
			$errors[] = "La clave debe tener al menos 6 caracteres";

		}
		if(strlen($_POST['contra']) > 16){
			$errors[] = "La clave no puede tener más de 16 caracteres";

		}
		if (!preg_match('`[a-z]`',$_POST['contra'])){
			$errors[] = "La clave debe tener al menos una letra minúscula";

		}
		if (!preg_match('`[A-Z]`',$_POST['contra'])){
			$errors[] = "La clave debe tener al menos una letra mayúscula";

		}
		if (!preg_match('`[0-9]`',$_POST['contra'])){
			$errors[] = "La clave debe tener al menos un caracter numérico";
		}


	}

	if( empty($_POST['contra']) || !ctype_alnum($_POST['contra'])  ){

		$errors[]="Contraseña no valida";
	}








// fin de la validacion

	if(count($errors) == 0 ){
		$nombre= $_POST['nombre'];
		$paterno= $_POST['paterno'];
		$materno= $_POST['materno'];
		$email= $_POST['email'];
		$empresa= $_POST['empresa'];
		$contra=$_POST['contra'];


		$busquedaCol=$conexion->query("select correo,id_empresa from Colaborador where correo='$email' and id_empresa='$empresa' ");
		if($busquedaCol->num_rows > 0){


			echo"<div class='alert alert-info' role='alert' style='height:4px; width:40%; margin:0 auto;'>";


			echo"<strong>¡Cuidado!</strong> EL usuario ya existe </div>";


		}else{

			$colaboradorn=$conexion->query("insert into Colaborador(nombre,a_paterno,a_materno,correo,id_empresa,clave,tipo,status) values ('$nombre','$paterno','$materno','$email','$empresa','$contra','2','1') ");

			if($colaboradorn){
            	$mensaje="¡Colaborador registrado!";
			}else{
 				$mensaje="Ups algo fallo, no se registro";
			}
            //mostrar el mensaje dentro de script
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
	<title>Registro Colaborador</title>

  <link rel="stylesheet" href="css/formulario.css">

  <link rel="stylesheet" type="text/css" href="css/estilos-index.css">
	 <link rel="stylesheet" href="css/fontello.css">
	 <link href="https://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">
  


  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body background="images/bt.png">
<header>
		<?php
			 include("includes/menu.html");
		  ?>
	 </header><br/><br/><br>

<?php

		  if(isset($errors) and count($errors) > 0 ){
				foreach($errors as $error){
					 
					
					 echo"<div class='alert alert-info' role='alert' style='height:4px; width:40%; margin:0 auto;'>";
					 echo"<strong>¡Cuidado!</strong> ".$error."</div>";

				}
		  }
?> 






<br><br><br>
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
	 <input type="text" class="form-control"  placeholder="Apellido Materno"  name="materno">
  </div>
  <div class="form-group">
	 <label>Email</label>
	 <input type="text" class="form-control"  placeholder="Email" name="email">
  </div><br>
 <div class="form-group">
 <label>Empresa : </label>
 <select  name="empresa">
		<option>Selecciona...</option>
		
						<?php
							 while($em = $empresan->fetch_assoc()){

								  echo'<OPTION VALUE="'.$em['id_empresa'].'">'.$em['nombre_empresa'].'</OPTION>';
							 }
						
						?>


	 </select>
</div><br>
<div class="form-group">
	 <p>¡Recuerda!  La Contrase&ntilde;a debe tener entre 6 y 16 caracteres, al menos una mayuscula, una minuscula y menos un caracter numerico<p>
	 <label>Contrase&ntilde;a</label>
	 <input type="password" class="form-control"  placeholder="Contrase&ntilde;a"  name="contra">
  </div>

  <input type="submit" class="btn-group btn-group-lg" role="group" name="enviarc" value="Registrar" />
 
		

</form>

</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	 <!-- Include all compiled plugins (below), or include individual files as needed -->
	 <script src="js/bootstrap.min.js"></script>


</body>
</html>


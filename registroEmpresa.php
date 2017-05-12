


<?php
include "includes/dbconection.php";

if(isset($_POST['enviarb'])){
    $errors = array();

    if(!ctype_alpha($_POST['nombre']) || empty($_POST['nombre']) ){ 
        $errors[]="Valor invalida nombre";
    }
    if(!ctype_alnum($_POST['rfc']) || empty($_POST['rfc']) || strlen($_POST['rfc']) != 13  ){ 
        $errors[]="rfc no valido";
    }
    if(empty($_POST['direccion']) ){ 
        $errors[]="direccion no valida";
    }







    if(count($errors) == 0 ){
        $nombre= $_POST['nombre'];
        $rfc= $_POST['rfc'];
        $direccion= $_POST['direccion'];


        $nva_empresa=$conexion->query("insert into Empresa(nombre,RFC,direccion) values ('$nombre','$rfc','$direccion')");
        if($nva_empresa){
            $mensaje="¡Empresa registrada!";
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


?>






<html>
	<head >
		 <link rel="stylesheet" href="css/formulario.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/estilos-index.css">
<link rel="stylesheet" href="css/fontello.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<title>    
			REGISTRO DE EMPRESA
		</title>
	</head>
	<body background="images/bt.png">


  <header>
      <?php
          include("includes/menu.html");
        ?>
    </header><br><br><br>
	

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
<form method="POST" action="">
  <div class="form-group">
    <label>Nombre</label>
    <input type="text" class="form-control"  placeholder="Nombre de la empresa" name="nombre">
  </div>
  <div class="form-group">
    <label>RFC</label>
    <input type="text" class="form-control"  placeholder="RFC" name="rfc">
  </div>
   <div class="form-group">
    <label>Dirección</label>
    <input type="text" class="form-control"  placeholder="Direccion" name="direccion">
  </div>
  <br>

  <br><input type="submit" class="btn-group btn-group-lg" role="group" name="enviarb" value="Registrar" />


</form>

</div>




           
						
	</body>
</html>

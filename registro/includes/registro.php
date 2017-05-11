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
   if(!ctype_alpha($_POST['identificacion']) || empty($_POST['identificacion']) ){ 
        $errors[]="Valor invalido empresa";
   }
   if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)  || empty($_POST['email']) ) {
       $errors[]="correo no valido";
   }
        
      

   if(count($errors) == 0 ){
        $nombre= $_POST['nombre'];
        $apaterno= $_POST['paterno'];
        $amaterno= $_POST['materno'];
        $evisitantes= $_POST['identificacion'];
        $email= $_POST['email'];
     

$busquedaVisitante=$dbconection->query("select email from visitantes where email='$email'   ");
    if($busquedaVisitante->num_rows > 0){
  echo"el usuario ya existe";

    }else{

       $nva_visitantes=$dbconection->query("insert into visitantes(nombre,a_paterno,a_materno,empresa_origen,email) values ('$nombre','$apaterno','$amaterno','$evisitantes','$email')");

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

	 
	 <link rel="stylesheet" href="../css/bootstrap.min.css">
	 <script src="../js/jquery/jquery-3.2.1.min.js"></script>
</head>
<body>
<?php include "menu.php";
    ?>
      <div class="row">
         
         <div class="col-md-6 col-md-push-3">
                <h3>Registro nuevo visitante</h3>

            <div class="input-group">
            	<span class="input-group-addon">Nombre
            	</span>
            	<input type="text" class="form-control" placeholder="Nombre" id="textNombre" name="">

            </div>

             <div class="input-group">
            	<span class="input-group-addon">Apellido Paterno
            	</span>
            	<input type="text" class="form-control" placeholder="Apellido Paterno" id="textApp" name="">

            </div>

             <div class="input-group">
            	<span class="input-group-addon">Apellido Materno
            	</span>
            	<input type="text" class="form-control" placeholder="Apellido Materno" id="textApm" name="">

            </div>

             <div class="input-group">
            	<span class="input-group-addon">Email
            	</span>
            	<input type="text" class="form-control" placeholder="Email" id="textmail" name="">

            </div>

             <div class="input-group">
            	<span class="input-group-addon">Empresa
            	</span>
            	<input type="text" class="form-control" placeholder="De que empresa nos visitas?" id="textempresa" name="">

            </div>
             <input  class="" type="submit" name="enviarv" value="Registrar"/>



         	
         </div>
      	


      </div>

</body>
</html>
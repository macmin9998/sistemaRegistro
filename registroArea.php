

<?php

include "includes/dbconection.php";

$empresan=$conexion->query("select id_empresa,nombre as nombre_empresa from Empresa;");

$colaborador=$conexion->query("select id_colaborador,nombre as nombre_cola from Colaborador");

if(isset($_POST['enviara'])){
     $errors = array();

     if(!ctype_alpha($_POST['nombre']) || empty($_POST['nombre']) ){ 
         $errors[]="Valor invalida nombre";
     }

     if(!ctype_alpha($_POST['puesto']) || empty($_POST['puesto']) ){ 
         $errors[]="Valor invalido para puesto";

     }

     if(!ctype_digit($_POST['empresa']) || empty($_POST['empresa']) ){ 
         $errors[]="Valor invalido para empresa";

     }
     if(!ctype_digit($_POST['colaborador']) || empty($_POST['colaborador']) ){ 
         $errors[]="Valor invalido para colaborador";

     }



     if(count($errors) == 0 ){
         $nombre= $_POST['nombre'];
         $puesto= $_POST['puesto'];
         $empresa= $_POST['empresa'];
         $colab= $_POST['colaborador'];
    
     
        
        
         $arean=$conexion->query("insert into Area(nombre_area,puesto,id_empresa,id_colab) values ('$nombre','$puesto','$empresa','$colab')");

     
     }




}

?>


<html>
<head>
	<title>Registrar Area</title>
  <link rel="stylesheet" href="css/formulario.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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








<br><br>
<div class="form1"> <p><h3>REGISTRO</h3><p>
<form method="POST" action="">
  <div class="form-group">
    <label>Nombre del Area</label>
    <input type="text" class="form-control"  placeholder="Nombre del Area" name="nombre">
  </div>
  <div class="form-group">
    <label>Puesto</label>
    <input type="text" class="form-control"  placeholder="Puesto" name="puesto">
  </div>
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
</div>
<br>
<div  class="form-group" >
<label>Colaborador : </label>
 <select  name="colaborador">
      <option>Colaborador...</option>
                  <?php
                      while($col = $colaborador->fetch_assoc()){
                          echo'<OPTION VALUE="'.$col['id_colaborador'].'">'.$col['nombre_cola'].'</OPTION>';
                      }
                  
                   ?>
    </select><BR>
</div>
  <br>
  <br><input type="submit" class="btn-group btn-group-lg" role="group" name="enviara" value="Registrar" />


</form>

</div>






</body>
</html>

<?php

include "includes/dbconection.php";


if(isset($_POST['btn_enviar'])){

$errors = array();

if(!ctype_alpha($_POST['nombre_txt']) || empty($_POST['nombre_txt']) ){ 
        $errors[]="Nombre de Colaborador no valido";
}



if(count($errors) == 0 ){

$nombreB=$_POST['nombre_txt'];
$busqueda=$conexion->query("select id_colaborador, nombre,a_paterno,a_materno,status, correo,clave from Colaborador where  nombre like '%".$nombreB."%' ");
                                          
}    





}


if(isset($_POST['btn_baja'])){
  
  $id_eliminar=$_POST['id_text'];


$eliminar=$conexion->query(" update Colaborador  SET status=0 where id_colaborador=$id_eliminar");

?>
<script type="text/javascript">
  alert("Colaborador dado de baja");
</script>
<?php


}else if(isset($_POST['btn_modificar'])) {

$id_eliminar=$_POST['id_text'];

$nombre=$_POST['nombre_n'];
$paterno=$_POST['paterno_n'];
$materno=$_POST['materno_n'];
$correo=$_POST['correo_n'];
$clave=$_POST['clave_n'];
$status=$_POST['select_txt1'];


$modificar=$conexion->query(" update Colaborador  SET  nombre='$nombre', a_paterno='$paterno',a_materno='$materno',correo='$correo',
clave='$clave', status=$status where id_colaborador=$id_eliminar");





}






?>



<!DOCTYPE html>
<html>
<head>
  <title></title>

<link rel="stylesheet" href="css/formulario.css">
<link rel="stylesheet" href="css/tabla.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="css/estilos-index.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link href="https://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">

</head>
<body   background="images/bt.png">


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
<br>

<div class="form1">

  <form method="POST" action="">
  
  <input type="text"  placeholder="Nombre del Colaborador" name="nombre_txt">
  <input type="submit" name="btn_enviar" value="Buscar">
  </div><br/><br/>

  </form>



  <?php
         if(isset($busqueda)){

                           
                             if($busqueda->num_rows > 0){
    ?>
             <div class="formula">
                          <table class="table" >
                          <tr class="active">
                         
                          <td><b>NOMBRE</b></td>
                          <td><b>A.PATERNO</b></td>
                          <td><b>A.MATERNO</b></td>
                          <td><b>CORREO</b></td>
                          <td><b>CLAVE</b></td>
                          <td><b>STATUS</b></td>
                          <td><b>     </b></td> 
                          <td><b>     </b></td> 

                          </tr>                           
<?php
                  
                          while($aux=$busqueda->fetch_assoc()) {
                  echo "<tr>";
                 
                 ?>
                   <form method="POST" action="">

                 <?php
                  echo "<td><input type='text' name='nombre_n'  value='{$aux['nombre']}'> </td>";
                  echo "<td><input type='text' name='paterno_n'  value='{$aux['a_paterno']}'> </td>";
                  echo "<td> <input type='text' name='materno_n'  value='{$aux['a_materno']}'>   </td>";
                  echo "<td><input type='text' name='correo_n'  value='{$aux['correo']} '> </td>";
                  echo "<td><input type='text' name='clave_n'  value='{$aux['clave']}' > </td>";
                  if($aux['status'] == 1 ){
                        echo "<td>";
 

                        echo"<select name='select_txt1'>";
                             echo"    <option value='1'> Activo </option>";
                                echo" <option value='0'> Inactivo </option>";
                        echo"</select>";

                       echo" </td>";
                  }else{
                   echo "<td>";
                   echo"<select name='select_txt1'>";
                   echo"    <option value='0'> Inactivo </option>";
                  echo" <option value='1'> Activo </option>";
                   echo"</select>";

                   echo"</td>";
                  }
                  
                

                  echo "<input name='id_text' type='hidden' value='{$aux['id_colaborador']}' >";
                   
                  echo "<td><input type='submit' value='Actualizar' name='btn_modificar' >  </td>  ";
                
                  echo "</tr>";
                   ?>
                  </form>
                   <?php
              
          

                        }




                             }
                             else{
                              
                                  echo"<div class='alert alert-info' role='alert' style='height:4px; width:40%; margin:0 auto;'>";
                                  echo"<strong>¡No hay resultado para tu busqueda !</strong>  </div>";
                             }

                         }
                         

    ?> 

    </table>
    </div>
   

 







</body>
</html>
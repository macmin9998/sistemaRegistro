<?php
  include "includes/dbconection.php";
    
  $aux_nombre=$_POST['PersonaVisitada']; 
  $aux_boton=$_POST['valor_boton'];
  $aux_inicio=$_POST['FechaInicio'];
  $aux_final=$_POST['FechaFinal'];
  $aux_contador=0; 
echo $aux_nombre;
?>
<!DOCTYPE html>
<html>
	<head>
    <title>
		  Reporte de visitas
		</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">		
	  <link rel="stylesheet" href="css/estilos-pdf.css">	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <!-- agregado -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 

  </head>

  <body background="bt.png">
	  <div id="HTMLtoPDF">
		  <?php
			  if($aux_boton==1)
        {			
			     /*validaciones*/
          $errors = array();
          if(empty($aux_nombre))
          { 
           $errors[]="nombre no valido";
          }
          if(!empty($aux_inicio))
          { 
           $errors[]="dato incorrecto en fecha de inicio";
          }
          if(!empty($aux_final))
          { 
           $errors[]="dato incorrecto en fecha final";
          }
          if(isset($errors) and count($errors) > 0 )
          {
            foreach($errors as $error)
            {     
              echo"<div class='alert alert-info' role='alert' style='height:4px; width:40%; margin:0 auto;'>";
              echo"<strong>¡Cuidado!</strong> ".$error."</div>";

            }
          }
          if(count($errors) == 0 )
          {

            $consulta=$conexion->query("select Colaborador.nombre,Colaborador.a_paterno as ca,visita.fecha,visita.hora,visitantes.nombre as vn, visitantes.a_paterno, visitantes.empresa_origen from Colaborador inner join visita on Colaborador.id_colaborador = visita.id_colaborador inner join visitantes on visitantes.id_visitante = visita.id_visitante where Colaborador.correo='{$aux_nombre}'");
              
            if($consulta->num_rows>0)
            {
		  ?>
              <center>
                <h2>Reporte de visitas</h2>
			          <table border="5" class="tabla-estilo">
                  <tr>     
                    <td><b><p>Persona visitada</p></b></td>
                   <td><b><p>Cita</p></b></td> 
                    <td><b><p>Visitante</p></b></td>
                    <td><b><p>empresa</p></b></td>
                  </tr>   
                  <?php
                  while($aux=$consulta->fetch_assoc()) 
                  {
                    echo "<tr>";
                    echo "<td>{$aux['nombre']} {$aux['ca']}</td>";     
                    echo "<td>{$aux['fecha']} {$aux['hora']}</td>";
                    echo "<td>{$aux['vn']} {$aux['a_paterno']}</td>";
                    echo "<td>{$aux['empresa_origen']}</td>";
                    echo "</tr>";
                  }
                  ?>    
                </table>
                <br>
                <br>
                  <form>
                    <input type="button" onclick="HTMLtoPDF()" value="Reporte en PDF"> 
                  </form> 

                  <a href="index.php">REGRESAR A PANTALLA DE INICIO</a>    
              </center> 


              <?php

              
            
 		        }
            else{
                 echo"<div class='alert alert-info' role='alert' style='height:4px; width:40%; margin:0 auto;'>";
                 echo"<strong>¡Cuidado!</strong> La persona no tiene visitas</div>";
                }
            }  
        } 

		  if($aux_boton==2)
	    {	
        $errors = array();

        if(empty($aux_inicio))
          { 
           $errors[]="La fecha de inicio esta vacia";
          }
        if(empty($aux_final))
          { 
           $errors[]="La fecha final esta vacia";
          }
        if(!empty($aux_nombre))
          { 
           $errors[]="El campo usuario debe de estar vacio";
          }
        if(isset($errors) and count($errors) > 0 )
          {
            foreach($errors as $error)
            {     
              echo"<div class='alert alert-info' role='alert' style='height:4px; width:40%; margin:0 auto;'>";
              echo"<strong>¡Cuidado!</strong> ".$error."</div>";

            }
          }
        if(count($errors) == 0 )
          {
		        $partesinicio=explode("/",$aux_inicio);
		        $Inicio="{$partesinicio[2]}-{$partesinicio[0]}-{$partesinicio[1]}";
		
		        $partesfinal=explode("/",$aux_final);
		        $Final="{$partesfinal[2]}-{$partesfinal[0]}-{$partesfinal[1]}";
		
	    

            $consulta_fechas=$conexion->query("select Colaborador.id_colaborador, Colaborador.nombre,Colaborador.a_paterno as ca,visita.fecha,visita.hora,visitantes.nombre as vnombre,visitantes.a_paterno, visitantes.empresa_origen from visitantes inner join visita on visitantes.id_visitante = visita.id_visitante inner join Colaborador on visita.id_colaborador=Colaborador.id_colaborador where visita.fecha BETWEEN '{$Inicio}' AND '{$Final}'");  

		        if($consulta_fechas->num_rows>0)
            {
		          
	           ?>
		          <center>
              <h2>Reporte de visitas</h2>
		          <table border="5" class="tabla-estilo">
                <tr>     
		              <td><b><p>Cita</p></b></td> 
                  <td><b><p>Persona visitada</p></b></td>                
                  <td><b><p>Visitante</p></b></td>
                  <td><b><p>empresa</p></b></td>
                </tr>   
                <?php
                  while($aux_fechas=$consulta_fechas->fetch_assoc()) 
                 {
                    echo "<tr>";
		                echo "<td>{$aux_fechas['fecha']} {$aux_fechas['hora']}</td>";
                    echo "<td>{$aux_fechas['nombre']} {$aux_fechas['ca']}</td>";     
                    echo "<td>{$aux_fechas['vnombre']} {$aux_fechas['a_paterno']}</td>";
                    echo "<td>{$aux_fechas['empresa_origen']}</td>";
                    echo "</tr>";
                  }
                ?>    
              </table> 
              <br>
              <br>
              <form>
                <input type="button" onclick="HTMLtoPDF()" value="Reporte en PDF"> 
              </form>
               <a href="index.php">REGRESAR A PANTALLA DE INICIO</a>  
		        </center>
	        <?php
        }
        else{
              echo"<div class='alert alert-info' role='alert' style='height:4px; width:40%; margin:0 auto;'>";
              echo"<strong>¡Cuidado!</strong> No hay visitas en esas fechas</div>";
            }    
	       }
      }

        if($aux_boton==3)
        {     
           /*validaciones*/
          $errors = array();
          if(empty($aux_nombre))
          { 
           $errors[]="nombre no valido";
          }
          if(empty($aux_inicio))
          { 
           $errors[]="dato incorrecto en fecha de inicio";
          }
          if(empty($aux_final))
          { 
           $errors[]="dato incorrecto en fecha final";
          }
          if(isset($errors) and count($errors) > 0 )
          {
            foreach($errors as $error)
            {     
              echo"<div class='alert alert-info' role='alert' style='height:4px; width:40%; margin:0 auto;'>";
              echo"<strong>¡Cuidado!</strong> ".$error."</div>";

            }
          }
          if(count($errors) == 0 )
          {

            $partesinicio=explode("/",$aux_inicio);
            $Inicio="{$partesinicio[2]}-{$partesinicio[0]}-{$partesinicio[1]}";
    
            $partesfinal=explode("/",$aux_final);
            $Final="{$partesfinal[2]}-{$partesfinal[0]}-{$partesfinal[1]}";


            $consulta_completa=$conexion->query("select Colaborador.nombre,Colaborador.a_paterno as ca,visita.fecha,visita.hora,visitantes.nombre as vn, visitantes.a_paterno, visitantes.empresa_origen from Colaborador inner join visita on Colaborador.id_colaborador = visita.id_colaborador inner join visitantes on visitantes.id_visitante = visita.id_visitante where visita.fecha BETWEEN '{$Inicio}' AND '{$Final}' AND Colaborador.correo='{$aux_nombre}'");

            if($consulta_completa->num_rows>0)
            {
      ?>
              <center>
                <h2>Reporte de visitas</h2>
                <table border="5" class="tabla-estilo">
                  <tr>     
                    <td><b><p>Persona visitada</p></b></td>
                   <td><b><p>Cita</p></b></td> 
                    <td><b><p>Visitante</p></b></td>
                    <td><b><p>empresa</p></b></td>
                  </tr>   
                  <?php
                  while($aux_total=$consulta_completa->fetch_assoc()) 
                  {
                    echo "<tr>";
                    echo "<td>{$aux_total['nombre']} {$aux_total['ca']}</td>";     
                    echo "<td>{$aux_total['fecha']} {$aux_total['hora']}</td>";
                    echo "<td>{$aux_total['vn']} {$aux_total['a_paterno']}</td>";
                    echo "<td>{$aux_total['empresa_origen']}</td>";
                    echo "</tr>";
                  }
                  ?>    
                </table>
                <br>
                <br>
                  <form>
                    <input type="button" onclick="HTMLtoPDF()" value="Reporte en PDF"> 
                  </form>   
                   <a href="index.php">REGRESAR A PANTALLA DE INICIO</a>    
              </center> 
              <?php       
            }
            else{
                 echo"<div class='alert alert-info' role='alert' style='height:4px; width:40%; margin:0 auto;'>";
                 echo"<strong>¡Cuidado!</strong> La persona no tiene visitas</div>";
                }
            }  
        } 
          ?>           	
	  </div>
	  <script src="js/jspdf.js"></script>
		<script src="js/jquery-2.1.3.js"></script>
		<script src="js/pdfFromHTML.js"></script>
	</body>
</html>

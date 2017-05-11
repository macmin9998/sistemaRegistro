<?php
	include "includes/dbconexion.php";
	$consulta=$conexion->query("select colaborador.id, colaborador.nombre,visita.fecha,visita.hora,visitantes.nombre as vnombre,visitantes.a_paterno,visitantes.a_materno from visitantes inner join visita on visitantes.id_visitante = visita.id_visitante inner join colaborador on visita.id_colaborador=colaborador.id where colaborador.nombre='{$_POST['PersonaVisitada']}'");	

$consulta_fechas=$conexion->query("select colaborador.id, colaborador.nombre,visita.fecha,visita.hora,visitantes.nombre as vnombre,visitantes.a_paterno,visitantes.a_materno from visitantes inner join visita on visitantes.id_visitante = visita.id_visitante inner join colaborador on visita.id_colaborador=colaborador.id where visita.fecha BETWEEN '2017/05/08' AND '2017/06/20'");	



?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrad.min.css" media="screen">
  		<title>jQuery UI Datepicker - Default functionality</title>
  		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    	<link rel="stylesheet" href="boostrap/estilo.css">
    	<link rel="stylesheet" href="boostrap/estilos.css">
  		<link rel="stylesheet" href="/resources/demos/style.css">
  		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  		<script>
  			$( function() {
    		$( "#datepicker" ).datepicker();
			 } );

  			$( function() {
    		$( "#datepicker1" ).datepicker();
  			} );
		</script>
	</head>
	<body>
		<form class="divRegistro" method='POST'>
			Persona Visitada: 
			<input name="PersonaVisitada" type="text">
			<br>
			<br>
			Fecha inicial: 
			<input name="FechaInicio" type="text" id="datepicker">
			<br>
			<br>
			Fecha final:
			<input name="FechaFinal" type="text" id="datepicker1">
			<br>
			<br>
			<input name="BusquedaNombre" type="radio" value=1>Busqueda por nombre 
			<br>
			<br>
			<input name="BusquedaNombre" type="radio" value=2>Busqueda por rango de fechas 
			<br>
			<br>
			<INPUT TYPE=submit NAME=ok VALUE="Buscar">
			
		</form>
		<?php

 		$valorboton=$_POST['BusquedaNombre'];

		$partesinicio=explode("/",$_POST['FechaInicio']);
		$Inicio="{$partesinicio[2]}-{$partesinicio[0]}-{$partesinicio[1]}";
	
		$partesfinal=explode("/",$_POST['FechaFinal']);
		$Final="{$partesfinal[2]}-{$partesfinal[0]}-{$partesfinal[1]}";


		if($valorboton==1){
		if(isset($consulta)){
                             if($consulta->num_rows > 0){
                           //muestra tabla
         	?>
		<div class="container">
			<table class="table" class="table table-striped table-hover" align="center" border="5">
            	<tr class="active">     
                    <td><b>PERSONA VISITADA</b></td>
                    <td><b>DÍA</b></td>
	            <td><b>HORA</b></td>
                    <td><b>VISITANTE</b></td>
                    <td><b>A.PATERNO</b></td>
                    <td><b>A.MATERNO</b></td>                              
           	 </tr>         
       
       		<?php
                        $contador=0;
                        while($aux=$consulta->fetch_assoc()) {
               			    echo "<tr>";
                        echo "<td>{$aux['nombre']}</td>";     
               			    echo "<td>{$aux['fecha']}</td>";
               			    echo "<td>{$aux['hora']}</td>";
                        echo "<td>{$aux['vnombre']}</td>";
                        echo "<td>{$aux['a_paterno']}</td>";
                        echo "<td>{$aux['a_materno']}</td>"; 	
                        echo "</tr>";
                        if($contador==0){
                        echo"<a href='pdf.php?nombrev={$aux['id']}''>VER INFORME</a>";
                          $contador=$contador+1;
                        }
                        }
              ?>                        
         </table>
                      
                        
                      
         </div>
       <?php		          
               	        }                
                             }	
				}		   
               	         ?>
		<?php
		
		if($valorboton==2){
		if(isset($consulta_fechas)){
                if($consulta_fechas->num_rows > 0){
         	?>
		<div class="container">
		<table class="table" class="table table-striped table-hover" align="center" border="5">
            	<tr class="active">  
		<td><b>DÍA</b></td>   
                  <td><b>PERSONA VISITADA</b></td>
                   <td><b>HORA</b></td>  
                    <td><b>VISITANTE</b></td>
                    <td><b>A.PATERNO</b></td>
                    <td><b>A.MATERNO</b></td>                              
           	 </tr>         
       
       		<?php
                        $contador1=0;
                        while($aux_fecha=$consulta_fechas->fetch_assoc()) {
                        echo "<tr>";
			echo "<td>{$aux_fecha['fecha']}</td>";
                        echo "<td>{$aux_fecha['nombre']}</td>";     
                        echo "<td>{$aux_fecha['hora']}</td>";
                        echo "<td>{$aux_fecha['vnombre']}</td>";
                        echo "<td>{$aux_fecha['a_paterno']}</td>";
                        echo "<td>{$aux_fecha['a_materno']}</td>"; 	
                        echo "</tr>";
                        if($contador1==0){
                        echo"<a href='pdf.php?nombrev={$aux['id']}''>VER INFORME</a>";
                          $contador1=$contador1+1;
                        }
                        }
              ?>                        
         </table>
                      
                        
                      
         </div>
       <?php		          
               	        }                
                             }	
				}		   
               	         ?>

	</body>		
</html>


<?php
	ini_set('display_errors', 'on');  
	$usuario=$_POST['usuario'];
	$clave=$_POST['clave'];

	$conexion=new mysqli("localhost","root","123","sistema");

	$busqueda=$conexion->query("select * from Colaborador where correo='{$usuario}' and clave='{$clave}'");

	if(isset($busqueda))
	{
      if($busqueda->num_rows > 0)
      {
      	$aux_busqueda=$busqueda->fetch_assoc();
      	if($aux_busqueda['tipo']==1)
      	{
		header("location:index.php");
		}
		else{
	    	
	    $id=$aux_busqueda['id_colaborador'];
	    $consulta=$conexion->query("select visita.fecha,visita.hora,visitantes.nombre, visitantes.a_paterno, visitantes.empresa_origen 
	    	from visita  inner join visitantes on visitantes.id_visitante = visita.id_visitante 
	    	where visita.id_colaborador='{$id}' and visita.fecha =curdate()");



?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>VISITAS</title>
			<link rel="stylesheet" href="css/estilos-login-tabla.css">
			<link rel="stylesheet" href="css/estilos-reporte.css">
    		
		</head>
		<body background="bt.png">
	    	<center>
                <h2>Tus visitas del día</h2>
			    <table border="5" class="tabla-estilo">
                  <tr>     
                   <td><b><p>Cita</p></b></td> 
                    <td><b><p>Visitante</p></b></td>
                    <td><b><p>empresa</p></b></td>
                  </tr>   
                  <?php
                  while($aux=$consulta->fetch_assoc()) 
                  {
                    echo "<tr>";  
                    echo "<td>{$aux['hora']}</td>";
                    echo "<td>{$aux['nombre']} {$aux['a_paterno']}</td>";
                    echo "<td>{$aux['empresa_origen']}</td>";
                    echo "</tr>";
                  }
                  ?>    
                </table>
                <br>
                <br>
                <br>
               	<form action="login.html">
               		<input type="submit" name="ok" value="Cerrar Sesión ">
               	</form>
        	</center>

	  <?php
	       }
	  }
	    
	  else{
	  	header("location:error.html");
	  }
	}
?>
		</body>
	</html>

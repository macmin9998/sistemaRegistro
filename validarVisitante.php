<?php
 include "includes/dbconection.php";

   if(isset($_POST['buscarb'])){
       $errors = array();

   if(   empty($_POST['correo'])  ){ 
        $errors[]="correo no valido <a href='registro.php'>Registrate</a>";

   }



   if(count($errors) == 0 ){
        
      $email=$_POST['correo'];
        
    $busquedaVisitante=$conexion->query("select id_visitante,nombre,a_paterno,a_materno,empresa_origen,email from visitantes where email='$email'");




    
    }  



   

    
   } 



 
?>






<html>
	<head id="main-header">
		      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
           <link rel="stylesheet" href="css/bootstrap.min.css">


		      
         
          

  		    <!-- Compiled and minified JavaScript -->
  		    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
        

        <link rel="stylesheet" href="css/formulario.css">
<link rel="stylesheet" href="css/tablaVisit.css">


    <link rel="stylesheet" type="text/css" href="css/estilos-index.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link href="https://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet"> 

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		       <title>REGISTRO DE VISITAS</title>
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
                        echo $error;
                        echo"<br>";
                    }
                }



      ?> 


           <!-- Inicio formulario -->

                
        <br>
        <div class="form1">
   
           <div class="card-pane"></div>
            
           <form class="col s6" method="POST" ACTION="">
           <div class="row">
           <div class="input-field col s6">
           <input  name="correo"  type="text" class="validate" placeholder="Ingresa correo/visitante ">
           
           </div>
          </div>
 	
         <br>
          <input  class="waves-effect waves-light btn" type="submit" name="buscarb" value="Buscar"/>
      
          </form>
       </div>

        
           <!--Fin del formulario -->


    <?php
         if(isset($busquedaVisitante)){
                           
                             if($busquedaVisitante->num_rows > 0){
    ?>
          <div class="container">
                          <table class="table" class="table table-striped table-hover " >
                          <tr class="active">
                         
                      

                          <h1><font color="white"> Bienvenido </font></h1>

                          </tr>                           
<?php
                          while($aux=$busquedaVisitante->fetch_assoc()) {
                         echo "<tr>";
                         
                        
                        echo ucwords("<td>{$aux['nombre']} {$aux['a_paterno']} {$aux['a_materno']}</td>");
                   
                    
                        echo "<td><a href='registroVisita.php?idvisitante={$aux['id_visitante']}'>Registrar Visita</a></td>";
                          echo "<td><a href='agendarVisita.php?idvisitante={$aux['id_visitante']}'>Agendar cita</a></td>";
                        echo "</tr>";

                   
          

                    }



                             }
                             else{
                              echo"no existe el visitante <a href='registro.php'>Registrate</a> ";
                             }

                         }
                         

    ?>




           
						
	</body>
</html>

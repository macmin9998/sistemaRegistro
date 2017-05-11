<?php
include "dbconection.php";
include "peticion.php";
$empresan=$dbconection->query("select id_empresa,nombre as nombre_empresa from Empresa;");
$id= htmlentities($_GET['idvisitante']);
$BusquedaVisitante=$dbconection->query("select id_visitante,nombre,a_paterno,a_materno,empresa_origen,email from visitantes where id_visitante='".$id."'");

$visitante = $BusquedaVisitante->fetch_assoc();
$visitante['nombre']

?>



<!DOCTYPE html>
<html>
<head>
          


	<title> prueba</title>

	 
	 <link rel="stylesheet" href="../css/bootstrap.min.css">
	 <script src="../js/jquery/jquery-3.2.1.min.js"></script>
</head>
<body>
 <?php include "menu.php";
    ?>
      <div class="row">
         
         <div class="col-md-6 col-md-push-3">
            <h3><?php echo ucwords ($visitante['nombre']); ?> a quien visitas?</h3>

            <div class="input-group">
            	
             <input type="hidden" class="form-control" placeholder="Nombre" id="textNombre" value="<?php echo ($_GET['idvisitante'] ) ?>" name="">

            </div>

            <div class="input-group">
            	<span class="input-group-addon">Hora
            	</span>
            	<input type="text" class="form-control" placeholder="Hora" id="textHora" value="<?php $time = time();echo date("H:i", $time);?>" name="">

            </div>

            <div class="input-group">
            	<span class="input-group-addon">Fecha
            	</span>
            	<input type="text" class="form-control" placeholder="Fecha" id="textfecha" value="<?php $time = time();echo date("d-m-Y" , $time);?>"  name="">

            </div>

             
             
            <div class="input-group">
            	<span class="input-group-addon">Empresa
            	</span>
            	<select class="form-control" id="empresa">
            	  <option value="0">
            	  	Seleccionar Empresa
            	  </option>
            	  
                  <?php
                    while($em = $empresan->fetch_assoc())
                    {
                     echo'<OPTION VALUE="'.$em['id_empresa'].'">'.$em['nombre_empresa'].'</OPTION>';
                    }
                  
                  ?>
            		

            	</select>

            </div>

              <div class="input-group">
                 <span class="input-group-addon">Colaborador</span>
                 <select class="form-control" id="colaborador" disabled=""></select>
              	

              </div>


         	
        </div>
      	


      </div>
         <script type="text/javascript"> 
            $(document).ready(function(){
             $("#empresa").change(function(){
               $.post("",{
                Ws:"getColaborador",
                Empresa:$('#empresa').val()

               },function(){
                // direccion, parametros en formato json, funcion para captar resultados de la peticion, formato de la respuesta que va a recibir

               },"json");

             });
            });
           
         </script>

</body>
</html>
<?php
 include "includes/dbconection.php";
date_default_timezone_set('America/Mexico_City');


$empresan=$conexion->query("select id_empresa,nombre as nombre_empresa from Empresa;");


    if(isset($_POST['empresa'])  ){
        
        $empresa=$_POST['empresa'];

        $colaborador=$conexion->query("select id_colaborador,nombre,a_paterno,a_materno,correo from Colaborador where id_empresa='".$empresa."'");

    }



    $id= htmlentities($_GET['idvisitante']);

    $BusquedaVisitante=$conexion->query("select id_visitante,nombre,a_paterno,a_materno,empresa_origen,email from visitantes where id_visitante='".$id."'");

   
  while($auxnombre= $BusquedaVisitante->fetch_assoc()){

        $nombreUsuario=$auxnombre['nombre']; 

  }


   



if(isset($_POST['enviarb'])) {

    $errors = array();


if(!ctype_digit($_POST['colaborador']) || empty($_POST['colaborador']) ){ 


           $errors[]="Valor invalido para colaborador";

       }





    if(!isset($_POST['fecha']) || empty($_POST['fecha']) )  { 


           $errors[]="La fecha es requerida ";

       }

     if(($_POST['hora']==0) ){ 


           $errors[]="La hora es requerida";

       }
      

   


    if (count($errors) == 0) {
        $visitante = $_POST['idvisitante'];
        $fecha = explode('-',$_POST['fecha']);
        $fechaInsert = $fecha[2]."-".$fecha[1]."-".$fecha[0];
        $hora = $_POST['hora'];
        $colaborador = $_POST['colaborador'];

        //$BusquedaVisitante=$dbconection->query("select id_visitante,nombre,a_paterno,a_materno,empresa_origen,email from visitantes where id_visitante='".$visitante."'");
        //var_dump($_POST);
        

       $consultaFecha=$conexion->query("select fecha,id_colaborador,hora from visita where id_colaborador='".$colaborador."' and fecha='".$fechaInsert."' and hora='".$hora."' ");

       if($consultaFecha->num_rows > 0){
                echo "<br><br><br>"; 
                echo"<div class='alert alert-info' role='alert' style='height:4px; width:40%; margin:0 auto;'>";
                echo"<strong> ¡ La cita ya existe !  </strong> </div>";
               unset($empresa);
   

       }else{
       
      $buscaCol= $conexion->query("select nombre,correo from Colaborador where id_colaborador=$colaborador ");
        $buscaV=$conexion->query("select nombre, a_paterno,a_materno from visitantes where id_visitante= $visitante ");

        while($bn = $buscaV->fetch_assoc()){
       
        $nom=$bn['nombre'];
        $pat=$bn['a_paterno'];
        $mat=$bn['a_materno'];

        }


         while($b = $buscaCol->fetch_assoc()){
       
        $varnombre=$b['nombre'];
        $var=$b['correo'];
        }





     



        $nva_visita = $conexion->query("insert into visita(id_visitante,fecha,hora,id_colaborador) values ('".$visitante."','".$fechaInsert."','".$hora."','".$colaborador."')");
        //echo 'inserto <br>'.mysqli_error($dbconection);
        //$visitante = $BusquedaVisitante->fetch_assoc();

 //inicio

ini_set('display_errors', 'on');
require '/var/www/html/proyecto/PHPMailer-master/PHPMailerAutoload.php';


$mail = new PHPMailer();


/**configuracion PHPMailer*/

$mail->IsSMTP(); 
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "elizabeth.diaz@blackinntech.com";
$mail->Password = "Elizabeth30112909";




/*configuracion correo a enviar*/


$mail->setFrom('elizabeth.diaz@blackinntech.com');  //remitente
$mail->addAddress($var); //destinatario
//$mail->FromName = "Recepcion";

$mail->Subject = $varnombre.' Tienes un Recordatorio de visita';
$mail->Body = 'Hola '.$varnombre.' Te informamos que : '.$nom.' '.$pat. ' '.$mat.' te agendo una visita para el dia '.$fechaInsert.' a las '.$hora;  


/*enviar email*/

if($mail->send()==false)
{
  echo "fallo al enviar email";  
  echo "Error del PHPMailer ". $mail->ErrorInfo; 
}else{
  echo"mensaje enviado ";
}







      
       
        header("Location: gracias.php");
        die();

      }

    }


}




?>



<!DOCTYPE html>
    <html>
    <head>
        <title>Registrar visita</title>
      
        <link rel="stylesheet" type="text/css" href="css/estilos-index.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link href="https://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet"> 

        <link rel="stylesheet" href="css/bootstrap.min.css">
         <script src="js/jquery/jquery-3.2.1.min.js"></script>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="estilos-index.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link href="https://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet"> 


            <link rel="stylesheet" href="css/formulario.css">
<link rel="stylesheet" href="css/tabla.css">
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
         <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!--inicia datepicker!-->

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
          $(function() { $('#fecha1').datepicker({ beforeShowDay: $.datepicker.noWeekends, minDate: 0,
            changeMonth: true,
            changeYear: true,
            dateFormat: 'd-m-y',
            minDate: "+1D"


             }); });
        
        </script>

    </head>
    <body   background="images/bt.png">


<header>
      <?php
          include("includes/menu.html");
        ?>
    </header><br><br><br><br>


    <?php

        if(isset($errors) and count($errors) > 0 ){
            foreach($errors as $error){
                
               
                echo"<div class='alert alert-info' role='alert' style='height:4px; width:40%; margin:0 auto;'>";
                echo"<strong>¡Cuidado!</strong> ".$error."</div>";

            }
        }
?> 


              <div class="form1">
                  <form action="" method="POST">
                  
                   <h3><font color="white"><?php echo ucwords ($nombreUsuario) ?> , ¿ a quien visitas ?</font></h3>

               

                      <input type="hidden" class="form-control" placeholder="Nombre" id="textNombre" name="idvisitante" value="<?php echo ($_GET['idvisitante'] ) ?>">

                  

               <br><br>
                


                   <!--menu de seleccion empresa y colaborador!-->

                   <div class="input-group">
                     <span class="input-group-addon">Empresa
                     </span>
                   <select name="empresa" onchange="document.getElementById('btnBuscar').click()" class="form-control" id="empresa">
                     <option>Empresa...</option>
                      <?php
                        while($em = $empresan->fetch_assoc())
                        {
                          echo'<OPTION VALUE="'.$em['id_empresa'].'" '.
                          ($empresa == $em['id_empresa']?" selected":"")
                          .'>'.$em['nombre_empresa'].'</OPTION>';
                        }

                      ?>
                  </select>
                  <INPUT type="submit" style='display:none' value="Buscar" id='btnBuscar' name="button">





                    </select>
               </div>
                <br><br>

                   <div class="input-group">
                     <span class="input-group-addon">Colaborador
                     </span>
                     <select class="form-control" id="empresa" name="colaborador">
                     <option>A quien visita...</option>
                        <?php
                          while($col = $colaborador->fetch_assoc())
                         {
                           echo'<OPTION VALUE="'.$col['id_colaborador'].'">'.$col['nombre'].' '.$col['a_paterno'].' '.$col['a_materno'].'</OPTION>';
                          }

                        ?>
                     </select><BR>

                    

                  </div>
                      
                      <!--Elige fecha-->
                      <div class="input-group">
                       <span class="input-group-addon">Fecha
                     </span>

                      <input type="text" class="form-control" placeholder="No reservar el mismo dia" id="fecha1" name="fecha">

                  </div>

                     <!--Elige Hora-->
                    <div class="input-group">
                     <span class="input-group-addon">Hora
                     </span>
                   <select name="hora" class="form-control" id="hora">
                     <option value="0">Elige la Hora</option>
                     <option>09:00</option>
                     <option>09:00</option>
                     <option>09:30</option>
                     <option>10:00</option>
                     <option>10:30</option>
                     <option>11:00</option>
                     <option>11:30</option>
                     <option>12:00</option>
                     <option>12:30</option>
                     <option>13:00</option>
                     <option>13:30</option>
                     <option>14:00</option>
                     <option>14:30</option>
                     <option>15:00</option>
                     <option>15:30</option>
                     <option>16:00</option>
                     <option>16:30</option>
                     <option>17:00</option>
                     <option>17:30</option>
                     <option>18:00</option>
                      
                  </select>
                  </div>

                 


                     <br>
                   <input  class="" href="index2.php" role="button" type="submit" name="enviarb" value="Registrar"/>

                   </form>



             </div>
             </div>





    </body>
</html>

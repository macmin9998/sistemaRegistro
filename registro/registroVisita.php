<?php
 include "includes/dbconection.php";
date_default_timezone_set('America/Mexico_City');



$empresan=$conexion->query("select id_empresa,nombre as nombre_empresa from Empresa;");

    if(isset($_POST['empresa']) ){


        $empresa=$_POST['empresa'];
        $colaborador=$conexion->query("select id_colaborador,nombre,a_paterno,a_materno from Colaborador where id_empresa='".$empresa."'");
             
    }



    $id= htmlentities($_GET['idvisitante']);

    $BusquedaVisitante=$conexion->query("select id_visitante,nombre,a_paterno,a_materno,empresa_origen,email from visitantes where id_visitante='".$id."'");
     
    $visitante = $BusquedaVisitante->fetch_assoc();
    $nombrevisitante=$visitante['nombre'];


if(isset($_POST['enviarb'])) {

    $errors = array();




  if(!ctype_digit($_POST['colaborador']) || empty($_POST['colaborador']) ){ 


           $errors[]="Valor invalido para colaborador";

       }







    if (count($errors) == 0) {
        $visitante = $_POST['idvisitante'];
        $fecha = explode('-',$_POST['fecha']);
        $fechaInsert = $fecha[2]."/".$fecha[1]."-".$fecha[0];
        $hora = $_POST['hora'];
        $colaborador = $_POST['colaborador'];
        echo"colaborador: ".$colaborador;

        //$BusquedaVisitante=$dbconection->query("select id_visitante,nombre,a_paterno,a_materno,empresa_origen,email from visitantes where id_visitante='".$visitante."'");

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
$mail->Username = "correo_";
$mail->Password = "contrasena_de_correo";




/*configuracion correo a enviar*/


$mail->setFrom('elizabeth.diaz@blackinntech.com');  //remitente
$mail->addAddress($var); //destinatario
//$mail->FromName = "Recepcion";

$mail->Subject = $varnombre.' tienes una visita';
$mail->Body = 'Hola '.$varnombre.' Te informamos que : '.$nom.' '.$pat. ' '.$mat.' te vino a visitar';  


/*enviar email*/

if($mail->send()==false)
{
  echo "fallo al enviar email";  
  echo "Error del PHPMailer ". $mail->ErrorInfo; 
}else{
  echo"mensaje enviado ";
}



      //fin



   header("Location: gracias.php");
   die();
     

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



            <link rel="stylesheet" href="css/formulario.css">
<link rel="stylesheet" href="css/tabla.css">
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
           

    </head>
    <body  background="images/bt.png">
         
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


               <br><br>
              <div class="form1">
                  <form action="" method="POST">
                 

                       <h3><font color="white"><?php echo ucwords ($visitante['nombre']); ?> , ¿ a quien visitas ?</font></h3>

                  <div class="input-group">

                      <input type="hidden" class="form-control" placeholder="Nombre"  name="idvisitante" value="<?php echo ($_GET['idvisitante'] ) ?>">

                  </div>

                



                  <div class="input-group">

                      <input type="hidden" class="form-control" placeholder="Hora" id="textHora" value="<?php $time = time();echo date("H:i", $time);?>" name="hora">

                 </div>

                  <div class="input-group">

                      <input type="hidden" class="form-control" placeholder="Fecha" id="textfecha" value="<?php $time = time();echo date("d-m-Y" , $time);?>"  name="fecha">

                 </div>

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
                  </select></div>
                  <INPUT type="submit" style='display:none' value="Buscar" id='btnBuscar' name="button">



                   <div class="input-group">
                     <span class="input-group-addon">Colaborador
                     </span>
                     <select class="form-control" id="empresa" name="colaborador">
                     <option>A quien visita...</option>
                        <?php
                          while($col = $colaborador->fetch_assoc())
                         {

                      
           
            echo'<OPTION    VALUE="'.$col['id_colaborador'].'">'.$col['nombre'].' '.$col['a_paterno'].' '.$col['a_materno'].'</     OPTION>';

                          
                          }

                        ?>
                     </select><BR>

                   </div>

                   <input  class="" href="index2.php" role="button" type="submit" name="enviarb" value="Registrar"/>

                   </form>

                 </div>

          





    </body>
</html>

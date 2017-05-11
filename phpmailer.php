<?php
/*

$email =$_POST["email"];
$asunto = $_POST["asunto"];
$archhivo =  $_FILES["archivo"];

*/
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
$mail->addAddress('macario.miror@blackinntech.com'); //destinatario
//$mail->FromName = "Recepcion";

$mail->Subject = 'correo prueba';
$mail->Body = 'espero que funcioneee';  


/*enviar email*/

if($mail->send()==false)
{
  echo "fallo al enviar email";  
  echo "Error del PHPMailer ". $mail->ErrorInfo; 
}else{
  echo"mensaje enviado ";
}



/*
$mail->MsgHTML("Tienes una visita");

if($adjunto["size"] > 0)
{
    $mail->addAttachment($adjunto["tmp_name"], $adjunto["name"]);
}


if($mail->$end())
{
    $msg = "Email enviado exitosamente a $email";
}
else
{
    $msg = "Ocurrio un error";
}

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8"
</head>
<body>

<strong><?php echo $msg; ?></strong>
 <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]?>">

<table>
<tr>
   <td>Email Destinatario:</td>
   <td><input type="text" name="email"></tr>
</tr>

<tr>
   <td>Asunto:</td>
   <td><input type="text" name="asunto"></tr>
</tr>
<tr>
   <td>Adjuntar Archivo:</td>
   <td><input type="file" name="archivo"></tr> 
</tr>
</table>
     <input type="hidden" name="phpmailer">
     <input type="submit" value="Enviar email"> 

</form>
</body>
</html>
*/

?>

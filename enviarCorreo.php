<?php
$para="macpumaunam@gmail.com";
$mail = "Prueba de mensaje";
//Titulo
$titulo = "PRUEBA DE TITULO";
//cabecera
$cabeceras = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: macpumaunam@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$bool = mail($para,$titulo,$mail,$cabeceras);
if($bool){
    echo "Mensaje enviado";
}else{
    echo "Mensaje no enviado";
}
?>






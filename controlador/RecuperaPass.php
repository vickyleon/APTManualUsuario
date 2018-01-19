<?php
	require '../PHPMailer-master/PHPMailerAutoload.php';
    require_once("connection.php");
	require_once("BeanUsuario.php");
	$email = $_POST['email'];
	$conexion = new connection();
	$conexion->conectar();
	$query = "SELECT password FROM usuario WHERE email = '$email'";
	$conexion->myQuery($query);
	
		if($conexion->getFilas() <= 0){
			$no="Error, la cuenta que usted ingres&oacute; no existe en nuestro sistema";
			echo $no;
		}
		else{
			
			while($fila=$conexion->getArrayFila()){
				$pass=$email;
				$pass.=rand(200,8000);
			}
			$encrpass=md5($pass);
			$query = "UPDATE usuario SET password='$encrpass' WHERE email='$email'";
			$conexion->myQuery($query);
			$conexion->desconectar();
			
			$mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'tlamatiliztli.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication   
$mail->Username = 'soporte2017@tlamatiliztli.net';                 // SMTP username
$mail->Password = '147896325';                           // SMTP password

$mail->Port = 25;                                    // TCP port to connect to

$mail->setFrom('soporte2017@tlamatiliztli.net', 'NoReply: Servicio de Email Tlamatiliztli');
$mail->addAddress($email, 'Usuario');     // Add a recipient
$mail->addReplyTo('soporte2017@tlamatiliztli.net', 'NoReply: Servicio de Email Tlamatiliztli');
$mail->addCC('soporte2017@tlamatiliztli.net');
$mail->addBCC($email);                                 // Set email format to HTML

$mail->Subject = 'Renvio de contraseña';
$mail->Body    = '
<style type="text/css">
  body,
  html, 
  .body {
    background: #f3f3f3 !important;
  }

  .container.header {
    background: #f3f3f3;
  }

  .body-border {
    border-top: 8px solid #663399;
  }
</style>

<container class="header">
  <row>
    <columns>
      <h1 class="text-center"><center>Tlamatiliztli</center></h1>


    </columns>
  </row>
</container>

<container class="body-border">
  <row>
    <columns>

      <spacer size="32"></spacer>

      <center>
        <img src="http://physics-education.tlamatiliztli.net/images/logoIndex.png">
      </center>

      <spacer size="16"></spacer>

      <h4>Estimado usuario:</h4>
      <p>Agradecemos que haya preferido nuestra servicio de reposici&oacute;n de contraseñas, su nueva clave temporal es:
      
      <p>Contraseña: '.$pass.'</p>

		<p>Le recomendamos que a la brevedad la reestablezca dentro de: </p>
		<p>Menu --> Mi Perfil</p>
     

    </columns>
  </row>

  <spacer size="16"></spacer>
</container>
';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
   // echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 1;
}
			
			
			
		}

?>

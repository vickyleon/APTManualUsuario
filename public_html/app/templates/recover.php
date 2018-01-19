<?php
	require 'PHPMailer-master/PHPMailerAutoload.php';
	$email=$_POST['email'];
	$mysqli= new mysqli("aapt-mx.org","aaptmx","ylatesis?","aaptmx_db_prueba") ;
	if (mysqli_connect_errno())
		{
		    	printf("Falló la conexión failed: %s\n", $mysqli->connect_error);
	    		exit();
		}
	$query = "SELECT password from socio where email like('%$email%'); ";
	$result = mysqli_query($mysqli,$query);
	 $numrows=mysqli_num_rows($result);
		while ($line = mysqli_fetch_array($result, MYSQLI_BOTH)) 
		{
			$pass=$line['0'];
			//echo $pass;
		}
	if($numrows==1){
		$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

//$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'aapt.mx.oficial@gmail.com';                 // SMTP username
$mail->Password = 'ylatesis?';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('aapt.mx.oficial@gmail.com', 'Servicio de Recuperacion de Contraseñas AAPT-MX');
$mail->addAddress($email, 'Usuario');     // Add a recipient
$mail->addReplyTo('aapt.mx.oficial@gmail.com', 'Servicio de Recuperacion de Contraseñas AAPT-MX');
$mail->addCC('aapt.mx.oficial@gmail.com');
$mail->addBCC($email);


$mail->isHTML(true);                                  // Set email format to HTML

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
      <h1 class="text-center"><center>AAPT-MX</center></h1>


    </columns>
  </row>
</container>

<container class="body-border">
  <row>
    <columns>

      <spacer size="32"></spacer>

      <center>
        <img src="https://scontent.fmex6-1.fna.fbcdn.net/v/t1.0-9/970630_654021824663735_487968958_n.jpg?oh=150aad6b32e4a5d3c0d4da1f1accffcc&oe=595F7D71">
      </center>

      <spacer size="16"></spacer>

      <h4>Estimado usuario:</h4>
      <p>Agradecemos que haya preferido nuestra servicio de reposici&oactue;n de contraseñas, sus datos son:
      
      <p>Contraseña: '.$pass.'</p>


     

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
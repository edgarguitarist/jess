<?php
	require 'includes/conexion.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/Exception.php';
	require 'PHPMailer/PHPMailer.php';
	require 'PHPMailer/SMTP.php';

	if (!empty($_POST)){$email = $_POST['email'];}else{$email = $_GET['email'];}
		
		
		$consulta="SELECT firstname,lastname FROM mdl_user WHERE email= '{$email}'";
		$resultado=mysqli_query($conexion,$consulta);
		$contador = mysqli_num_rows($resultado);
     	
			if($consulta){
			
				if($reg=mysqli_fetch_array($resultado)){
					echo "chevere";
				}
			}

    	 if($contador == 1) {

			$token = base64_encode ($email);
			$nombre = $reg['0'].' '.$reg['1'];
			echo $token;
			echo $nombre;
			$url = 'http://'.$_SERVER["SERVER_NAME"].'/change_pass.php?idus='.$token;
    	 	$mail = new PHPMailer(true);

			try {
			    //Server settings
			    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
			    $mail->isSMTP();                                            // Send using SMTP
			    $mail->Host       = 'smtp.hostinger.com';                    // Set the SMTP server to send through
			    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			    $mail->Username   = 'noreply-recovery@letrasyvida.com';     // SMTP username
			    $mail->Password   = '1q2w3e4r5t6Y.';                               // SMTP password
			    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
			    $mail->Port       = 587;                                    // TCP port to connect to

			    //Recipients
			    $mail->setFrom('noreply-recovery@letrasyvida.com', 'LETRAS Y VIDA');
			    $mail->addAddress($email, $nombre);     // Add a recipient


			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Reset Password - LETRAS Y VIDA';
			    $mail->Body    = "<center>
				<div style='margin-bottom:50px; align-content: center;'><img style='' src='https://aulavirtual.letrasyvida.com/images/small-logo.png' width='150px' height='150px'>
				<h2 style='color: #013C80; font-weight: bold;'> Unidad Educativa 'Letras y Vida' </h2></center>
				<p style='font-size: 16px; font-weight: bold; color:black;'>Hola $nombre, </p>
				<p style='font-size: 16px; font-weight: bold; color:black;'>Se ha solicitado un cambio de contrase&ntilde;a de tu cuenta del sitio de evaluaciones de Letras y Vida.</p> 
				<p style='font-size: 16px; font-weight: bold; color:black;'>Para restaurar la contrase&ntilde;a, visita la siguiente direcci&oacute;n: <a href='$url'>$url</a> </p>
				<p style='font-size: 16px; font-weight: bold; color:black;'>Si no solicitaste cambiar la contrase&ntilde;a ignora este correo electrónico.</p>
				<br/>
				<p style='font-size: 16px; font-weight: bold; color:black;'>El equipo de LETRAS Y VIDA.</p> ";
			 
			    $mail->send();
				echo 'El mensaje ha sido enviado';
				header("Location: forget.php?info=success");
			} catch (Exception $e) {
			    echo "No se pudo enviar el mensaje. Error: {$mail->ErrorInfo}";
			}
       		mysqli_close($conexion); 
     	} else { 
			 echo "El Correo no existe";
			 header("Location: forget.php?info=error");
     }		
	
?>
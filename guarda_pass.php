<?php
	
	include 'includes/conexion.php';
	require 'includes/funcs.php';
	
	$idus = base64_decode($_POST['idus']);
	$password = $_POST['password'];
	$con_password = $_POST['con_password'];
	
	if(validaPassword($password, $con_password))
	{
		$consulta="UPDATE mdl_user SET contrasena = '{$password}' WHERE email = '{$idus}'";
		$resultado=mysqli_query($conexion,$consulta);
			if($consulta){
				header('Location: updatepass.php?info=success');}
			else{
				header('Location: updatepass.php?info=error');
				echo "No se Pudieron Actualizar los Datos";	
				mysqli_close($conexion);
			}
		} else {
		header('Location: change_pass.php?idus='.$_POST['idus'].'&info=warning');
		echo 'Las contraseñas no coinciden';
		
	}
	
?>	
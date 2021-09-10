<?php

$user = $_POST['ncorreo'];
$pass = $_POST['npassword'];
$nosesion = "Location: login.php?info=error";

if(empty($user) || empty($pass)){
header($nosesion);
exit();
}

include "conexion.php";
$consulta="SELECT * from mdl_user where username='$user' ";
$result=mysqli_query($conexion,$consulta);

if($row = mysqli_fetch_array($result)){
	if($row['contrasena'] == $pass){
		session_start();
		$_SESSION['user'] = $row['firstname'].' '.$row['lastname'];
		$_SESSION['id'] = $row['id'];
		$_SESSION['Rol'] = 1;
		$_SESSION['ico'] = 'https://aulavirtual.letrasyvida.com/images/small-logo.png';
		$_SESSION['active']   = true;

		if ($_SESSION['Rol']==1) {
		  header("Location: inicio.php");
		  exit();
		}else{header("Location: inicio.php");}
		
	}else{
		header($nosesion);
		session_destroy();
		exit();
	}
}else{
	header($nosesion);
	session_destroy();
	exit();
}
?>
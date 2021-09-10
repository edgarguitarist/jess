<?php
	
	require 'includes/conexion.php';
	require 'includes/funcs.php';
	if(isset($_GET["idus"])){$idus =$_GET['idus'];}
	
?>

<html>
	<head>
		<title>Cambiar Contraseña - Letras y Vida</title>
		<link rel="icon" type="image/png" href="https://aulavirtual.letrasyvida.com/images/small-logo.png" />
		<script src="https://uniwebsidad.com/static/libros/ejemplos/bootstrap-3/js/jquery.min.js" type="text/javascript"></script>
    	<script src="https://uniwebsidad.com/static/libros/ejemplos/bootstrap-3/js/bootstrap.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
		<style type="text/css">
		input{  padding : 7px;
            width   : 300px;
            border-radius:10px;
            border:3px solid #F4CE00;
            background-color: #fff ;
            display: block;
            font-size: 16px;
            margin-left: auto;
            margin-right: auto;
            shape-margin: 1px;}

		textarea:focus, input:focus, input[type]:focus {
		border-color: rgb(255, 144, 0);
		box-shadow: 0 1px 1px rgba(229, 103, 23, 0.075)inset, 0 0 8px rgba(255,144,0,0.6);
		outline: 0 none;
		}

		body{
background: url('https://static.vecteezy.com/system/resources/previews/000/544/180/non_2x/white-and-grey-circular-curve-abstract-background-vector-for-presentation-background-and-abstract-concept.jpg') no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
}
		</style>
		
	</head>
	<?PHP
if(isset($_GET["info"])){
  $estado=$_GET["info"];
  $success="display: none";
  $warning="display: none";
  $error="display: none";
    if($estado=="success"){
        $success="display: block";
    }
    if($estado=="error"){
        $error="display: block";
    }

    if($estado=="warning"){
        $warning="display: block";
    }

} else{
        $success="display: none";
        $error="display: none";
        $warning="display: none";
	}
	
?>
	<body>
		<div class="alert alert-success alert-dismissable" style="<?php echo $success; ?>">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>¡Se ha cambiado la Contraseña!</strong>
		</div>
		<div class="alert alert-warning alert-dismissable" style="<?php echo $warning; ?>">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>¡Las Contraseñas no coinciden!</strong> 
		</div>
		<div class="alert alert-danger alert-dismissable" style="<?php echo $error; ?>">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>¡No se pudo cambiar la Contraseña!</strong> 
		</div>

		<div>
			<center>
			<div style=" margin-top: 0px; margin-bottom:50px; align-content: center;"><img style="" src="https://aulavirtual.letrasyvida.com/images/small-logo.png" width="200px" height="200px">
			<h1 class="sombra" style="color: #013C80" style="font-weight: bold;" > Unidad Educativa "Letras y Vida" </h1>
			</center>
		</div>

		<div class="container">    
		<div id="loginbox" style="margin-top:0px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">            
		<div class="panel panel-info" >
			<div class="panel-heading" style="color:white; background:#44A0D3; ">
				<div class="panel-title sombra" style="font-weight: bold;">Cambiar Contraseña</div>
			</div>     
			
			<div style="padding-top:30px" class="panel-body" >
				
				<form id="loginform" class="form-horizontal" role="form" action="guarda_pass.php" method="POST" autocomplete="off">
					
					<input type="hidden" id="idus" name="idus" value ="<?php echo $idus; ?>" />
					
					<div class="form-group">
						<label for="password" class="col-md-3 control-label" style="text-align: center; font-size: 16px; margin-left:5px;">Nueva Contraseña</label>
						<input type="password"  name="password" placeholder="Contraseña" required>
					</div>
					
					<div class="form-group">
						<label for="con_password" class="col-md-3 control-label" style="text-align: center; font-size: 16px; margin-left:5px;">Confirmar Contraseña</label>
						<input type="password"  name="con_password" placeholder="Confirmar Contraseña" required>
					</div>
					
					<div style="margin-top:10px" class="form-group">
						<div class="col-sm-12 controls">
							<center><button class="btn btntam" style= "background-color: #479ED4; color: white;" type="submit">Modificar</a></center>
						</div>
					</div>   
				</form>
			</div>                     
		</div>  
		</div>
		</div>
	</body>
</html>	
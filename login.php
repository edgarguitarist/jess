<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">

    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Use title if it's in the page YAML frontmatter -->
    <title>Letras y Vida</title>
    <link rel="icon" type="image/png" href="https://aulavirtual.letrasyvida.com/images/small-logo-blanco.png" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <script src="https://uniwebsidad.com/static/libros/ejemplos/bootstrap-3/js/jquery.min.js" type="text/javascript"></script>
    <script src="https://uniwebsidad.com/static/libros/ejemplos/bootstrap-3/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/main.css">

</head>

    <body  class="fondo">

        <?PHP
            if(isset($_GET["info"])){
              $estado=$_GET["info"];
              $success="display:none";
              $error="display:none";
                if($estado=="success"){
                    $success="display: block";
                }
                if($estado=="error"){
                    $error="display: block";
                }
            } else{
                    $success="display: none";
                    $error="display: none";
                }
            ?>

            <div class="alert alert-success alert-dismissable" style="margin-top: -110px; position: fixed; width: 100%; <?php echo $success; ?>">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Se ha cambiado la Contraseña!</strong>
            </div>
            <div id = "alerta" class="alert alert-danger alert-dismissable" style="margin-top: -110px; position: fixed; width: 100%; <?php echo $error; ?> ">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>¡Usuario no encontrado!</strong> Verifique sus datos. 
            </div>



    	<div style=" margin-top: 0px; margin-bottom:50px; align-content: center;"><img alt="LOGO" src="https://aulavirtual.letrasyvida.com/images/small-logo-blanco.png" width="200px" height="200px">
    	<h1 class="sombra" style="color: #013C80" style="font-weight: bold;" > Unidad Educativa "Letras y Vida" </h1>
            <div >
                
                    <form id = "validar" name = "validar" method="POST" action="validar.php">
                        <input type="text" name="ncorreo" placeholder="Ingrese su Usuario" maxlength="15" autofocus required/>
                        <br>
                        <input type="password" name="npassword" placeholder="Ingrese su Contraseña" maxlength="15" autofocus required/>
                        <br>
                        
                        <button class="btn btntam" style= "background-color: #479ED4; color: white;" type="submit">Iniciar Sesión</button>    
                        
                    </form>
                    <br>                    
                    <div class="csess" style=" font-size: 18px; color: #013C80;"><a class="csess" style="color: #013C80" href="forget.php">Olvide mi Contraseña</a></div>
                    <div class="csess" style=" font-size: 20px; background-color: gray;"></div>
                
            </div> 
        </div>
    	  
        

    </body>


</html>
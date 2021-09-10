<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">

    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Use title if it's in the page YAML frontmatter -->
    <title>Recuperar cuenta - Letras y Vida</title>
    <link rel="icon" type="image/png" href="https://aulavirtual.letrasyvida.com/images/small-logo-blanco.png" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <script src="https://uniwebsidad.com/static/libros/ejemplos/bootstrap-3/js/jquery.min.js" type="text/javascript"></script>
    <script src="https://uniwebsidad.com/static/libros/ejemplos/bootstrap-3/js/bootstrap.min.js" type="text/javascript"></script>

    <style type="text/css">
    div {
    text-align: center;
    position: relative;
    top: 15%;
    -ms-transform: translateY(15%);
    -webkit-transform: translateY(15%);
    transform: translateY(15%);
    }
    input{  padding : 7px;
            width   : 300px;
            border-radius:10px;
            border:3px solid #F4CE00;
            background-color: #fff ;
            display: block;
            font-size: 20px;
            margin-left: auto;
            margin-right: auto;
            shape-margin: 1px;}

    textarea:focus, input:focus, input[type]:focus {
    border-color: rgb(255, 144, 0);
    box-shadow: 0 1px 1px rgba(229, 103, 23, 0.075)inset, 0 0 8px rgba(255,144,0,0.6);
    outline: 0 none;
    }

     .csess {text-align: center;
             font-size: 20px;
             font-weight: 600;
             color: #fff}

    .btntam {font-size: 18px;
             }
             .sombra{
    font-weight: 700;
    
    }

    .fondo{
    background-image: url('https://static.vecteezy.com/system/resources/previews/000/544/180/non_2x/white-and-grey-circular-curve-abstract-background-vector-for-presentation-background-and-abstract-concept.jpg');
    width:100%;
    height:100vh;
    background-size: cover;
    
}

    </style>

</head>

    <body class="fondo">

        <?PHP
            if(isset($_GET["info"])){
              $estado=$_GET["info"];
              $success="display:none";
              $error="display:none";
                if($estado=="success"){
                    $success="display: block; margin-top: -110px; position: fixed; width: 100%;";
                }
                if($estado=="error"){
                    $error="display: block; margin-top: -110px; position: fixed; width: 100%;";
                }
            } else{
                    $success="display: none";
                    $error="display: none";
                }
            ?>

              <div class="alert alert-success alert-dismissable" style="<?php echo $success; ?>">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>¡Se ha Enviado el Correo!</strong>
            </div>

            <div class="alert alert-danger alert-dismissable" style="<?php echo $error; ?>">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>¡El Correo No Existe!</strong> 
            </div>


        <div style=" margin-top: -50px; align-content: center;"><img alt="LOGO" src="https://aulavirtual.letrasyvida.com/images/small-logo-blanco.png" width="200px" height="200px">
    	<h1 class="sombra" style="color: #013C80" style="font-weight: bold;" > Unidad Educativa "Letras y Vida" </h1>
            <div>
                
                    <form method="POST" action="enviar_correo.php">
                        <input type="text" name="email" placeholder="Correo" autofocus required/>
                        <br>
                        
                        <button class="btn btntam" style= "background-color: #479ED4; color: white;" type="submit">Enviar</button>    
                        
                    </form>
                    <br>
                    <div class="csess sombra " style=" font-size: 18px; color: #013C80;"><a class="csess" style="color: #013C80" href="login.php">Iniciar Sesión</a></div>
                
            </div> 
        </div>
    	  
        

    </body>


</html>
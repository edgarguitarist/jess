<!DOCTYPE html>
<html lang="es">

<head>
      <title>GRACIAS - Letras y Vida</title>
      <style>
            H2 {
                  color: #013C80;
                  font-family: 'Arial';
                  font-size: 100%;
                  letter-spacing: 1pt;
                  width: 60%;
                  padding: 15px;
                  text-align: center;
                  text-transform: uppercase;
                  border: 2px solid #F4CE00;
                  padding: 10px;
                  border-radius: 10px;
            }

            .padre {
                  display: table;
                  height: 100vh;
                  width: 100%;
            }

            .hijo {
                  display: table-cell;
                  vertical-align: middle;
                  text-align: -webkit-center;
            }
      </style>
</head>

<body>
      <?php if (isset($_GET['info'])) {
            $info = $_GET['info'];
            if ($info == 'success') {
      ?>
                  <div class='padre'>
                        <div class='hijo'>
                              <img src='images/small-logo.png' style='width:40%;' alt='GRACIAS'>
                              <br>
                              <h2 class='hachados'>¡La contraseña ha sido actualizada!</h2>
                        </div>
                  </div>
            <?php
            } else if ($info == 'error') {
            ?>
                  <div class='padre'>
                        <div class='hijo'>
                              <img src='images/small-logo.png' style='width:40%;' alt='GRACIAS'>
                              <br>
                              <h2 class='hachados'>¡La contraseña no se ha podido actualizar, por favor vuelva a intentar mas tarde!</h2>
                        </div>
                  </div>
            <?php
            }
      } else {
            ?>
            <div class='padre'>
                  <div class='hijo'>
                              <img src='images/small-logo.png' style='width:40%;' alt='GRACIAS'>
                              <br>
                              <h2 class='hachados'>¡No hay nada que mostrar aqui!</h2>
                  </div>
            </div>
      <?php
      } ?>

</body>

</html>
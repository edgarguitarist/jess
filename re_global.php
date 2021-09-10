<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
$logo = "";
//$sel1=$_SESSION['esp'];
//$sel2=$_SESSION['per'];
//$sel3=$_SESSION['bac'];

include "conexion.php";
date_default_timezone_set('America/Guayaquil');
$fecha = date("d-m-Y");
$hoy = date("Y-m-d");
$hora = date("h:i") . " " . date("A");
$reporte = "Reporte Global";
$namepdf = "Reporte Global - " . $fecha;

$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
//echo "http://" . $host . $url;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<link rel="icon" type="image/png" href="https://aulavirtual.letrasyvida.com/images/small-logo-blanco.png" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="js/sorttable.js"></script>

    <title>REPORTE GLOBAL- Letras y Vida</title>
    <?php
    include "includes/conexion.php";
    include "includes/scripts.php";
    ?>
    <script>
        function datos() {
            var combo = document.getElementById("sel_esp_re");
            var selected = combo.options[combo.selectedIndex].text;
            var msg = document.getElementById("msg");

            var combo2 = document.getElementById("sel_per_re");
            var selected2 = combo2.options[combo2.selectedIndex].text;
            var msg2 = document.getElementById("msg2");

            var combo3 = document.getElementById("sel_bac_re");
            var selected3 = combo3.options[combo3.selectedIndex].text;
            var msg3 = document.getElementById("msg3");

            msg.innerHTML = selected;
            msg2.innerHTML = selected2;
            msg3.innerHTML = selected3;
        }

    </script>
</head>

<body onload="">
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="container_index">
            <br>
            <h2>REPORTE</h2><br>
            <div id="Resultados" class="datos">
                <div class="wd20">
                    <label for="ESPECIALIDAD" class="fuente">ESPECIALIDAD</label>
                    <?php
                    $query_tipo = mysqli_query($conexion, "SELECT * FROM mdl_course_categories WHERE idnumber > 10 AND idnumber < 15");
                    $result_tipo = mysqli_num_rows($query_tipo);
                    ?>
                    <select name="sel_esp_re" id="sel_esp_re" class="select-css" required="">
                        <option value="0">Seleccionar ESPECIALIDAD</option>
                        <?php
                        if ($result_tipo > 0) {
                            while ($tipo = mysqli_fetch_array($query_tipo)) {
                        ?>
                                <option value='<?php echo $tipo["id"]; ?>'><?php echo $tipo["name"] ?></option>
                        <?php
                            }
                        } ?>
                    </select>
                </div>

                <div class="wd15">
                    <label class="fuente">Periodo</label>
                    <select name="sel_per_re" id="sel_per_re" class="select-css" required>
                    </select>
                </div>

                <div class="wd50" style="margin-right: -4%;">
                    <label class="fuente">BACHILLERATO</label>
                    <select onchange="datos()" name="sel_bac_re" id="sel_bac_re" class="select-css" required="">
                    </select>
                </div>

                <br>

            </div>
            <h2 id="hachedos" style="text-align: center; display: none;">RESULTADOS</h2>
            <div id="pdf_container">
                <div id='informacion' class='informacion' style='display: none;'>
                    <div style='margin: auto; width: 100%; display: grid; grid-template-columns: 1fr 1fr; grid-gap: 1px;'>
                        <img id='logo' style='width: 35%; grid-column: 1 / 3; margin: auto;' src='images/banner-logo.png' alt='logo'>
                        <div style='justify-self: center; width:80%; grid-column: 1 / 3; display: grid; grid-template-columns: 1fr 1fr;'>
                            <div style='margin-left: 10%; display: inline-flex; align-items: center; justify-items: left'>
                                <h3 style="margin-right: auto;">Bachillerato:</h3>
                                <h5 id="msg3"></h5>
                            </div>
                            <div style='margin-left: 20%; display: inline-flex; align-items: center; justify-items: left'>
                                <h3 style="margin-right: auto;">Año Lectivo:</h3>
                                <h5 id="msg2"></h5>
                            </div>
                            <div style='margin-left: 10%; display: inline-flex; align-items: center; justify-items: left'>
                                <h3 style="margin-right: auto;">Curso:</h3>
                                <h5 id="msg"></h5>
                            </div>
                            <div style='margin-left: 20%; display: inline-flex; align-items: center; justify-items: left'>
                                <h3 style="margin-right: auto;">Fecha:</h3>
                                <h5><?php echo $hoy; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: none; " id="mostrar_data" class="tablas"></div>
            </div>
            <center><button id='btn-export' class='btn btn_guardar_usuario' onclick="genPDF('<?php echo $namepdf; ?>');" style='display:none;'>IMPRIMIR</button></center>
            <br>
    </section>

</body>

</html>
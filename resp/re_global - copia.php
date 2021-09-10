<?php
session_start();
if (!isset($_SESSION['id']))
{
header("Location: login.php");
exit();
}
$logo="";
//$sel1=$_SESSION['esp'];
//$sel2=$_SESSION['per'];
//$sel3=$_SESSION['bac'];


$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
//echo "http://" . $host . $url;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<link rel="icon" type="image/png" href="https://aulavirtual.letrasyvida.com/images/small-logo-blanco.png" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>REPORTE GLOBAL- Letras y Vida</title>
<?php   
    include "includes/scripts.php";
    include "includes/conexion.php";
?>
<script>

function imprim1(mostrar_data){
$(".detalle").hide();
$(".informacion").show();
var printContents = document.getElementById('mostrar_data').innerHTML;
        w = window.open();
        w.document.write(printContents);
        w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10
		w.print();
		w.close();
        $(".detalle").show();
        $(".informacion").hide();
        return true;}
</script>
</head>
<body onload="">
<?php include "includes/header.php";?>
    <section id="container">
        <div class="container_index">
        <br>
            <h2>REPORTE</h2><br>
            <div class="datos">
                <div class="wd20">
                <label for="ESPECIALIDAD" class="fuente">ESPECIALIDAD</label>
                <?php 
                $query_tipo = mysqli_query($conexion,"SELECT * FROM mdl_course_categories WHERE idnumber > 10 AND idnumber < 15");
                $result_tipo = mysqli_num_rows($query_tipo);
                ?>
                <select  name="sel_esp_re" id="sel_esp_re" class="select-css" required="">
                <option value="0">Seleccionar ESPECIALIDAD</option>
                    <?php
                    if($result_tipo > 0)
                        {while($tipo = mysqli_fetch_array($query_tipo)){
                    ?>
                        <option value='<?php echo $tipo["id"]; ?>'><?php echo $tipo["name"] ?></option>
                    <?php
                        }
                    }?>
                </select>
                </div>

                <div class="wd15">
                    <label class="fuente">Periodo</label>
                    <select name="sel_per_re" id="sel_per_re" class="select-css" required>
                    </select>
                </div>

                <div class="wd50" style="margin-right: -4%;">
                    <label class="fuente">BACHILLERATO</label>
                    <select name="sel_bac_re" id="sel_bac_re" class="select-css" required="">
                    </select>
                </div>
            
            <br>
            
        </div>
        <h2 id="hachedos" style="text-align: center; display: none;">RESULTADOS</h2>
        <div style = "display: none; " id="mostrar_data" class="tablas"></div>
        <!-- cambiar a none el display!-->
        <p></p>
        <button id="imprimir" class='btn_guardar' style='display: none; width: auto; margin: auto; padding: 10px;' type='button' onclick='javascript:imprim1(mostrar_data);'>Imprimir</button>
        <br>
    </section>
    
</body>
</html>
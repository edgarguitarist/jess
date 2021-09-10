<?php
session_start();
if (!isset($_SESSION['id']))
{
header("Location: login.php");
exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<link rel="icon" type="image/png" href="https://aulavirtual.letrasyvida.com/images/small-logo-blanco.png" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Autoevaluación Docente - Letras y Vida</title>
<?php   
    include "includes/scripts.php";
    include "includes/conexion.php";
?>

</head>
<body>
<?php include "includes/header.php";?>
    <section id="container">
        <div class="container_index">
        <br>
            <h2>AUTOEVALUACIÓN:</h2><br>
            <div class="datos">
                <div class="wd40">
                <label for="Categoria" class="fuente">CATEGORIA</label>
                <?php 
                $query_tipo = mysqli_query($conexion,"SELECT * FROM mdl_course_categories WHERE name Like '%Evaluaciones%' AND parent = 2");
                $result_tipo = mysqli_num_rows($query_tipo);
                ?>
                <select  name="sel_cur_auto" id="sel_cur_auto" class="select-css" required="">
                <option value="0">Seleccionar Categoria</option>
                    <?php
                    if($result_tipo > 0)
                        {while($tipo = mysqli_fetch_array($query_tipo)){
                    ?>
                        <option value='<?php echo $tipo["id"]; ?>'><?php echo $tipo["name"] ?></option>
                    <?php
                    }}?>
                </select>
                </div>
                <div class="wd50">
                    <label class="fuente">DOCENTE</label>
                    <select name="sel_doc_auto" id="sel_doc_auto" class="select-css" required="">
                    </select>
                </div>      
            </div>
            
            <br>
            <h2 id="hachedos" style="text-align: center; display: none;">RESULTADOS</h2>
            <div style = "display: none;" class="tablas" id="mostrar_data" required=""></div>
            <br>
        </div>
    </section>
    
</body>
</html>
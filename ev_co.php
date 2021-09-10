<?php
session_start();
if (!isset($_SESSION['id']))
{
header("Location: login.php");
exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="icon" type="image/png" href="https://aulavirtual.letrasyvida.com/images/small-logo.png" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Evaluacion de Estudiantes - Letras y Vida</title>
<?php   
    include "includes/scripts.php";
    include "conexion.php";
?>
  
</head>
<body>
<?php include "includes/header.php";?>
    <section id="container">
        <div class="container_index">
            <br>
            <h2>COEVALUACIÓN:</h2><br>
            <div class="datos">
                <div class="wd30">
                <label for="Categoria" class="fuente">CATEGORIA</label>
                <?php 
                $query_tipo = mysqli_query($conexion,"SELECT * FROM mdl_course_categories WHERE name Like '%Evaluaciones%' AND parent = 2");
                $result_tipo = mysqli_num_rows($query_tipo);
                ?>
                <select  name="sel_cur_coev" id="sel_cur_coev" class="select-css" required="">
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
                
                <div class="wd30">
                    <label class="fuente">AREA</label>
                    <select name="sel_area_coev" id="sel_area_coev" class="select-css" required="">
                    </select>
                </div>
                
                <div class="wd30">
                    <label class="fuente">DOCENTE</label>
                    <select name="sel_doc_coev" id="sel_doc_coev" class="select-css" required="">
                    </select>
                </div>   
            </div>
            
            <br>
            <h2 id="hachedos" style="text-align: center; display: none;">RESULTADOS</h2>
            <div style = "display:none;" class="tablas" id="mostrar_data" required="">
                
            </div>
            <br>
        </div>
    </section>
    
</body>
</html>
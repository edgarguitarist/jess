<?php 
include "conexion.php";

if (isset($_GET['iduser']) && isset($_GET['questid']) && isset($_GET['rol'])){
    //$curso = $_GET['curso'];
    $iduser = $_GET['iduser'];
    $questid = $_GET['questid'];
    $rol = $_GET['rol'];
    if( $rol == 'Estudiante'){
        $tipo = 'Estudiantes';
    }else if($rol == 'Docente'){
        $tipo = 'Autoevaluación';
    }else if($rol == 'Directivo'){
        $tipo = 'Directivos';
    }else {
        $tipo = '';
    }
        $html="<!DOCTYPE html>
        <html lang='es'>
        <head>
        <title>GG</title>
        <link rel='stylesheet' href='style.css'
        </head>
        <body>
        <h1 class='hdos' align='center'>Evaluación de ".$tipo."</h1>
        <br><br>
        <form method='POST'>
        <input type='hidden' name='iduser' value='".$iduser."'>
        <input type='hidden' name='questid' value='".$questid."'>     
        ";
        $conter1 = 0;
        foreach ($conexion->query("SELECT c.id AS ID, c.name AS GRUPO, c.content AS Contenido FROM mdl_questionnaire_question c, mdl_questionnaire_quest_choice d, mdl_questionnaire_survey b WHERE d.question_id = c.id AND c.surveyid = $questid AND b.title LIKE '%".$tipo."%' AND c.surveyid = b.id GROUP BY c.id") as $IDPRE)
        {            
            $html.="   
            <h3 style='margin-left:5%;'>".$IDPRE['Contenido']."</h3><br><br>
            <table id = 'tabla' style='margin: auto; width: 90%; border-spacing: 10px 5px;'>
            <thead>
            <th><center>Preguntas</th>
            <th><center>1</th>
            <th><center>2</th>
            <th><center>3</th>
            <th><center>4</th>
            <th><center>5</th>
            </thead>";
            $promedio = 0;
            
            $conter2 = 0;
            
            foreach ($conexion->query("SELECT c.id AS ID, c.name AS GRUPO, c.content AS Contenido, d.id AS ID_PREGUNTA, d.content AS PREGUNTAS FROM mdl_questionnaire_question c, mdl_questionnaire_quest_choice d, mdl_questionnaire_survey b WHERE d.question_id = c.id AND c.surveyid = $questid AND b.title LIKE '%$tipo%' AND d.question_id = '{$IDPRE['ID']}' AND c.surveyid = b.id GROUP BY d.content ORDER BY d.id") as $filas)
            {    
                $html.= "<tr>".
                        "<td>".$filas['PREGUNTAS']."<input type='hidden' name='opcion[]' value='".$filas['ID_PREGUNTA']."'> </td>".
                        "<td align='center'><input type='radio' value='1' name='rank[".$conter1."][".$conter2."]' required></td>".
                        "<td align='center'><input type='radio' value='2' name='rank[".$conter1."][".$conter2."]'></td>".
                        "<td align='center'><input type='radio' value='3' name='rank[".$conter1."][".$conter2."]'></td>".
                        "<td align='center'><input type='radio' value='4' name='rank[".$conter1."][".$conter2."]'></td>".
                        "<td align='center'><input type='radio' value='5' name='rank[".$conter1."][".$conter2."]'></td>".
                        "</tr>";
                $conter2 += 1;
            }
            $html.="</table><br><br>";   
            $conter1 +=1;      
        }

        if($html==''){
            echo "<h3>¡Aun no hay evaluaciones en este curso!</h3>";
        }else{
            $html.="<div>
            <center><input type='submit' class='btn_nusuario' name='insertar' value='Enviar'></center>
            </div>  
            </form></body></html>";
            echo $html;
        }
    
}
//////////////////////// PRESIONAR EL BOTÓN //////////////////////////
if(isset($_POST['insertar'])) {
    $items1 = ($_POST['rank']);
    $items2 = ($_POST['opcion']);
    $items3 = ($_POST['iduser']);
    $items4 = ($_POST['questid']);
    date_default_timezone_set("UTC");
    $hora = time();
    
    $consulta2 = "SELECT questionnaireid FROM mdl_questionnaire_response WHERE questionnaireid = $items4 AND userid = $items3";
    $result=mysqli_query($conexion,$consulta2);

    if($regi=mysqli_fetch_array($result)){
        echo "";
    } else{
        $consulta = "INSERT INTO mdl_questionnaire_response (questionnaireid,submitted, complete, grade, userid) VALUES (".$items4.",".$hora.",'y',0,".$items3.")";
        $resultado3=mysqli_query($conexion,$consulta);
    }

    $sql2 = "SELECT id FROM mdl_questionnaire_response WHERE questionnaireid = $items4 AND userid = $items3";
    $resultado2=mysqli_query($conexion,$sql2);
    $reg2=mysqli_fetch_array($resultado2);

    $revi2 = "SELECT * FROM mdl_questionnaire_response_rank WHERE response_id = $reg2[0]";

    $resulti=mysqli_query($conexion,$revi2);

    if($regis=mysqli_fetch_array($resulti)){
        echo "";
    } else{
        $conterstine = 0;
        foreach($items1 as $pregunta)
        {
            foreach($pregunta as $rank)
            {
                $sql = "SELECT question_id FROM mdl_questionnaire_quest_choice WHERE id = $items2[$conterstine]";
                $resultado=mysqli_query($conexion,$sql);
                $reg=mysqli_fetch_array($resultado);

                $sqlc = "INSERT INTO mdl_questionnaire_response_rank (response_id, question_id, choice_id, rankvalue) 
                VALUES (".$reg2[0].','.$reg[0].','.$items2[$conterstine].','.$rank.")";
                $resultadoc=mysqli_query($conexion,$sqlc);
                $conterstine +=1;
            }        
        }
    }
    mysqli_close($conexion);
   ?>
   <script>
   if(<?php $conterstine > 0 ?>){
    window.location.replace("gracias.php");
   }
   </script>
   <?php header('Location: gracias.php');
}
?>

<?php 
include "conexion.php";

if (isset($_GET['curso']) && isset($_GET['iduser']) && isset($_GET['questid']) && isset($_GET['rol'])){
    $curso = $_GET['curso'];
    $iduser = $_GET['iduser'];
    $questid = $_GET['questid'];
    $rol = $_GET['rol'];
    if( $rol == 'Estudiante'){
    	$tipo = 'Estudiantes';
        $html="<!DOCTYPE html>
        <html lang='es'>
        <head>
        <title>GG</title>
        <link rel='stylesheet' href='style.css'
        </head>
        <body>
        <form method='POST'>
        <input type='hidden' name='iduser' value='".$iduser."'>
        <input type='hidden' name='questid' value='".$questid."'>     
        ";
        $conter1 = 0;
        foreach ($conexion->query("SELECT DISTINCT(E.question_id) AS ID, C.name AS GRUPO, C.content AS Contenido FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = $curso AND C.surveyid = B.id and B.title='{$tipo}'") as $IDPRE)
        {            
            $html.="   
            <h3>".$IDPRE['Contenido']."</h3><br><br>
            <table id = 'tabla' style='margin: auto; width: 90%; border-spacing: 10px 5px;'>
            <thead>
            <th><center>Pregunta</th>
            <th><center>1</th>
            <th><center>2</th>
            <th><center>3</th>
            <th><center>4</th>
            <th><center>5</th>
            </thead>";
            $promedio = 0;
            
            $conter2 = 0;
            
            foreach ($conexion->query("SELECT E.question_id AS ID_GRUPO, C.name AS GRUPO, D.id AS ID_PREGUNTA, D.content AS PREGUNTAS, ROUND(avg(E.rankvalue),2) AS RESP_PROMEDIO, COUNT(E.rankvalue) AS CANTIDAD FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = $curso AND C.surveyid = B.id AND E.question_id = '{$IDPRE['ID']}' AND B.title='{$tipo}' GROUP BY E.choice_id") as $filas)
            {    
                
                //$promedio+= $filas['RESP_PROMEDIO'];
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

            //$html.="</table><br><br>";
            //$proSEC=$promedio/$conter;  
            $html.="</table><br><br>";   
            $conter1 +=1;      
        }

        if($html==''){
            echo "<h3>¡Aun no hay evaluaciones en este curso!</h3>";
        }else{
            $html.="<div>
            <input type='submit' name='insertar' value='Enviar'>
            </div>  
            </form></body></html>";
            echo $html;
        }
    }
}
//////////////////////// PRESIONAR EL BOTÓN //////////////////////////
if(isset($_POST['insertar'])) {

    //header("Location: survey.php");
    $items1 = ($_POST['rank']);
    $items2 = ($_POST['opcion']);
    $items3 = ($_POST['iduser']);
    $items4 = ($_POST['questid']);
    //print '<pre>';
    //print_r($items1);
    //print '</pre>'; 
    date_default_timezone_set("UTC");
    $hora = time();
    
    $consulta2 = "SELECT questionnaireid FROM mdl_questionnaire_response WHERE questionnaireid = $items4 AND userid = $items3";
    //echo $sql2;
    $result=mysqli_query($conexion,$consulta2);

    if($regi=mysqli_fetch_array($result)){
        echo "";
    //echo $consulta;
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
    //echo $consulta;
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


}

?>
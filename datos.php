<?php
include "conexion.php";
//Variables de Evaluacion de Estudiantes
if (isset($_POST['sel_esp'])){$sel_esp = $_POST['sel_esp'];}
if (isset($_POST['sel_bac'])){$sel_bac = $_POST['sel_bac'];}
if (isset($_POST['sel_bac2'])){$sel_cat = $_POST['sel_bac2'];}
if (isset($_POST['sel_per'])){$sel_per = $_POST['sel_per'];}
if (isset($_POST['sel_doc'])){$sel_doc = $_POST['sel_doc'];}
if (isset($_POST['sel_mat'])){$sel_mat = $_POST['sel_mat'];}
//Variables de Autoevaluacion
if (isset($_POST['sel_cur_auto'])){$sel_cur_auto = $_POST['sel_cur_auto'];}
if (isset($_POST['sel_cur_auto2'])){$sel_cur_auto2 = $_POST['sel_cur_auto2'];}
if (isset($_POST['sel_doc_auto'])){$sel_doc_auto = $_POST['sel_doc_auto'];}
//Variables de Evaluacion de Padres
if (isset($_POST['sel_esp_pad'])){$sel_esp_pad = $_POST['sel_esp_pad'];}
if (isset($_POST['sel_bac_pad'])){$sel_bac_pad = $_POST['sel_bac_pad'];}
if (isset($_POST['sel_bac2_pad'])){$sel_cat_pad = $_POST['sel_bac2_pad'];}
if (isset($_POST['sel_per_pad'])){$sel_per_pad = $_POST['sel_per_pad'];}
if (isset($_POST['sel_doc_pad'])){$sel_doc_pad = $_POST['sel_doc_pad'];}
if (isset($_POST['sel_mat_pad'])){$sel_mat_pad = $_POST['sel_mat_pad'];}
//Variables de Evaluacion de Directivos
if (isset($_POST['sel_cur_dir'])){$sel_cur_dir = $_POST['sel_cur_dir'];}
if (isset($_POST['sel_cur_dir2'])){$sel_cur_dir2 = $_POST['sel_cur_dir2'];}
if (isset($_POST['sel_doc_dir'])){$sel_doc_dir = $_POST['sel_doc_dir'];}
//Variables de Coevaluacion
if (isset($_POST['sel_cur_coev'])){$sel_cur_coev = $_POST['sel_cur_coev'];}
if (isset($_POST['sel_area_coev2'])){$sel_area_coev2= $_POST['sel_area_coev2'];}
if (isset($_POST['sel_area_coev'])){$sel_area_coev = $_POST['sel_area_coev'];}
if (isset($_POST['sel_doc_coev'])){$sel_doc_coev = $_POST['sel_doc_coev'];}
//Variables de Observacion en Clase   
if (isset($_POST['sel_esp_obs'])){$sel_esp_obs = $_POST['sel_esp_obs'];}
if (isset($_POST['sel_bac_obs'])){$sel_bac_obs = $_POST['sel_bac_obs'];}
if (isset($_POST['sel_bac2_obs'])){$sel_cat_obs = $_POST['sel_bac2_obs'];}
if (isset($_POST['sel_per_obs'])){$sel_per_obs = $_POST['sel_per_obs'];}
if (isset($_POST['sel_doc_obs'])){$sel_doc_obs = $_POST['sel_doc_obs'];}
if (isset($_POST['sel_mat_obs'])){$sel_mat_obs = $_POST['sel_mat_obs'];}
//Variables de Reporte Global
if (isset($_POST['sel_esp_re'])){$sel_esp_re = $_POST['sel_esp_re'];}
if (isset($_POST['sel_bac_re'])){$sel_bac_re = $_POST['sel_bac_re'];}
if (isset($_POST['sel_per_re'])){$sel_per_re = $_POST['sel_per_re'];}
//////////////////////////////////////////////////////////////////////
date_default_timezone_set('America/Guayaquil'); 
$Fecha= date("d-m-Y");
////////////////////////////// DEBUG /////////////////////////////////

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

if (isset($sel_esp)) {
    $queryM = "SELECT * FROM mdl_course_categories WHERE parent = '$sel_esp'";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0'>Seleccionar PERIODO</option>";
        while($rowM = $resultadoM->fetch_assoc())
        { 
            $data = explode(" ", $rowM['name']);
            $html.= "<option value='".$rowM['id']."'>".$data["2"].' - '.$data["4"]."</option>";
        }
    echo $html;
}elseif (isset($sel_per)) { 
    $queryM = "SELECT * FROM mdl_course_categories WHERE parent = '$sel_per'";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0'>Seleccionar BACHILLERATO</option>";
        while($rowM = $resultadoM->fetch_assoc())
        { 
            $html.= "<option value='".$rowM['id']."'>".$rowM['name']."</option>";
        }
    echo $html;
}elseif (isset($sel_bac)) {
    $queryM = "SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_bac' AND B.courseid = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0'>Seleccionar DOCENTE</option>";
        while($rowM = $resultadoM->fetch_assoc())
        {
            $html.= "<option value='".$rowM['ID_DOCENTE']."'>".$rowM['NOMBRES']."</option>";
        }
    echo $html;
} elseif (isset($sel_cat) && isset($sel_doc)) {
    $queryM = "SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE, A.fullname AS FULL, A.shortname AS CORTO , A.id AS ID_CURSO FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_cat' AND B.courseid = A.id AND D.id = '$sel_doc' AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0'>Seleccionar MATERIA</option>";
        while($rowM = $resultadoM->fetch_assoc())
        { 
            $html.= "<option value='".$rowM['ID_CURSO']."'>".$rowM['FULL']."</option>";
        }
    echo $html;
} elseif (isset($sel_mat)) {
    $html='';
    $sql = "SELECT C.name AS GRUPO, D.content AS PREGUNTAS, ROUND(AVG(E.rankvalue),2) AS RESP_PROMEDIO FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id and A.course = $sel_mat and C.surveyid = B.id AND B.title='Estudiantes' GROUP BY C.name ORDER BY C.position";

    $query = $conexion->query($sql); // Ejecutar la consulta SQL
    $data = array(); // Array donde vamos a guardar los datos
    while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
        $data[]=$r; // Guardar los resultados en la variable $data
    }
    if($data != null){
        $html="<div style='width: 100%;'>
        <canvas id='chart1' width='100' height='20'></canvas>
        <script>
        var ctx = document.getElementById('chart1');
        var data = {
            labels: [";
            foreach($data as $d):
            $html.="'" . $d->GRUPO . "',"; 
            endforeach; $html.="],
            datasets: [{
                label: 'Promedio',
                data: ["; 
                foreach($data as $d):
                $html.=$d->RESP_PROMEDIO . ","; 
                endforeach; $html.="],
                backgroundColor: '#44A0D388',
                fontColor: '#000000', 
                borderColor: '#013C8088',
                minBarLength: 5,
                borderWidth: 2
            }]
        };
        var options = {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            };
        var chart1 = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
        
        </script>
        </div><BR>";
    }

    


    foreach ($conexion->query("SELECT DISTINCT(E.question_id) AS ID, C.name AS GRUPO, C.content AS Contenido FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = $sel_mat AND C.surveyid = B.id and B.title='Estudiantes'") as $IDPRE)
    {            
        $html.="<h3>".$IDPRE['Contenido']."</h3><table id = 'tabla' style='margin: auto; width: 90%; border-spacing: 10px 5px;'><thead><th><center>Pregunta</th><th><center>Promedio</th><th><center>Calificación</th></thead>";
        $promedio = 0;
        $conter = 0;
        
        foreach ($conexion->query("SELECT E.question_id AS ID, C.name AS GRUPO, D.content AS PREGUNTAS, ROUND(avg(E.rankvalue),2) AS RESP_PROMEDIO, COUNT(E.rankvalue) AS CANTIDAD FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = $sel_mat AND C.surveyid = B.id AND E.question_id = '{$IDPRE['ID']}' AND B.title='Estudiantes' GROUP BY E.choice_id") as $filas)
        {    
            $promedio+= $filas['RESP_PROMEDIO'];
            $conter+= 1;
            if ($filas['RESP_PROMEDIO'] >= 1 && $filas['RESP_PROMEDIO']<3){
                $cal = 'Regular';
            }elseif ($filas['RESP_PROMEDIO'] >= 3 && $filas['RESP_PROMEDIO']<4){
                $cal = 'Bueno';
            }elseif ($filas['RESP_PROMEDIO'] >= 4 && $filas['RESP_PROMEDIO']<4.6){
                $cal = 'Muy Bueno';
            }elseif ($filas['RESP_PROMEDIO'] >= 4.6 && $filas['RESP_PROMEDIO']<=5){
                $cal = 'Excelente';
            }
            $html.= "<tr>"."<td>".$filas['PREGUNTAS']."</td>"."<td><center>".$filas['RESP_PROMEDIO']."</td>"."<td><center>".$cal."</td>"."</tr>";
        }
        $proSEC=$promedio/$conter;  
        $html.="</table><p></p>";         
    }
    if($html==''){
        echo "<p></p><img src='images/estamos-trabajando.png' style='width:25%;' alt='Estamos trabajando'>
        <p style='font-size: 2em; font-weight: bold; color: #44A0D3;  text-align:center;'>¡Lo sentimos, No tenemos Resultados del elemento seleccionado!</p>";
    }else{
        echo $html;
    }
    

} elseif (isset($sel_cur_auto)) { // Autoevaluacion 
    $queryM = "SELECT DISTINCT CONCAT(g.firstname, ' ', g.lastname) AS NOMBRE, g.id AS ID_DOCENTE FROM mdl_questionnaire a, mdl_questionnaire_survey b, mdl_questionnaire_question c, mdl_questionnaire_quest_choice d, mdl_questionnaire_response_rank e, mdl_questionnaire_response f, mdl_user g WHERE e.response_id = f.id AND e.question_id = c.id AND e.choice_id = d.id AND f.questionnaireid = a.id and a.course = (SELECT id FROM mdl_course WHERE category = '$sel_cur_auto' AND fullname LIKE '%Auto%') and c.surveyid = b.id and g.id = f.userid and b.title='Autoevaluacion'";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0'>Seleccionar DOCENTE</option>";
        while($rowM = $resultadoM->fetch_assoc())
        { 
            $html.= "<option value='".$rowM['ID_DOCENTE']."'>".$rowM['NOMBRE']."</option>";
        }
    echo $html;

} elseif (isset($sel_doc_auto) && isset($sel_cur_auto2)) {
    $html='';
    $sql = "SELECT DISTINCT CONCAT(G.firstname, ' ', G.lastname) AS NOMBRE, C.name AS Pregunta, D.content AS opciones, ROUND(avg(E.rankvalue),2) AS Respuesta 
    FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F, mdl_user G 
    WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = (SELECT id FROM mdl_course WHERE category = '$sel_cur_auto2' AND fullname LIKE '%Auto%') AND C.surveyid = B.id AND G.id = F.userid AND G.id = '$sel_doc_auto' GROUP BY C.name ORDER BY C.position";

    $query = $conexion->query($sql); // Ejecutar la consulta SQL
    $data = array(); // Array donde vamos a guardar los datos
    while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
        $data[]=$r; // Guardar los resultados en la variable $data
    }
    if($data != null){
    $html="<div style='width: 100%;'>
    <canvas id='chart1' width='100' height='20'></canvas>
    <script>
    var ctx = document.getElementById('chart1');
    var data = {
        labels: [";
        foreach($data as $d):
        $html.="'" . $d->Pregunta . "',"; 
        endforeach; $html.="],
        datasets: [{
            label: 'Promedio',
            data: ["; 
            foreach($data as $d):
            $html.=$d->Respuesta . ","; 
            endforeach; $html.="],
            backgroundColor: '#44A0D388',
            fontColor: '#000000', 
            borderColor: '#013C8088',
            minBarLength: 5,
            borderWidth: 2
        }]
    };
    var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        };
    var chart1 = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });
    
    </script>
    </div><BR>";
}
    foreach ($conexion->query("SELECT DISTINCT(E.question_id) AS ID, C.name AS GRUPO, C.content AS Contenido FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = (SELECT id FROM mdl_course WHERE category = '$sel_cur_auto2' AND fullname LIKE '%Auto%') AND C.surveyid = B.id and B.title='Autoevaluacion'") as $IDPRE)
    {            
        $html.="<h3>".$IDPRE['Contenido']."</h3><table id = 'tabla' style='margin: auto; width: 90%; border-spacing: 10px 5px;'><thead><th><center>Pregunta</th><th><center>Respuesta</th><th><center>Calificación</th></thead>";
        $promedio = 0;
        $conter = 0;
        
        foreach ($conexion->query("SELECT E.question_id AS ID, C.name AS GRUPO, D.content AS PREGUNTAS, ROUND(E.rankvalue,2) AS RESPUESTA FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = (SELECT id FROM mdl_course WHERE category = '$sel_cur_auto2' AND fullname LIKE '%Auto%') AND C.surveyid = B.id AND E.question_id = '{$IDPRE['ID']}' AND B.title='Autoevaluacion' AND F.userid = '$sel_doc_auto' GROUP BY E.choice_id") as $filas)
        {    
            $promedio+= $filas['RESPUESTA'];
            $conter+= 1;
            if ($filas['RESPUESTA'] >= 1 && $filas['RESPUESTA']<3){
                $cal = 'Regular';
            }elseif ($filas['RESPUESTA'] >= 3 && $filas['RESPUESTA']<4){
                $cal = 'Bueno';
            }elseif ($filas['RESPUESTA'] >= 4 && $filas['RESPUESTA']<4.6){
                $cal = 'Muy Bueno';
            }elseif ($filas['RESPUESTA'] >= 4.6 && $filas['RESPUESTA']<=5){
                $cal = 'Excelente';
            }
            $html.= "<tr>"."<td>".$filas['PREGUNTAS']."</td>"."<td><center>".$filas['RESPUESTA']."</td>"."<td><center>".$cal."</td>"."</tr>";
        }

        $html.="</table><p></p>";
        $proSEC=$promedio/$conter;            
    }
    if($html==''){
        echo "<p></p><img src='images/estamos-trabajando.png' style='width:25%;' alt='Estamos trabajando'>
        <p style='font-size: 2em; font-weight: bold; color: #44A0D3;  text-align:center;'>¡Lo sentimos, No tenemos Resultados del elemento seleccionado!</p>";
    }else{
        echo $html;
    }
    

} elseif (isset($sel_esp_pad)) { //padres
    $queryM = "SELECT * FROM mdl_course_categories WHERE parent = '$sel_esp_pad'";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0'>Seleccionar PERIODO</option>";
        while($rowM = $resultadoM->fetch_assoc())
        { 
            $data = explode(" ", $rowM['name']);
            $html.= "<option value='".$rowM['id']."'>".$data["2"].' - '.$data["4"]."</option>";
        }
    echo $html;
}elseif (isset($sel_per_pad)) { 
    $queryM = "SELECT * FROM mdl_course_categories WHERE parent = '$sel_per_pad'";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0'>Seleccionar BACHILLERATO</option>";
        while($rowM = $resultadoM->fetch_assoc())
        { 
            $html.= "<option value='".$rowM['id']."'>".$rowM['name']."</option>";
        }
    echo $html;
}elseif (isset($sel_bac_pad)) {
    $queryM = "SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_bac_pad' AND B.courseid = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0'>Seleccionar DOCENTE</option>";
        while($rowM = $resultadoM->fetch_assoc())
        {
            $html.= "<option value='".$rowM['ID_DOCENTE']."'>".$rowM['NOMBRES']."</option>";
        }
    echo $html;
} elseif (isset($sel_cat_pad) && isset($sel_doc_pad)) {
    $queryM = "SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE, A.fullname AS FULL, A.shortname AS CORTO , A.id AS ID_CURSO FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_cat_pad' AND B.courseid = A.id AND D.id = '$sel_doc_pad' AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0'>Seleccionar MATERIA</option>";
        while($rowM = $resultadoM->fetch_assoc())
        { 
            $html.= "<option value='".$rowM['ID_CURSO']."'>".$rowM['FULL']."</option>";
        }
    echo $html;
} elseif (isset($sel_mat_pad)) {
    $html='';
    $sql = "SELECT C.name AS GRUPO, D.content AS PREGUNTAS, ROUND(AVG(E.rankvalue),2) AS RESP_PROMEDIO FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id and A.course = $sel_mat_pad and C.surveyid = B.id AND B.title='Padres' GROUP BY C.name ORDER BY C.position";

    $query = $conexion->query($sql); // Ejecutar la consulta SQL
    $data = array(); // Array donde vamos a guardar los datos
    while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
        $data[]=$r; // Guardar los resultados en la variable $data
    }
    if($data != null){
    $html="<div style='width: 100%;'>
    <canvas id='chart1' width='100' height='20'></canvas>
    <script>
    var ctx = document.getElementById('chart1');
    var data = {
        labels: [";
        foreach($data as $d):
        $html.="'" . $d->GRUPO . "',"; 
        endforeach; $html.="],
        datasets: [{
            label: 'Promedio',
            data: ["; 
            foreach($data as $d):
            $html.=$d->RESP_PROMEDIO . ","; 
            endforeach; $html.="],
            backgroundColor: '#44A0D388',
            fontColor: '#000000', 
            borderColor: '#013C8088',
            minBarLength: 5,
            borderWidth: 2
        }]
    };
    var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        };
    var chart1 = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });
    
    </script>
    </div><BR>";}
    foreach ($conexion->query("SELECT DISTINCT(E.question_id) AS ID, C.name AS GRUPO, C.content AS Contenido FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = $sel_mat_pad AND C.surveyid = B.id and B.title='Padres'") as $IDPRE)
    {            
        $html.="<h3>".$IDPRE['Contenido']."</h3><table id = 'tabla' style='margin: auto; width: 90%; border-spacing: 10px 5px;'><thead><th><center>Pregunta</th><th><center>Promedio</th><th><center>Calificación</th></thead>";
        $promedio = 0;
        $conter = 0;
        
        foreach ($conexion->query("SELECT E.question_id AS ID, C.name AS GRUPO, D.content AS PREGUNTAS, ROUND(avg(E.rankvalue),2) AS RESP_PROMEDIO, COUNT(E.rankvalue) AS CANTIDAD FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = $sel_mat_pad AND C.surveyid = B.id AND E.question_id = '{$IDPRE['ID']}' AND B.title='Padres' GROUP BY E.choice_id") as $filas)
        {    
            $promedio+= $filas['RESP_PROMEDIO'];
            $conter+= 1;
            if ($filas['RESP_PROMEDIO'] >= 1 && $filas['RESP_PROMEDIO']<3){
                $cal = 'Regular';
            }elseif ($filas['RESP_PROMEDIO'] >= 3 && $filas['RESP_PROMEDIO']<4){
                $cal = 'Bueno';
            }elseif ($filas['RESP_PROMEDIO'] >= 4 && $filas['RESP_PROMEDIO']<4.6){
                $cal = 'Muy Bueno';
            }elseif ($filas['RESP_PROMEDIO'] >= 4.6 && $filas['RESP_PROMEDIO']<=5){
                $cal = 'Excelente';
            }
            $html.= "<tr>"."<td>".$filas['PREGUNTAS']."</td>"."<td><center>".$filas['RESP_PROMEDIO']."</td>"."<td><center>".$cal."</td>"."</tr>";
        }

        $html.="</table><p></p>";
        $proSEC=$promedio/$conter;            
    }
    if($html==''){
        echo "<p></p><img src='images/estamos-trabajando.png' style='width:25%;' alt='Estamos trabajando'>
        <p style='font-size: 2em; font-weight: bold; color: #44A0D3;  text-align:center;'>¡Lo sentimos, No tenemos Resultados del elemento seleccionado!</p>";
    }else{
        echo $html;
    }
    

}elseif (isset($sel_esp_obs)) { //observacion en clase
    $queryM = "SELECT * FROM mdl_course_categories WHERE parent = '$sel_esp_obs'";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0'>Seleccionar PERIODO</option>";
        while($rowM = $resultadoM->fetch_assoc())
        { 
            $data = explode(" ", $rowM['name']);
            $html.= "<option value='".$rowM['id']."'>".$data["2"].' - '.$data["4"]."</option>";
        }
    echo $html;
}elseif (isset($sel_per_obs)) { 
    $queryM = "SELECT * FROM mdl_course_categories WHERE parent = '$sel_per_obs'";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0'>Seleccionar BACHILLERATO</option>";
        while($rowM = $resultadoM->fetch_assoc())
        { 
            $html.= "<option value='".$rowM['id']."'>".$rowM['name']."</option>";
        }
    echo $html;
} elseif (isset($sel_bac_obs)) {
    $queryM = "SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_bac_obs' AND B.courseid = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0 DOCENTE</option>";
        while($rowM = $resultadoM->fetch_assoc())
        {
            $html.= "<option value='".$rowM['ID_DOCENTE']."'>".$rowM['NOMBRES']."</option>";
        }
    echo $html;
} elseif (isset($sel_cat_obs) && isset($sel_doc_obs)) {
    $queryM = "SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE, A.fullname AS FULL, A.shortname AS CORTO , A.id AS ID_CURSO FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_cat_obs' AND B.courseid = A.id AND D.id = '$sel_doc_obs' AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0'>Seleccionar MATERIA</option>";
        while($rowM = $resultadoM->fetch_assoc())
        { 
            $html.= "<option value='".$rowM['ID_CURSO']."'>".$rowM['FULL']."</option>";
        }
    echo $html;
} elseif (isset($sel_mat_obs)) {
    $html='';
    $sql = "SELECT C.id , C.name AS GRUPO, D.content AS PREGUNTAS, ROUND(AVG(E.rankvalue),2) AS RESP_PROMEDIO, (SELECT COUNT(N.rankvalue) AS CANTIDAD 
    FROM mdl_questionnaire J, mdl_questionnaire_survey K, mdl_questionnaire_question L, mdl_questionnaire_quest_choice M, mdl_questionnaire_response_rank N, mdl_questionnaire_response O
    WHERE N.response_id = O.id AND N.question_id = L.id AND N.choice_id = M.id AND O.questionnaireid = J.id and J.course = $sel_mat_obs and L.surveyid = K.id AND K.title='Observación en Clase' AND L.id = C.id
    GROUP BY L.name 
    ORDER BY L.position) AS CANTIDAD_T, COUNT(E.rankvalue) AS CANTIDAD_R
    FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F 
    WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id and A.course = $sel_mat_obs and C.surveyid = B.id AND B.title='Observación en Clase' AND E.rankvalue < 2
    GROUP BY C.name ORDER BY C.position";
    $query = $conexion->query($sql); // Ejecutar la consulta SQL
    $data = array(); // Array donde vamos a guardar los datos
    while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
        $data[]=$r; // Guardar los resultados en la variable $data
    }
    if($data != null){
    $html="<div style='width: 100%;'>
    <canvas id='chart1' width='100' height='20'></canvas>
    <script>
    var ctx = document.getElementById('chart1');
    var data = {
        labels: [";
        foreach($data as $d):
        $html.="'" . $d->GRUPO . "',"; 
        endforeach; $html.="],
        datasets: [{
            label: 'Promedio',
            data: ["; 
            foreach($data as $d):
                $n1 = $d->CANTIDAD_R;
                $n2 = $d->CANTIDAD_T;                
                $valor = round($n1/$n2,2);
            $html.=$valor . ","; 
            endforeach; $html.="],
            backgroundColor: '#44A0D388',
            fontColor: '#000000', 
            borderColor: '#013C8088',
            minBarLength: 5,
            borderWidth: 2
        }]
    };
    var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        };
    var chart1 = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });
    
    </script>
    </div><BR>";}
    foreach ($conexion->query("SELECT DISTINCT(E.question_id) AS ID, C.name AS GRUPO, C.content AS Contenido FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = $sel_mat_obs AND C.surveyid = B.id and B.title='Observación en Clase'") as $IDPRE)
    {            
        $html.="<h2>".$IDPRE['Contenido']."</h2><table id = 'tabla' style='margin: auto; width: 90%; border-spacing: 10px 5px;'><thead><th><center>Pregunta</th><th><center>Respuesta</th></thead>";
        $promedio = 0;
        $conter = 0;
        //console_log($IDPRE['ID']);
        
        foreach ($conexion->query("SELECT E.question_id AS ID, C.name AS GRUPO, D.content AS PREGUNTAS, ROUND(avg(E.rankvalue),2) AS RESP_PROMEDIO, COUNT(E.rankvalue) AS CANTIDAD FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = $sel_mat_obs AND C.surveyid = B.id AND E.question_id = '{$IDPRE['ID']}' AND B.title='Observación en Clase' GROUP BY E.choice_id") as $filas)
        {    
            if($filas['RESP_PROMEDIO'] != 2){
                $promedio+= $filas['RESP_PROMEDIO'];
                $res='SI';
            }else{
                $res='NO';
            }
            
            $conter+= 1;
            /*
            if ($filas['RESP_PROMEDIO'] >= 1 && $filas['RESP_PROMEDIO']<3){
                $cal = 'Regular';
            }elseif ($filas['RESP_PROMEDIO'] >= 3 && $filas['RESP_PROMEDIO']<4){
                $cal = 'Bueno';
            }elseif ($filas['RESP_PROMEDIO'] >= 4 && $filas['RESP_PROMEDIO']<4.6){
                $cal = 'Muy Bueno';
            }elseif ($filas['RESP_PROMEDIO'] >= 4.6 && $filas['RESP_PROMEDIO']<=5){
                $cal = 'Excelente';
            }*/
            $html.= "<tr>"."<td>".$filas['PREGUNTAS']."</td>"."<td><center>".$res."</td></tr>";
        }

        $html.="</table><p></p>";
        $proSEC=$promedio/$conter;            
    }
    if($html==''){
        echo "<p></p><img src='images/estamos-trabajando.png' style='width:25%;' alt='Estamos trabajando'>
        <p style='font-size: 2em; font-weight: bold; color: #44A0D3;  text-align:center;'>¡Lo sentimos, No tenemos Resultados del elemento seleccionado!</p>";
    }else{
        echo $html;
    }
}elseif (isset($sel_cur_dir)) { ///////////////////////////// Directivos
    if($sel_cur_dir > 0 ){
        $queryM = "SELECT A.id AS ID_Survey, A.course AS Curso, A.name AS NAME_SURVEY, IF(D.id IN (SELECT G.userid FROM mdl_questionnaire_response G WHERE G.questionnaireid = F.id),'SI','NO') AS COMPLETADO FROM mdl_user D, mdl_questionnaire_survey F, mdl_questionnaire A, mdl_user_enrolments E, mdl_enrol AS B WHERE F.courseid = (SELECT id FROM mdl_course WHERE category = '$sel_cur_dir' AND fullname LIKE '%Directivo%') AND A.id = F.id AND B.courseid = A.course AND E.enrolid = B.id AND D.id = E.userid";
        $resultadoM = $conexion->query($queryM);
        $html= "<option value='0'>Seleccionar Docente</option>";
            while($rowM = $resultadoM->fetch_assoc())
            { 
                if($rowM['COMPLETADO'] == 'SI'){
                    $data = explode(" - ", $rowM['NAME_SURVEY']);
                    $html.= "<option value='".$rowM["ID_Survey"]."'>".$data["1"]."</option>";
                }
                
            }
        echo $html;
    }

} elseif (isset($sel_cur_dir2) && isset($sel_doc_dir)) {
    $html='';
    
    $sql = "SELECT  C.name AS GRUPO, D.content AS PREGUNTAS, ROUND(AVG(E.rankvalue),2) AS RESP_PROMEDIO 
    FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F 
    WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = (SELECT id FROM mdl_course WHERE category = '$sel_cur_dir2' AND fullname LIKE '%Directivo%') AND B.id = $sel_doc_dir AND A.id = B.id GROUP BY C.name ORDER BY C.position";

    $query = $conexion->query($sql); // Ejecutar la consulta SQL
    $data = array(); // Array donde vamos a guardar los datos
    while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
        $data[]=$r; // Guardar los resultados en la variable $data
    }
    if($data != null){
        $html="<div style='width: 100%;'>
        <canvas id='chart1' width='100' height='20'></canvas>
        <script>
        var ctx = document.getElementById('chart1');
        var data = {
            labels: [";
            foreach($data as $d):
            $html.="'" . $d->GRUPO . "',"; 
            endforeach; $html.="],
            datasets: [{
                label: 'Promedio',
                data: ["; 
                foreach($data as $d):
                $html.=$d->RESP_PROMEDIO . ","; 
                endforeach; $html.="],
                backgroundColor: '#44A0D388',
                fontColor: '#000000', 
                borderColor: '#013C8088',
                minBarLength: 5,
                borderWidth: 2
            }]
        };
        var options = {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            };
        var chart1 = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
        
        </script>
        </div><BR>";
    }

    foreach ($conexion->query("SELECT DISTINCT(E.question_id) AS ID, C.name AS GRUPO, C.content AS Contenido, A.course AS CURSO FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = (SELECT id FROM mdl_course WHERE category = '$sel_cur_dir2' AND fullname LIKE '%Directivo%') AND B.id = $sel_doc_dir AND A.id = B.id") as $IDPRE)
    {            
        $html.="<h3>".$IDPRE['Contenido']."</h3><table id = 'tabla' style='margin: auto; width: 90%; border-spacing: 10px 5px;'><thead><th><center>Pregunta</th><th><center>Respuesta</th><th><center>Calificación</th></thead>";
        $promedio = 0;
        $conter = 0;
        
        foreach ($conexion->query("SELECT E.question_id AS ID, C.name AS GRUPO, D.content AS PREGUNTAS, E.rankvalue AS RESPUESTA FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = (SELECT id FROM mdl_course WHERE category ='$sel_cur_dir2' AND fullname LIKE '%Directivo%') AND C.surveyid = B.id AND E.question_id = '{$IDPRE['ID']}' AND B.title='Directivos' GROUP BY E.choice_id") as $filas)
        {    
            $promedio+= $filas['RESPUESTA'];
            $conter+= 1;
            if ($filas['RESPUESTA'] >= 1 && $filas['RESPUESTA']<3){
                $cal = 'Regular';
            }elseif ($filas['RESPUESTA'] >= 3 && $filas['RESPUESTA']<4){
                $cal = 'Bueno';
            }elseif ($filas['RESPUESTA'] >= 4 && $filas['RESPUESTA']<4.6){
                $cal = 'Muy Bueno';
            }elseif ($filas['RESPUESTA'] >= 4.6 && $filas['RESPUESTA']<=5){
                $cal = 'Excelente';
            }
            $html.= "<tr>"."<td>".$filas['PREGUNTAS']."</td>"."<td><center>".$filas['RESPUESTA']."</td>"."<td><center>".$cal."</td>"."</tr>";
        }

        $html.="</table><p></p>";
        $proSEC=$promedio/$conter;            
    }
    
    if($html==''){
        echo "<p></p><img src='images/estamos-trabajando.png' style='width:25%;' alt='Estamos trabajando'>
        <p style='font-size: 2em; font-weight: bold; color: #44A0D3;  text-align:center;'>¡Lo sentimos, No tenemos Resultados del elemento seleccionado!</p>";
    }else{
        echo $html;
    }
    

}elseif (isset($sel_cur_coev)) { ////////////// COEVALUACION
    if($sel_cur_coev > 0 ){
        $queryM = "SELECT * FROM mdl_course WHERE category = '$sel_cur_coev' AND fullname LIKE '%Coevaluacion%'";
        $resultadoM = $conexion->query($queryM);
        $html= "<option value='0'>Seleccionar AREA</option>";
            while($rowM = $resultadoM->fetch_assoc())
            { 
                $data = explode(" - ", $rowM['fullname']);
                $html.= "<option value='".$rowM["id"]."'>".$data["1"]."</option>";
            }
        echo $html;
    }
}elseif (isset($sel_area_coev)) { 
    if($sel_area_coev > 0 ){
        $queryM = "SELECT A.id AS ID_Survey, A.course AS Curso, A.name AS NAME_SURVEY, IF(D.id IN (SELECT G.userid FROM mdl_questionnaire_response G WHERE G.questionnaireid = F.id),'SI','NO') AS COMPLETADO FROM mdl_user D, mdl_questionnaire_survey F, mdl_questionnaire A, mdl_user_enrolments E, mdl_enrol AS B WHERE F.courseid = $sel_area_coev AND A.id = F.id AND B.courseid = A.course AND E.enrolid = B.id AND D.id = E.userid";
        $resultadoM = $conexion->query($queryM);
        $html= "<option value='0'>Seleccionar DOCENTE</option>";
            while($rowM = $resultadoM->fetch_assoc())
            { 
                if($rowM['COMPLETADO'] == 'SI'){
                    $data = explode(" - ", $rowM['NAME_SURVEY']);
                    $html.= "<option value='".$rowM["ID_Survey"]."'>".$data["1"]."</option>";
                }
            }
        echo $html;
    }
} elseif (isset($sel_area_coev2) && isset($sel_doc_coev)) {
    $html='';
    
    $sql = "SELECT  C.name AS GRUPO, D.content AS PREGUNTAS, ROUND(AVG(E.rankvalue),2) AS RESP_PROMEDIO 
    FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F 
    WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = $sel_area_coev2 AND B.id = $sel_doc_coev AND A.id = B.id GROUP BY C.name ORDER BY C.position";
    
    //console_log($sql);

    $query = $conexion->query($sql); // Ejecutar la consulta SQL
    $data = array(); // Array donde vamos a guardar los datos
    while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
        $data[]=$r; // Guardar los resultados en la variable $data
    }
    if($data != null){
        $html="<div style='width: 100%;'>
        <canvas id='chart1' width='100' height='20'></canvas>
        <script>
        var ctx = document.getElementById('chart1');
        var data = {
            labels: [";
            foreach($data as $d):
            $html.="'" . $d->GRUPO . "',"; 
            endforeach; $html.="],
            datasets: [{
                label: 'Promedio',
                data: ["; 
                foreach($data as $d):
                $html.=$d->RESP_PROMEDIO . ","; 
                endforeach; $html.="],
                backgroundColor: '#44A0D388',
                fontColor: '#000000', 
                borderColor: '#013C8088',
                minBarLength: 5,
                borderWidth: 2
            }]
        };
        var options = {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            };
        var chart1 = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
        
        </script>
        </div><BR>";
    }
    foreach ($conexion->query("SELECT DISTINCT(E.question_id) AS ID, C.name AS GRUPO, C.content AS Contenido, A.course AS CURSO FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = '$sel_area_coev2' AND B.id = $sel_doc_coev AND A.id = B.id") as $IDPRE)
    {            
        $html.="<h3>".$IDPRE['Contenido']."</h3><table id = 'tabla' style='margin: auto; width: 90%; border-spacing: 10px 5px;'><thead><th><center>Pregunta</th><th><center>Respuesta</th><th><center>Calificación</th></thead>";
        $promedio = 0;
        $conter = 0;
        
        foreach ($conexion->query("SELECT E.question_id AS ID, C.name AS GRUPO, D.content AS PREGUNTAS, E.rankvalue AS RESPUESTA FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = '$sel_area_coev2' AND C.surveyid = B.id AND E.question_id = '{$IDPRE['ID']}' GROUP BY E.choice_id") as $filas)
        {    
            $promedio+= $filas['RESPUESTA'];
            $conter+= 1;
            if ($filas['RESPUESTA'] >= 1 && $filas['RESPUESTA']<3){
                $cal = 'Regular';
            }elseif ($filas['RESPUESTA'] >= 3 && $filas['RESPUESTA']<4){
                $cal = 'Bueno';
            }elseif ($filas['RESPUESTA'] >= 4 && $filas['RESPUESTA']<4.6){
                $cal = 'Muy Bueno';
            }elseif ($filas['RESPUESTA'] >= 4.6 && $filas['RESPUESTA']<=5){
                $cal = 'Excelente';
            }
            $html.= "<tr>"."<td>".$filas['PREGUNTAS']."</td>"."<td><center>".$filas['RESPUESTA']."</td>"."<td><center>".$cal."</td>"."</tr>";
        }

        $html.="</table><p></p>";
        //$proSEC=$promedio/$conter;            
    }
    
    if($html==''){
        echo "<p></p><img src='images/estamos-trabajando.png' style='width:25%;' alt='Estamos trabajando'>
        <p style='font-size: 2em; font-weight: bold; color: #44A0D3;  text-align:center;'>¡Lo sentimos, No tenemos Resultados del elemento seleccionado!</p>";
    }else{
        echo $html;
    } 






////////////////////////////////////////////////////////////////////////////////////////////////////////







}elseif (isset($sel_esp_re)) { ///////////////// REPORTE GLOBAL
    $queryM = "SELECT * FROM mdl_course_categories WHERE parent = '$sel_esp_re'";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0'>Seleccionar PERIODO</option>";
        while($rowM = $resultadoM->fetch_assoc())
        { 
            $data = explode(" ", $rowM['name']);
            $html.= "<option value='".$rowM['id']."'>".$data["2"].' - '.$data["4"]."</option>";
            //console_log($html);
        }
    echo $html;
}elseif (isset($sel_per_re)) { 
    $queryM = "SELECT * FROM mdl_course_categories WHERE parent = '$sel_per_re'";
    $resultadoM = $conexion->query($queryM);
    $html= "<option value='0'>Seleccionar BACHILLERATO</option>";
        while($rowM = $resultadoM->fetch_assoc())
        { 
            $html.= "<option value='".$rowM['id']."'>".$rowM['name']."</option>";
        }
    echo $html;
}elseif (isset($sel_bac_re)) {
        $Espe = '';
        $Peri = '';
        $Curso = '';
        $bue=0;
        $reg=0;
        $muy=0;
        $exc=0;
        $especialidad= $_POST['sel_esp_re2'];;
        $periodo= $_POST['sel_per_re2'];;
        
        $consultaA="SELECT name AS Nombre FROM mdl_course_categories WHERE id = $especialidad";
        $resultadoA=mysqli_query($conexion,$consultaA);
        if($rowA = mysqli_fetch_array($resultadoA)){
            $Espe= $rowA['Nombre'];
        }

        $consultaB = "SELECT SUBSTRING(name,17,15) AS Nombre FROM `mdl_course_categories` WHERE id = (SELECT parent FROM `mdl_course_categories` WHERE id=$sel_bac_re)";
        $resultadoB = mysqli_query($conexion,$consultaB);
        if($rowB = mysqli_fetch_array($resultadoB)){
            $Peri= $rowB['Nombre'];
        }

        $consultaC = "SELECT name AS Nombre FROM `mdl_course_categories` WHERE id = $sel_bac_re";
        $resultadoC = mysqli_query($conexion,$consultaC);
        if($rowC = mysqli_fetch_array($resultadoC)){
            $Curso= $rowC['Nombre'];
        }


    $html = '';
    //console_log($sel_bac_re);
    $queryM = " SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE 
                FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E 
                WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_bac_re' AND B.courseid = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')";
    
    $html.=""; ///oculto para imprimir agregar datos


    for ($i=0;$i<2;$i++) {
        if($i==0){
            $sumatoria = 0;
            $reg=0;
            $bue=0;
            $muy=0;
            $exc=0;
            $doc_reg='';
            $doc_bue='';
            $doc_muy='';
            $doc_exc='';
            foreach ($conexion->query("SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE, D.username AS USERNAME
            FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E 
            WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_bac_re' AND B.courseid = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')
            ORDER BY D.firstname") as $filas)
            {
                //console_log($filas['USERNAME']);
                $est = 0;
                $pad = 0;
                $obs = 0;
                $auto = 0;
                $dir = 0;
                $coe = 0;
                $cal = '';
                $per = '';
                $enlace='';
                $total = 0;
                $nombre = $filas['NOMBRES'];
                
                

                $consulta="SELECT SUBSTRING(name,17,15) AS Nombre FROM `mdl_course_categories` WHERE id = (SELECT parent FROM `mdl_course_categories` WHERE id=$sel_bac_re)";
        
                $result=mysqli_query($conexion,$consulta);
                if($row = mysqli_fetch_array($result)){
                    $per= $row['Nombre'];
                    //console_log($per);
                }

                //$per='2021'; /// PRUEBA LOCAL

                ////////// Ev. Estudiantes
                $consulta1="SELECT A.id AS ID_CURSO, B.id AS ID_ENROL, D.username AS USERNAME, CONCAT(D.firstname, ' ', D.lastname) NOMBRES, E.name AS NOMBRE_ENCUESTA, ROUND ( AVG ((SELECT AVG(U.rankvalue) FROM mdl_questionnaire Q, mdl_questionnaire_survey R, mdl_questionnaire_question S, mdl_questionnaire_quest_choice T, mdl_questionnaire_response_rank U, mdl_questionnaire_response V WHERE U.response_id = V.id AND U.question_id = S.id AND U.choice_id = T.id AND V.questionnaireid = Q.id AND Q.course = E.course AND S.surveyid = R.id AND Q.name LIKE '%Estudiantes%'))*0.2,2) AS PROMEDIO
                FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E 
                WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND B.courseid = A.id AND E.course = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20') AND A.category = $sel_bac_re AND D.username = '".$filas['USERNAME']."' AND E.name LIKE '%Estudiantes%'
                ORDER BY D.firstname";
                $result1=mysqli_query($conexion,$consulta1);

                if($row1 = mysqli_fetch_array($result1)){
                $est= $row1['PROMEDIO'];
                }

                /////////// Ev. Padres
                $consulta2="SELECT A.id AS ID_CURSO, B.id AS ID_ENROL, D.username AS USERNAME, CONCAT(D.firstname, ' ', D.lastname) NOMBRES, E.name AS NOMBRE_ENCUESTA, ROUND ( AVG ((SELECT AVG(U.rankvalue) FROM mdl_questionnaire Q, mdl_questionnaire_survey R, mdl_questionnaire_question S, mdl_questionnaire_quest_choice T, mdl_questionnaire_response_rank U, mdl_questionnaire_response V WHERE U.response_id = V.id AND U.question_id = S.id AND U.choice_id = T.id AND V.questionnaireid = Q.id AND Q.course = E.course AND S.surveyid = R.id  AND Q.name LIKE '%Padres%'))*0.2,2) AS PROMEDIO
                FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E 
                WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND B.courseid = A.id AND E.course = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20') AND A.category = $sel_bac_re AND D.username = '".$filas['USERNAME']."' AND E.name LIKE '%Padres%'
                ORDER BY D.firstname";
                $result2=mysqli_query($conexion,$consulta2);

                if($row2 = mysqli_fetch_array($result2)){
                $pad= $row2['PROMEDIO'];
                }

                /// Observacion en Clase
                $consulta3="SELECT A.id AS ID_CURSO, B.id AS ID_ENROL, D.username AS USERNAME, CONCAT(D.firstname, ' ', D.lastname) NOMBRES, E.name AS NOMBRE_ENCUESTA, SUM((SELECT COUNT(U.rankvalue) FROM mdl_questionnaire Q, mdl_questionnaire_survey R, mdl_questionnaire_question S, mdl_questionnaire_quest_choice T, mdl_questionnaire_response_rank U, mdl_questionnaire_response V WHERE U.response_id = V.id AND U.question_id = S.id AND U.choice_id = T.id AND V.questionnaireid = Q.id AND Q.course = E.course AND S.surveyid = R.id  AND Q.name LIKE '%Clase%' AND U.rankvalue <2)) AS CANTIDAD_R, SUM((SELECT COUNT(U.rankvalue) AS CANTIDAD_R FROM mdl_questionnaire Q, mdl_questionnaire_survey R, mdl_questionnaire_question S, mdl_questionnaire_quest_choice T, mdl_questionnaire_response_rank U, mdl_questionnaire_response V WHERE U.response_id = V.id AND U.question_id = S.id AND U.choice_id = T.id AND V.questionnaireid = Q.id AND Q.course = E.course AND S.surveyid = R.id  AND Q.name LIKE '%Clase%')) AS CANTIDAD_T 
                FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E 
                WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND B.courseid = A.id AND E.course = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20') AND A.category = $sel_bac_re AND D.username = '".$filas['USERNAME']."' AND E.name LIKE '%Clase%'
                ORDER BY D.firstname";
                $result3=mysqli_query($conexion,$consulta3);

                if($row3 = mysqli_fetch_array($result3)){
                    if($row3['CANTIDAD_R'] != null && $row3['CANTIDAD_T'] != null){       
                    $obs= round(($row3['CANTIDAD_R']/$row3['CANTIDAD_T'])*0.5,2);}else {$obs=0;} 
                }

                //////// Autoevaluacion
                $consulta4=" SELECT ROUND(AVG(e.rankvalue)*0.1,2) AS Respuesta 
                            FROM mdl_questionnaire a, mdl_questionnaire_survey b, mdl_questionnaire_question c, mdl_questionnaire_quest_choice d, mdl_questionnaire_response_rank e, mdl_questionnaire_response f, mdl_user g 
                            WHERE e.response_id = f.id AND e.question_id = c.id AND e.choice_id = d.id AND f.questionnaireid = a.id and a.course = (SELECT id FROM mdl_course WHERE category = (SELECT id FROM mdl_course_categories WHERE parent = 2 AND name LIKE '%Evaluaciones ".$per."%') AND fullname LIKE '%Auto%') and c.surveyid = b.id and g.id = f.userid and g.id = '".$filas['ID_DOCENTE']."'";
                $result4=mysqli_query($conexion,$consulta4);
                
                if($row4 = mysqli_fetch_array($result4)){
                    $auto= $row4['Respuesta'];
                }

                //////// Ev. Directivos
                $consulta5=" SELECT ROUND(AVG(E.rankvalue)*0.2,2) AS Respuesta 
                FROM mdl_questionnaire_response_rank E 
                WHERE E.response_id = (SELECT B.id FROM mdl_questionnaire_response B WHERE B.questionnaireid = (SELECT A.id FROM mdl_questionnaire A WHERE A.course = (SELECT id FROM mdl_course WHERE fullname LIKE '%Directivo%' AND category = (SELECT id FROM mdl_course_categories WHERE parent = 2 AND name LIKE '%Evaluaciones ".$per."%')) AND A.name LIKE '%".$filas['NOMBRES']."%'))";
                $result5=mysqli_query($conexion,$consulta5);
                if($row5 = mysqli_fetch_array($result5)){
                    $dir= $row5['Respuesta'];
                }

                ///////////////// Coevaluacion //////////////////
                $conter = 0;
                foreach ($conexion->query("SELECT id AS Curso, SUBSTRING(fullname,15,50) AS NOMBRE FROM mdl_course WHERE category =( SELECT id FROM mdl_course_categories WHERE parent = 2 AND NAME LIKE '%Evaluaciones ".$per."%' ) AND fullname LIKE '%Coevaluación%'") as $rows)
                {   
                    $consulta6="SELECT ROUND(AVG(E.rankvalue) * 0.2, 2) AS Respuesta FROM mdl_questionnaire_response_rank E WHERE E.response_id =(SELECT B.id FROM mdl_questionnaire_response B WHERE B.questionnaireid =(SELECT A.id FROM mdl_questionnaire A WHERE A.course =".$rows['Curso']." AND A.name LIKE '%".$filas['NOMBRES']."%'))";
                    $result6=mysqli_query($conexion,$consulta6);
                    if($row6 = mysqli_fetch_array($result6)){
                        $coe += $row6['Respuesta'];
                        //console_log($rows['NOMBRE']);
                        if($row6['Respuesta']>0){
                            $conter += 1;
                        }                
                        //console_log($coe);
                    }
                    //console_log($filas['NOMBRES']);
                    //console_log($rows['Curso']);
                }
                if($conter>0){
                    $coev= $coe/$conter;
                }else{
                    $coev= '0';
                }
                
                /////////////////////////////////////////////////
                $total= $est + $pad + $obs + $auto + $dir + $coev;
                if($est == 0){
                    $est= '0';
                }
                if($pad == 0){
                    $pad= '0';
                }
                if($obs == 0){
                    $obs= '0';
                }
                if($auto == 0){
                    $auto= '0';
                }
                if($dir == 0){
                    $dir= '0';
                }
                if($coev == 0){
                    $coev= '0';
                }

                if ($total >= 1 && $total<3) { //Cambiar a 1
                    $cal = 'Regular';
                    $sortkey = 4;
                    $reg+=1;
                    $doc_reg.= "'   ".$filas['NOMBRES']."', ";
                    
                } elseif ($total >= 3 && $total<4) {
                    $cal = 'Bueno';
                    $sortkey = 3;
                    $bue+=1;
                    $doc_bue.= "'   ".$filas['NOMBRES']."', ";
                } elseif ($total >= 4 && $total<4.6) {
                    $cal = 'Muy Bueno';
                    $sortkey = 2;
                    $muy+=1;
                    $doc_muy.= "'   ".$filas['NOMBRES']."', ";
                } elseif ($total >= 4.6 && $total<=5) {
                    $cal = 'Excelente';
                    $sortkey = 1;
                    $exc+=1;
                    $doc_exc.= "'   ".$filas['NOMBRES']."', ";
                }
            }

            $matrix = "[[".$doc_exc."],[".$doc_muy."],[".$doc_bue."],[".$doc_reg."]]"; 
            
            //$html.="<script>console.log([[".$doc_exc."],[".$doc_muy."],[".$doc_bue."],[".$doc_reg."]]);</script>";
            $html.="
                    <div id='grafico' class='' style='width: 100%; margin-bottom: 2%;'>
                    <canvas id='chart1' width='100' height='20'></canvas>
                    <script>

                        var ctx = document.getElementById('chart1');
                        //
                        var data = {
                            labels: ['EXCELENTE ', 'MUY BUENO ', 'BUENO ', 'REGULAR '],
                            datasets: [{
                                label: 'Docentes',
                                data: [".$exc.",".$muy.",".$bue.",".$reg."],
                                backgroundColor: ['#013C8088','#F4CE0088','#FD770088','#cf161688']                                                  
                            }]
                        };
                        var matriz =[[".$doc_exc."],[".$doc_muy."],[".$doc_bue."],[".$doc_reg."]];
                        var chart1 = new Chart(ctx, {
                            type: 'pie',
                            data: data,
                            options: {
                                legend: {
                                    display: true
                                },
                                animation: {
                                    duration: 1200,
                                    easing: 'easeOutQuart',
                                    onComplete: function() {
                                        var ctx = this.chart.ctx;
                
                                        
                                        ctx.font = '16px LatoRegular, Helvetica,sans-serif';
                                        ctx.font.weight = '900';
                                        ctx.textAlign = 'center';
                                        ctx.textBaseline = 'bottom';
                                        this.data.datasets.forEach(function(dataset) {
                                            for (var i = 0; i < dataset.data.length; i++) {
                                                var m = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                                    t = dataset._meta[Object.keys(dataset._meta)[0]].total,
                                                    mR = m.innerRadius + (m.outerRadius - m.innerRadius) / 2,
                                                    sA = m.startAngle,
                                                    eA = m.endAngle,
                                                    mA = sA + (eA - sA) / 2;
                                                var x = mR * Math.cos(mA);
                                                var y = mR * Math.sin(mA);
                                                ctx.fillStyle = '#000';
                
                                                var p = String(Math.round(dataset.data[i] / t * 100)) + '%';
                                                if (dataset.data[i] > 0) {
                                                    //ctx.fillText(dataset.data[i], m.x + x, m.y + y-10);
                                                    ctx.fillText(p, m.x + x, m.y + y + 5);
                                                }
                                            }
                                        });
                                    }
                                },
                                tooltips: {
                                    callbacks: {
                                        title: function(tooltipItem, data) {
                                        return data['labels'][tooltipItem[0]['index']];
                                        },
                                        beforeLabel: function(tooltipItem, data) {
                                        return 'No. de Docentes: ' + data['datasets'][0]['data'][tooltipItem['index']];
                                        },
                                        label: function(tooltipItem, data) {
                                        //var multistringText = ['label 1' + tooltipItem['index'],'label 2','label 3','label 4']; //Cambiar el array por una matriz para mostrar los datos segun la key que tengan, por ejemplo: todos los docentes de excelente, luego todos los docentes de muy bueno y asi sucesivamente...      
                                        
                                        var multistringText = matriz[tooltipItem['index']];
                                        return multistringText;
                                        },
                                        afterLabel: function(tooltipItem, data) {
                                        var dataset = data['datasets'][0];
                                        var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset['_meta'][0]['total']) * 100)
                                        return 'Porcentaje: ' + percent + '%';
                                        }
                                    },
                                    backgroundColor: '#FFF',
                                    titleFontSize: 16,
                                    titleFontColor: '#013C80',
                                    bodyFontColor: '#000',
                                    bodyFontSize: 14,
                                    displayColors: false
                                }
                            }
                        });    
                        chart1.update();
                    </script>
                </div>";
                
                 
        }else{
            $html.="
            
            <script src='js/sorttable.js'></script>
            <table id = 'tabla' style='margin: auto; width: 100%; border-spacing: 10px 5px;' class='sortable'>
                <thead>
                    <th style='width: 0%;' class='sorttable_nosort'><center>No.</th>
                    <th><center>Docentes</th>
                    <th><center>Ev. Estudiantes</th>
                    <th><center>Ev. Padres</th>                    
                    <th><center>Observación en Clase</th>
                    <th><center>Autoevaluación</th>
                    <th><center>Ev. Directivos</th>
                    <th><center>Coevaluación</th>
                    <th><center>Total</th>
                    <th><center>Cualitativo</th>
                    <th class='detalle sorttable_nosort'><center>Detalle</th>
                </thead>";
            $cont =0;

            foreach ($conexion->query("SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE, D.username AS USERNAME
            FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E 
            WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_bac_re' AND B.courseid = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')
            ORDER BY D.firstname") as $filas)
            {           
                //console_log($filas['USERNAME']); 
                $est = 0;
                $pad = 0;
                $obs = 0;
                $auto = 0;
                $dir = 0;
                $coe = 0;
                $cal = '';
                $per = '';
                $enlace='';
                $total = 0;
                $nombre = $filas['NOMBRES'];

                $consulta="SELECT SUBSTRING(name,17,15) AS Nombre FROM `mdl_course_categories` WHERE id = (SELECT parent FROM `mdl_course_categories` WHERE id=$sel_bac_re)";
        
                $result=mysqli_query($conexion,$consulta);
                if($row = mysqli_fetch_array($result)){
                    $per= $row['Nombre'];
                    //console_log($per);
                }

                //$per='2021'; /// PRUEBA LOCAL

                ////////// Ev. Estudiantes
                $consulta1="SELECT A.id AS ID_CURSO, B.id AS ID_ENROL, D.username AS USERNAME, CONCAT(D.firstname, ' ', D.lastname) NOMBRES, E.name AS NOMBRE_ENCUESTA, ROUND ( AVG ((SELECT AVG(U.rankvalue) FROM mdl_questionnaire Q, mdl_questionnaire_survey R, mdl_questionnaire_question S, mdl_questionnaire_quest_choice T, mdl_questionnaire_response_rank U, mdl_questionnaire_response V WHERE U.response_id = V.id AND U.question_id = S.id AND U.choice_id = T.id AND V.questionnaireid = Q.id AND Q.course = E.course AND S.surveyid = R.id AND Q.name LIKE '%Estudiantes%'))*0.2,2) AS PROMEDIO
                FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E 
                WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND B.courseid = A.id AND E.course = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20') AND A.category = $sel_bac_re AND D.username = '".$filas['USERNAME']."' AND E.name LIKE '%Estudiantes%'
                ORDER BY D.firstname";
                $result1=mysqli_query($conexion,$consulta1);

                if($row1 = mysqli_fetch_array($result1)){
                $est= $row1['PROMEDIO'];
                }

                /////////// Ev. Padres
                $consulta2="SELECT A.id AS ID_CURSO, B.id AS ID_ENROL, D.username AS USERNAME, CONCAT(D.firstname, ' ', D.lastname) NOMBRES, E.name AS NOMBRE_ENCUESTA, ROUND ( AVG ((SELECT AVG(U.rankvalue) FROM mdl_questionnaire Q, mdl_questionnaire_survey R, mdl_questionnaire_question S, mdl_questionnaire_quest_choice T, mdl_questionnaire_response_rank U, mdl_questionnaire_response V WHERE U.response_id = V.id AND U.question_id = S.id AND U.choice_id = T.id AND V.questionnaireid = Q.id AND Q.course = E.course AND S.surveyid = R.id  AND Q.name LIKE '%Padres%'))*0.2,2) AS PROMEDIO
                FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E 
                WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND B.courseid = A.id AND E.course = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20') AND A.category = $sel_bac_re AND D.username = '".$filas['USERNAME']."' AND E.name LIKE '%Padres%'
                ORDER BY D.firstname";
                $result2=mysqli_query($conexion,$consulta2);

                if($row2 = mysqli_fetch_array($result2)){
                $pad= $row2['PROMEDIO'];
                }

                /// Observacion en Clase
                $consulta3="SELECT A.id AS ID_CURSO, B.id AS ID_ENROL, D.username AS USERNAME, CONCAT(D.firstname, ' ', D.lastname) NOMBRES, E.name AS NOMBRE_ENCUESTA, SUM((SELECT COUNT(U.rankvalue) FROM mdl_questionnaire Q, mdl_questionnaire_survey R, mdl_questionnaire_question S, mdl_questionnaire_quest_choice T, mdl_questionnaire_response_rank U, mdl_questionnaire_response V WHERE U.response_id = V.id AND U.question_id = S.id AND U.choice_id = T.id AND V.questionnaireid = Q.id AND Q.course = E.course AND S.surveyid = R.id  AND Q.name LIKE '%Clase%' AND U.rankvalue <2)) AS CANTIDAD_R, SUM((SELECT COUNT(U.rankvalue) AS CANTIDAD_R FROM mdl_questionnaire Q, mdl_questionnaire_survey R, mdl_questionnaire_question S, mdl_questionnaire_quest_choice T, mdl_questionnaire_response_rank U, mdl_questionnaire_response V WHERE U.response_id = V.id AND U.question_id = S.id AND U.choice_id = T.id AND V.questionnaireid = Q.id AND Q.course = E.course AND S.surveyid = R.id  AND Q.name LIKE '%Clase%')) AS CANTIDAD_T 
                FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E 
                WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND B.courseid = A.id AND E.course = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20') AND A.category = $sel_bac_re AND D.username = '".$filas['USERNAME']."' AND E.name LIKE '%Clase%'
                ORDER BY D.firstname";
                $result3=mysqli_query($conexion,$consulta3);

                if($row3 = mysqli_fetch_array($result3)){
                    if($row3['CANTIDAD_R'] != null && $row3['CANTIDAD_T'] != null){       
                    $obs= round(($row3['CANTIDAD_R']/$row3['CANTIDAD_T'])*0.5,2);}else {$obs=0;} 
                }

                //////// Autoevaluacion
                $consulta4=" SELECT ROUND(AVG(e.rankvalue)*0.1,2) AS Respuesta 
                            FROM mdl_questionnaire a, mdl_questionnaire_survey b, mdl_questionnaire_question c, mdl_questionnaire_quest_choice d, mdl_questionnaire_response_rank e, mdl_questionnaire_response f, mdl_user g 
                            WHERE e.response_id = f.id AND e.question_id = c.id AND e.choice_id = d.id AND f.questionnaireid = a.id and a.course = (SELECT id FROM mdl_course WHERE category = (SELECT id FROM mdl_course_categories WHERE parent = 2 AND name LIKE '%Evaluaciones ".$per."%') AND fullname LIKE '%Auto%') and c.surveyid = b.id and g.id = f.userid and g.id = '".$filas['ID_DOCENTE']."'";
                $result4=mysqli_query($conexion,$consulta4);
                
                if($row4 = mysqli_fetch_array($result4)){
                    $auto= $row4['Respuesta'];
                }

                //////// Ev. Directivos
                $consulta5=" SELECT ROUND(AVG(E.rankvalue)*0.2,2) AS Respuesta 
                FROM mdl_questionnaire_response_rank E 
                WHERE E.response_id = (SELECT B.id FROM mdl_questionnaire_response B WHERE B.questionnaireid = (SELECT A.id FROM mdl_questionnaire A WHERE A.course = (SELECT id FROM mdl_course WHERE fullname LIKE '%Directivo%' AND category = (SELECT id FROM mdl_course_categories WHERE parent = 2 AND name LIKE '%Evaluaciones ".$per."%')) AND A.name LIKE '%".$filas['NOMBRES']."%'))";
                $result5=mysqli_query($conexion,$consulta5);
                if($row5 = mysqli_fetch_array($result5)){
                    $dir= $row5['Respuesta'];
                }

                ///////////////// Coevaluacion //////////////////
                $conter = 0;
                foreach ($conexion->query("SELECT id AS Curso, SUBSTRING(fullname,15,50) AS NOMBRE FROM mdl_course WHERE category =( SELECT id FROM mdl_course_categories WHERE parent = 2 AND NAME LIKE '%Evaluaciones ".$per."%' ) AND fullname LIKE '%Coevaluación%'") as $rows)
                {   
                    $consulta6="SELECT ROUND(AVG(E.rankvalue) * 0.2, 2) AS Respuesta FROM mdl_questionnaire_response_rank E WHERE E.response_id =(SELECT B.id FROM mdl_questionnaire_response B WHERE B.questionnaireid =(SELECT A.id FROM mdl_questionnaire A WHERE A.course =".$rows['Curso']." AND A.name LIKE '%".$filas['NOMBRES']."%'))";
                    $result6=mysqli_query($conexion,$consulta6);
                    if($row6 = mysqli_fetch_array($result6)){
                        $coe += $row6['Respuesta'];
                        //console_log($rows['NOMBRE']);
                        if($row6['Respuesta']>0){
                            $conter += 1;
                        }                
                        //console_log($coe);
                    }
                    //console_log($filas['NOMBRES']);
                    //console_log($rows['Curso']);
                }
                if($conter>0){
                    $coev= $coe/$conter;
                }else{
                    $coev= '0';
                }
                
                /////////////////////////////////////////////////
                $total= $est + $pad + $obs + $auto + $dir + $coev;
                if($est == 0){
                    $est= '0';
                }
                if($pad == 0){
                    $pad= '0';
                }
                if($obs == 0){
                    $obs= '0';
                }
                if($auto == 0){
                    $auto= '0';
                }
                if($dir == 0){
                    $dir= '0';
                }
                if($coev == 0){
                    $coev= '0';
                }


                if ($total >= 1 && $total<3){ //Cambiar a 1
                    $cal = 'Regular';
                    $sortkey = 4;
                    $reg+=1;
                }elseif ($total >= 3 && $total<4){
                    $cal = 'Bueno';
                    $sortkey = 3;
                    $bue+=1;
                }elseif ($total >= 4 && $total<4.6){
                    $cal = 'Muy Bueno';
                    $sortkey = 2;
                    $muy+=1;
                }elseif ($total >= 4.6 && $total<=5){
                    $cal = 'Excelente';
                    $sortkey = 1;
                    $exc+=1;
                }

                $cont +=1;
                $enlace = "re_detalle.php?idd=".base64_encode($filas['ID_DOCENTE'])."&esp=".base64_encode($especialidad)."&per=".base64_encode($periodo)."&bac=".base64_encode($sel_bac_re);

                $html.= "<tr>".
                            "<td><center>".$cont."</td>".
                            "<td>".$filas['NOMBRES']."</td>".
                            "<td><center>".$est."</td>".
                            "<td><center>".$pad."</td>".
                            "<td><center>".$obs."</td>".
                            "<td><center>".$auto."</td>".
                            "<td><center>".$dir."</td>".
                            "<td><center>".$coev."</td>".
                            "<td><center>".$total."</td>".
                            "<td sorttable_customkey=".$sortkey."><center>".$cal."</td>".
                            "<td class='detalle'><center><a class='csess' target='_blank' href='".$enlace."'><b>VER</b></a>".""."</td>".
                        "</tr>";            
            }
            $html.="</table>
            <input type='hidden' id='estado' name='estado' value='1'></div>";

            if($cont==0){
                echo "<p></p><img src='images/estamos-trabajando.png' style='width:28%;' alt='Estamos trabajando'><p style='font-size: 2em; font-weight: bold; color: #44A0D3;  text-align:center;'>¡Lo sentimos, No tenemos Resultados del elemento seleccionado!</p>";
            }else{
                $html.="";
                echo $html;
            } 
        }
    }
}


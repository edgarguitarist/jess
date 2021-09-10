<?php
include "conexion.php";
//variable de control de inicio
if (isset($_GET['carga'])){$carga = $_GET['carga'];}
//Variables de Evaluacion de Estudiantes
if (isset($_GET['sel_esp'])){$sel_esp = $_GET['sel_esp'];}
if (isset($_GET['sel_bac'])){$sel_bac = $_GET['sel_bac'];}
if (isset($_GET['sel_bac2'])){$sel_cat = $_GET['sel_bac2'];}
if (isset($_GET['sel_per'])){$sel_per = $_GET['sel_per'];}
if (isset($_GET['sel_doc'])){$sel_doc = $_GET['sel_doc'];}
if (isset($_GET['sel_mat'])){$sel_mat = $_GET['sel_mat'];}
//Variables de Autoevaluacion
if (isset($_GET['sel_cur_auto'])){$sel_cur_auto = $_GET['sel_cur_auto'];}
if (isset($_GET['sel_cur_auto2'])){$sel_cur_auto2 = $_GET['sel_cur_auto2'];}
if (isset($_GET['sel_doc_auto'])){$sel_doc_auto = $_GET['sel_doc_auto'];}
//Variables de Evaluacion de Padres
if (isset($_GET['sel_esp_pad'])){$sel_esp_pad = $_GET['sel_esp_pad'];}
if (isset($_GET['sel_bac_pad'])){$sel_bac_pad = $_GET['sel_bac_pad'];}
if (isset($_GET['sel_bac2_pad'])){$sel_cat_pad = $_GET['sel_bac2_pad'];}
if (isset($_GET['sel_per_pad'])){$sel_per_pad = $_GET['sel_per_pad'];}
if (isset($_GET['sel_doc_pad'])){$sel_doc_pad = $_GET['sel_doc_pad'];}
if (isset($_GET['sel_mat_pad'])){$sel_mat_pad = $_GET['sel_mat_pad'];}
//Variables de Evaluacion de Directivos
if (isset($_GET['sel_cur_dir'])){$sel_cur_dir = $_GET['sel_cur_dir'];}
if (isset($_GET['sel_cur_dir2'])){$sel_cur_dir2 = $_GET['sel_cur_dir2'];}
if (isset($_GET['sel_doc_dir'])){$sel_doc_dir = $_GET['sel_doc_dir'];}
//Variables de Coevaluacion
if (isset($_GET['sel_cur_coev'])){$sel_cur_coev = $_GET['sel_cur_coev'];}
if (isset($_GET['sel_area_coev2'])){$sel_area_coev2= $_GET['sel_area_coev2'];}
if (isset($_GET['sel_area_coev'])){$sel_area_coev = $_GET['sel_area_coev'];}
if (isset($_GET['sel_doc_coev'])){$sel_doc_coev = $_GET['sel_doc_coev'];}
//Variables de Observacion en Clase   
if (isset($_GET['sel_esp_obs'])){$sel_esp_obs = $_GET['sel_esp_obs'];}
if (isset($_GET['sel_bac_obs'])){$sel_bac_obs = $_GET['sel_bac_obs'];}
if (isset($_GET['sel_bac2_obs'])){$sel_cat_obs = $_GET['sel_bac2_obs'];}
if (isset($_GET['sel_per_obs'])){$sel_per_obs = $_GET['sel_per_obs'];}
if (isset($_GET['sel_doc_obs'])){$sel_doc_obs = $_GET['sel_doc_obs'];}
if (isset($_GET['sel_mat_obs'])){$sel_mat_obs = $_GET['sel_mat_obs'];}
////////////////////////////////////////////////////////////////

////////////////////////ESTUDIANTES/////////////////////////////

if (isset($sel_esp)) {
    $queryM = "SELECT * FROM mdl_course_categories WHERE parent = '$sel_esp'";
    $resultadoM = $conexion->query($queryM);

    if($queryM){
		while($rowM = $resultadoM->fetch_assoc()){ 
                $json['datos_apk'][]=$rowM;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["id"]='';
        $results["name"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
	}
    
} elseif (isset($sel_per)) {
    $queryM = "SELECT * FROM mdl_course_categories WHERE parent = '$sel_per'";
    $resultadoM = $conexion->query($queryM);

    if($queryM){
		while($rowM = $resultadoM->fetch_assoc()){ 
                $json['datos_apk'][]=$rowM;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["id"]='';
        $results["name"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
	}
    
}elseif (isset($sel_bac)) {
    $queryM = "SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_bac' AND B.courseid = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')";
    $resultadoM = $conexion->query($queryM);
    if($queryM){
		while($rowM = $resultadoM->fetch_assoc()){ 
                $json['datos_apk'][]=$rowM;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["NOMBRES"]='';
        $results["ID_DOCENTE"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
	}
    
} elseif (isset($sel_cat) && isset($sel_doc)) {
    $queryM = "SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE, A.fullname AS FULL, A.shortname AS CORTO , A.id AS ID_CURSO FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_cat' AND B.courseid = A.id AND D.id = '$sel_doc' AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')";
    $resultadoM = $conexion->query($queryM);
    if($queryM){
		while($rowM = $resultadoM->fetch_assoc()){ 
                $json['datos_apk'][]=$rowM;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["FULL"]='';
        $results["ID_CURSO"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
    }
    
} elseif (isset($sel_mat)) {
    $html='';
    foreach ($conexion->query("SELECT DISTINCT(E.question_id) AS ID, C.name AS GRUPO, C.content AS Contenido FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id and A.course = $sel_mat and C.surveyid = B.id") as $IDPRE)
    {
        
        $html.="<h4>".$IDPRE['Contenido']."</h4><P></P><table id = 'tabla' style='margin: auto; width: 90%; border-spacing: 10px 5px;'><thead><th><center>Pregunta</th><th><center>Promedio</th><th><center>Calificación</th></thead>";
        $promedio = 0;
        $conter= 0;
        
        foreach ($conexion->query("SELECT E.question_id AS ID, C.name AS GRUPO, D.content AS PREGUNTAS, ROUND(avg(E.rankvalue),2) AS RESP_PROMEDIO FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id and A.course = $sel_mat and C.surveyid = B.id AND E.question_id = '{$IDPRE['ID']}' GROUP BY E.choice_id") as $filas)
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

        $html.="</table><br><br><P></P>";
        $promedio=$promedio/$conter;            
    }
    if($html==''){
    echo "<!DOCTYPE html>
    <html>
    <head>
    <style>
    H2{
        color: #013C80 ;
        font-family: 'Arial';
        font-size: 30pt;
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
       height:100vh;
       width:100%;
    }
    .hijo {
       display: table-cell;
       vertical-align: middle;
       horizontal-align: middle;
    }
    </style>
    </head>
    <body>
    <div class='padre'>
      <div class='hijo'><center>
      <img src='../images/losentimos.png' style='width:60%;' alt='Lo sentimos'> 
      <br>
      <h2 class='hachados'>¡Aun no hay evaluaciones en este curso!</h2></div>
    </div>
    </body>
    </html>";
    } else {
    echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
    <html lang='es' xmlns='http://www.w3.org/1999/xhtml'>
    <link rel='icon' type='image/png' href='https://aulavirtual.letrasyvida.com/images/small-logo-blanco.png' />
    <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>Evaluacion de Estudiantes - Letras y Vida</title>
    <?php   
        include 'includes/scripts.php';
        include 'includes/conexion.php';
    ?>
    
    <link rel='stylesheet' href='style.css'>
    
    </head>
    <body>
    <section id='containera'>
    <div class='container_index'>
    <div class='' id='mostrar_data' required=''>".$html."</div></div>
    </section></body></html>";
    }
} elseif (isset($carga) && $carga == 1){// AREAS...... 
    $query_tipo = "SELECT id, name FROM mdl_course_categories WHERE idnumber > 10 AND idnumber < 15";
    $resultado_tipo = $conexion->query($query_tipo);

    if($query_tipo){
		while($row_tipo = $resultado_tipo->fetch_assoc()){ 
                $json['datos_apk'][]=$row_tipo;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["id"]='';
        $results["name"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
	}
} elseif (isset($carga) && $carga == 2){ // Evaluaciones 2020 - 2021.... etc
    $query_tipo = "SELECT * FROM mdl_course_categories WHERE name LIKE '%Evaluaciones%'";
    $resultado_tipo = $conexion->query($query_tipo);

    if($query_tipo){
		while($row_tipo = $resultado_tipo->fetch_assoc()){ 
                $json['datos_apk'][]=$row_tipo;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["id"]='';
        $results["name"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
	}
}elseif (isset($sel_cur_auto)) { // Autoevaluacion 
    $queryM = "SELECT DISTINCT CONCAT(g.firstname, ' ', g.lastname) AS NOMBRE, g.id AS ID_DOCENTE FROM mdl_questionnaire a, mdl_questionnaire_survey b, mdl_questionnaire_question c, mdl_questionnaire_quest_choice d, mdl_questionnaire_response_rank e, mdl_questionnaire_response f, mdl_user g WHERE e.response_id = f.id AND e.question_id = c.id AND e.choice_id = d.id AND f.questionnaireid = a.id and a.course = (SELECT id FROM mdl_course WHERE category = '$sel_cur_auto' AND fullname LIKE '%Autoevaluacion%') and c.surveyid = b.id and g.id = f.userid and b.title LIKE '%Autoevaluacion%'";
    $resultadoM = $conexion->query($queryM);
    if($queryM){
		while($rowM = $resultadoM->fetch_assoc()){ 
                $json['datos_apk'][]=$rowM;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["ID_DOCENTE"]='';
        $results["NOMBRE"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
	}

} elseif (isset($sel_doc_auto) && isset($sel_cur_auto2)) {
    $html='';
    foreach ($conexion->query("SELECT DISTINCT(E.question_id) AS ID, C.name AS GRUPO, C.content AS Contenido FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = (SELECT id FROM mdl_course WHERE category = '$sel_cur_auto2' AND fullname LIKE '%Auto%') AND C.surveyid = B.id and B.title='Autoevaluacion'") as $IDPRE)
    {            
        $html.="<h4>".$IDPRE['Contenido']."</h4><P></P><table id = 'tabla' style='margin: auto; width: 90%; border-spacing: 10px 5px;'><thead><th><center>Pregunta</th><th><center>Respuesta</th><th><center>Calificación</th></thead>";
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

        $html.="</table><br><br><P></P>";
        $proSEC=$promedio/$conter;            
    }
    if($html==''){
        echo "<!DOCTYPE html>
        <html>
        <head>
        <style>
        H2{
            color: #013C80 ;
            font-family: 'Arial';
            font-size: 30pt;
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
           height:100vh;
           width:100%;
        }
        .hijo {
           display: table-cell;
           vertical-align: middle;
           horizontal-align: middle;
        }
        </style>
        </head>
        <body>
        <div class='padre'>
          <div class='hijo'><center>
          <img src='../images/losentimos.png' style='width:60%;' alt='Lo sentimos'> 
          <br>
          <h2 class='hachados'>¡Aun no hay evaluaciones en este curso!</h2></div>
        </div>
        </body>
        </html>";
        } else {
        echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html lang='es' xmlns='http://www.w3.org/1999/xhtml'>
        <link rel='icon' type='image/png' href='https://aulavirtual.letrasyvida.com/images/small-logo-blanco.png' />
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>Evaluacion de Estudiantes - Letras y Vida</title>
        <?php   
            include 'includes/scripts.php';
            include 'includes/conexion.php';
        ?>
        
        <link rel='stylesheet' href='style.css'>
        
        </head>
        <body>
        <section id='containera'>
        <div class='container_index'>
        <div class='' id='mostrar_data' required=''>".$html."</div></div>
        </section></body></html>";
        }
    

} elseif (isset($sel_esp_pad)) { //padres
    $queryM = "SELECT * FROM mdl_course_categories WHERE parent = '$sel_esp_pad'";
    $resultadoM = $conexion->query($queryM);
    if($queryM){
		while($rowM = $resultadoM->fetch_assoc()){ 
                $json['datos_apk'][]=$rowM;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["id"]='';
        $results["name"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
	}
} elseif (isset($sel_per_pad)) {
    $queryM = "SELECT * FROM mdl_course_categories WHERE parent = '$sel_per_pad'";
    $resultadoM = $conexion->query($queryM);

    if($queryM){
		while($rowM = $resultadoM->fetch_assoc()){ 
                $json['datos_apk'][]=$rowM;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["id"]='';
        $results["name"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
	}
    
} elseif (isset($sel_bac_pad)) {
    $queryM = "SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_bac_pad' AND B.courseid = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')";
    $resultadoM = $conexion->query($queryM);
    if($queryM){
		while($rowM = $resultadoM->fetch_assoc()){ 
                $json['datos_apk'][]=$rowM;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["NOMBRES"]='';
        $results["ID_DOCENTE"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
	}
} elseif (isset($sel_cat_pad) && isset($sel_doc_pad)) {
    $queryM = "SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE, A.fullname AS FULL, A.shortname AS CORTO , A.id AS ID_CURSO FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_cat_pad' AND B.courseid = A.id AND D.id = '$sel_doc_pad' AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')";
    $resultadoM = $conexion->query($queryM);
    if($queryM){
		while($rowM = $resultadoM->fetch_assoc()){ 
                $json['datos_apk'][]=$rowM;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["FULL"]='';
        $results["ID_CURSO"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
    }
} elseif (isset($sel_mat_pad)) {
    $html='';
    foreach ($conexion->query("SELECT DISTINCT(E.question_id) AS ID, C.name AS GRUPO, C.content AS Contenido FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = $sel_mat_pad AND C.surveyid = B.id and B.title='Padres'") as $IDPRE)
    {            
        $html.="<h4>".$IDPRE['Contenido']."</h4><P></P><table id = 'tabla' style='margin: auto; width: 90%; border-spacing: 10px 5px;'><thead><th><center>Pregunta</th><th><center>Promedio</th><th><center>Calificación</th></thead>";
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

        $html.="</table><br><br><P></P>";
        $proSEC=$promedio/$conter;            
    }
    if($html==''){
        echo "<!DOCTYPE html>
        <html>
        <head>
        <style>
        H2{
            color: #013C80 ;
            font-family: 'Arial';
            font-size: 30pt;
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
           height:100vh;
           width:100%;
        }
        .hijo {
           display: table-cell;
           vertical-align: middle;
           horizontal-align: middle;
        }
        </style>
        </head>
        <body>
        <div class='padre'>
          <div class='hijo'><center>
          <img src='../images/losentimos.png' style='width:60%;' alt='Lo sentimos'> 
          <br>
          <h2 class='hachados'>¡Aun no hay evaluaciones en este curso!</h2></div>
        </div>
        </body>
        </html>";
        } else {
        echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html lang='es' xmlns='http://www.w3.org/1999/xhtml'>
        <link rel='icon' type='image/png' href='https://aulavirtual.letrasyvida.com/images/small-logo-blanco.png' />
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>Evaluacion de Estudiantes - Letras y Vida</title>
        <?php   
            include 'includes/scripts.php';
            include 'includes/conexion.php';
        ?>
        
        <link rel='stylesheet' href='style.css'>
        
        </head>
        <body>
        <section id='containera'>
        <div class='container_index'>
        <div class='' id='mostrar_data' required=''>".$html."</div></div>
        </section></body></html>";
        }
    

}elseif (isset($sel_esp_obs)) { // observacion
    $queryM = "SELECT * FROM mdl_course_categories WHERE parent = '$sel_esp_obs'";
    $resultadoM = $conexion->query($queryM);
    if($queryM){
		while($rowM = $resultadoM->fetch_assoc()){ 
                $json['datos_apk'][]=$rowM;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["id"]='';
        $results["name"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
	}

}elseif (isset($sel_per_obs)) {
    $queryM = "SELECT * FROM mdl_course_categories WHERE parent = '$sel_per_obs'";
    $resultadoM = $conexion->query($queryM);

    if($queryM){
		while($rowM = $resultadoM->fetch_assoc()){ 
                $json['datos_apk'][]=$rowM;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["id"]='';
        $results["name"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
	}
    
} elseif (isset($sel_bac_obs)) {
    $queryM = "SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_bac_obs' AND B.courseid = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')";
    $resultadoM = $conexion->query($queryM);
    if($queryM){
		while($rowM = $resultadoM->fetch_assoc()){ 
                $json['datos_apk'][]=$rowM;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["NOMBRES"]='';
        $results["ID_DOCENTE"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
	}
} elseif (isset($sel_cat_obs) && isset($sel_doc_obs)) {
    $queryM = "SELECT DISTINCT CONCAT(D.firstname, ' ', D.lastname) NOMBRES, D.id AS ID_DOCENTE, A.fullname AS FULL, A.shortname AS CORTO , A.id AS ID_CURSO FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND A.category = '$sel_cat_obs' AND B.courseid = A.id AND D.id = '$sel_doc_obs' AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20')";
    $resultadoM = $conexion->query($queryM);
    if($queryM){
		while($rowM = $resultadoM->fetch_assoc()){ 
                $json['datos_apk'][]=$rowM;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        $results["FULL"]='';
        $results["ID_CURSO"]='';
        $json['datos_apk'][]=$results;
        echo json_encode($json);
    }
} elseif (isset($sel_mat_obs)) {
    $html='';
    foreach ($conexion->query("SELECT DISTINCT(E.question_id) AS ID, C.name AS GRUPO, C.content AS Contenido FROM mdl_questionnaire A, mdl_questionnaire_survey B, mdl_questionnaire_question C, mdl_questionnaire_quest_choice D, mdl_questionnaire_response_rank E, mdl_questionnaire_response F WHERE E.response_id = F.id AND E.question_id = C.id AND E.choice_id = D.id AND F.questionnaireid = A.id AND A.course = $sel_mat_obs AND C.surveyid = B.id and B.title='Observación en Clase
'") as $IDPRE)
    {            
        $html.="<h4>".$IDPRE['Contenido']."</h4><table id = 'tabla' style='margin: auto; width: 90%; border-spacing: 10px 5px;'><thead><th><center>Pregunta</th><th><center>Respuesta</th></thead>";
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
        $html.="</table><br><br><P></P>";
        $proSEC=$promedio/$conter;            
    }
    if($html==''){
        echo "<!DOCTYPE html>
        <html>
        <head>
        <style>
        H2{
            color: #013C80 ;
            font-family: 'Arial';
            font-size: 30pt;
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
           height:100vh;
           width:100%;
        }
        .hijo {
           display: table-cell;
           vertical-align: middle;
           horizontal-align: middle;
        }
        </style>
        </head>
        <body>
        <div class='padre'>
          <div class='hijo'><center>
          <img src='../images/losentimos.png' style='width:60%;' alt='Lo sentimos'> 
          <br>
          <h2 class='hachados'>¡Aun no hay evaluaciones en este curso!</h2></div>
        </div>
        </body>
        </html>";
        } else {
        echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html lang='es' xmlns='http://www.w3.org/1999/xhtml'>
        <link rel='icon' type='image/png' href='https://aulavirtual.letrasyvida.com/images/small-logo-blanco.png' />
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>Evaluacion de Estudiantes - Letras y Vida</title>
        <?php   
            include 'includes/scripts.php';
            include 'includes/conexion.php';
        ?>
        
        <link rel='stylesheet' href='style.css'>
        
        </head>
        <body>
        <section id='containera'>
        <div class='container_index'>
        <div class='' id='mostrar_data' required=''>".$html."</div></div>
        </section></body></html>";
        }
    

}elseif (isset($sel_cur_dir)) { ///////////////////////////// Directivos
    if($sel_cur_dir > 0 ){
        $queryM = "SELECT A.id AS ID_SURVEY, A.course AS Curso, SUBSTRING(A.name,25,100) AS NAME_SURVEY, IF(D.id IN (SELECT G.userid FROM mdl_questionnaire_response G WHERE G.questionnaireid = F.id),'SI','NO') AS COMPLETADO FROM mdl_user D, mdl_questionnaire_survey F, mdl_questionnaire A, mdl_user_enrolments E, mdl_enrol AS B WHERE F.courseid = (SELECT id FROM mdl_course WHERE category = '$sel_cur_dir' AND fullname LIKE '%Directivo%') AND A.id = F.id AND B.courseid = A.course AND E.enrolid = B.id AND D.id = E.userid";
        $resultadoM = $conexion->query($queryM);
        if($queryM){
            while($rowM = $resultadoM->fetch_assoc()){ 
                    $json['datos_apk'][]=$rowM;
            }
            mysqli_close($conexion);
            echo json_encode($json);
        }else{
            $results["ID_SURVEY"]='';
            $results["NAME_SURVEY"]='';
            $json['datos_apk'][]=$results;
            echo json_encode($json);
        }
    }

} elseif (isset($sel_cur_dir2) && isset($sel_doc_dir)) {
    $html='';
    
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
        echo "<!DOCTYPE html>
        <html>
        <head>
        <style>
        H2{
            color: #013C80 ;
            font-family: 'Arial';
            font-size: 30pt;
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
           height:100vh;
           width:100%;
        }
        .hijo {
           display: table-cell;
           vertical-align: middle;
           horizontal-align: middle;
        }
        </style>
        </head>
        <body>
        <div class='padre'>
          <div class='hijo'><center>
          <img src='../images/losentimos.png' style='width:60%;' alt='Lo sentimos'> 
          <br>
          <h2 class='hachados'>¡Aun no hay evaluaciones en este curso!</h2></div>
        </div>
        </body>
        </html>";
        } else {
        echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html lang='es' xmlns='http://www.w3.org/1999/xhtml'>
        <link rel='icon' type='image/png' href='https://aulavirtual.letrasyvida.com/images/small-logo-blanco.png' />
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>Evaluacion de Estudiantes - Letras y Vida</title>
        <?php   
            include 'includes/scripts.php';
            include 'includes/conexion.php';
        ?>
        
        <link rel='stylesheet' href='style.css'>
        
        </head>
        <body>
        <section id='containera'>
        <div class='container_index'>
        <div class='' id='mostrar_data' required=''>".$html."</div></div>
        </section></body></html>";
        }
    

}elseif (isset($sel_cur_coev)) { ////////////// COEVALUACION
    if($sel_cur_coev > 0 ){
        $queryM = "SELECT id AS ID_AREA, SUBSTRING(fullname,16,100) AS NAME_AREA  FROM mdl_course WHERE category = '$sel_cur_coev' AND fullname LIKE '%Coevaluacion%'";
        $resultadoM = $conexion->query($queryM);
        if($queryM){
            while($rowM = $resultadoM->fetch_assoc()){ 
                    $json['datos_apk'][]=$rowM;
            }
            mysqli_close($conexion);
            echo json_encode($json);
        }else{
            $results["ID_AREA"]='';
            $results["NAME_AREA"]='';
            $json['datos_apk'][]=$results;
            echo json_encode($json);
        }
    }
}elseif (isset($sel_area_coev)) { 
    if($sel_area_coev > 0 ){
        $queryM = "SELECT A.id AS ID_SURVEY, A.course AS Curso, SUBSTRING(A.name,16,100) AS NAME_SURVEY, IF(D.id IN (SELECT G.userid FROM mdl_questionnaire_response G WHERE G.questionnaireid = F.id),'SI','NO') AS COMPLETADO FROM mdl_user D, mdl_questionnaire_survey F, mdl_questionnaire A, mdl_user_enrolments E, mdl_enrol AS B WHERE F.courseid = $sel_area_coev AND A.id = F.id AND B.courseid = A.course AND E.enrolid = B.id AND D.id = E.userid";
        $resultadoM = $conexion->query($queryM);
        if($queryM){
            while($rowM = $resultadoM->fetch_assoc()){ 
                    $json['datos_apk'][]=$rowM;
            }
            mysqli_close($conexion);
            echo json_encode($json);
        }else{
            $results["ID_SURVEY"]='';
            $results["NAME_SURVEY"]='';
            $json['datos_apk'][]=$results;
            echo json_encode($json);
        }
    }
} elseif (isset($sel_area_coev2) && isset($sel_doc_coev)) {
    $html='';
    
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
        echo "<!DOCTYPE html>
        <html>
        <head>
        <style>
        H2{
            color: #013C80 ;
            font-family: 'Arial';
            font-size: 30pt;
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
           height:100vh;
           width:100%;
        }
        .hijo {
           display: table-cell;
           vertical-align: middle;
           horizontal-align: middle;
        }
        </style>
        </head>
        <body>
        <div class='padre'>
          <div class='hijo'><center>
          <img src='../images/losentimos.png' style='width:60%;' alt='Lo sentimos'> 
          <br>
          <h2 class='hachados'>¡Aun no hay evaluaciones en este curso!</h2></div>
        </div>
        </body>
        </html>";
        } else {
        echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html lang='es' xmlns='http://www.w3.org/1999/xhtml'>
        <link rel='icon' type='image/png' href='https://aulavirtual.letrasyvida.com/images/small-logo-blanco.png' />
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>Evaluacion de Estudiantes - Letras y Vida</title>
        <?php   
            include 'includes/scripts.php';
            include 'includes/conexion.php';
        ?>
        
        <link rel='stylesheet' href='style.css'>
        
        </head>
        <body>
        <section id='containera'>
        <div class='container_index'>
        <div class='' id='mostrar_data' required=''>".$html."</div></div>
        </section></body></html>";
        }

}




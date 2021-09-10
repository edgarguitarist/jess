<?php
include "includes/conexion.php";
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
$logo = "";

if (!isset($_GET['bac']) || !isset($_GET['per']) || !isset($_GET['esp']) || !isset($_GET['idd'])) {
    header("Location: re_global.php");
    exit();
}
$tablas = '';
$doc = base64_decode($_GET['idd']); //any else
$bac = base64_decode($_GET['bac']); //23
$per = base64_decode($_GET['per']); //16
$esp = base64_decode($_GET['esp']); //12
$Suma = 0;

date_default_timezone_set('America/Guayaquil');
$Fecha = date("d-m-Y");

$consultaA = "SELECT name AS Nombre FROM mdl_course_categories WHERE id = $esp";
$resultadoA = mysqli_query($conexion, $consultaA);
if ($rowA = mysqli_fetch_array($resultadoA)) {
    $Esp = $rowA['Nombre'];
}

$consultaB = "SELECT SUBSTRING(name,17,15) AS Nombre FROM `mdl_course_categories` WHERE id = $per";
$resultadoB = mysqli_query($conexion, $consultaB);
if ($rowB = mysqli_fetch_array($resultadoB)) {
    $Per = $rowB['Nombre'];
}

$consultaC = "SELECT name AS Nombre FROM `mdl_course_categories` WHERE id = $bac";
$resultadoC = mysqli_query($conexion, $consultaC);
if ($rowC = mysqli_fetch_array($resultadoC)) {
    $Cur = $rowC['Nombre'];
}


$consultaD = "SELECT CONCAT(firstname, ' ', lastname) AS NOMBRES, username AS USERNAME FROM mdl_user WHERE id = $doc";
$resultadoD = mysqli_query($conexion, $consultaD);
if ($rowD = mysqli_fetch_array($resultadoD)) {
    $Doc = $rowD['NOMBRES'];
    $User = $rowD['USERNAME'];
}

$TablaE = "<p></p><table id = 'tabla' style='margin: 0 auto 3% auto; width: 90%; border-spacing: 10px 5px;'>
<thead>
    <th style='display: none; width: 15%;'><center>TIPO</th>
    <th style='display: none; width: 20%;'><center>BACHILLERATO</th>
    <th style='display: none; width: 50%;'><center>MATERIA</th>
    <th style='display: none; width: 5%;'><center>PROMEDIO</th>   
</thead>";

/////////////////////////EV. ESTUDIANTES//////////////////////////////
$total = 0;
$Conter = 0;
$tablas .= $TablaE;
foreach ($conexion->query("SELECT A.id AS ID_CURSO, B.id AS ID_ENROL, D.username AS USERNAME, CONCAT(D.firstname, ' ', D.lastname) NOMBRES, A.fullname AS MATERIA, ROUND(((SELECT AVG(U.rankvalue) FROM mdl_questionnaire Q, mdl_questionnaire_survey R, mdl_questionnaire_question S, mdl_questionnaire_quest_choice T, mdl_questionnaire_response_rank U, mdl_questionnaire_response V WHERE U.response_id = V.id AND U.question_id = S.id AND U.choice_id = T.id AND V.questionnaireid = Q.id AND Q.course = E.course AND S.surveyid = R.id AND Q.name LIKE '%Estudiantes%')),2) AS PROMEDIO
FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E 
WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND B.courseid = A.id AND E.course = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20') AND A.category = $bac AND D.username = '$User' AND E.name LIKE '%Estudiantes%'") as $filasEST) {
    if ($filasEST['PROMEDIO'] != 0) {
        $promedio = $filasEST['PROMEDIO'];
    } else {
        $promedio = '0';
    }
    if ($Conter == 0) {
        $tablas .= "<tr>" .
            "<td style='width: 15%; color: #013C80;'><b>Ev. Estudiantes</b></td>" .
            "<td style='width: 20%;'>" . $Cur . "</td>" .
            "<td style='width: 50%;'>" . $filasEST['MATERIA'] . "</td>" .
            "<td style='width: 5%;'><center>" . $promedio . "</td>" .
            "</tr>";
    } else {
        $tablas .= "<tr>" .
            "<td style='width: 15%;'>" . "</td>" .
            "<td style='width: 20%;'>" . "</td>" .
            "<td style='width: 50%;'>" . $filasEST['MATERIA'] . "</td>" .
            "<td style='width: 5%;'><center>" . $promedio . "</td>" .
            "</tr>";
    }
    $Conter += 1;
    $total += $promedio;
}
$total = $total / $Conter;
$eq = $total * 0.2;
$eq1 = $eq;
$Suma += round($eq, 2);
if ($Conter <= 1) {
    $tablas .=   "<tr>" .
        "<td style='width: 15%;'></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%; text-align: end; color: #013C80;'><b>Equivalente</b></td>" .
        "<td style='width: 5%; color: #013C80;'><center><b>" . round($eq, 2) . "</b></td>" .
        "</tr></table>";
} else {
    $tablas .= "<tr>" .
        "<td style='width: 15%;'></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%; text-align: end; color: #44A0D3;'><b>Promedio</b></td>" .
        "<td style='width: 5%; color: #44A0D3;'><center><b>" . round($total, 2) . "</b></td>" .
        "</tr>" .
        "<tr>" .
        "<td style='width: 15%;'></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%; text-align: end; color: #013C80;'><b>Equivalente</b></td>" .
        "<td style='width: 5%; color: #013C80;'><center><b>" . round($eq, 2) . "</b></td>" .
        "</tr></table>";
}

/////////////////////EV. PADRES/////////////////////////////////
$total = 0;
$Conter = 0;
$tablas .= $TablaE;
foreach ($conexion->query("SELECT A.id AS ID_CURSO, B.id AS ID_ENROL, D.username AS USERNAME, CONCAT(D.firstname, ' ', D.lastname) NOMBRES, A.fullname AS MATERIA, ROUND(((SELECT AVG(U.rankvalue) FROM mdl_questionnaire Q, mdl_questionnaire_survey R, mdl_questionnaire_question S, mdl_questionnaire_quest_choice T, mdl_questionnaire_response_rank U, mdl_questionnaire_response V WHERE U.response_id = V.id AND U.question_id = S.id AND U.choice_id = T.id AND V.questionnaireid = Q.id AND Q.course = E.course AND S.surveyid = R.id AND Q.name LIKE '%Padres%')),2) AS PROMEDIO
FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E 
WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND B.courseid = A.id AND E.course = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20') AND A.category = $bac AND D.username = '$User' AND E.name LIKE '%Padres%'") as $filasEST) {
    if ($filasEST['PROMEDIO'] != 0) {
        $promedio = $filasEST['PROMEDIO'];
    } else {
        $promedio = '0';
    }
    if ($Conter == 0) {
        $tablas .= "<tr>" .
            "<td style='width: 15%; color: #013C80;'><b>Ev. Padres</b></td>" .
            "<td style='width: 20%;'>" . $Cur . "</td>" .
            "<td style='width: 50%;'>" . $filasEST['MATERIA'] . "</td>" .
            "<td style='width: 5%;'><center>" . $promedio . "</td>" .
            "</tr>";
    } else {
        $tablas .= "<tr>" .
            "<td style='width: 15%;'>" . "</td>" .
            "<td style='width: 20%;'>" . "</td>" .
            "<td style='width: 50%;'>" . $filasEST['MATERIA'] . "</td>" .
            "<td style='width: 5%;'><center>" . $promedio . "</td>" .
            "</tr>";
    }
    $Conter += 1;
    $total += $promedio;
}
$total = $total / $Conter;
$eq = $total * 0.2;
$eq2 = $eq;
$Suma += round($eq, 2);
if ($Conter <= 1) {
    $tablas .=   "<tr>" .
        "<td style='width: 15%;'></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%; text-align: end; color: #013C80;'><b>Equivalente</b></td>" .
        "<td style='width: 5%; color: #013C80;'><center><b>" . round($eq, 2) . "</b></td>" .
        "</tr></table>";
} else {
    $tablas .= "<tr>" .
        "<td style='width: 15%;'></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%; text-align: end; color: #44A0D3;'><b>Promedio</b></td>" .
        "<td style='width: 5%; color: #44A0D3;'><center><b>" . round($total, 2) . "</b></td>" .
        "</tr>" .
        "<tr>" .
        "<td style='width: 15%;'></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%; text-align: end; color: #013C80;'><b>Equivalente</b></td>" .
        "<td style='width: 5%; color: #013C80;'><center><b>" . round($eq, 2) . "</b></td>" .
        "</tr></table>";
}
/////////////////////////OBSERVACION EN CLASE/////////////////////////////
$total = 0;
$Conter = 0;
$tablas .= $TablaE;
foreach ($conexion->query("SELECT A.id AS ID_CURSO, B.id AS ID_ENROL, D.username AS USERNAME, CONCAT(D.firstname, ' ', D.lastname) NOMBRES, A.fullname AS MATERIA, ROUND(((SELECT AVG(U.rankvalue) FROM mdl_questionnaire Q, mdl_questionnaire_survey R, mdl_questionnaire_question S, mdl_questionnaire_quest_choice T, mdl_questionnaire_response_rank U, mdl_questionnaire_response V WHERE U.response_id = V.id AND U.question_id = S.id AND U.choice_id = T.id AND V.questionnaireid = Q.id AND Q.course = E.course AND S.surveyid = R.id AND Q.name LIKE '%Clase%')),2) AS PROMEDIO, (SELECT COUNT(U.rankvalue) FROM mdl_questionnaire Q, mdl_questionnaire_survey R, mdl_questionnaire_question S, mdl_questionnaire_quest_choice T, mdl_questionnaire_response_rank U, mdl_questionnaire_response V WHERE U.response_id = V.id AND U.question_id = S.id AND U.choice_id = T.id AND V.questionnaireid = Q.id AND Q.course = E.course AND S.surveyid = R.id AND Q.name LIKE '%Clase%' AND U.rankvalue <2) AS CANTIDAD_R, (SELECT COUNT(U.rankvalue) FROM mdl_questionnaire Q, mdl_questionnaire_survey R, mdl_questionnaire_question S, mdl_questionnaire_quest_choice T, mdl_questionnaire_response_rank U, mdl_questionnaire_response V WHERE U.response_id = V.id AND U.question_id = S.id AND U.choice_id = T.id AND V.questionnaireid = Q.id AND Q.course = E.course AND S.surveyid = R.id AND Q.name LIKE '%Clase%') AS CANTIDAD_T
FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E 
WHERE B.id = C.enrolid AND C.userid = D.id AND B.enrol = 'manual' AND B.courseid = A.id AND E.course = A.id AND NOT (D.id = '1' or D.id= '2' or D.id= '3' or D.id= '19' OR D.id = '20') AND A.category = $bac AND D.username = '$User' AND E.name LIKE '%Clase%'") as $filasEST) {
    if ($filasEST['PROMEDIO'] != 0) {
        $promedio = $filasEST['PROMEDIO'];
        $tot = round($filasEST['CANTIDAD_R'] / $filasEST['CANTIDAD_T'], 2);
    } else {
        $tot = '0';
    }

    if ($Conter == 0) {
        $tablas .= "<tr>" .
            "<td style='width: 15%; color: #013C80;'><b>Observación en Clase</b></td>" .
            "<td style='width: 20%;'>" . $Cur . "</td>" .
            "<td style='width: 50%;'>" . $filasEST['MATERIA'] . "</td>" .
            "<td style='width: 5%;'><center>" . $tot . "</td>" .
            "</tr>";
    } else {
        $tablas .= "<tr>" .
            "<td style='width: 15%;'>" . "</td>" .
            "<td style='width: 20%;'>" . "</td>" .
            "<td style='width: 50%;'>" . $filasEST['MATERIA'] . "</td>" .
            "<td style='width: 5%;'><center>" . $tot . "</td>" .
            "</tr>";
    }
    $Conter += 1;
    $total += $tot;
}
$total = $total / $Conter;
$eq = $total * 0.5;
$eq3 = $eq;
$Suma += round($eq, 2);
if ($Conter <= 1) {
    $tablas .=   "<tr>" .
        "<td style='width: 15%;'></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%; text-align: end; color: #013C80;'><b>Equivalente</b></td>" .
        "<td style='width: 5%; color: #013C80;'><center><b>" . round($eq, 2) . "</b></td>" .
        "</tr></table>";
} else {
    $tablas .= "<tr>" .
        "<td style='width: 15%;'></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%; text-align: end; color: #44A0D3;'><b>Promedio</b></td>" .
        "<td style='width: 5%; color: #44A0D3;'><center><b>" . round($total, 2) . "</b></td>" .
        "</tr>" .
        "<tr>" .
        "<td style='width: 15%;'></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%; text-align: end; color: #013C80;'><b>Equivalente</b></td>" .
        "<td style='width: 5%; color: #013C80;'><center><b>" . round($eq, 2) . "</b></td>" .
        "</tr></table>";
}

/////////////////////////AUTOEVALUACIÓN/////////////////////////////
$total = 0;
$Conter = 0;
//$Per = '2021'; /// PRUEBA LOCAL
$tablas .= $TablaE;
foreach ($conexion->query("SELECT ROUND(AVG(e.rankvalue),2) AS PROMEDIO 
FROM mdl_questionnaire a, mdl_questionnaire_survey b, mdl_questionnaire_question c, mdl_questionnaire_quest_choice d, mdl_questionnaire_response_rank e, mdl_questionnaire_response f, mdl_user g 
WHERE e.response_id = f.id AND e.question_id = c.id AND e.choice_id = d.id AND f.questionnaireid = a.id and a.course = (SELECT id FROM mdl_course WHERE category = (SELECT id FROM mdl_course_categories WHERE parent = 2 AND name LIKE '%Evaluaciones " . $Per . "%') AND fullname LIKE '%Auto%') and c.surveyid = b.id and g.id = f.userid and g.id = $doc") as $filasEST) {
    if ($filasEST['PROMEDIO'] != 0) {
        $promedio = $filasEST['PROMEDIO'];
    } else {
        $promedio = '0';
    }

    $tablas .= "<tr>" .
        "<td style='width: 15%; color: #013C80;'><b>Autoevaluación</b></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%;'></td>" .
        "<td style='width: 5%;'><center>" . $promedio . "</td>" .
        "</tr>";

    $Conter += 1;
    $total += $promedio;
}
$total = $total / $Conter;
$eq = $total * 0.1;
$eq4 = $eq;
$Suma += round($eq, 2);
$tablas .= "<tr>" .
    "<td style='width: 15%;'></td>" .
    "<td style='width: 20%;'></td>" .
    "<td style='width: 50%; text-align: end; color: #013C80;'><b>Equivalente</b></td>" .
    "<td style='width: 5%; color: #013C80;'><center><b>" . round($eq, 2) . "</b></td>" .
    "</tr></table>";

/////////////////////////EV. DIRECTIVOS/////////////////////////////
$total = 0;
$Conter = 0;
$tablas .= $TablaE;
foreach ($conexion->query("SELECT ROUND(AVG(E.rankvalue),2) AS PROMEDIO 
FROM mdl_questionnaire_response_rank E 
WHERE E.response_id = (SELECT B.id FROM mdl_questionnaire_response B WHERE B.questionnaireid = (SELECT A.id FROM mdl_questionnaire A WHERE A.course = (SELECT id FROM mdl_course WHERE fullname LIKE '%Directivo%' AND category = (SELECT id FROM mdl_course_categories WHERE parent = 2 AND name LIKE '%Evaluaciones " . $Per . "%')) AND A.name LIKE '%" . $Doc . "%'))") as $filasEST) {
    if ($filasEST['PROMEDIO'] != 0) {
        $promedio = $filasEST['PROMEDIO'];
    } else {
        $promedio = '0';
    }

    $tablas .= "<tr>" .
        "<td style='width: 15%; color: #013C80;'><b>Ev. Directivos</b></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%;'></td>" .
        "<td style='width: 5%;'><center>" . $promedio . "</td>" .
        "</tr>";

    $Conter += 1;
    $total += $promedio;
}
$total = $total / $Conter;
$eq = $total * 0.2;
$eq5 = $eq;
$Suma += round($eq, 2);
$tablas .= "<tr>" .
    "<td style='width: 15%;'></td>" .
    "<td style='width: 20%;'></td>" .
    "<td style='width: 50%; text-align: end; color: #013C80;'><b>Equivalente</b></td>" .
    "<td style='width: 5%; color: #013C80;'><center><b>" . round($eq, 2) . "</b></td>" .
    "</tr></table>";



/////////////////////////COEVALUACIÓN/////////////////////////////
$total = 0;
$Conter = 0;
$tablas .= $TablaE;

foreach ($conexion->query("SELECT id AS ID_CURSO, SUBSTRING(fullname,15,50) AS NOMBRE FROM mdl_course WHERE category =( SELECT id FROM mdl_course_categories WHERE parent = 2 AND NAME LIKE '%Evaluaciones " . $Per . "%' ) AND fullname LIKE '%Coevaluación%'") as $rows) {
    foreach ($conexion->query("SELECT ROUND(AVG(E.rankvalue), 2) AS PROMEDIO FROM mdl_questionnaire_response_rank E WHERE E.response_id =(SELECT B.id FROM mdl_questionnaire_response B WHERE B.questionnaireid =(SELECT A.id FROM mdl_questionnaire A WHERE A.course =" . $rows['ID_CURSO'] . " AND A.name LIKE '%" . $Doc . "%'))") as $filas) {
        if ($filas['PROMEDIO'] != 0) {
            $promedio = $filas['PROMEDIO'];
            if ($Conter == 0) {
                $tablas .= "<tr>" .
                    "<td style='width: 15%; color: #013C80;'><b>Coevaluación</b></td>" .
                    "<td style='width: 20%;'></td>" .
                    "<td style='width: 50%;'>" . $rows['NOMBRE'] . "</td>" .
                    "<td style='width: 5%;'><center>" . $promedio . "</td>" .
                    "</tr>";
            } else {
                $tablas .= "<tr>" .
                    "<td style='width: 15%;'>" . "</td>" .
                    "<td style='width: 20%;'>" . "</td>" .
                    "<td style='width: 50%;'>" . $rows['NOMBRE'] . "</td>" .
                    "<td style='width: 5%;'><center>" . $promedio . "</td>" .
                    "</tr>";
            }
            $Conter += 1;
            $total += $promedio;
        }
    }
}
if ($Conter == 0) {
    $tablas .= "<tr>" .
        "<td style='width: 15%; color: #013C80;'><b>Coevaluación</b></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%;'>" . "</td>" .
        "<td style='width: 5%;'><center>" . '0' . "</td>" .
        "</tr>";
    $total = 0;
    $Conter = 1;
}

$total = $total / $Conter;
$eq = $total * 0.2;

$eq6 = $eq;
$Suma += round($eq, 2);
if ($Conter <= 1) {
    $tablas .=   "<tr>" .
        "<td style='width: 15%;'></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%; text-align: end; color: #013C80;'><b>Equivalente</b></td>" .
        "<td style='width: 5%; color: #013C80;'><center><b>" . round($eq, 2) . "</b></td>" .
        "</tr></table>";
} else {
    $tablas .= "<tr>" .
        "<td style='width: 15%;'></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%; text-align: end; color: #44A0D3;'><b>Promedio</b></td>" .
        "<td style='width: 5%; color: #44A0D3;'><center><b>" . round($total, 2) . "</b></td>" .
        "</tr>" .
        "<tr>" .
        "<td style='width: 15%;'></td>" .
        "<td style='width: 20%;'></td>" .
        "<td style='width: 50%; text-align: end; color: #013C80;'><b>Equivalente</b></td>" .
        "<td style='width: 5%; color: #013C80;'><center><b>" . round($eq, 2) . "</b></td>" .
        "</tr></table>";
}

$cal = '';
$cuali = round($Suma, 2);
if ($cuali >= 1 && $cuali < 3) {
    $cal = 'Regular';
} elseif ($cuali >= 3 && $cuali < 4) {
    $cal = 'Bueno';
} elseif ($cuali >= 4 && $cuali < 4.6) {
    $cal = 'Muy Bueno';
} elseif ($cuali >= 4.6 && $cuali <= 5) {
    $cal = 'Excelente';
}
$namepdf = 'Reporte Detalle de ' . $Doc . " - " . $Fecha;
////// .round($Suma, 2)       
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<link rel="icon" type="image/png" href="https://aulavirtual.letrasyvida.com/images/small-logo-blanco.png" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>DETALLE DE REPORTE- Letras y Vida</title>
    <?php
    include "includes/scripts.php";
    ?>
    <script>
        function imprim1(mostrar_data) {
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
            return true;
        }
    </script>
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="container_index">
            <br>
            <h2><?php echo $Doc; ?></h2><br>
            <table id='tabla' style='margin: auto; width: 100%; border-spacing: 10px 5px;'>
                <thead>
                    <th style='width: 0%;'>
                        <center>
                    </th>
                    <th>
                        <center>Ev. Estudiantes
                    </th>
                    <th>
                        <center>Ev. Padres
                    </th>
                    <th>
                        <center>Observación en Clase
                    </th>
                    <th>
                        <center>Autoevaluación
                    </th>
                    <th>
                        <center>Ev. Directivos
                    </th>
                    <th>
                        <center>Coevaluación
                    </th>
                    <th>
                        <center>Total
                    </th>
                    <th>
                        <center>Cualitativo
                    </th>
                </thead>

                <tr>
                    <td>VALORES ESPERADOS</td>
                    <td>
                        <center>1
                    </td>
                    <td>
                        <center>1
                    </td>
                    <td>
                        <center>0.5
                    </td>
                    <td>
                        <center>0.5
                    </td>
                    <td>
                        <center>1
                    </td>
                    <td>
                        <center>1
                    </td>
                    <td>
                        <center>5
                    </td>
                    <td>
                        <center>Excelente
                    </td>
                </tr>
                <tr>
                    <td style='color: #013C80;'><b>VALORES OBTENIDOS</b></td>
                    <td style='color: #013C80;'>
                        <center><b><?php echo round($eq1, 2); ?></b>
                    </td>
                    <td style='color: #013C80;'>
                        <center><b><?php echo round($eq2, 2); ?></b>
                    </td>
                    <td style='color: #013C80;'>
                        <center><b><?php echo round($eq3, 2); ?></b>
                    </td>
                    <td style='color: #013C80;'>
                        <center><b><?php echo round($eq4, 2); ?></b>
                    </td>
                    <td style='color: #013C80;'>
                        <center><b><?php echo round($eq5, 2); ?></b>
                    </td>
                    <td style='color: #013C80;'>
                        <center><b><?php echo round($eq6, 2); ?></b>
                    </td>
                    <td style='color: #013C80;'>
                        <center><b><?php echo round($Suma, 2); ?></b>
                    </td>
                    <td style='color: #013C80;'>
                        <center><b><?php echo $cal; ?></b>
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <h2 class="hachedos">RESULTADOS</h2>
        <div id="pdf_container">
            <div id='informacion' class='informacion' style='display: none; width:100%;'>
                <div style='margin: auto; width: 100%; display: grid; grid-template-columns: 1fr 1fr; grid-gap: 1px;'>
                    <img id='logo' style='width: 35%; grid-column: 1 / 3; margin: auto;' src='images/banner-logo.png' alt='logo'>
                    <div style='justify-self: center; width:80%; grid-column: 1 / 3; display: grid; grid-template-columns: 1fr 1fr;'>
                        <div style='margin-left: 10%; display: inline-flex; align-items: center; justify-items: left'>
                            <h3 style="margin-right: auto;">Bachillerato:</h3>
                            <h5 id="msg3"><?php echo $Esp ?></h5>
                        </div>
                        <div style='margin-left: 20%; display: inline-flex; align-items: center; justify-items: left'>
                            <h3 style="margin-right: auto;">Año Lectivo:</h3>
                            <h5 id="msg2"><?php echo $Per ?></h5>
                        </div>
                        <div style='margin-left: 10%; display: inline-flex; align-items: center; justify-items: left'>
                            <h3 style="margin-right: auto;">Curso:</h3>
                            <h5 id="msg"><?php echo $Cur ?></h5>
                        </div>
                        <div style='margin-left: 20%; display: inline-flex; align-items: center; justify-items: left'>
                            <h3 style="margin-right: auto;">Fecha:</h3>
                            <h5><?php echo $Fecha ?></h5>
                        </div>
                    </div>
                </div>

                <h2 style="color: #013C80 ;font-family: 'Arial'; font-size: 18pt; letter-spacing: 1pt;	width: 100%; padding: 15px;	text-align: center;	text-transform: uppercase;"><?php echo $Doc; ?></h2>

                <table id='tabla' style='margin: auto; width: 100%; border-spacing: 10px 5px;'>
                    <thead>
                        <th style='width: 0%;'>
                            <center>
                        </th>
                        <th>
                            <center>Ev. Estudiantes
                        </th>
                        <th>
                            <center>Ev. Padres
                        </th>
                        <th>
                            <center>Observación en Clase
                        </th>
                        <th>
                            <center>Autoevaluación
                        </th>
                        <th>
                            <center>Ev. Directivos
                        </th>
                        <th>
                            <center>Coevaluación
                        </th>
                        <th>
                            <center>Total
                        </th>
                        <th>
                            <center>Cualitativo
                        </th>
                    </thead>

                    <tr>
                        <td style='color: #013C80;'><b>VALORES OBTENIDOS</b></td>
                        <td style='color: #013C80;'>
                            <center><b><?php echo round($eq1, 2); ?></b>
                        </td>
                        <td style='color: #013C80;'>
                            <center><b><?php echo round($eq2, 2); ?></b>
                        </td>
                        <td style='color: #013C80;'>
                            <center><b><?php echo round($eq3, 2); ?></b>
                        </td>
                        <td style='color: #013C80;'>
                            <center><b><?php echo round($eq4, 2); ?></b>
                        </td>
                        <td style='color: #013C80;'>
                            <center><b><?php echo round($eq5, 2); ?></b>
                        </td>
                        <td style='color: #013C80;'>
                            <center><b><?php echo round($eq6, 2); ?></b>
                        </td>
                        <td style='color: #013C80;'>
                            <center><b><?php echo round($Suma, 2); ?></b>
                        </td>
                        <td style='color: #013C80;'>
                            <center><b><?php echo $cal; ?></b>
                        </td>
                    </tr>
                </table>
                
            </div>
            <div id="mostrar_data" class="tablas">
                <!--Aqui llegan las tablas-->
                <br>
                <br>
                <?php echo $tablas; ?>
            </div>
        </div>

        <br><br>
        <center><button id='btn-export' class='btn btn_guardar_usuario' onclick="genPDF('<?php echo $namepdf; ?>');" style='display:block;'>IMPRIMIR</button></center>
        <br>
        <div id='grafico2'></div>
    </section>
</body>

</html>
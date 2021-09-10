<?PHP

include 'conexion.php';
$json=array();

if(isset($_GET["id_user"]) && isset($_GET["rol"])){
        
    $id_user=$_GET['id_user'];
    $rol = $_GET['rol'];
    if( $rol == 'Estudiante'){
    	$tipo = 'Estudiantes';
    
		$consulta="SELECT F.id AS ID_Survey, E.name AS NOMBRE_ENCUESTA, F.courseid AS ID_COURSE, A.fullname AS NAME_COURSE, IF(D.id IN (SELECT G.userid FROM mdl_questionnaire_response G WHERE G.questionnaireid = F.id),'SI','NO') AS COMPLETO FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E, mdl_questionnaire_survey F WHERE B.id = C.enrolid AND C.userid = D.id AND E.id = F.id AND B.enrol = 'self' AND B.courseid = A.id AND E.course = A.id AND F.title = '{$tipo}' AND D.id = '{$id_user}' ORDER BY D.username";

		$resultado=mysqli_query($conexion,$consulta);

		while($reg=mysqli_fetch_array($resultado)){
				$json['datosev'][]=$reg;
			}

		mysqli_close($conexion);
		echo json_encode($json);
	}else if( $rol == 'Docente'){
    	$tipo = 'Autoevaluación';
    
		$consulta="SELECT F.id AS ID_Survey, E.name AS NOMBRE_ENCUESTA, F.courseid AS ID_COURSE, A.fullname AS NAME_COURSE, IF(D.id IN (SELECT G.userid FROM mdl_questionnaire_response G WHERE G.questionnaireid = F.id),'SI','NO') AS COMPLETO FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E, mdl_questionnaire_survey F WHERE B.id = C.enrolid AND C.userid = D.id AND E.id = F.id AND B.enrol = 'self' AND B.courseid = A.id AND E.course = A.id AND F.title = '{$tipo}' AND D.id = '{$id_user}' ORDER BY D.username";

		$resultado=mysqli_query($conexion,$consulta);

		while($reg=mysqli_fetch_array($resultado)){
				$json['datosev'][]=$reg;
			}

		mysqli_close($conexion);
		echo json_encode($json);
	}else if( $rol == 'Directivo'){
    	$tipo = 'Directivos';
    
		$consulta="SELECT F.id AS ID_Survey, SUBSTRING(E.name, 25, 100) AS NAME_COURSE, F.courseid AS ID_COURSE, A.fullname AS NAME_COURSES, IF(D.id IN (SELECT G.userid FROM mdl_questionnaire_response G WHERE G.questionnaireid = F.id),'SI','NO') AS COMPLETO 
		FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E, mdl_questionnaire_survey F 
		WHERE B.id = C.enrolid AND C.userid = D.id AND E.id = F.id AND B.enrol = 'self' AND B.courseid = A.id AND E.course = A.id AND F.title LIKE '%{$tipo}%' AND F.courseid = (SELECT id FROM mdl_course WHERE category = 28 AND fullname LIKE '%{$tipo}%') AND D.id =  '{$id_user}'
		ORDER BY E.name";

		$resultado=mysqli_query($conexion,$consulta);

		while($reg=mysqli_fetch_array($resultado)){
				$json['datosev'][]=$reg;
			}

		mysqli_close($conexion);
		echo json_encode($json);
	}

}

?>


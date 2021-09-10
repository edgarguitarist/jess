<?PHP

include 'conexion.php';
$json=array();

if(isset($_GET["id_user"])){
        
        $id_user=$_GET['id_user'];

		$consulta="SELECT F.id AS ID_Survey, E.name AS NOMBRE_ENCUESTA, F.courseid AS ID_COURSE, A.fullname AS NAME_COURSE
        FROM mdl_course A, mdl_enrol B, mdl_user_enrolments C, mdl_user D, mdl_questionnaire E, mdl_questionnaire_survey F
		WHERE B.id = C.enrolid AND C.userid = D.id AND E.id = F.id AND B.enrol = 'self' AND B.courseid = A.id AND E.course = A.id AND F.title = 'Estudiantes' AND D.id = '{$id_user}' ORDER BY D.username";

		$resultado=mysqli_query($conexion,$consulta);

		while($reg=mysqli_fetch_array($resultado)){

				$json['datosev'][]=$reg;

			}

			mysqli_close($conexion);

			echo json_encode($json);
}

?>
<?PHP

include 'conexion.php';

$json=array();
	if(isset($_GET["Correo"]) && isset($_GET["Contrasena"])){
		$Correo=$_GET['Correo'];
		$Contrasena=$_GET['Contrasena'];
		
		$consulta="SELECT id, username, firstname, lastname, email, contrasena, idnumber FROM mdl_user WHERE email= '{$Correo}' AND contrasena = '{$Contrasena}'";
		$resultado=mysqli_query($conexion,$consulta);

		if($consulta){
		
			if($reg=mysqli_fetch_array($resultado)){
				$json['datos'][]=$reg;
			}
			mysqli_close($conexion);
			echo json_encode($json);
		}else{
			$results["email"]='';
			$results["contrasena"]='';
			$results["firstname"]='';
			$results["lastname"]='';
			$json['datos'][]=$results;
			echo json_encode($json);
		}
		
	}else{
		$results["email"]='';
		$results["contrasena"]='';
		$results["firstname"]='';
		$results["lastname"]='';
		$json['datos'][]=$results;
		echo json_encode($json);
	}
?>
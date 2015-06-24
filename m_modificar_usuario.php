<?php
	include 'conexion.php';

	$query = "SELECT P.nombres || ' ' || P.apellidos AS nombre_completo, N.numeronivel, N.tiponivel " .
			 'FROM Usuarios U, Personas P, NivelesUsuarios N ' .
			 'WHERE U.persona = P.id_persona ' .
			 'AND U.nivel = N.numeronivel ' .
			 "AND U.id_usuario = '" . $_POST['persona'] . "'";

	conectarBD();
	$resultado = pg_query($conexion, $query);

	$row = pg_fetch_array($resultado);
	
	echo $texto_nombre = $row['nombre_completo'];
	echo $numeronivel = $row['numeronivel'];

	print_r($arreglo = array('input#nombre' => $texto_nombre, 'select#nivel_usuario' => $numeronivel));

	echo json_encode($arreglo);

	// $clientId = $_POST['Client_ID']; // Selected Client Id

	// $query  = "SELECT Address1, Address2 from Client where Client_ID = $clientId";
	// $result = mysql_query($query);
	// $row = mysql_fetch_array($result, MYSQL_ASSOC);

	// $add1 = $row[Address1];
	// $add2 = $row[Address2];
	// $gender = 1;

	// $arr = array( 'input#address1' => $add1, 'input#address2' => $add2, 'select#gender' => $gender );
	// echo json_encode( $arr );
?>
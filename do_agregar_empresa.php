<?php
	session_start();
	include 'conexion.php';

	if (!isset($_POST['estado'])) {
		$_POST['estado'] = 'false';
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {    	
    	$query = 'INSERT INTO empresas (estado, nombre, responsable, id_empresa)' .
				 " VALUES ( '" . $_POST['estado'] . "', '" . $_POST['nombre'] . "', '" . $_POST['responsable'] . "', (SELECT cargarRegistro('Empresas')));";

    	conectarBD();

		if (pg_send_query($conexion, $query)) {
		  	$resultado=pg_get_result($conexion);
			if ($resultado) {
			    $estado = pg_result_error_field($resultado, PGSQL_DIAG_SQLSTATE);
			    if ($estado==0) {
			      	// En caso de que no haya ningún error.
			      	$_SESSION['error_bd_empresa'] = false;
			      	$_SESSION['insert_successful_empresa'] = true;
			      	$_SESSION['success_msg_empresa'] = "Empresa agregada exitosamente.";
			    } else {
			    	//Hay algún error.
				    $_SESSION['error_bd_empresa'] = true;
				    $_SESSION['estado_empresa'] = $estado;

			    	if ($estado=="23505") { 
			    		$_SESSION['estado_empresa'] = "Violación de valor único";
			    		// Violación de estado único.	
			      	}
			    } 
			} else {
		    	$_SESSION['error_bd_empresa'] = true;
		    	$_SESSION['estado_empresa'] = "Error Desconocido";
		    }
			
			header('Location: empresas.php');
		}

    } else {
    	header('Location: dashboard.php');
    }
	
?>
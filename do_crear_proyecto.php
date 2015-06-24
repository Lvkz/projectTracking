<?php
session_start();
	include 'conexion.php';

	if (!isset($_POST['estado'])) {
		$_POST['estado'] = 'false';
	}


	if ($_SERVER['REQUEST_METHOD'] === 'POST') {    	
    	echo $query = 'INSERT INTO proyectos (nombre, empresa, creador, fechaasignacion, fechacompromiso, estado,id_proyecto) ' .
				 " VALUES ( '" . $_POST['nombres'] . "', '" . $_POST['Empresa'] . "', '" . $_POST['Creador'] ."', '". $_POST['fecha1'] . "', '" . $_POST['fecha2'] ."', '" . $_POST['estado'] . "',(SELECT cargarRegistro('Proyectos')));";

    	conectarBD();

		if (pg_send_query($conexion, $query)) {
		  	$resultado=pg_get_result($conexion);
			if ($resultado) {
			    $estado = pg_result_error_field($resultado, PGSQL_DIAG_SQLSTATE);
			    if ($estado==0) {
			      	// En caso de que no haya ningún error.
			      	$_SESSION['error_bd'] = false;
			      	$_SESSION['insert_successful'] = true;
			      	$_SESSION['success_msg'] = "Persona agregada exitosamente.";
			    } else {
			    	//Hay algún error.
				    $_SESSION['error_bd'] = true;
				    $_SESSION['estado'] = $estado;

			    	if ($estado=="23505") { 
			    		$_SESSION['estado'] = "Violación de valor único";
			    		// Violación de estado único.	
			      	}
			    } 
			} else {
		    	$_SESSION['error_bd'] = true;
		    	$_SESSION['estado'] = "Error Desconocido";
		    }
			
			header('Location: proyectos.php');
		}

    } else {
    	header('Location: dashboard.php');
    }
	
?>
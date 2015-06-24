<?php
	session_start();
	include 'conexion.php';

	if (!isset($_POST['estado'])) {
		$_POST['estado'] = 'false';
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {    	
    	$query = 'INSERT INTO Tareas (id_tarea, proyecto, cantidadhoras, creador, responsable, fechaasignacion, fechacompromiso, condicion, nota, estado) ' .
				 "VALUES((SELECT cargarRegistro('Tareas')), '" . $_POST['proyecto'] . "'," . $_POST['horas'] . ", '" . $_POST['id_creador'] . "', '" . $_POST['responsable'] . "', '" . $_POST['fecha1'] . "', '" . $_POST['fecha2'] . "' , '" . $_POST['condicion'] . "', '" . $_POST['nota'] . "', " . $_POST['estado'] . ")";

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
			
			header('Location: proyectos.php');
		}

    } else {
    	header('Location: dashboard.php');
    }
	
?>
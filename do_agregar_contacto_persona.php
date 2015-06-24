<?php
	session_start();
	include 'conexion.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {    	
    	$query = 'INSERT INTO contactospersonas (id_contacto, tipo, contacto, persona)' .
				 " VALUES ((SELECT cargarRegistro('ContactosPersonas')), '" . $_POST['tipo_contacto'] . "', '" . $_POST['detalle'] . "', '" . $_POST['persona'] . "');";

    	conectarBD();

		if (pg_send_query($conexion, $query)) {
		  	$resultado=pg_get_result($conexion);
			if ($resultado) {
			    $estado = pg_result_error_field($resultado, PGSQL_DIAG_SQLSTATE);
			    if ($estado==0) {
			      	// En caso de que no haya ningún error.
			      	$_SESSION['error_bd'] = false;
			      	$_SESSION['insert_successful'] = true;
			      	$_SESSION['success_msg'] = "Contacto agregado exitosamente.";
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
			
			header('Location: personas.php');
		}

    } else {
    	header('Location: dashboard.php');
    }
	
?>
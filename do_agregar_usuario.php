<?php
	session_start();
	include 'conexion.php';

	if (!isset($_POST['estado'])) {
		$_POST['estado'] = 'false';
	}

	//Verificación de que ambas contraseñas sean iguales.
	if (isset($_POST['contrasenia']) && isset($_POST['contrasenia2']) && $_POST['contrasenia'] !== $_POST['contrasenia2']) {
		$_SESSION['error_bd_usuarios'] = true;
		$_SESSION['estado_usuarios'] = "Error en contraseña";
		header('Location: usuarios.php');
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$contrasenia = md5($_POST['contrasenia']);

		$query = 'INSERT INTO usuarios (id_usuario, nombre, contrasenia, estado, nivel, persona) ' .
				 "VALUES ((SELECT cargarRegistro('Usuarios')), '" . $_POST['nombre'] . "', '". $contrasenia . "', '" . $_POST['estado'] .  "', '" . $_POST['nivel_usuario'] . "', '" . $_POST['persona'] . "')";

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
			
			header('Location: usuarios.php');
		}

    } else {
    	header('Location: dashboard.php');
    }
	
?>
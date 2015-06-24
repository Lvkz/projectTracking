<?php
	session_start();

	include 'conexion.php';
	$_SESSION['update_successful'] = false;
	$_SESSION['error_change_password'] = false;
	$_SESSION['msg_change_password'] = false;

	if($_SERVER['REQUEST_METHOD'] === 'POST') {		
		if (!empty($_POST['contrasenia_actual']) && !empty($_POST['nueva_contrasenia']) && !empty($_POST['confirmacion_contrasenia'])) {
			if($_POST['nueva_contrasenia'] !== $_POST['confirmacion_contrasenia']) {
				$_SESSION['error_change_password'] = true;
				$_SESSION['msg_change_password'] = "Contraseñas no coinciden.";
			} else {
				//Consulto la contrasenia vieja.
				$query = "SELECT contrasenia FROM Usuarios WHERE nombre = '" . $_SESSION['usuario'] . "'";
				conectarBD();

				$resultado = pg_query($conexion, $query);
				$row = pg_fetch_array($resultado);

				if (md5($_POST['contrasenia_actual']) === $row['contrasenia']) {
					$contrasenia = md5($_POST['nueva_contrasenia']);
					$query = "UPDATE usuarios SET contrasenia = '" . $contrasenia . "' WHERE id_usuario = '" . $_SESSION['id_usuario'] ."'";

					conectarBD();
            		$resultado = pg_query($conexion, $query);
            		$_SESSION['update_successful'] = true;
				} else {
					$_SESSION['error_change_password'] = true;
					$_SESSION['msg_change_password'] = "Contraseña actual no es correcta.";
				}
			} 
		} else {
			$_SESSION['error_change_password'] = true;
			$_SESSION['msg_change_password'] = "Campos en blanco.";
		}

		header('Location: dashboard.php');

	} else {
		header('Location: dashboard.php');
	}
?>
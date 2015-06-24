<?php
	session_start();
	include 'conexion.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$query = "SELECT id_usuario, nivel, nombre, nombres || ' ' || apellidos AS nombre_completo " .
				 'FROM Usuarios U, Personas P ' .
				 'WHERE U.persona = P.id_persona '.
				 "AND U.nombre = '" . $_POST['usuario'] . "' " .
				 "AND U.contrasenia = md5('" . $_POST['contrasenia'] . "')";

		conectarBD();
		$resultado = pg_query($conexion, $query)
			OR DIE("No puedo ejecutar el query: $query\n");

		$_SESSION['error'] = false;

		if (pg_num_rows($resultado) != 0) {
			while ($row = pg_fetch_array($resultado)) {
				$_SESSION['nombre_usuario'] = $row['nombre_completo'];
				$_SESSION['usuario'] = $row['nombre'];
				$_SESSION['nivel_usuario'] = $row['nivel'];
				$_SESSION['id_usuario'] = $row['id_usuario'];
			}
		} else {
			//Usuario y/o contrasenia equivocados.
			$_SESSION['error'] = true;
		}
    }

    header('Location: index.php');

	pg_close($conexion);
?>
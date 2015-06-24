<?php
	include 'conexion.php';

	echo '<form action="do_agregar_usuario.php" class="form-horizontal" id="validation-form" method="post">';
	echo '<div class="control-group">';
	echo '<label class="control-label" for="nombres">Nombre de Usuario:</label>';
	echo '<div class="controls">';
	echo '<div class="span12">';
	echo '<input type="text" name="nombre" id="nombre" class="input-xlarge" data-rule-required="true" data-rule-minlength="3" />';
	echo '</div>';
	echo '</div>';
	echo '</div>';

	echo '<div class="control-group">';
	echo '<label class="control-label" for="persona">Persona:</label>';
	echo '<div class="controls">';
	echo '<div class="span12">';
	echo '<select class="input-xlarge" name="persona" id="persona" data-rule-required="true">';

	$query = "SELECT id_persona, nombres || ' ' || apellidos AS nombrecompleto FROM personas WHERE estado = 'true' ORDER BY id_persona";
	conectarBD();

	$resultado = pg_query($conexion, $query);

	while($row = pg_fetch_array($resultado)) {
		echo '<option value="' . $row['id_persona'] . '">' . $row['nombrecompleto'] . '</option>';
	}

	echo '</select>';
	echo '</div>';
	echo '</div>';
	echo '</div>';

	echo '<div class="control-group">';
	echo '<label class="control-label" for="contrasenia">Contraseña:</label>';
	echo '<div class="controls">';
	echo '<div class="span12">';
	echo '<input type="password" name="contrasenia" id="contrasenia" class="input-xlarge" data-rule-required="true" data-rule-minlength="3" />';
	echo '</div>';
	echo '</div>';
	echo '</div>';

	echo '<div class="control-group">';
	echo '<label class="control-label" for="contrasenia2">Repetir Contraseña:</label>';
	echo '<div class="controls">';
	echo '<div class="span12">';
	echo '<input type="password" name="contrasenia2" id="contrasenia2" class="input-xlarge" data-rule-required="true" data-rule-minlength="3" />';
	echo '</div>';
	echo '</div>';
	echo '</div>';

	echo '<div class="control-group">';
	echo '<label class="control-label" for="nivel_usuario">Tipo Permiso:</label>';
	echo '<div class="controls">';
	echo '<div class="span12">';
	echo '<select class="input-xlarge" name="nivel_usuario" id="nivel_usuario" data-rule-required="true">';

	$query = "SELECT numeronivel, tiponivel FROM nivelesusuarios WHERE estado = 'true' ORDER BY id_nivel";
	conectarBD();

	$resultado = pg_query($conexion, $query);

	while($row = pg_fetch_array($resultado)) {
		echo '<option value="' . $row['numeronivel'] . '">' . $row['tiponivel'] . '</option>';
	}

	echo '</select>';
	echo '</div>';
	echo '</div>';
	echo '</div>';

	echo '<div class="control-group">';
	echo '<div class="controls">';
	echo '<label class="checkbox inline">';
	echo '<input type="checkbox" name="estado" value="true" /> Estado';
	echo '</label>';
	echo '</div>';
	echo '</div>';

	echo '<div class="form-actions">';
	echo '<input type="submit" class="btn btn-primary" value="Agregar">';
	echo ' <button type="button" class="btn">&nbsp;Cancel&nbsp;</button>';
	echo '</div>';
	echo '</form>';
?>
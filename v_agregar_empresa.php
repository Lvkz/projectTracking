<?php
	include 'conexion.php';

	echo '<form action="do_agregar_empresa.php" class="form-horizontal" id="validation-form" method="post">';
	echo '<div class="control-group">';
	echo '<label class="control-label" for="nombres">Nombre de la Empresa:</label>';
	echo '<div class="controls">';
	echo '<div class="span12">';
	echo '<input type="text" name="nombre" id="nombre" class="input-xlarge" data-rule-required="true" data-rule-minlength="3" />';
	echo '</div>';
	echo '</div>';
	echo '</div>';

	echo '<div class="control-group">';
	echo '<label class="control-label" for="responsable">Responsable:</label>';
	echo '<div class="controls">';
	echo '<div class="span12">';
	echo '<select class="input-xlarge" name="responsable" id="responsable" data-rule-required="true">';

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
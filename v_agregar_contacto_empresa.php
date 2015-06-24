<?php
	include 'conexion.php';

	echo '<form action="do_agregar_contacto_empresa.php" class="form-horizontal" id="validation-form" method="post">';
	echo '<div class="control-group">';
	echo '<label class="control-label" for="empresa">Elija la Empresa:</label>';
	echo '<div class="controls">';
	echo '<select class="input-xlarge" name="empresa" id="empresa" data-rule-required="true">';

	$query = "SELECT id_empresa, nombre FROM empresas WHERE estado = 'true' ORDER BY id_empresa";
	conectarBD();

	$resultado = pg_query($conexion, $query);

	while($row = pg_fetch_array($resultado)) {
		echo '<option value="' . $row['id_empresa'] . '">' . $row['nombre'] . '</option>';
	}

	echo '</select>';
	echo '</div>';
	echo '</div>';

	echo '<div class="control-group">';
	echo '<label class="control-label" for="tipo_contacto">Tipo de Contacto:</label>';
	echo '<div class="controls">';
	echo '<select class="input-xlarge" name="tipo_contacto" id="tipo_contacto" data-rule-required="true">';

	$query = "SELECT id_tipocontacto, nombre FROM tiposcontactos WHERE estado = 'true' ORDER BY id_tipocontacto";
	conectarBD();

	$resultado = pg_query($conexion, $query);

	while($row = pg_fetch_array($resultado)) {
		echo '<option value="' . $row['id_tipocontacto'] . '">' . $row['nombre'] . '</option>';
	}
	echo '</select>';
	echo '</div>';
	echo '</div>';

	echo '<div class="control-group">';
	echo '<label class="control-label" for="detalle">Detalle:</label>';
	echo '<div class="controls">';
	echo '<div class="span12">';
	echo '<input type="text" name="detalle" id="detalle" class="input-xlarge" data-rule-required="true" data-rule-minlength="3" />';
	echo '</div>';
	echo '</div>';
	echo '</div>';

	echo '<div class="form-actions">';
	echo '<input type="submit" class="btn btn-primary" value="Agregar">';
	echo ' <button type="button" class="btn">&nbsp;Cancel&nbsp;</button>';
	echo '</div>';
	echo '</form>';
?>
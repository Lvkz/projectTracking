<?php
	include 'conexion.php';

	if($_SERVER['REQUEST_METHOD'] === 'GET') {
		if (isset($_GET['seleccionID'])) {
			$variable = explode(',', $_GET['seleccionID']);

			$query = "UPDATE tiposcontactos SET estado = " . $variable[0] . " WHERE id_tipocontacto = '" . $variable[1] . "'";
		                      
		  	conectarBD();
		  	$resultado = pg_exec($conexion, $query);
		}	
	}

	//echo '<form id="validation-form" action="" method="post" class="form-horizontal">';

	echo '<form action="do_agregar_tipocontacto.php" class="form-horizontal" id="validation-form" method="post">';
	echo '<div class="control-group">';
	echo '<label class="control-label">Tipo de Contacto</label>';
	echo '<div class="controls">';
	echo '<input type="text" id="tipo_contacto" name="tipo_contacto" placeholder="" class="input-block-level">';
	//echo '<span class="help-inline">Requerido</span>';
	echo '</div>';
	echo '</div>';

	echo '<div class="controls">';
	echo '<button type="submit" class="btn btn-success validation_button"><i class="icon-ok"></i> Guardar</button>';
	echo ' <button type="reset" class="btn">Cancel</button>';
	echo '</div>';
	echo '</div>';
	echo '</form>';

	$query = "SELECT * FROM tiposcontactos ORDER BY id_tipocontacto ASC;";

    conectarBD();
    $resultado = pg_exec($conexion, $query);

     if(pg_num_rows($resultado) == 0){
      echo 'Actualmente no existen tipos';
    } else {
		echo '<table class="table">';
		echo '<thead>';
		echo '<tr>';
		echo '<th>#</th>';
		echo '<th>Código</th>';
		echo '<th>Tipo de Contacto</th>';
		echo '<th>Status</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
      
      $conteo = 1;

      while ($row = pg_fetch_array($resultado)) {
        echo '<tr>';
        echo '<td class="hidden-phone hidden-tablet">' . $conteo++ . '</td>';
        echo '<td class="hidden-phone hidden-tablet">' . $row['id_tipocontacto'] . '</td>';
        echo '<td>' . $row['nombre'] . '</td>';
        echo '<td>';
        	if ($row['estado'] == 't') {
        		echo '<input type="checkbox" id="activo_contacto" name="activar_nivel" value="' . $row['id_tipocontacto'] . '" checked="checked"/>';
        	} else {
        		echo '<input type="checkbox" id="activo_contacto" name="activar_nivel	" value="' . $row['id_tipocontacto'] . '" />';
        	}
        echo '</td>';
        echo '</tr>';
      }
      	echo '</tbody>';
		echo '</table>';
    }	
?>
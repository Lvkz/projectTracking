<?php
	include 'conexion.php';

	if($_SERVER['REQUEST_METHOD'] === 'GET') {
		if (isset($_GET['seleccionID'])) {
			$variable = explode(',', $_GET['seleccionID']);

			$query = "UPDATE condiciones SET estado = " . $variable[0] . " WHERE id_condicion = '" . $variable[1] . "'";
		                      
		  	conectarBD();
		  	$resultado = pg_exec($conexion, $query);
		}	
	}

	//echo '<form id="validation-form" action="" method="post" class="form-horizontal">';

	echo '<form action="do_agregar_condicion.php" class="form-horizontal" id="validation-form" method="post">';
	echo '<div class="control-group">';
	echo '<label class="control-label">Tipo de Condición</label>';
	echo '<div class="controls">';
	echo '<input type="text" id="tipo_condicion" name="tipo_condicion" placeholder="" class="input-block-level">';
	//echo '<span class="help-inline">Requerido</span>';
	echo '</div>';
	echo '</div>';

	echo '<div class="controls">';
	echo '<button type="submit" class="btn btn-success validation_button"><i class="icon-ok"></i> Guardar</button>';
	echo ' <button type="reset" class="btn">Cancel</button>';
	echo '</div>';
	echo '</div>';
	echo '</form>';

	$query = "SELECT * FROM condiciones ORDER BY id_condicion ASC;";

    conectarBD();
    $resultado = pg_exec($conexion, $query);

     if(pg_num_rows($resultado) == 0){
      echo 'Actualmente no existen tipos';
    } else {
		echo '<table class="table">';
		echo '<thead>';
		echo '<tr>';
		echo '<th>#</th>';
		echo '<th>Tipo de Condición</th>';
		echo '<th>Status</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
      
      $conteo = 1;

      while ($row = pg_fetch_array($resultado)) {
        echo '<tr>';
        echo '<td class="hidden-phone hidden-tablet">' . $conteo++ . '</td>';
        echo '<td class="hidden-phone hidden-tablet">' . $row['id_condicion'] . '</td>';
        echo '<td>' . $row['nombre'] . '</td>';
        echo '<td>';
        	if ($row['estado'] == 't') {
        		echo '<input type="checkbox" id="activo_condicion" name="activar_nivel" value="' . $row['id_condicion'] . '" checked="checked"/>';
        	} else {
        		echo '<input type="checkbox" id="activo_condicion" name="activar_nivel	" value="' . $row['id_condicion'] . '" />';
        	}
        echo '</td>';
        echo '</tr>';
      }
      	echo '</tbody>';
		echo '</table>';
    }	
?>
<?php
	include 'conexion.php';


	if($_SERVER['REQUEST_METHOD'] === 'GET') {
		if (isset($_GET['seleccionID'])) {
			$variable = explode(',', $_GET['seleccionID']);

			$query = "UPDATE nivelesusuarios SET estado = " . $variable[0] . " WHERE id_nivel = '" . $variable[1] . "'";
		                      
		  	conectarBD();
		  	$resultado = pg_exec($conexion, $query);
		}	
	}

	//echo '<form id="validation-form" action="" method="post" class="form-horizontal">';

	echo '<form action="do_agregar_nivel.php" class="form-horizontal" id="validation-form" method="post">';
	echo '<div class="control-group">';
	echo '<label class="control-label">Número de Nivel</label>';
	echo '<div class="controls">';
	echo '<input type="text" id="numero_nivel" name="numero_nivel" placeholder="" class="input-block-level">';
	//echo '<span class="help-inline">Requerido</span>';
	echo '</div>';
	echo '</div>';

	echo '<div class="control-group">';
	echo '<label class="control-label">Nombre de Nivel</label>';
	echo '<div class="controls">';
	echo '<input type="text"  id="nombre_nivel" name="nombre_nivel" placeholder="" class="input-block-level">';
	//echo '<span class="help-inline">Requerido</span>';
	echo '</div>';
	echo '</div>';

	echo '<div class="controls">';
	echo '<button type="submit" class="btn btn-success validation_button"><i class="icon-ok"></i> Guardar</button>';
	echo ' <button type="reset" class="btn">Cancel</button>';
	echo '</div>';
	echo '</div>';
	echo '</form>';

	$query = "SELECT * FROM nivelesusuarios ORDER BY id_nivel ASC;";

    conectarBD();
    $resultado = pg_exec($conexion, $query);

     if(pg_num_rows($resultado) == 0){
      echo 'Actualmente no existen estados de salud.';
    } else {
		echo '<table class="table">';
		echo '<thead>';
		echo '<tr>';
		echo '<th class="hidden-phone hidden-tablet">#</th>';
		echo '<th class="hidden-phone hidden-tablet">ID Nivel</th>';
		echo '<th>Tipo Nivel</th>';
		echo '<th># Nivel</th>';
		echo '<th>Status</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
      
      $conteo = 1;

      while ($row = pg_fetch_array($resultado)) {
        echo '<tr>';
        echo '<td class="hidden-phone hidden-tablet">' . $conteo++ . '</td>';
        echo '<td class="hidden-phone hidden-tablet">' . $row['id_nivel'] . '</td>';
        echo '<td>' . $row['tiponivel'] . '</td>';
        echo '<td>' . $row['numeronivel'] . '</td>';
        echo '<td>';
        	if ($row['estado'] == 't') {
        		echo '<input type="checkbox" id="activo_nivel" name="activar_nivel" value="' . $row['id_nivel'] . '" checked="checked"/>';
        	} else {
        		echo '<input type="checkbox" id="activo_nivel" name="activar_nivel	" value="' . $row['id_nivel'] . '" />';
        	}
        echo '</td>';
        echo '</tr>';
      }
      	echo '</tbody>';
		echo '</table>';
    }	
?>
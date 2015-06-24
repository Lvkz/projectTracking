<?php
	include 'conexion.php';

	echo '<form action="do_agregar_referencia.php" class="form-horizontal" id="validation-form" method="post">';
	echo '<div class="control-group">';
	echo '<label class="control-label">Referencia</label>';
	echo '<div class="controls">';
	echo '<input type="text" id="referencia" name="referencia" placeholder="" class="input-block-level">';
	//echo '<span class="help-inline"></span>';
	echo '</div>';
	echo '</div>';

	echo '<div class="control-group">';
	echo '<label class="control-label">Serie</label>';
	echo '<div class="controls">';
	echo '<input type="text" id="serie" name="serie" placeholder="" class="input-block-level">';
	//echo '<span class="help-inline"></span>';
	echo '</div>';
	echo '</div>';

	echo '<div class="controls">';
	echo '<button type="submit" class="btn btn-success validation_button"><i class="icon-ok"></i> Guardar</button>';
	echo ' <button type="reset" class="btn">Cancel</button>';
	echo '</div>';
	echo '</div>';
	echo '</form>';

	$query = "SELECT * FROM referencias;";

    conectarBD();
    $resultado = pg_exec($conexion, $query);

     if(pg_num_rows($resultado) == 0){
      echo 'Actualmente no existen referencias.';
    } else {
		echo '<table class="table">';
		echo '<thead>';
		echo '<tr>';
		echo '<th class="hidden-phone hidden-tablet">#</th>';
		echo '<th>Módulo</th>';
		echo '<th>Referencia</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
      
      $conteo = 1;

      while ($row = pg_fetch_array($resultado)) {
        echo '<tr>';
        echo '<td class="hidden-phone hidden-tablet">' . $conteo++ . '</td>';
        echo '<td>' . $row['modulo'] . '</td>';
        echo '<td>' . $row['referencia'] . '</td>';
        echo '<td>' . $row['serie'] . '</td>';
        echo '</tr>';
      }
      	echo '</tbody>';
		echo '</table>';
    }	
?>
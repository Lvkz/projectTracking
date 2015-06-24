<?php
    session_start();
    include 'conexion.php';

    if (isset($_SESSION['error_bd_usuarios']) && ($_SESSION['error_bd_usuarios'] == true)) {
        echo '<div class="alert alert-error">';
        echo '<button class="close" data-dismiss="alert">&times;</button>';
        echo '<strong>¡Error!</strong> No se ha podido procesar la solicitud. (Error No: '. $_SESSION['estado_usuarios'] .').';
        echo '</div>';

        $_SESSION['error_bd_usuarios'] = false;
    }

    if (isset($_SESSION['success_msg']) && ($_SESSION['insert_successful'] == true) && ($_SESSION['error_bd_usuarios'] == false)) {
        echo '<div class="alert alert-info">';
        echo '<button class="close" data-dismiss="alert">&times;</button>';
        echo '<strong>¡Información Procesada!</strong> '. $_SESSION['success_msg_usuarios'];
        echo '</div>';

        $_SESSION['insert_successful_usuarios'] = false;
    } 

    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['seleccionID'])) {
            $variable = explode(',', $_GET['seleccionID']);

            $query = "UPDATE usuarios SET estado = " . $variable[0] . " WHERE id_usuario = '" . $variable[1] . "'";
                              
            conectarBD();
            $resultado = pg_exec($conexion, $query);
        }   
    }

    $query = "SELECT U.id_usuario, U.nombre, U.estado, N.tiponivel, P.nombres || ' ' || P.apellidos as nombre_completo " .
             'FROM usuarios U, personas P, nivelesusuarios N ' .
             'WHERE U.persona = P.id_persona ' .
             'AND U.nivel = N.numeronivel ' . 
             'ORDER BY U.id_usuario ASC';

    conectarBD();
    $resultado = pg_exec($conexion, $query);

     if(pg_num_rows($resultado) == 0){
      echo 'Actualmente no existen personas.';
    } else {
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID Usuario</th>';
        echo '<th>Usuario</th>';
        echo '<th>Nombres Apellidos</th>';
        echo '<th>Nivel</th>';
        echo '<th>Estado</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
      
      $conteo = 1;

      while ($row = pg_fetch_array($resultado)) {
        echo '<tr>';
        echo '<td>' . $row['id_usuario'] . '</td>';
        echo '<td>' . $row['nombre'] . '</td>';
        echo '<td>' . $row['nombre_completo'] . '</td>';
        echo '<td>' . $row['tiponivel'] . '</td>';
        echo '<td>';
        if ($row['estado'] == 't') {
            echo '<input type="checkbox" id="activo_usuario" name="activar_nivel" value="' . $row['id_usuario'] . '" checked="checked"/>';
        } else {
            echo '<input type="checkbox" id="activo_usuario" name="activar_nivel   " value="' . $row['id_usuario'] . '" />';
        }
        echo '</td>';
        echo '</tr>';
      }
        echo '</tbody>';
        echo '</table>';
    } 
?>
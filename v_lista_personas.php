<?php
    session_start();

    include 'conexion.php';

    if (isset($_SESSION['error_bd']) && ($_SESSION['error_bd'] == true)) {
        echo '<div class="alert alert-error">';
        echo '<button class="close" data-dismiss="alert">&times;</button>';
        echo '<strong>¡Error!</strong> No se ha podido procesar la solicitud. (Error No: '. $_SESSION['estado'] .').';
        echo '</div>';

        $_SESSION['error_bd'] = false;
    }

    if (isset($_SESSION['success_msg']) && ($_SESSION['insert_successful'] == true) && ($_SESSION['error_bd'] == false)) {
        echo '<div class="alert alert-info">';
        echo '<button class="close" data-dismiss="alert">&times;</button>';
        echo '<strong>¡Información Procesada!</strong> '. $_SESSION['success_msg'];
        echo '</div>';

        $_SESSION['insert_successful'] = false;
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['seleccionID'])) {
            $variable = explode(',', $_GET['seleccionID']);

            $query = "UPDATE personas SET estado = " . $variable[0] . " WHERE id_persona = '" . $variable[1] . "'";
                              
            conectarBD();
            $resultado = pg_exec($conexion, $query);
        }   
    }
    
    //Selecciono todas las personas
    //Dentro de cada iteracion, cargo el contacto.

    echo '<table class="table table_personas">';
    echo '<thead>';
    echo '<tr>';
    echo '<th style="width: 5%" class="hidden-phone hidden-tablet">#</th>';
    echo '<th style="width: 18%">Cód. Persona</th>';
    echo '<th style="width: 45%">Nombre</th>';
    echo '<th style="width: 10%">Sexo</th>';
    echo '<th style="width: 25%">Fecha Nacimiento</th>';
    echo '</tr>';
    echo '</thead>';
    echo '</table>';

    $query = "SELECT * FROM personas ORDER BY id_persona ASC";
    conectarBD();

    $resultado = pg_query($conexion, $query);

    $conteo = 0;
    while($row = pg_fetch_array($resultado)) {
        $conteo++;

        echo '<div class="accordion-group">';
        echo '<div class="accordion-heading">';
        echo '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#' . $row['id_persona'] . '">';
        
        //Tabla
        echo '<table class="table table_personas">';
        echo '<tbody>';
        echo '<tr>';
        echo '<td style="width: 5%"class="hidden-phone hidden-tablet">' . $conteo . '</td>';
        echo '<td style="width: 18%">' . $row['id_persona'] . '</td>';
        echo '<td style="width: 42%">' . $row['nombres'] . " " . $row['apellidos'] . '</td>';
        echo '<td style="width: 13%">' . $row['sexo'] . '</td>';
        echo '<td style="width: 15%">' . $row['fechanacimiento'] . '</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';

        echo '</a>';
        echo '</div>';

        echo '<div id="' . $row['id_persona'] . '" class="accordion-body collapse">';
        echo '<div class="accordion-inner">';
        
        $query2 = 'SELECT nombre, contacto ' . 
                  'FROM contactospersonas CP, tiposcontactos TC ' .
                  'WHERE CP.tipo = TC.id_tipocontacto ' .
                  "  AND CP.persona = '" . $row['id_persona'] . "';";

        $resultado2 = pg_query($conexion, $query2);

        echo '<table class="table table_personas">';
        echo '<tbody>';
        echo '<tr>';

        if (pg_num_rows($resultado2) == 0) {
            echo '<td style="width: 60%">Esta persona no tiene contactos asignados.</td>';
        } else {
            echo '<td style="width: 60%">Listado de Contactos:</td>';
        }
        echo '<td style="width: 25%">Estado de la Persona: </td>';   
        echo '<td style="width: 5%">';
            if ($row['estado'] == 't') {
                echo '<input type="checkbox" id="activo_persona" name="activar_nivel" value="' . $row['id_persona'] . '" checked="checked"/>';
            } else {
                echo '<input type="checkbox" id="activo_persona" name="activar_nivel   " value="' . $row['id_persona'] . '" />';
            }
        echo '</td>';
        
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';

        while($row = pg_fetch_array($resultado2)) {
            //Tabla
            echo '<table class="table table_personas">';
            echo '<tbody>';
            echo '<tr>';
            echo '<td style="width: 25%">' . $row['nombre'] . '</td>';
            echo '<td style="width: 25%">' . $row['contacto'] . '</td>';
            echo '<td style="width: 50%"></td>';
            echo '</tr>';
            echo '</tbody>';
            echo '</table>';
        }

        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    
    // conectarBD();
    // $resultado = pg_exec($conexion, $query);

    //  if(pg_num_rows($resultado) == 0){
    //   echo 'Actualmente no existen personas.';
    // } else {
    //     echo '<table class="table">';
    //     echo '<thead>';
    //     echo '<tr>';
    //     echo '<th>Código</th>';
    //     echo '<th>Nombres Appellidos</th>';
    //     echo '<th>Sexo</th>';
    //     echo '<th>Fecha Nacimiento</th>';
    //     echo '<th>Estado</th>';
    //     echo '</tr>';
    //     echo '</thead>';
    //     echo '<tbody>';
      
    //   $conteo = 1;

    //   while ($row = pg_fetch_array($resultado)) {
    //     echo '<tr>';
    //     echo '<td>' . $row['id_persona'] . '</td>';
    //     echo '<td>' . $row['nombres'] . ' ' . $row['apellidos'] . '</td>';
    //     echo '<td>' . $row['sexo'] . '</td>';
    //     echo '<td>' . $row['fechanacimiento'] . '</td>';
    //     echo '<td>';
    //     if ($row['estado'] == 't') {
    //         echo '<input type="checkbox" id="activo_persona" name="activar_nivel" value="' . $row['id_persona'] . '" checked="checked"/>';
    //     } else {
    //         echo '<input type="checkbox" id="activo_persona" name="activar_nivel   " value="' . $row['id_persona'] . '" />';
    //     }
    //     echo '</td>';
    //     echo '</tr>';
    //   }
    //     echo '</tbody>';
    //     echo '</table>';
    // }   
?>
<?php
    session_start();

    include 'conexion.php';

    if (isset($_SESSION['error_bd_empresa']) && ($_SESSION['error_bd_empresa'] == true)) {
        echo '<div class="alert alert-error">';
        echo '<button class="close" data-dismiss="alert">&times;</button>';
        echo '<strong>¡Error!</strong> No se ha podido procesar la solicitud. (Error No: '. $_SESSION['estado_empresa'] .').';
        echo '</div>';

        $_SESSION['error_bd_empresa'] = false;
    }

    if (isset($_SESSION['success_msg_empresa']) && ($_SESSION['insert_successful_empresa'] == true) && ($_SESSION['error_bd_empresa'] == false)) {
        echo '<div class="alert alert-info">';
        echo '<button class="close" data-dismiss="alert">&times;</button>';
        echo '<strong>¡Información Procesada!</strong> '. $_SESSION['success_msg_empresa'];
        echo '</div>';

        $_SESSION['insert_successful_empresa'] = false;
    }

        if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['seleccionID'])) {
            $variable = explode(',', $_GET['seleccionID']);

            $query = "UPDATE empresas SET estado = " . $variable[0] . " WHERE id_empresa = '" . $variable[1] . "'";
                              
            conectarBD();
            $resultado = pg_exec($conexion, $query);
        }   
    }

    echo '<table class="table table_personas">';
    echo '<thead>';
    echo '<tr>';
    echo '<th style="width: 5%" class="hidden-phone hidden-tablet">#</th>';
    echo '<th style="width: 18%">Cód. Empresa</th>';
    echo '<th style="width: 42%">Nombre de la Empresa</th>';
    echo '<th style="width: 35%">Responsable</th>';
    echo '</tr>';
    echo '</thead>';
    echo '</table>';

    $query = "SELECT E.id_empresa, E.nombre, E.estado, P.nombres || ' ' || P.apellidos AS Nombre_Responsable " .
             'FROM empresas E, personas P ' .
             'WHERE E.responsable = P.id_persona ' .
             'ORDER BY E.id_empresa ASC ';
    conectarBD();

    $resultado = pg_query($conexion, $query);

    $conteo = 0;
    while($row = pg_fetch_array($resultado)) {
        $conteo++;

        echo '<div class="accordion-group">';
        echo '<div class="accordion-heading">';
        echo '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#' . $row['id_empresa'] . '">';
        
        //Tabla
        echo '<table class="table table_personas">';
        echo '<tbody>';
        echo '<tr>';
        echo '<td style="width: 5%"class="hidden-phone hidden-tablet">' . $conteo . '</td>';
        echo '<td style="width: 18%">' . $row['id_empresa'] . '</td>';
        echo '<td style="width: 42%">' . $row['nombre'] . '</td>';
        echo '<td style="width: 35%">' . $row['nombre_responsable'] . '</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';

        echo '</a>';
        echo '</div>';

        echo '<div id="' . $row['id_empresa'] . '" class="accordion-body collapse">';
        echo '<div class="accordion-inner">';
        
        $query2 = 'SELECT nombre, contacto ' . 
                  'FROM contactosempresas CE, tiposcontactos TC ' .
                  'WHERE CE.tipo = TC.id_tipocontacto ' .
                  "  AND CE.empresa = '" . $row['id_empresa'] . "';";

        $resultado2 = pg_query($conexion, $query2);

        echo '<table class="table table_personas">';
        echo '<tbody>';
        echo '<tr>';

        if (pg_num_rows($resultado2) == 0) {
            echo '<td style="width: 60%">Esta empresa no tiene contactos asignados.</td>';
        } else {
            echo '<td style="width: 60%">Listado de Contactos:</td>';
        }
        echo '<td style="width: 25%">Estado de la Empresa: </td>';   
        echo '<td style="width: 5%">';
            if ($row['estado'] == 't') {
                echo '<input type="checkbox" id="activo_empresa" name="activar_nivel" value="' . $row['id_empresa'] . '" checked="checked"/>';
            } else {
                echo '<input type="checkbox" id="activo_empresa" name="activar_nivel   " value="' . $row['id_empresa'] . '" />';
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
?>
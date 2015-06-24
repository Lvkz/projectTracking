<?php $thisPage = 'tareas'; ?>
<?php $thisGroup = 'proyectos'; ?>
<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>

<!-- BEGIN Content -->
<div id="main-content">
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>
            <h1><i class="icon-file-alt"></i> Gestión de Tareas</h1>
        </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.html">Dashboard</a>
                <span class="divider"><i class="icon-angle-right"></i></span>
            </li>
            <li class="active"> Tareas</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
     <div class="row-fluid">
        <div class="span6">
             <div class="box box-gray">
                <div class="box-title">
                    <h3><i class="icon-check"></i> Agregar Tarea</h3>
                </div>
                <div class="box-content">
                    <form action="do_agregar_tarea_proyecto.php" class="form-horizontal" id="validation-form" method="post">
                        <div class="control-group">
                        <label class="control-label">Nombre de Proyecto: </label>
                            <div class="controls">
                                <?php
                                    echo '<select class="input-large" name="proyecto" id="proyecto" data-rule-required="true">';

                                    $query = "SELECT id_proyecto, nombre FROM proyectos WHERE estado = 'true' ORDER BY id_proyecto";
                                    conectarBD();

                                    $resultado = pg_query($conexion, $query);

                                    while($row = pg_fetch_array($resultado)) {
                                        echo '<option value="' . $row['id_proyecto'] . '">' . $row['nombre'] . '</option>';
                                    }

                                    echo '</select>';
                                ?>
                            </div>
                        </div>

                        <div class="control-group">
                        <label class="control-label">Cantidad de Horas: </label>
                            <div class="controls">
                                <div class="span12">
                                <input type="text" name="horas" id="horas" class="input-small" data-rule-required="true" data-rule-minlength="3" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="control-group">
                        <label class="control-label"> Creador: </label>
                            <div class="controls">
                                <input type="text" name="creador" id="creador" value="<?php echo $_SESSION['nombre_usuario']; ?>"class="input-small" data-rule-required="true" data-rule-minlength="3" disabled />
                                <input type="hidden" name="id_creador" value="<?php echo $_SESSION['id_usuario']; ?>">                             
                            </div>
                        </div>

                        <div class="control-group">
                        <label class="control-label"> Responsable: </label>
                            <div class="controls">
                                <?php
                                    echo '<select class="input-large" name="responsable" id="responsable" data-rule-required="true">';

                                    $query = "SELECT U.id_usuario, P.nombres || ' ' || P.apellidos as nombrecompleto " .
                                             'FROM Usuarios U, Personas P ' . 
                                             'WHERE U.persona = P.id_persona ' .
                                             'ORDER BY id_persona'; 

                                    conectarBD();
                                    $resultado = pg_query($conexion, $query);

                                    while($row = pg_fetch_array($resultado)) {
                                        echo '<option value="' . $row['id_usuario'] . '">' . $row['nombrecompleto'] . '</option>';
                                    }

                                    echo '</select>';
                                ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Fecha Asignación:</label>
                            <div class="controls">
                                <div class="input-append date date-picker" data-date="2012-02-12" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input name="fecha1" id="fecha1" class="date-picker" size="16" type="text" value="1980-01-01" /><span class="add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Fecha Compromiso:</label>
                            <div class="controls">
                                <div class="input-append date date-picker" data-date="2012-02-12" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input name="fecha2" id="fecha2" class="date-picker" size="16" type="text" value="1980-01-01" /><span class="add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="control-group">
                        <label class="control-label"> Condicion: </label>
                            <div class="controls">
                                <?php
                                    echo '<select class="input-large" name="condicion" id="condicion" data-rule-required="true">';

                                    $query = "SELECT * FROM Condiciones WHERE estado = true ORDER BY id_condicion ASC"; 

                                    conectarBD();
                                    $resultado = pg_query($conexion, $query);

                                    while($row = pg_fetch_array($resultado)) {
                                        echo '<option value="' . $row['id_condicion'] . '">' . $row['nombre'] . '</option>';
                                    }

                                    echo '</select>';
                                ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"> Notas: </label>
                            <div class="controls">
                                <textarea type="text" name="nota" id="nota" class="input-large" data-rule-required="true" data-rule-minlength="3" >
                                </textarea>
                            </div>
                        </div>
                        

                        <div class="control-group">
                            <div class="controls">
                                <label class="checkbox inline">
                                    <input type="checkbox" name="estado" value="true" /> Estado
                                </label>
                            </div>
                        </div>

                        <div class="controls">
                            <button type="submit" class="btn btn-success validation_button"><i class="icon-ok"></i> Guardar</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="box box-gray">
                <div class="box-title">
                    <h3><i class="icon-user"></i> Listado de proyectos detallados</h3>
                </div>
                <div id="contenedor_proyectos_tareas" class="box-content">
                    <?php

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

                                $query = "UPDATE tareas SET estado = " . $variable[0] . " WHERE id_tarea = '" . $variable[1] . "'";
                                                  
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
                        echo '<th style="width: 22%">Nombre</th>';
                        echo '<th style="width: 22%">Empresa</th>';
                        echo '<th style="width: 22%">Creador</th>';
                        echo '<th style="width: 22%">Estado</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '</table>';

                        $query = "SELECT * FROM proyectos ORDER BY id_proyecto ASC";
                        conectarBD();

                        $resultado = pg_query($conexion, $query);

                        $conteo = 0;
                        while($row = pg_fetch_array($resultado)) {
                            $conteo++;

                            echo '<div class="accordion-group">';
                            echo '<div class="accordion-heading">';
                            echo '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#' . $row['id_proyecto'] . '">';
                            
                            //Tabla
                            echo '<table class="table table_personas">';
                            echo '<tbody>';
                            echo '<tr>';
                            echo '<td style="width: 5%"class="hidden-phone hidden-tablet">' . $conteo . '</td>';
                            echo '<td style="width: 22%">' . $row['nombre'] . '</td>';
                            echo '<td style="width: 22%">' . $row['empresa'] . '</td>';
                            echo '<td style="width: 22%">' . $row['creador'] . '</td>';
                            echo '<td style="width: 22%">' . $row['estado'] . '</td>';
                            echo '</tr>';
                            echo '</tbody>';
                            echo '</table>';

                            echo '</a>';
                            echo '</div>';

                            echo '<div id="' . $row['id_proyecto'] . '" class="accordion-body collapse">';
                            echo '<div class="accordion-inner">';
                            
                            $query2 = "SELECT T.id_tarea, " .
                                      "     P.nombre, " . 
                                      "     T.cantidadhoras, " . 
                                      "     (SELECT P.nombres || ' ' || P.apellidos as creador FROM personas P, usuarios U WHERE U.id_usuario = T.creador AND U.persona = P.id_persona ), " . 
                                      "     (SELECT P.nombres || ' ' || P.apellidos as responsable FROM personas P, usuarios U WHERE U.id_usuario = T.responsable  AND U.persona = P.id_persona), " . 
                                      "     P.fechaasignacion, " .
                                      "     P.fechacompromiso, " .
                                      "    C.nombre, " . 
                                      "     T.nota, " .
                                      "     T.estado " .
                                    " FROM tareas T, proyectos P, personas H, condiciones C, usuarios U " .
                                    " WHERE t.condicion = c.id_condicion " .
                                    "  AND t.proyecto = p.id_proyecto " .
                                    "  AND u.persona = h.id_persona " . 
                                    "  AND t.creador = u.id_usuario" . 
                                    "  AND p.id_proyecto = '" . $row['id_proyecto'] ."'" ;

                            $resultado2 = pg_query($conexion, $query2);

                            echo '<table class="table table_personas">';
                            echo '<tbody>';
                            echo '<tr>';

                            if (pg_num_rows($resultado2) == 0) {
                                echo '<td style="width: 60%">Este proyecto no tiene tareas asignadas.</td>';
                            } else {
                                echo '<td style="width: 60%">Listado de Tareas:</td>';
                            }
                            
                            echo '</tr>';
                            echo '</tbody>';
                            echo '</table>';

                            while($row = pg_fetch_array($resultado2)) {
                                //Tabla
                                echo '<table class="table table_personas">';
                                echo '<tbody>';
                                echo '<tr>';
                                echo '<td style="width: 5%">';
                                if ($row['estado'] == 't') {
                                    echo '<input type="checkbox" id="activo_tarea" name="activar_nivel" value="' . $row['id_tarea'] . '" checked="checked"/>';
                                } else {
                                    echo '<input type="checkbox" id="activo_tarea" name="activar_nivel   " value="' . $row['id_tarea'] . '" />';
                                }
                                echo '</td>';
                                echo '<td style="width: 25%">' . $row['id_tarea'] . '</td>';
                                echo '<td style="width: 25%">' . $row['creador'] . '</td>';
                                echo '<td style="width: 25%">' . $row['responsable'] . '</td>';
                                echo '<td style="width: 25%">' . $row['nombre'] . '</td>';
                                echo '<td style="width: 25%">' . $row['nota'] . '</td>';
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
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <!-- END Main Content -->
<?php include 'footer.php' ?>
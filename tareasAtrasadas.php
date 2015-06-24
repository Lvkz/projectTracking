<?php $thisPage = 'tareasAtrasadas'; ?>
<?php $thisGroup = 'reportes'; ?>
<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>

<!-- BEGIN Content -->
<div id="main-content">
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>
            <h1><i class="icon-file-alt"></i> Gestión de Tareas Atrasadas</h1>
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
            <li class="active"> Tareas Atrasadas</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row-fluid">
        <div class="span12">
            <div class="box box-gray">
                <div class="box-title">
                    <h3><i class="icon-file"></i> Ventana</h3>
                </div>
                <div id="lista_proyectos" class="box-content">
                    <?php
                      
                    $query = "SELECT T.id_tarea, ". 
                            " P.nombre, ". 
                            "T.cantidadhoras,". 
                            "(SELECT P.nombres || ' ' || P.apellidos as creador FROM personas P, usuarios U WHERE U.id_usuario = T.creador AND U.persona = P.id_persona ),".
                            "(SELECT P.nombres || ' ' || P.apellidos as responsable FROM personas P, usuarios U WHERE U.id_usuario = T.responsable AND U.persona = P.id_persona), ".
                            "P.fechaasignacion,P.fechacompromiso,C.nombre,T.nota,T.estado ".
                            "FROM tareas T, proyectos P, personas H, condiciones C, usuarios U ".
                            "WHERE t.condicion = c.id_condicion ".
                            "AND t.proyecto = p.id_proyecto ".
                            "AND u.persona = h.id_persona ".
                            "AND t.creador = u.id_usuario ".
                            "AND  t.estado='false'".
                            "AND P.fechacompromiso < '".date('Y-m-d')."'"; 

                    conectarBD();

                    $resultado = pg_exec($conexion, $query);

                     if(pg_num_rows($resultado) == 0){
                      echo 'Actualmente no existen referencias.';
                    } else {
                        echo '<table class="table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th class="hidden-phone hidden-tablet">#</th>';
                        echo '<th>Proyecto</th>';
                        echo '<th>cantidadhora</th>';
                        echo '<th>Creador</th>';
                        echo '<th>Respondable</th>';
                        echo '<th>fecha asignacion</th>';
                        echo '<th>fecha Compromiso</th>';
                        echo '<th>condicion</th>';
                        echo '<th>nota</th>';
                        echo '<th>Estado</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                      
                      $conteo = 1;

                      while ($row = pg_fetch_array($resultado)) {
                        echo '<tr>';
                        echo '<td class="hidden-phone hidden-tablet">' . $conteo++ . '</td>';   
                        echo '<td>' . $row['nombre'] . '</td>';
                        echo '<td>' . $row['cantidadhoras'] . '</td>';
                        echo '<td>' . $row['creador'] . '</td>';
                        echo '<td>' . $row['responsable'] . '</td>';
                        echo '<td>' . $row['fechaasignacion'] . '</td>';
                        echo '<td>' . $row['fechacompromiso'] . '</td>';
                        echo '<td>' . $row['nombre'] . '</td>';
                        echo '<td>' . $row['nota'] . '</td>';
                        echo '<td>' . $row['estado'] . '</td>';
                        echo '</tr>';
                      }
                        echo '</tbody>';
                        echo '</table>';
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
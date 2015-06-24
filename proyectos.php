<?php $thisPage = 'proyectos'; ?>
<?php $thisGroup = 'proyectos'; ?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?> 



<!-- BEGIN Content -->
<div id="main-content">
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>
            <h1><i class="icon-file-alt"></i> Gestión de Proyectos</h1>
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
            <li class="active"> Proyecto</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <!-- BEGIN Main Content -->
    <div class="row-fluid">
        <div class="span4">
             <div class="box box-gray">
                <div class="box-title">
                    <h3><i class="icon-check"></i> Crear Proyecto</h3>
                </div>
    <!--Errores-->
    <?php
    if (isset($_GET['error_bd'])) {$_SESSION['error_bd'] = $_GET['error_bd'];}
    echo '<div id="div_session_write"> </div>';
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
    ?>
    <!--Errores Fin-->
     <div id="" class="box-content">
    <form action="do_crear_proyecto.php"  id="validation-form" method="post" >
    <div class="control-group">
    <label class="control-label" for="nombres">Nombres:</label>
    <div class="controls">
    <div class="span12">
    <input type="text" name="nombres" id="nombres" class="input-xlarge" data-rule-required="true" data-rule-minlength="3" />
    </div>
    </div>
     </div>
     <div class="control-group">
    <label for="select" class="control-label">Empresa</label>
    <div class="controls">
    <select class="input-xlarge" name="Empresa" id="Empresa" data-rule-required="true">
    <?php
     
    $query = "SELECT id_empresa, nombre FROM empresas order by id_empresa";
    conectarBD();

    $resultado = pg_query($conexion, $query);

    while($row = pg_fetch_array($resultado)) {
        echo '<option value="' . $row['id_empresa'] . '">' . $row['nombre'] . '</option>';
    } 
    ?>
    </select>
    </div>
    </div>
     <div class="control-group">
    <label for="select" class="control-label">Creador</label>
    <div class="controls">
    <select class="input-xlarge" name="Creador" id="Creador" data-rule-required="true">
    <?php
     
    $query = "SELECT U.id_usuario, nombres || ' ' || apellidos AS nombrecompleto ". 
            'FROM personas P, nivelesusuarios N, Usuarios U '.
            'WHERE P.id_persona = U.persona '.
            'AND N.numeronivel = U.nivel '.
            'AND U.nivel >= 9 '. 
            'ORDER BY id_persona';
    conectarBD();

    $resultado = pg_query($conexion, $query);

    while($row = pg_fetch_array($resultado)) {
        echo '<option value="' . $row['id_usuario'] . '">' . $row['nombrecompleto'] . '</option>';
    } 
    ?>
    </select>
    </div>
    </div>
     <div class="control-group">
     <label class="control-label">Fecha de asignacion</label>
     <div class="controls">
     <div class="input-append date date-picker" data-date="12-02-2012" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
     <input name="fecha1" id="fecha1" class="date-picker" size="16" type="text" value="1980-01-01" /><span class="add-on"><i class="icon-calendar"></i></span>
     </div>
     </div>
     </div>
     <div class="control-group">
     <label class="control-label">Fecha de compromiso</label>
     <div class="controls">
     <div class="input-append date date-picker" data-date="12-02-2012" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
     <input name="fecha2" id="fecha2" class="date-picker" size="16" type="text" value="1980-01-01" /><span class="add-on"><i class="icon-calendar"></i></span>
     </div>
     </div>
     </div>
     <div class="control-group">
     <div class="controls">
     <label class="checkbox inline">
     <input type="checkbox" name="estado" value="true" /> Estado
     </label>
     </div>
     </div>
     <div class="form-actions">
     <input type="submit" class="btn btn-primary" value="Agregar">
      <button type="button" class="btn">&nbspCancel&nbsp</button>
     </div>
     </form>
     </div>
    
            </div>
        </div>
        <div class="span7">
            <div class="box box-gray">
                <div class="box-title">
                    <h3><i class="icon-user"></i> Listado de Proyectos</h3>
                </div>
                <div id="lista_proyectos" class="box-content">
                    <?php
                    $query = "SELECT P.nombre as nom1, E.nombre as nom2, H.nombres || ' ' || H.apellidos as nombres,".
                    ' P.fechaasignacion as fecha, P.fechacompromiso as fecha2, P.estado as estado '.
                    'FROM proyectos P, empresas E, usuarios U, personas H '.
                    'WHERE P.empresa = E.id_empresa '.
                    'AND P.creador = U.id_usuario '.
                    'AND U.persona = H.id_persona ;'; 

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
                        echo '<th>Empresa</th>';
                        echo '<th>Creador</th>';
                        echo '<th>Fecha de asignacion</th>';
                        echo '<th>Fecha de compromiso</th>';
                        echo '<th>Estado</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                      
                      $conteo = 1;

                      while ($row = pg_fetch_array($resultado)) {
                        echo '<tr>';
                        echo '<td class="hidden-phone hidden-tablet">' . $conteo++ . '</td>';   
                        echo '<td>' . $row['nom1'] . '</td>';
                        echo '<td>' . $row['nom2'] . '</td>';
                        echo '<td>' . $row['nombres'] . '</td>';
                        echo '<td>' . $row['fecha'] . '</td>';
                        echo '<td>' . $row['fecha2'] . '</td>';
                        echo '<td>';
                        if ($row['estado'] == 't') {
                            echo '<input type="checkbox" id="activo_usuario" name="activar_nivel" value="' . $row['nom1'] . '" checked="checked"/>';
                        } else {
                            echo '<input type="checkbox" id="activo_usuario" name="activar_nivel   " value="' . $row['nom1'] . '" />';
                        }
                         echo '</td>';
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
<?php $thisPage = 'mantenimientos'; ?>
<?php $thisGroup = 'none'; ?>
<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>

<!-- BEGIN Content -->
<div id="main-content">
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>
            <h1><i class="icon-file-alt"></i> Gestión Mantenimiento</h1>
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
            <li class="active"> Mantenimientos</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row-fluid">
        <div class="span4">
            <div class="box box-gray">
                <div class="box-title">
                    <h3><i class="icon-check"></i> Tipos Mantenimientos</h3>
                </div>
                <div class="box-content">
                    <ul class="todo-list">
                        <li>
                            <div class="todo">
                                <p id="agregar_nivel" class="lista_agregar">Agregar Niveles</p>
                            </div>
                        </li>
                        <li>
                            <div class="todo">
                                <p id="agregar_referencia" class="lista_agregar">Agregar Referencia</p>
                            </div>
                        </li>
                        <li>
                            <div class="todo">
                                <p id="agregar_contacto" class="lista_agregar">Agregar Tipo Contacto  </p>
                            </div>
                        </li>
                        <li>
                            <div class="todo">
                                <p id="agregar_condicion" class="lista_agregar">Agregar Condicion  </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="span8">
            <div class="box box-gray">
                <div class="box-title">
                    <h3><i class="icon-file"></i> Detalle de Módulo</h3>
                </div>
                <div id="ingresar_mantenimiento" class="box-content">
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
                    ?>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <!-- END Main Content -->
<?php include 'footer.php' ?>
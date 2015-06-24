<?php $thisPage = 'usuarios'; ?>
<?php $thisGroup = 'entidades'; ?>
<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>

<!-- BEGIN Content -->
<div id="main-content">
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>
            <h1><i class="icon-file-alt"></i> Gestión de Usuarios</h1>
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
            <li class="active"> Usuarios</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row-fluid">
        <div class="span4">
             <div class="box box-gray">
                <div class="box-title">
                    <h3><i class="icon-check"></i> Menú Usuarios</h3>
                </div>
                <div class="box-content">
                 <ul class="todo-list">
                    <li>
                        <div class="todo">
                            <p id="agregar_usuario" class="lista_agregar">Agregar Usuario</p>
                        </div>
                    </li>
                    <li>
                        <div class="todo">
                            <p id="ver_usuario" class="lista_agregar">Ver Usuarios</p>
                        </div>
                    </li>
                    <li>
                        <div class="todo">
                            <p id="modificar_usuario" class="lista_agregar">Modificar Usuarios</p>
                        </div>
                    </li>
                </ul>
            </div>
            </div>
        </div>
        <div class="span8">
            <div class="box box-gray">
                <div class="box-title">
                    <h3><i class="icon-user"></i> Detalle Usuario</h3>
                </div>
                <div id="contenedor_usuarios" class="box-content">
                    
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <!-- END Main Content -->
<?php include 'footer.php' ?>
<?php $thisPage = 'dashboard'; ?>
<?php $thisGroup = 'none'; ?>
<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>

<!-- BEGIN Content -->
<div id="main-content">
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>
            <h1><i class="icon-file-alt"></i> ¡Bienvenid@!</h1>
            <h4>¡Hola! Bienvenido al gestor de proyectos de Aguacat.</h4>
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
            <li class="active">¡Mensaje de Bienvenida!</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row-fluid">
        <div class="span12">
            <div class="box box-gray">
                <div class="box-title">
                    <h3><i class="icon-file"></i> Hola, <?php echo $_SESSION['nombre_usuario']; ?></h3>
                    <div class="box-tool">
                        <a data-action="close" href="#"><i class="icon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <?php 
                        if (isset($_SESSION['error_change_password']) && ($_SESSION['error_change_password'] == true)) {
                            echo '<div class="alert alert-error">';
                            echo '<button class="close" data-dismiss="alert">&times;</button>';
                            echo '<strong>¡Error!</strong> No se ha podido procesar la solicitud. (Error: '. $_SESSION['msg_change_password'] .').';
                            echo '</div>';

                            $_SESSION['error_change_password'] = false;
                        }

                        if (isset($_SESSION['msg_change_password']) && ($_SESSION['update_successful'] == true) && ($_SESSION['error_change_password'] == false)) {
                            echo '<div class="alert alert-info">';
                            echo '<button class="close" data-dismiss="alert">&times;</button>';
                            echo '<strong>¡Información Procesada!</strong> '. $_SESSION['msg_change_password'];
                            echo '</div>';

                            $_SESSION['update_successful'] = false;
                        }
                    ?>
                    <p>Bienvenido al sistema de gestión de proyectos de aguacate. PAR DE IMAGENES Y MÁS TEXTO.</p>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <!-- END Main Content -->
<?php include 'footer.php' ?>
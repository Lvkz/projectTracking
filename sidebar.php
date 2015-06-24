<!-- BEGIN Container -->
<div class="container-fluid sidebar-green" id="main-container">
<!-- BEGIN Sidebar -->
<div id="sidebar" class="nav-collapse sidebar-fixed">
    <!-- BEGIN Navlist -->
    <ul class="nav nav-list">
        <!-- BEGIN Search Form -->
        <?php
        if($_SESSION['nivel_usuario']==10)
        {
            echo"<li>
            <form target='#'' method='GET' class='search-form'>
                <span class='search-pan'>
                    
                </span>
            </form>
        </li>
       

        
        <li ";if ($thisGroup == 'entidades') { echo 'class="active"'; }echo" >
            <a href='#' class='dropdown-toggle'>
                <i class='icon-edit'></i>
                <span>Crear Entidades</span>
                <b class='arrow icon-angle-right'></b>
            </a>
            <ul class='submenu'>
                <li ";
                if ($thisPage == 'personas') { echo ' class="active"'; }
                echo" ><a href='personas.php'>Personas</a></li>
                <li ";if ($thisPage == 'empresas') { echo ' class="active"'; }echo" ><a href='empresas.php'>Empresas</a></li>
                <li ";if ($thisPage == 'usuarios') { echo ' class="active"'; }echo" ><a href='usuarios.php'>Usuarios</a></li>
            </ul>
          
        </li>

        <li ";if ($thisGroup == 'proyectos') { echo ' class="active"'; }echo" >
            <a href='#' class='dropdown-toggle'>
                <i class='icon-list'></i>
                <span>Proyectos</span>
                <b class='arrow icon-angle-right'></b>
            </a>

            
            <ul class='submenu'>
                <li ";if ($thisPage == 'proyectos') { echo ' class="active"'; }echo" ><a href='proyectos.php'>Crear Proyecto</a></li>
                <li ";if ($thisPage == 'tareas') { echo ' class="active"'; }echo" ><a href='tareas.php'>Crear Tarea</a></li>
            </ul>
            
        </li>

        <li ";if ($thisGroup == 'reportes') { echo ' class="active"'; }echo" >
            <a href='#' class='dropdown-toggle'>
                <i class='icon-screenshot'></i>
                <span>Reportes</span>
                <b class='arrow icon-angle-right'></b>
            </a>

            
            <ul class='submenu'>
                <li ";if ($thisPage == 'tareasTerminadas') { echo ' class="active"'; }echo" ><a href='tareasTerminadas.php'>Tareas Terminadas</a></li>
                <li ";if ($thisPage == 'tareasPendientes') { echo ' class="active"'; }echo" ><a href='tareasPendientes.php'>Tareas Pendientes</a></li>
                <li ";if ($thisPage == 'tareasAtrasadas') { echo ' class="active"'; }echo" ><a href='tareasAtrasadas.php'>Tareas Atrasadas</a></li>
            </ul>
            
        </li>

        <li ";if ($thisPage == 'mantenimientos') { echo ' class="active"'; }echo" >
            <a href='mantenimientos.php'>
                <i class='icon-dashboard'></i>
                <span>Mantenimientos</span>
            </a>
        </li>
    </ul>";
        }
    else if($_SESSION['nivel_usuario']==8)
    {

          echo"<li>
            <form target='#'' method='GET' class='search-form'>
                <span class='search-pan'>
                    
                </span>
            </form>
        </li>
       

        
       

        <li ";if ($thisGroup == 'proyectos') { echo ' class="active"'; }echo" >
            <a href='#' class='dropdown-toggle'>
                <i class='icon-list'></i>
                <span>Proyectos</span>
                <b class='arrow icon-angle-right'></b>
            </a>

            
            <ul class='submenu'>
               
                <li ";if ($thisPage == 'tareas') { echo ' class="active"'; }echo" ><a href='tareas.php'>Crear Tarea</a></li>
            </ul>
            
        </li>

        <li ";if ($thisGroup == 'reportes') { echo ' class="active"'; }echo" >
            <a href='#' class='dropdown-toggle'>
                <i class='icon-screenshot'></i>
                <span>Reportes</span>
                <b class='arrow icon-angle-right'></b>
            </a>

            
            <ul class='submenu'>
                <li ";if ($thisPage == 'tareasTerminadas') { echo ' class="active"'; }echo" ><a href='tareasTerminadas.php'>Tareas Terminadas</a></li>
                <li ";if ($thisPage == 'tareasPendientes') { echo ' class="active"'; }echo" ><a href='tareasPendientes.php'>Tareas Pendientes</a></li>
                <li ";if ($thisPage == 'tareasAtrasadas') { echo ' class="active"'; }echo" ><a href='tareasAtrasadas.php'>Tareas Atrasadas</a></li>
            </ul>
            
        </li>

    </ul>";
    } else if($_SESSION['nivel_usuario']==9)
    {
        echo"<li>
            <form target='#'' method='GET' class='search-form'>
                <span class='search-pan'>
                    
                </span>
            </form>
        </li>

        <li ";if ($thisGroup == 'proyectos') { echo ' class="active"'; }echo" >
            <a href='#' class='dropdown-toggle'>
                <i class='icon-list'></i>
                <span>Proyectos</span>
                <b class='arrow icon-angle-right'></b>
            </a>

          
            <ul class='submenu'>
                <li ";if ($thisPage == 'proyectos') { echo ' class="active"'; }echo" ><a href='proyectos.php'>Crear Proyecto</a></li>
                <li ";if ($thisPage == 'tareas') { echo ' class="active"'; }echo" ><a href='tareas.php'>Crear Tarea</a></li>
            </ul>
          
        </li>

        <li ";if ($thisGroup == 'reportes') { echo ' class="active"'; }echo" >
            <a href='#' class='dropdown-toggle'>
                <i class='icon-screenshot'></i>
                <span>Reportes</span>
                <b class='arrow icon-angle-right'></b>
            </a>

            
            <ul class='submenu'>
                <li ";if ($thisPage == 'tareasTerminadas') { echo ' class="active"'; }echo" ><a href='tareasTerminadas.php'>Tareas Terminadas</a></li>
                <li ";if ($thisPage == 'tareasPendientes') { echo ' class="active"'; }echo" ><a href='tareasPendientes.php'>Tareas Pendientes</a></li>
                <li ";if ($thisPage == 'tareasAtrasadas') { echo ' class="active"'; }echo" ><a href='tareasAtrasadas.php'>Tareas Atrasadas</a></li>
            </ul>
            
        </li>

        <li ";if ($thisPage == 'mantenimientos') { echo ' class="active"'; }echo" >
            <a href='mantenimientos.php'>
                <i class='icon-dashboard'></i>
                <span>Mantenimientos</span>
            </a>
        </li>
    </ul>";
    }
    else if($_SESSION['nivel_usuario']==1)
    {
        echo"<li ";if ($thisGroup == 'proyectos') { echo ' class="active"'; }echo" >
            <a href='#' class='dropdown-toggle'>
                <i class='icon-list'></i>
                <span>Proyectos</span>
                <b class='arrow icon-angle-right'></b>
            </a>

            
            <ul class='submenu'>
            
                <li ";if ($thisPage == 'tareas') { echo ' class="active"'; }echo" ><a href='tareas.php'>Crear Tarea</a></li>
            </ul>
            
        </li>
        </ul>";
    }   
     ?>   
    <!-- END Navlist -->

    <!-- BEGIN Sidebar Collapse Button -->
    <div id="sidebar-collapse" class="visible-desktop">
        <i class="icon-double-angle-left"></i>
    </div>
    <!-- END Sidebar Collapse Button -->
</div>
<!-- END Sidebar -->
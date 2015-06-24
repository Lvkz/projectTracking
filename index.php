<?php 
    session_start();
    error_reporting(-1);
    ini_set('display_errors', 'On');

    //Reviso si hay una conexión activa
    
    if(isset($_SESSION['usuario'])){
        header('Location: dashboard.php');
    } else {
        header('Location: login.php');
    }
?>
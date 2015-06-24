<?php
error_reporting(-1);
ini_set('display_errors', 'On');

function conectarBD(){
    $user = 'Lvkz';
    $pass = '.L,vkaz3natoR';
    $db = 'gestorproyectos';
        $port = '5432'; //'5432';
        $host = 'localhost';
        $connectionString = 'host=' . $host . ' port=' . $port . ' dbname=' . $db . ' user=' . $user . ' password=' . $pass;

        global $conexion;

        $conexion = pg_connect($connectionString)
        or die("Connection ERROR: " . pg_last_error());
    }
    ?>

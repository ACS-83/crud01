<?php
    require '../vendor/autoload.php';
    use Clases\Datos;
    $usu = new Datos('users', 50);
    echo "<h2>Usuarios creados</h2>";
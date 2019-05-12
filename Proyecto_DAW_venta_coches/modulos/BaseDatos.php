<?php
define("DB_USUARIO", "root");
define("DB_PASS", "");
define("DB_HOST", "localhost");
define("DB_NOMBRE_BASE_DATOS", "coches-turon");

function usuarioEsCorrecto($nick, $contrasena){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if($conexion->connect_error){
        die("La conexion ha fallado" . $conexion->connect_error);
    }
    $sql = "select contrasena from usuarios where nick like '$nick'";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    if($resultado->fetch_row()[0] == $contrasena){
        $sentencia->close();
        $conexion->close();
        return true;
    }
    $sentencia->close();
    $conexion->close();
    return false;
}


function guardarItemCarritoBBDD($nick, $referencia, $cantidadItems){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if ($conexion->connect_error) {
        die("La conexión ha fallado " . $conexion->connect_error);
    }
    $sql = "INSERT INTO carrito (nick, referencia, cantidad) VALUES (?, ?, ?)";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bind_param('ssi', $nick, $referencia, $cantidadItems);
    $sentencia->execute();
    $sentencia->close();
    $conexion->close();
}
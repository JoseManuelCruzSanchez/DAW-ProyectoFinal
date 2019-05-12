<?php
$imagenes = $_FILES['img'];

$ruta_directorio = '../fotos-coches/' . date('Y-m-d') . ' ' . $_POST['marca'];
crear_directorio($ruta_directorio);

guardar_varios_archivos($imagenes, $ruta_directorio);

function crear_directorio($nombre_directorio){
    if(!is_dir($nombre_directorio)){
        mkdir($nombre_directorio);
    }
}
// $array_files = $_FILES['nombre input']
function guardar_varios_archivos($array_files, $ruta_donde_guardarlos){
    for($i = 0; $i < count($array_files['name']); $i++){
        $nombre_archivo = date('Y-m-d') . '--' . $array_files['name'][$i];
        move_uploaded_file($array_files['tmp_name'][$i], $ruta_donde_guardarlos . '/' . $nombre_archivo);
    }
}

echo '<div>Un nuevo coche se ha guardado en la Base de Datos.</div>';
echo '<a href="../subir-coche.html">Ir a subir un nuevo coche</a>';
<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mi_base_de_datos');

/* Intentar conectar a la base de datos MySQL */
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificar la conexión
if($conn->connect_errno){
    die("ERROR: No se pudo conectar. " . $conn->connect_error);
}
?>


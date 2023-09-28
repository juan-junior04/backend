<?php
Class Conectar{
   public function con(){

    $host = 'localhost'; // Cambia esto a la dirección de tu servidor MySQL
    $dbname = 'calendario'; // Nombre de tu base de datos
    $username = 'juanda'; // Nombre de usuario de MySQL
    $password = ''; // Contraseña de MySQL
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        return "Error de conexión a la base de datos: " . $e->getMessage();
    }
   }
}




?>
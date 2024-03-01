
<?php

$host = 'localhost'; // Update MySQL host
$database = 'cars'; // Update database name
$username = 'root'; // Update MySQL username
$password = 'Vnc09074675107'; // Update MySQL password

try {
    $connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    echo "Connected to the database successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>

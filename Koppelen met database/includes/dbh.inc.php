<?php

$dsn = "mysql:host=localhost;dbname=myfirstdatabase";
$dbusername = "root"; //
$dbpassword = "";

try {
    // Maak verbinding met de database
    $pdo = new PDO($dsn, $dbusername, $dbpassword);

    // Stel de foutmodus in op uitzonderingen (exceptions)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Als de verbinding niet lukt, toon dan de foutmelding
    echo "Connection failed: " . $e->getMessage();
}



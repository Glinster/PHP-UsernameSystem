<?php
// Controleer of het formulier is verzonden met de POST-methode
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verkrijg de ingevulde gegevens uit het formulier
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        // Verbind met de database
        require_once "dbh.inc.php";
       

        // De SQL-query om gegevens toe te voegen aan de gebruikersdatabase
        $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";

        // Bereid de query voor
        $stmt = $pdo->prepare($query);

        // Bind parameters met de juiste variabelen
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $pwd);
        $stmt->bindParam(":email", $email);

        // Voer de query uit
        $stmt->execute();

        // Sluit de databaseverbinding en de statement
        $pdo = null;
        $stmt = null;

        // Redirect naar de indexpagina na succesvolle invoer
        header("Location: ../index.php");
        die(); // Stop verdere uitvoering van de code

    } catch (PDOException $e) {
        // Als er een fout optreedt, toon een foutmelding
        die("Query failed: " . $e->getMessage());
    }
} else {
    // Als het formulier niet is verzonden, redirect terug naar de indexpagina
    header("Location: ../index.php");
   
}

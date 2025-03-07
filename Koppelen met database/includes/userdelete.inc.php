<?php
// Controleer of het formulier is verzonden met de POST-methode
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verkrijg de ingevulde gegevens uit het formulier
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        // Verbind met de database
        require_once "dbh.inc.php";

        // De SQL-query om gegevens te verwijderen
        $query = "DELETE FROM users WHERE username = :username AND pwd = :pwd";

        // Bereid de query voor en voer deze uit
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $pwd);

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

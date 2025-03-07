<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verkrijg de ingevulde gegevens
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];
    

    try {
        require_once "dbh.inc.php";

        // SQL-query
        $query = "UPDATE users SET username = :username, pwd = :pwd, email = :email WHERE id = 19;";

        // Debugging (comment uit na controle)
        $stmt = $pdo->prepare($query);
        // Bind parameters
       
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $pwd);
        $stmt->bindParam(":email", $email);
       
 

        // Voer query uit
        $stmt->execute();

        $pdo= null;
        $stmt= null;

        header("Location: ../index.php");


    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");

    exit;
}

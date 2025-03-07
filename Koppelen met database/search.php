<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verkrijg de ingevulde gegevens uit het formulier
    $userSearch = $_POST["usersearch"];


    try {
        // Verbind met de database
        require_once "includes/dbh.inc.php";

        // De SQL-query om gegevens op te halen uit de gebruikersdatabase
        $query = "SELECT * FROM comments WHERE username = :usersearch";

        // Bereid de query voor
        $stmt = $pdo->prepare($query);

        // Bind parameters met de juiste variabelen
        $stmt->bindParam(":usersearch", $userSearch);

        // Voer de query uit
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Sluit de verbinding
        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
   
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Search Results</title>
</head>
<body>
<section>
<h3>Search results:</h3>

<?php

if (empty($results)) {
    echo "<div>";
    echo "<p>There were no results!</p>";
    echo "</div>";
} else { 
    foreach ($results as $row) {
        echo "<div>";
        echo "<h4>" . htmlspecialchars($row["username"]) . "</h4>";
        echo "<p>" . htmlspecialchars($row["comment_text"]) . "</p>";
        echo "<p>" . htmlspecialchars($row["created_at"]) . "</p>";
        echo "</div>";
    }
}
?>

</section>

</body>
</html>

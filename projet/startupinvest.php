<?php
// Traitement PHP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $servername = 'localhost';
    $username = 'root';
    $password = ''; // Mettez ici votre mot de passe si nécessaire
    $dbname = 'startupinvest';

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérification si le startuper existe dans la base de données
        $pseudo = $_POST['pseudo'];
        $pass = $_POST['pass'];
        $stmt = $conn->prepare("SELECT * FROM startuper WHERE pseudo = :pseudo");
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Le startuper existe dans la base de données
            echo "<div class='message'>Le pseudo existe dans la base de données.</div>";
        } else {
            // Le startuper n'existe pas dans la base de données
            echo "<div class='message'>Le pseudo n'existe pas dans la base de données.</div>";
        }
    } catch(PDOException $e) {
        // Erreur lors de la connexion à la base de données
        echo "<div class='message'>Erreur : " . $e->getMessage() . "</div>";
    }
}
?>

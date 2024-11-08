<?php
include("connexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nbactacht'])) {
    $nbactions = $_POST['nbactacht'];
    $id_projet = $_SESSION['resultat']['id_projet'];
    try {
        $stmt = $conn->prepare("SELECT nombre_actions_a_vendre FROM projet WHERE id_projet = :id_projet");
        $stmt->bindParam(':id_projet', $id_projet);
        $stmt->execute();
        $resultat = $stmt->fetchColumn();
        if ($resultat < $nbactions) {
            echo "<div id='nbactachterr'>veuillez saisir un nombre inférieur !!</div>";
        } else {
            echo "<script>showConfirmation();</script>";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<?php
session_start();
include('connexion.php');

if (isset($_SESSION['idCapital']) && isset($_POST['nbactacht']) && isset($_SESSION['resultat']['id_projet'])) {
    $id_projet = $_SESSION['resultat']['id_projet'];
    $nb_actions_achetees = $_POST['nbactacht'];
    $id_capital = $_SESSION['idCapital'];
    
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM capital_risque_projet WHERE id_capital_risque = :id_capital AND id_projet = :id_projet");
        $stmt->bindParam(':id_capital', $id_capital);
        $stmt->bindParam(':id_projet', $id_projet);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $stmt = $conn->prepare("UPDATE capital_risque_projet SET nombre_actions_achetees = nombre_actions_achetees + :nb_actions_achetees 
            WHERE id_capital_risque = :id_capital AND id_projet = :id_projet");
     
        } else {
            $stmt = $conn->prepare("INSERT INTO capital_risque_projet (id_projet, nombre_actions_achetees, id_capital_risque)
             VALUES (:id_projet, :nb_actions_achetees, :id_capital)");
        }

        $stmt->bindParam(':id_projet', $id_projet);
        $stmt->bindParam(':nb_actions_achetees', $nb_actions_achetees);
        $stmt->bindParam(':id_capital', $id_capital);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE projet SET nombre_actions_a_vendre = nombre_actions_a_vendre - :nb_actions_achetees WHERE id_projet = :id_projet");
        $stmt->bindParam(':id_projet', $id_projet);
        $stmt->bindParam(':nb_actions_achetees', $nb_actions_achetees);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE projet SET nombre_actions_vendues = nombre_actions_vendues + :nb_actions_achetees WHERE id_projet = :id_projet");
        $stmt->bindParam(':id_projet', $id_projet);
        $stmt->bindParam(':nb_actions_achetees', $nb_actions_achetees);
        $stmt->execute();

        echo "Le nombre d'actions vendues pour le projet a été mis à jour avec succès.";
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    $conn = null;
} else {
    echo "Erreur : méthode de requête invalide ou données manquantes.";
}
?>

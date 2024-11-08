<?php
        session_start();
        include("connexion.php");

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['projet'])) {
            $id_projet = $_POST['projet'];
            echo "<hr><h2>Le Projet Souhaité:</h2><br><div class='col-md-6 center-table'>";

            try {
                $stmt = $conn->prepare("SELECT * FROM projet WHERE id_projet = :id_projet");
                $stmt->bindParam(':id_projet', $id_projet);
                $stmt->execute();

                $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['resultat'] = $resultat;
                $_SESSION['idProjet'] = $resultat['id_projet'];
                echo "<caption><center>Le Projet Souhaité</center></caption>";
                echo "<table class='table table-bordered'>";
                echo "<tr><th>Titre</th><th>Description</th><th>Nombre D'actions Disponible</th><th>Prix De l'action</th></tr>";
                echo "<tr><td>{$resultat['titre']}</td><td>{$resultat['description']}</td><td>{$resultat['nombre_actions_a_vendre']}</td><td>{$resultat['prix_action']}</td></tr>";
                echo "</table>";
                echo "</div>";
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }
        ?>
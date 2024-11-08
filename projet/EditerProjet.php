<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="investstart.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 center-table">
                <?php
                session_start();
                include("connexion.php");
                $idS=  $_SESSION['idStartuper'];
                try {
                    $sth = $conn->prepare("SELECT id_projet, titre FROM projet WHERE id_startuper=:id");
                    $sth->bindParam(':id', $idS);
                    $sth->execute();
                    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
                    $str = "<caption><center>Liste De Vos Projets</center></caption>";
                    $str .= "<table class='table table-bordered'>";
                    $str .= "<tr><th>ID Projet</th><th>Titre</th></tr>";
                    foreach ($resultat as $projet) {
                        $str .= "<tr><td>{$projet['id_projet']}</td><td>{$projet['titre']}</td></tr>";
                    }
                    $str .= "</table>";
                    echo $str;
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
                ?>
            </div>
        <div class="select-wrapper">
    <form action="" method="post" id="form1">
        <caption>Choisissez l'ID Du Projet Souhaité</caption><br>
        <select name='projet' class='form-select' id="projetSelect">
            <?php
            foreach ($resultat as $projet) {
                echo "<option value='" . $projet["id_projet"] . "'>" . $projet["id_projet"] . "</option>";
            }
            ?>
        </select>
        <br>
        <center><button class="btn btn-primary" type="submit">Editer</button></center>
    </form>
</div>
        <div>
            <form id="form2">
                            <?php
                include("connexion.php");

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['projet'])) {
                    $id_projet = $_POST['projet'];
                    echo "<hr>";
                    echo "<h2><center>Le Projet Souhaité:</center></h2>";
                    echo "<br>";
                    echo "<div class='col-md-6 center-table'>";

                    try {
                        $stmt = $conn->prepare("SELECT * FROM projet WHERE id_projet = :id_projet");
                        $stmt->bindParam(':id_projet', $id_projet);
                        $stmt->execute();
                        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['resultat'] = $resultat;
                        $_SESSION['idProjet'] = $resultat['id_projet'];
                        $total=$resultat['nombre_actions_vendues']*$resultat['prix_action'];
                        echo "<table class='table table-bordered'>";
                        echo "<tr><th>Titre</th><th>Description</th><th>Nombre D'actions à Vendre</th><th>Nombre D'actions Vendues</th><th>Prix De l'action</th><th>Montant Collecté</th></tr>";
                        echo "<tr><td>{$resultat['titre']}</td><td>{$resultat['description']}</td><td>{$resultat['nombre_actions_a_vendre']}</td><td>{$resultat['nombre_actions_vendues']}</td><td>{$resultat['prix_action']}</td><td>{$total}</td></tr>";
                        echo "</table>";
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                }
                ?>
            </div>
            </form>
 


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+"></script>
</body>
</html>



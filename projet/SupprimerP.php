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
                    $sth = $conn->prepare("SELECT id_projet, titre FROM projet WHERE id_startuper=:id AND nombre_actions_vendues=0");
                    $sth->bindParam(':id', $idS);
                    $sth->execute();
                    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
                    $str = "<caption><center>Liste Des Projets Non Financés</center></caption>";
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
        <caption>Choisissez l'ID Du Projet à Supprimer</caption><br>
        <select name='projet' class='form-select' id="projetSelect">
            <?php
            foreach ($resultat as $projet) {
                echo "<option value='" . $projet["id_projet"] . "'>" . $projet["id_projet"] . "</option>";
            }
            ?>
        </select>
        <br>
        <center><button class="btn btn-primary" type="submit">Supprimer</button></center>
    </form>
</div>
        <div>
            <form id="form2">
                            <?php
                include("connexion.php");

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['projet'])) {
                    $id_projet = $_POST['projet'];

                    try {
                        $stmt = $conn->prepare("DELETE FROM projet WHERE id_projet = :id_projet");
                        $stmt->bindParam(':id_projet', $id_projet);
                        $stmt->execute();
                     echo "<div id='message'><center>Le projet a été Supprimer définitivement</center></div>";
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                }
                ?>
            </div>
            </form>
 



</body>
</html>



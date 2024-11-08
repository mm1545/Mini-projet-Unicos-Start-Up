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
    <h1 id="titreinvest">ESPACE CAPITAL RISQUE</h1>
    <nav>
        <ul>
            <li><a href="investsearch.php">Chercher Un Projet Spécifique</a></li>
            <li><a href="projetsFinancés.php">Lister Les projets Financés Par Vous</a></li>
        </ul>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-6 center-table">
                <?php
                include("connexion.php");
                try {
                    $sth = $conn->prepare("SELECT id_projet, titre FROM projet WHERE nombre_actions_a_vendre > 0");
                    $sth->execute();
                    $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
                    $str = "<caption><center class='caption'>Liste Des Projets Disponibles</center></caption>";
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
    <style>
           .caption {
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ;
            color:slateblue;
            font-size: 20px;
            text-align: center;
        }
    </style>
    <form action='' id='form2'>
        <?php
        session_start();
        include("connexion.php");

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['projet'])) {
            $id_projet = $_POST['projet'];
            echo "<hr><div class='col-md-6 center-table'>";

            try {
                $stmt = $conn->prepare("SELECT * FROM projet WHERE id_projet = :id_projet");
                $stmt->bindParam(':id_projet', $id_projet);
                $stmt->execute();

                $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['resultat'] = $resultat;
                $_SESSION['idProjet'] = $resultat['id_projet'];
                echo "<center  class='caption'><caption>Le Projet Souhaité:</caption></center>";
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
        <div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['projet'])) {
        echo '<center><button class="btn btn-primary" type="button" id="suivreAchat">Suivre Achat</button></center>';
    }
    ?>
</div>
    </form>
</div>
<div>
    <hr>
    <form action='insererprojetcapital.php' method='POST' id='form3' style='display:none;'>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['projet'])) {
            echo"
                <div  class='form-group'>
                    <h2 class='caption'>Acheter Des Actions</h2>
                    <label  for='nbactacht'>Saisir le nombre d'actions à acheter:</label>
                    <input type='number' id='nbactacht' name='nbactacht' class='form-control'>
                    <br>
                    <center><button id='confirmachat' class='btn btn-primary' type='button'>Acheter</button></center>
                </div>
                <br>";
        }
        ?>
    </form>
</div>

</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="fermer()"></button>
            </div>
            <div class="modal-body">
                Vous voulez vraiment faire cet achat ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="erreurbouton" data-bs-dismiss="modal">Non</button>
                <form  action="insererprojetcapital.php" method="POST">
                    <input type="hidden" id="nbactacht_hidden" name="nbactacht" value="">
                    <button type="submit" class="btn btn-primary" id="confirmAchatButton" onclick="setNbActions()">Oui</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div>
<center><button id='logout' class='btn btn-primary' type='button' >Log Out</button></center>
</div>
        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
document.getElementById('suivreAchat').addEventListener('click', function() {
    document.getElementById('form3').style.display = 'block';
});

document.getElementById('confirmachat').addEventListener('click', checkActions);

function submitForm() {
    document.getElementById('form3').submit(); 
}

function showConfirmation() {
    var confirmationModal = document.getElementById('confirmationModal');
    confirmationModal.classList.add('show');
    confirmationModal.style.display = 'block';
}

function checkActions() {
    var nbActions = parseInt(document.getElementById('nbactacht').value);
    var availableActions = <?php echo $_SESSION['resultat']['nombre_actions_a_vendre']; ?>;
    
    if (nbActions <= 0 || isNaN(nbActions)) {
        alert("Veuillez saisir un nombre valide d'actions.");
    } else if (nbActions > availableActions) {
        document.getElementById('confirmationModalLabel').innerText = "Erreur";
        document.querySelector('.modal-body').innerText = "Le nombre d'actions que vous souhaitez acheter est supérieur au nombre d'actions disponibles.";
        document.getElementById('confirmAchatButton').style.display = 'none';
        document.getElementById('erreurbouton').style.display = 'block';

        showConfirmation();
    } else {
        document.getElementById('confirmationModalLabel').innerText = "Confirmation";
        document.querySelector('.modal-body').innerText = "Vous voulez vraiment faire cet achat ?";
        document.getElementById('confirmAchatButton').style.display = 'block';
        showConfirmation();
    }
}

document.getElementById('confirmAchatButton').addEventListener('click', function() {
    submitForm();
});

function setNbActions() {
    var nbActions = parseInt(document.getElementById('nbactacht').value);
    var nbactacht_hidden = document.getElementById('nbactacht_hidden');
    nbactacht_hidden.value = nbActions;
}

// Ajoutez l'événement pour fermer la modal lorsque le bouton "Non" est cliqué
document.getElementById('erreurbouton').addEventListener('click', function() {
    var confirmationModal = document.getElementById('confirmationModal');
    confirmationModal.classList.remove('show');
    confirmationModal.style.display = 'none';
});

function fermer() {
    confirmationModal.classList.remove('show');
}
document.getElementById('logout').addEventListener('click', function() {
    window.location.href = 'mainpage.html'; 
});
</script>

</body>
</html>

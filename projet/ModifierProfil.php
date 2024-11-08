<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="controle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <style>
            img {
            display: block;
            margin: auto;
            width: 200px; /* Ajustez la taille de la photo */
            height: 200px; /* Ajustez la taille de la photo */
            object-fit: cover;
            border-radius: 50%; /* Pour créer une photo d'identité arrondie */
        }
    </style>
<?php
session_start();
include('connexion.php');

// Vérifier si le formulaire a été soumis
try {
        // Récupérer l'ID du startuper à partir de la session
        $idS = $_SESSION['idStartuper'];
        // Sélectionner les données du startuper depuis la base de données
        $stmt = $conn->prepare("SELECT * FROM startuper WHERE id_startuper = :id");
        $stmt->bindParam(':id', $idS);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si des données sont trouvées, les attribuer aux variables
        if ($resultat) {
            $nom = $resultat['nom'];
            $prenom = $resultat['prenom'];
            $cin = $resultat['CIN'];
            $email = $resultat['email'];
            $nomEise = $resultat['nom_entreprise'];
            $adresseEise = $resultat['adresse_entreprise'];
            $numreg = $resultat['numero_registre_commerce'];
            $pseudo = $resultat['pseudo'];
            $pass = $resultat['pwrd'];
            $imgS = $resultat['photo'];
        } else {
            echo "Aucun résultat trouvé.";
        }
        $imageExtensions = array('jpg', 'jpeg', 'png', 'gif');
            $imageData = $resultat['photo'];
            $imageBase64 = base64_encode($imageData);
    
            // Récupérer l'extension de fichier de l'image
            $mime = finfo_buffer(finfo_open(), $imageData, FILEINFO_MIME_TYPE);
            $extension = explode('/', $mime)[1];
            
            // Vérifier si l'extension est une extension d'image supportée
            if (in_array(strtolower($extension), $imageExtensions)) {
                // Utiliser le type MIME correspondant pour le préfixe de données
                echo "<img src='data:" . $mime . ";base64," . $imageBase64 . "' alt='User Photo'>";
            } else {
                echo 'Extension de fichier non prise en charge.';
            }
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;
?>
    <div class="startuper">
        <div class="container-fluid">
            <form action="" method="POST" class="form" class="formcontrol" id="form1" style="margin:50px" enctype="multipart/form-data">
                <div class="form-group">
                    <label for= "name"> Nom </label>
                    <input type="text" name="Lname" id="Lname" class="form-control" value="<?php echo isset($nom) ? $nom : 'yyy'; ?>">
                    <label for= "prenom"> Prénom </label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($prenom) ? $prenom : 'yyy'; ?>">
                    <label for= "cin"> CIN </label>
                    <input type="text" name="cin" id="cin" class="form-control" value="<?php echo isset($cin) ? $cin : 'yyy'; ?>">
                </div>
                <div class="form-group">
                    <label for= "email"> Email </label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo isset($email) ? $email : ''; ?>">
                    <label for= "nomEise"> Nom de l'entreprise </label>
                    <input type="text" name="nomEise" id="nomEise" class="form-control" value="<?php echo isset($nomEise) ? $nomEise : ''; ?>">
                    <label for= "adresseEise"> Adresse de l'entreprise </label>
                    <input type="text" name="adresseEise" id="adresseEise" class="form-control" value="<?php echo isset($adresseEise) ? $adresseEise : ''; ?>">
                    <label for= "numreg"> numéro du registre de commerce </label>
                    <input type="text" name="numreg" id="numreg" class="form-control" value="<?php echo isset($numreg) ? $numreg : ''; ?>">
                </div>
                <div class="form-group">
                    <label for= "pseudo"> Pseudo </label>
                    <input type="text" name="pseudo" id="pseudo" class="form-control" value="<?php echo isset($pseudo) ? $pseudo : ''; ?>">
                    <label for= "pass"> mot de passe </label>
                    <div class="eye-icon">
                        <input type="password" name="pass" id="pass" class="form-control" value="<?php echo isset($pass) ? $pass : ''; ?>">
                        <i class="icon" data-feather="eye"></i>
                        <i class="icon" data-feather="eye-off"></i>
                    </div>
                    <label for="confirmpass">Confirmez votre mot de passe </label>
                    <div class="eye-icon">
                        <input type="password" id="confirmpass" class="form-control" value="<?php echo isset($pass) ? $pass : ''; ?>">
                        <i class="icon" data-feather="eye"></i>
                        <i class="icon" data-feather="eye-off"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for= "comments"> déposez une photo d'identité </label>
                    <input type="file" id="imgS" name="imgS" class="form-control" accept="image/*">
                    <label for= "comments"> commentaires </label>
                    <textarea id="comments" class="form-control"></textarea>
                </div>
                <button class="btn btn-primary" type="submit" > Submit </button>
                <p id='erreur'></p>
            </form>
            
        </div>
    </div>  
    <?php 
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("connexion.php");
        try {
            // Récupérer les valeurs du formulaire
            $nom = $_POST['Lname'];
            $prenom = $_POST['name'];
            $cin = $_POST['cin'];
            $email = $_POST['email'];
            $nomE = $_POST['nomEise'];
            $adresseE = $_POST['adresseEise'];
            $numreg = $_POST['numreg'];
            $pseudo = $_POST['pseudo'];
            $pass = $_POST['pass'];
            
            if (!empty($_FILES['imgS']['tmp_name'])) {
                // si un fichier est uploadé
                $imageF = file_get_contents($_FILES['imgS']['tmp_name']);
                $stmt = $conn->prepare("UPDATE startuper SET nom=:nom, prenom=:prenom, CIN=:cin, email=:email, nom_entreprise=:nomEise, adresse_entreprise=:adresseEise, numero_registre_commerce=:numreg, pseudo=:pseudo, pwrd=:pass, photo=:image WHERE id_startuper = :id");
                $stmt->bindParam(':image', $imageF, PDO::PARAM_LOB);
            } else {
                // garder l'ancienne image
                $stmt = $conn->prepare("UPDATE startuper SET nom=:nom, prenom=:prenom, CIN=:cin, email=:email, nom_entreprise=:nomEise, adresse_entreprise=:adresseEise, numero_registre_commerce=:numreg, pseudo=:pseudo, pwrd=:pass WHERE id_startuper = :id");
            }
        
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':cin', $cin);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':nomEise', $nomE);
            $stmt->bindParam(':adresseEise', $adresseE);
            $stmt->bindParam(':numreg', $numreg);
            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->bindParam(':pass', $pass);
            $stmt->bindParam(':id', $idS);
            $stmt->execute();
            echo "Données mises à jour avec succès";
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        

        // Fermer la connexion
        $conn = null;
    }

    ?>

    <div>
    <center><button id='logout' class='btn btn-primary' type='button' >Menu Principal</button></center>
    </div>
    <script>
        document.getElementById('logout').addEventListener('click', function() {
            window.location.href = 'AccStart.php'; 
});
    </script>
    <style>
        #logout{
            margin-bottom: 2ch;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+"></script>
    <script src="https://unpkg.com/feather-icons@4.29.1/dist/feather.min.js"></script>
<script>feather.replace();</script>
<script src="controleModif.js" method="POST"></script>
</body>
</html>


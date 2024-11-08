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
<h1 id="titre">Formulaire D'inscription</h1>
    <div class="startuper">
        <div class="container-fluid">
            <form action="" method="POST" class="form" class="formcontrol" id="form1" style="margin:50px" enctype="multipart/form-data">
                <div class="form-group">
                    <label for= "name"> Nom </label>
                    <input type="text" name="Lname" id="Lname" class="form-control">
                    <label for= "prenom"> Prénom </label>
                    <input type="text" name="name" id="name" class="form-control">
                    <label for= "cin"> CIN </label>
                    <input type="text" name="cin" id="cin" class="form-control">
                </div>
                <div class="form-group">
                    <label for= "email"> Email </label>
                    <input type="email" name="email" id="email" class="form-control">
                    <label for= "nomEise"> Nom de l'entreprise </label>
                    <input type="text" name="nomEise" id="nomEise" class="form-control">
                    <label for= "adresseEise"> Adresse de l'entreprise </label>
                    <input type="text" name="adresseEise" id="adresseEise" class="form-control">
                    <label for= "numreg"> numéro du registre de commerce </label>
                    <input type="text" name="numreg" id="numreg" class="form-control">
                </div>
                <div class="form-group">
                    <label for= "pseudo"> Pseudo </label>
                    <input type="text" name="pseudo" id="pseudo" class="form-control">
                    <label for= "pass"> mot de passe </label>
                    <div class="eye-icon">
                        <input type="password" name="pass" id="pass" class="form-control">
                        <i class="icon" data-feather="eye"></i>
                        <i class="icon" data-feather="eye-off"></i>
                    </div>
                    <label for="confirmpass">Confirmez votre mot de passe </label>
                    <div class="eye-icon">
                        <input type="password" id="confirmpass" class="form-control">
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

    <div>
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
            $nom = $_POST['Lname'];
            $prenom = $_POST['name'];
            $cin = $_POST['cin'];
            $email = $_POST['email'];
            $nomE = $_POST['nomEise'];
            $adresseE = $_POST['adresseEise'];
            $numreg = $_POST['numreg'];
            $pseudo = $_POST['pseudo'];
            $pass = $_POST['pass'];
            $imageF = file_get_contents($_FILES['imgS']['tmp_name']);
            include("connexion.php");

            try {
                $sql = "INSERT INTO startuper (nom, prenom,CIN, email, nom_entreprise, adresse_entreprise,numero_registre_commerce, pseudo, pwrd, photo) 
                VALUES (:nom, :prenom, :cin, :email, :nomEise, :adresseEise, :numreg, :pseudo, :pass,  :image)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':cin', $cin);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':nomEise', $nomE);
                $stmt->bindParam(':adresseEise', $adresseE);
                $stmt->bindParam(':numreg', $numreg);
                $stmt->bindParam(':pseudo', $pseudo);
                $stmt->bindParam(':pass', $pass);
                $stmt->bindParam(':image',$imageF, PDO::PARAM_LOB); 
                $stmt->execute();
                echo "Startuper inséré avec succès";	
                header("Location: login.php");
            } catch(PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }

            $conn = null;
        }
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+"></script>
    <script src="https://unpkg.com/feather-icons@4.29.1/dist/feather.min.js"></script>
<script>feather.replace();</script>
<script src="controle.js" method="POST"></script>
</body>
</html>

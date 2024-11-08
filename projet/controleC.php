
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
    <h1 id="titre1">Formulaire D'inscription</h1>
    <div class="capital-risque">
        <div class="container-fluid">
        <form action="" method="POST" class="form" id="form2" class="formcontrol" style="margin:50px">
        <div class="form-group">
        <label for= "name"> Nom </label>
        <input type="text" name="CapLname" id="CapLname" class="form-control">
        <label for= "prenom"> Prénom </label>
        <input type="text" name="Capname" id="name" class="form-control">
        <label for= "cin"> CIN </label>
        <input type="text" name="Capcin" id="Capcin" class="form-control">
        </div>
        <div class="form-group">
        <label for= "email"> Email </label>
        <input type="email" name="Capemail" id="Capemail" class="form-control">
       
    </div>
    <div class="form-group">
    <label for= "pseudo"> Pseudo </label>
    <input type="text" name="Cappseudo" id="Cappseudo" class="form-control">
    <label for= "pass"> mot de passe </label>
    <div class="eye-icon">
    <input type="password" id="Cappass" class="form-control">
    <i class="icon" data-feather="eye"></i>
    <i class="icon" data-feather="eye-off"></i>
      </div>
      <label for="Capconfirmpass">Confirmez votre mot de passe </label>
    <div class="eye-icon">
    <input type="password" name="Cappass" id="Capconfirmpass" class="form-control">
    <i class="icon" data-feather="eye"></i>
    <i class="icon" data-feather="eye-off"></i>
      </div>
    </div>
        <div class="form-group">
        <label for= "comments"> commentaires </label>
        <textarea id="comments" class="form-control"></textarea>
        </div>
        <button class="btn btn-primary" type="submit" > Submit </button>
        <p id='erreur2'></p>
        </form>
        </div>
    </div>  
    <div>
    <?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $nom = $_POST['CapLname'];
    $prenom = $_POST['Capname'];
    $cin = $_POST['Capcin'];
    $email = $_POST['Capemail'];
    $pseudo = $_POST['Cappseudo'];
    $pass = $_POST['Cappass'];
    include("connexion.php");

    try {
        $sql = "INSERT INTO capital_risque (nom, prenom,CIN, email,pseudo, pwrd) VALUES (:nom, :prenom, :cin, :email,:pseudo, :pass)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':cin', $cin);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
	    echo "utilisateur inséré avec succès";	
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Fermer la connexion
    $conn = null;
}
?>
    </div>
       
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons@4.29.1/dist/feather.min.js"></script>
<script>feather.replace();</script>
<script src="controleC.js" method="POST"></script>
<script src="controle.js" method="POST"></script>

</body>
</html>
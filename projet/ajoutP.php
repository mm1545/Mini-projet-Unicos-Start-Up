
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
    <h1>AJOUTER UN PROJET</h1>
    <style>
           h1{
            color: lightcoral;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 32px;
            text-align: center;
        }
    </style>
    <div class="projet">
        <div class="container-fluid">
        <form action="" method="POST" class="form" class="formcontrol" id="form" style="margin:50px">
        <div class="form-group">
        <label for= "titreP"> Titre </label>
        <input type="text" name="titreP" id="titreP" class="form-control">
        <label for= "desc">Description</label>
        <textarea id="desc" name="desc" class="form-control"></textarea>
        <label for= "nbactven"> Nombre d'actions à vendre </label>
        <input type="text" name="nbactven" id="nbactven" class="form-control">
        <label for= "prix">Prix d'action</label>
        <input type="text" name="prix" id="prix" class="form-control">
        </div>
        <button class="btn btn-primary" type="submit" > Submit </button>
        <div id='erreur'></div>
        </form>
    </div>
    <div>
        <?php
        session_start();
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" &&isset( $_SESSION['idStartuper'])) {
    // Récupérer les valeurs du formulaire
    $titre = $_POST['titreP'];
    $description = $_POST['desc'];
    $nbactions = $_POST['nbactven'];
    $prix= $_POST['prix'];
    $nbactionsvendu=0;
    $idStartuper=  $_SESSION['idStartuper'];
    include("connexion.php");

    try {
        $sql = "INSERT INTO projet (titre,description,nombre_actions_a_vendre,nombre_actions_vendues,prix_action,id_startuper) VALUES (:titre, :descri, :nbactaven, :nbactvendu, :prix, :idStart)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':descri', $description);
        $stmt->bindParam(':nbactaven', $nbactions);
        $stmt->bindParam(':nbactvendu', $nbactionsvendu);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':idStart',$idStartuper);
        $stmt->execute();
	    echo "projet inséré avec succès";	
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Fermer la connexion
    $conn = null;
}else{
    echo "erreur";
}
?>

    </div>
    <script>
    document.getElementById("form").addEventListener('submit',function(e){
        let nbactven = document.getElementById('nbactven').value;
        let prix = document.getElementById('prix').value;
        let titre=document.getElementById('titreP').value;
        let description=document.getElementById('desc').value;
        let myError=document.getElementById('erreur');
        let regExtitre = /^[a-zA-Z\s]+$/;

        if (!Number.isInteger(parseInt(nbactven))|| nbactven.trim()=="") {
            e.preventDefault();
            myError.innerHTML="Veuillez saisir un entier";
            document.getElementById('nbactven').classList.add('is-invalid');
        }else{
            document.getElementById('nbactven').classList.remove('is-invalid');
        }

        if (isNaN(parseFloat(prix))||prix.trim()=="") {
            e.preventDefault();
            myError.innerHTML="Veuillez saisir un nombre";
            document.getElementById('prix').classList.add('is-invalid');
        }else{
            document.getElementById('prix').classList.remove('is-invalid');
        }

        if (titre.trim()=='') {	
            myError.innerHTML='Le champ titre est requis';
            document.getElementById('titreP').classList.add('is-invalid');
            e.preventDefault();
        } else if (!regExtitre.test(titre)){
            myError.innerHTML="Le champ titre doit être composé de lettres ou d'espaces";
            document.getElementById('titreP').classList.add('is-invalid');
            e.preventDefault();
        } else {
            document.getElementById('titreP').classList.remove('is-invalid');
        }
    });
</script>

         <div>
    <center><button id='logout' class='btn btn-primary' type='button' >Menu Principal</button></center>
    </div>
    <script>
        document.getElementById('logout').addEventListener('click', function() {
    window.location.href = 'AccStart.php'; 
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>
</html>
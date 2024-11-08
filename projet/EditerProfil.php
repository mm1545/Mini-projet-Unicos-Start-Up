<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="investstart.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">
    <title>Mon CV</title>
    <style>
        img {
            display: block;
            margin: auto;
            width: 200px; 
            height: 200px;
            object-fit: cover;
            border-radius: 50%; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="text-center">
                <?php
$imageExtensions = array('jpg', 'jpeg', 'png', 'gif');
include('connexion.php');
try {
    session_start();
    $id = $_SESSION['idStartuper'];

    $stmt = $conn->prepare("SELECT photo FROM startuper WHERE id_startuper = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row && isset($row['photo'])) {
        $imageData = $row['photo'];
        $imageBase64 = base64_encode($imageData);

        $mime = finfo_buffer(finfo_open(), $imageData, FILEINFO_MIME_TYPE);
        $extension = explode('/', $mime)[1];
        
        if (in_array(strtolower($extension), $imageExtensions)) {
            echo "<img src='data:" . $mime . ";base64," . $imageBase64 . "' alt='User Photo'>";
        } else {
            echo 'Extension de fichier non prise en charge.';
        }
    } else {
        echo 'Image introuvable.';
    }
    $stt = $conn->prepare("SELECT * FROM startuper WHERE id_startuper = :id");
    $stt->bindParam(':id', $idS);
    $stt->execute();
    $_SESSION['info']  = $stt->fetch(PDO::FETCH_ASSOC);
    $info= $_SESSION['info'];
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
                </div>
            </div>

            <?php
include("connexion.php");

if (isset($_SESSION['idStartuper'])) {
    $idS = $_SESSION['idStartuper'];
    try {
        $stmt = $conn->prepare("SELECT * FROM startuper WHERE id_startuper = :id");
        $stmt->bindParam(':id', $idS);
        $stmt->execute();
        $info = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>


            <div id="cv" class="col-md-8">
                <h2>Nom Prénom</h2>
                <p id="nomprenom"><?php echo $info['nom'] . ' ' . $info['prenom']; ?></p>
                <h2>CIN</h2>
                <p id="cin"><?php echo $info['CIN']; ?></p>
                <h2>Email</h2>
                <p id="email"><?php echo $info['email']; ?></p>
                <h2>Nom de l'Entreprise</h2>
                <p id="nomEise"><?php echo $info['nom_entreprise']; ?></p>
                <h2>Adresse de l'Entreprise</h2>
                <p id="adresseEise"><?php echo $info['adresse_entreprise']; ?></p>
                <h2>Numéro du registre de commerce </h2>
                <p id="numreg"><?php echo $info['numero_registre_commerce']; ?></p>
                <br>
                <br>
            </div>
        </div> 
    </div>
   
    <style>
               h2{
                font-family: Georgia, 'Times New Roman', Times, serif;
            color:rebeccapurple;


        }
        p{
            font-family: 'Times New Roman', Times, serif;
    display: block;
    color: black ;
    font-size: x-large;
    font-weight: bold;
        }
     #boutons{
    display: flex;
    flex-direction:row;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
     }
    </style>
    <div id="boutons" class="container">
    <button id='logout' class='btn btn-primary' type='button' >Menu Principal</button>
    <button id='Modif' class='btn btn-primary' type='button' >Modifier Profil</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
    <script>
        document.getElementById('logout').addEventListener('click', function() {
    window.location.href = 'AccStart.php'; 
});
document.getElementById('Modif').addEventListener('click', function() {
    window.location.href = 'ModifierProfil.php'; 
});
    </script>
    
</body>
</html>

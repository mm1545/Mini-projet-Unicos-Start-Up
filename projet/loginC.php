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
    <h1 name="h1" id="titre1">Welcome, Investor</h1>
    <div class="startuper">
        <div class="container-fluid">
        <form action="" method="POST" class="form" id="form3" style="margin:50px">
        <div class="form-group">
        <label for= "pseudo"> Pseudo </label>
        <input type="text"  name="pseudo"  id="pseudolog" class="form-control">
        </div>
        <div class="form-group">
        <label for= "pass"> mot de passe </label>
        <div class="eye-icon">
        <input type="password" name="pass" id="passlog" class="form-control">
        <i class="icon" data-feather="eye"></i>
        <i class="icon" data-feather="eye-off"></i>
          </div>
        </div>
        <br>
        <center><button class="btn btn-primary" type="submit">OK</button></center>
        <p id='erreur'></p>
        </form>
        </div>
        <center><p>Vous n'avez pas de compte?<a href="controleC.php">Créez un compte</a></p></center>
    </div>  
    <div>
    <?php
        session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("connexion.php");
                $pseudo = $_POST['pseudo'];
                $pass = $_POST['pass'];
                $stmt = $conn->prepare("SELECT * FROM capital_risque WHERE pseudo = :pseudo AND pwrd=:pass");
                $stmt->bindParam(':pseudo', $pseudo);
                $stmt->bindParam(':pass', $pass);
                $stmt->execute();
                $idCapital = $stmt->fetch(PDO::FETCH_ASSOC); 
                if ($stmt->rowCount() > 0) {
                
                    $_SESSION['idCapital'] = $idCapital['id_capital_risque'];

                    echo "<script>document.getElementById('pseudolog').classList.remove('is-invalid');</script>";
                    echo "<script>document.getElementById('passlog').classList.remove('is-invalid');</script>";
                    header("Location: AccInvest.php");
                    exit;
                } else {
                    
                    echo "<div class='message'><center>Capital risque N'existe pas<center></div>";
                    echo "<script>document.getElementById('pseudolog').classList.add('is-invalid');</script>";
                    echo "<script>document.getElementById('passlog').classList.add('is-invalid');</script>";

                } 
            }
    ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons@4.29.1/dist/feather.min.js"></script>
<script>feather.replace();</script>
<script src="controle.js"></script>
</body>
</html>
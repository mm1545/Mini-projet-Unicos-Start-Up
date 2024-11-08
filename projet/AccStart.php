<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="investstart.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">
    
    <title>Document</title>
</head>
<body>
<h1 id="titreStart">ESPACE STARTUPER</h1>
    <nav>
        <ul>
            <li><a href="ajoutP.php">Ajouter un projet </a></li>
            <li><a href="EditerProfil.php">Editer et Modifier profil</a></li>
            <li><a href="afficherP.php">Lister les projets</a></li>
            <li><a href="SupprimerP.php">Supprimer les projets</a></li>
        </ul>
    </nav>
    <div>
    <center><button id='logout' class='btn btn-primary' type='button' >Log Out</button></center>
    </div>
    <script>
        document.getElementById('logout').addEventListener('click', function() {
    window.location.href = 'mainpage.html'; 
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>
</html>
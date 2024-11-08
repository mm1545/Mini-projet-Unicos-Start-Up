<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">
    <title>Recherche de Projets</title>
</head>
<body>
    <center><h1>Recherche de Projets</h1></center>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto my-5">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" name="search" placeholder="Rechercher par description" class="form-control">
                    </div>
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        h1{
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-size: 32px;
    font-weight: bold;
    color:teal;
    text-align: center; 
    text-transform:uppercase; 
    margin-top: 30px;        }
    </style>
    <?php
        include("connexion.php");

        if(isset($_POST['search'])) {
            $search = $_POST['search'];
            try {
                $stmt = $conn->prepare("SELECT * FROM projet WHERE description LIKE :searchQuery");
                $stmt->bindValue(':searchQuery', '%' . $search . '%', PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo "<center><h3>Résultats de la recherche :</h3></center>";
                if($result){
                    echo "<ul>";
                    foreach($result as $row){
                        echo "<li>".$row['titre']." - ".$row['description']."</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>Aucun résultat trouvé.</p>";
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }
    ?>
    <style>
        h3{
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ;
            color:slateblue;
        }
        ul{
    list-style: none;
    display: flex;
    flex-direction:row;
    justify-content: space-between;
    flex-wrap: wrap;
    align-items: center;
    padding: 10px;
}
ul>li {
    font-family: 'Times New Roman', Times, serif;
    display: block;
    margin: 10px;
    padding: 7px;
    border: 3px solid darkslategray ;
    color: black ;
    font-size: x-large;
    border-radius: 12px;
    font-weight: bold;
}
    </style>
    <div><center><button id='logout' class='btn btn-primary' type='button' >Menu Principal</button></center></div>
    <script>
        document.getElementById('logout').addEventListener('click', function() {
            window.location.href = 'AccInvest.php'; 
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+"></script>
</body>
</html>


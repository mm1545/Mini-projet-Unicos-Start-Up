<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">
    <title>Document</title>
    <style>
        .caption {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            color: slateblue;
            font-size: 20px;
            text-align: center;
        }
   
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <?php
            session_start();
            include('connexion.php');
            $id_capital = $_SESSION['idCapital'];

            try {
                $stmt = $conn->prepare("SELECT * FROM capital_risque_projet WHERE id_capital_risque=:id_capital");
                $stmt->bindParam(':id_capital', $id_capital);
                $stmt->execute();
                $projetF = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $totals = [];

                foreach ($projetF as $projet) {
                    $stt = $conn->prepare('SELECT prix_action FROM projet WHERE id_projet=:id_projet');
                    $stt->bindParam(':id_projet', $projet['id_projet']);
                    $stt->execute();
                    $prix = $stt->fetchColumn();

                    $total = $prix * $projet['nombre_actions_achetees'];

                    if (isset($totals[$projet['id_projet']])) {
                        $totals[$projet['id_projet']]['nombre_actions_achetees'] += $projet['nombre_actions_achetees'];
                        $totals[$projet['id_projet']]['total'] += $total;
                    } else {
                        $totals[$projet['id_projet']] = array('nombre_actions_achetees' => $projet['nombre_actions_achetees'], 'total' => $total);
                    }
                }

                echo "<center class='caption'><caption>Liste Des Projets Financés</caption><center>";
                echo "<table class='table table-bordered'>";
                echo "<tr><th>ID Projet</th><th>Nombre d'actions achetées</th><th>Total investissement</th></tr>";

                foreach ($totals as $id_projet => $data) {
                    echo "<tr><td>{$id_projet}</td><td>{$data['nombre_actions_achetees']}</td><td>{$data['total']}</td></tr>";
                }

                echo "</table>";
            } catch(PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }

            $conn = null;
            ?>
        </div>
    </div>
</div>
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

<?php
$id = $_GET['id'];

$pdo = new PDO('mysql:host=127.0.0.1;dbname=library;port=3506', 'root', 'root');

$query = "SELECT * FROM livres WHERE id= :book";
$stmt = $pdo->prepare($query);
$stmt->execute(['book' => $id]);
$livre = $stmt->fetch(PDO::FETCH_ASSOC); //seulement la première trouvée

$query2 = "SELECT * FROM genres WHERE id= :id";
$stmt2 = $pdo->prepare($query2);
$stmt2->execute(['id' => $livre['genre_id']]);
$genre = $stmt2->fetch(PDO::FETCH_ASSOC);

//se créer une nouvelle query qui recupère le genre_id du livre au dessus

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre sélectionné</title>
</head>
<body>
    <div class="container col-4">
        <h3><?= $livre['titre']?></h3> 
        <h4><?= $livre['auteur']?></h4>
        <p><?= $livre['description']?></p>
        <p>Genre :  <?= $genre['libelle']?></p>
    </div>
</body>
</html>
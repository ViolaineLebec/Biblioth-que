<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque Vio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=library;port=3506', 'root', 'root');

$query = "SELECT * FROM livres";
$stmt = $pdo->prepare($query);
$stmt->execute();
$livres = $stmt->fetchAll(PDO::FETCH_ASSOC); //tous les résultats
$livre = $stmt->fetch(PDO::FETCH_ASSOC); //seulement la première trouvée
?>

<div class="text-center col-12 m-5">
    <h1>Bibliviothèque</h1>
    <a href="add.php">
    <button type="button">Nouveau</button>
    </a>
</div>


<div class="container">
    <?php foreach($livres as $livre): ?>
        <div class="row justify-content-start m-2">
            <div  class="col-3">
                <p><?= $livre['titre']?> (<?= $livre['auteur']?>)</p>
            </div>
            <div  class="col-1">
                <a href="item.php?id=<?= $livre['id'] ?>">
                    <button type="button">Voir</button>
                </a>
            </div>
            <div  class="col-1">
                <a href="edit.php?id=<?= $livre['id'] ?>">
                    <button type="button">Modifier</button>
                </a>
            </div>
            <div  class="col-1">
                <a href="delete.php?id=<?= $livre['id'] ?>">
                    <button type="button">Supprimer</button>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
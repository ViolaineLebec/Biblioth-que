<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=library;port=3506', 'root', 'root');

$query = "SELECT * FROM livres";
$stmt = $pdo->prepare($query);
$stmt->execute();
$livres = $stmt->fetchAll(PDO::FETCH_ASSOC); //tous les résultats
$livre = $stmt->fetch(PDO::FETCH_ASSOC); //seulement la première trouvée
?>

<h1>Bibliothèque de Violaine</h1>

<a href="add.php">
    <button type="button">Nouveau</button>
</a>

<?php foreach($livres as $livre): ?>
<div>
    <h3><?= $livre['titre']?></h3> 
    <h4><?= $livre['auteur']?></h4>
    <a href="item.php?id=<?= $livre['id'] ?>">
        <button type="button">Voir</button>
    </a>
    <a href="delete.php?id=<?= $livre['id'] ?>">
        <button type="button">Supprimer</button>
    </a>
</div>
<?php endforeach; ?>
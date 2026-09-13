<?php
if(!isset($_GET['id'])){
    header('Location: index.php');
    exit;
    }
$id = $_GET['id'];

$pdo = new PDO('mysql:host=127.0.0.1;dbname=library;port=3506', 'root', 'root');

$query = "DELETE FROM livres WHERE id=:book";
$stmt = $pdo->prepare($query);
$stmt->execute(['book' => $id]);
$livre = $stmt->fetch(PDO::FETCH_ASSOC); //seulement la première trouvée
header('Location: index.php');
exit;
?>

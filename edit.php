<?php

$id = $_GET['id'];
$pdo = new PDO('mysql:host=127.0.0.1;dbname=library;port=3506', 'root', 'root');

$query = "SELECT * FROM livres WHERE id=:book";
$stmt = $pdo->prepare($query);
$stmt->execute(['book' => $id]);
$livre = $stmt->fetch(PDO::FETCH_ASSOC); //seulement la première trouvée

$query2 = "SELECT * FROM genres";
$stmt2 = $pdo->prepare($query2);
$stmt2->execute();
$genres = $stmt2->fetchAll(PDO::FETCH_ASSOC);

if (!$livre) {
    die("Livre introuvable !");
}

$titre = $livre['titre'];
$auteur = $livre['auteur'];
$description = $livre['description'];
$genre = $livre['genre_id'];

?>

<form method="post" class="container">
    
    <div>
                <input type="text" name="titre" placeholder="titre" required value="<?= $titre ?>">
    </div>

    <div>
                <input type="text" name="auteur" placeholder="auteur" required value="<?= $auteur ?>">
    </div>

    <div>
                <textarea name="description" placeholder="résumé" ><?= $description ?></textarea>
    </div>

    <div>
        <select name="genre_id">
            <?php foreach($genres as $gender): ?>
            <option value="<?= $gender['id'] == $livre['genre_id'] ? $gender['id'] : '' ?>" <?= $gender['id'] == $livre['genre_id'] ? 'selected' : '' ?>><?= $gender['libelle']?></option>

            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <button type="submit" name="submit">Enregistrer</button>
    </div>

    <?php
    
        if (isset($_POST['submit'])) {
        
            if (!empty($_POST['titre']) && !empty($_POST['auteur'])) {
                $titre = $_POST['titre'];
                $auteur = $_POST['auteur'];
                $description = $_POST['description'];
                $genre = $_POST['genre_id'];
                
                $query = "UPDATE livres SET titre = :titre, auteur = :auteur, description = :description, genre_id = :genre WHERE id = :id";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    'titre'=>$_POST['titre'],
                    'auteur'=>$_POST['auteur'],  
                    'description'=>$_POST['description'], 
                    'genre'=>$_POST['genre_id'],
                    'id' => $id
                    ]);
                echo "Livre ajouté";
            }else{
                echo "Le titre et l'auteur sont indispensables";
            }
        }

    ?>
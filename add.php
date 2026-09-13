<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php
$titre = '';

$pdo = new PDO('mysql:host=127.0.0.1;dbname=library;port=3506', 'root', 'root');

$query2 = "SELECT * FROM genres";
$stmt2 = $pdo->prepare($query2);
$stmt2->execute();
$genres = $stmt2->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    
    if (!empty($_POST['titre']) && !empty($_POST['auteur'])) {
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $description = $_POST['description'];
        $genre = $_POST['genre_id'];
        
        $query = "INSERT INTO livres (titre, auteur, description, genre_id) VALUES (:titre, :auteur, :description, :genre)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'titre'=>$_POST['titre'],
            'auteur'=>$_POST['auteur'],  
            'description'=>$_POST['description'], 
            'genre'=>$_POST['genre_id']
            ]);
        echo "Livre ajouté";
    }else{
        echo "Le titre et l'auteur sont indispensables";
    }
}


?>

<form method="post" class="container">
    
    <div>
                <input type="text" name="titre" placeholder="titre" required value="<?= $titre ?>">
    </div>

    <div>
                <input type="text" name="auteur" placeholder="auteur" required value="<?= $auteur ?>">
    </div>

    <div>
                <textarea name="description" placeholder="résumé"><?= $description ?></textarea>
    </div>

    <div>
        <select name="genre_id" id="" placeholder="genre" value="<?= $genre ?>">
            <?php foreach($genres as $genre): ?>
            <option value=<?=$genre['id']?>><?=$genre['libelle']?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <button type="submit" name="submit">Ajouter</button>
    </div>


</form> 
</body>
</html>

<?php

$titre = '';

$pdo = new PDO('mysql:host=127.0.0.1;dbname=library;port=3506', 'root', 'root');

if (isset($_POST['submit'])) {
    
    if (!empty($_POST['titre']) && !empty($_POST['auteur'])) {
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $description = $_POST['description'];
        $genre = $_POST['genre'];
        
        $query = "INSERT INTO livres (titre, auteur, description, genre_id) VALUES (:titre, :auteur, :description, :genre)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'titre'=>$_POST['titre'],
            'auteur'=>$_POST['auteur'],  
            'description'=>$_POST['description'], 
            'genre'=>$_POST['genre']
            ]);
        echo "Livre ajouté";
    }else{
        echo "Le titre et l'auteur sont indispensables";
    }
}
?>

<form method="post">
    
    <div>
                <input type="text" name="titre" placeholder="titre" required value="<?= $titre ?>">
    </div>

    <div>
                <input type="text" name="auteur" placeholder="auteur" required value="<?= $auteur ?>">
    </div>

    <div>
                <textarea name="description" placeholder="message" value ="<?= $description ?>"></textarea>
    </div>

    <div>
        <select name="genre_id" id="" placeholder="genre" value="<?= $genre ?>">
            <option value=1>roman historique</option>
            <option value=2>manga</option>
            <option value=3>roman philosophique</option>
            <option value=4>BD</option>
        </select>
    </div>

    <div>
        <button type="submit" name="submit">Ajouter</button>
    </div>


</form>
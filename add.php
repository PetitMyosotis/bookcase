<?php
session_start();

if($_POST){
    if(isset($_POST['titre']) && !empty($_POST['titre'])){
        require_once('connect.php');
        $titre = strip_tags($_POST['titre']);
        $sql = 'INSERT INTO `livres`(`titre`) VALUES (:titre)';
        $query = $db->prepare($sql);
        $query->bindValue(':titre', $titre,PDO::PARAM_STR);
        $query->execute();

        $_SESSION['message'] = "Livre enregistré";
        require_once('close.php');
        header('Location: index.php');

    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un livre</title>
</head>
<body>
    
    <h1>Ajouter un livre :</h1> 
    <form method="post">
        <label for="titre">Titre du livre</label>
        <input type="text" id="titre" name="titre">
        <button>Enregistrer</button>
    </form>
</body>
</html>
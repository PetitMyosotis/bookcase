<?php
session_start();

if($_POST){
    require_once('connect.php');
    $id_livre =strip_tags($_POST['id_livre']);
    $titre =strip_tags($_POST['titre']);
    $sql = 'UPDATE `livres` SET `titre` =:titre WHERE `id_livre`=:id_livre;';
    $query = $db->prepare($sql);
    $query->bindValue(':id_livre', $id_livre, PDO::PARAM_INT);
    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->execute();

    $_SESSION['message'] = "Livre modifié";
    require_once('close.php');
    header('Location: index.php');

}

if(isset($_GET['id_livre']) && !empty($_GET['id_livre'])){
    require_once('connect.php');
    $id_livre = strip_tags($_GET['id_livre']);
    $sql = 'SELECT* FROM `livres` WHERE `id_livre` = :id_livre;';
    $query = $db->prepare($sql);
    $query->bindValue(':id_livre', $id_livre,PDO::PARAM_INT);
    $query->execute();
    $livre = $query->fetch();
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un livre</title>
</head>
<body>
    
    <h1>Modifier un livre :</h1> 
    <form method="post">
        <label for="titre">Titre du livre</label>
        <input type="text" id="titre" name="titre" value="<?=$livre['titre']?>">
        <input type="hidden" name="id_livre" value="<?=$livre['id_livre']?>">
        <button>Enregistrer</button>
    </form>
</body>
</html>
<?php
session_start();
require_once('connect.php');
$sql= 'SELECT * FROM `livres`';
$query = $db->prepare($sql);
$query->execute();
//put everything in a array (FETCH_ASSOC is to have information just once)
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('close.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque de Marie-Line</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <?php
    if(!empty($_SESSION['message'])){
        echo $_SESSION['message'];
        $_SESSION['message']= "";
    }
    ?>
    <header><h1>Dans ma bibliothèque il y a :</h1></header>
    <div class="tableau">
    <table>
        <thead>
            <th class="hidden">id</th>
            <th>titre</th>
            <th>actions</th>
        </thead>
        <tbody>
            <?php
            foreach($result as $livre) {
            ?>
             <tr>
                 <td class="hidden"><?=$livre['id_livre'] ?></td>
                 <td><?=$livre['titre'] ?></td>
                 <td><a href="edit.php?id_livre=<?=$livre['id_livre']?>">Modifier</a>
                <a href="delete.php?id_livre=<?=$livre['id_livre']?>">Supprimer</a></td>
                 
             </tr>
            <?php
            }

            ?>
        </tbody>   
    </table>
    <a href="add.php">Ajouter un livre</a>
    </div>
</body>
</html>
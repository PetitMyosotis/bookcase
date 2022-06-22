<?php
session_start();

if(isset($_GET['id_livre']) && !empty($_GET['id_livre'])){
    require_once('connect.php');

    $id_livre = strip_tags($_GET['id_livre']);
    $sql = 'SELECT * FROM `livres` WHERE `id_livre` = :id_livre;';
    $query = $db->prepare($sql);
    $query->bindValue(':id_livre', $id_livre, PDO::PARAM_INT);
    $query->execute();
    $livre = $query->fetch();

    
    if(!$livre){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
        die();
    }

    $sql = 'DELETE FROM `livres` WHERE `id_livre` = :id_livre;';
    $query = $db->prepare($sql);
    $query->bindValue(':id_livre', $id_livre, PDO::PARAM_INT);
    $query->execute();
    $_SESSION['message'] = "livre supprimé";
    header('Location: index.php');


}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}
<?php
session_start(); 

require './conexion.php'; 
require './../class/favorirs.php'; 
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php"); 
    exit();
}

if (isset($_GET['id_article'])) {
    $id_article = $_GET['id_article'];
    $id_user = $_SESSION['id_user']; 
    $db = new Database();
    $favorites = new Favorites($db);
    if ($favorites->suppArticleToFavorites($id_user, $id_article)) {
        header("Location: article.php");
        exit();
    } else {
        echo "Une erreur s'est produite lors de la suppression de l'article.";
        exit();
    }
} else {
    exit();
}
?>

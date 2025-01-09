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
    if ($favorites->addArticleToFavorites($id_user, $id_article)) {
        header("Location: article.php");
        exit();
    } else {
        echo "Cet article est déjà dans vos favoris.";
        exit();
    }
} else {
    echo "Article non défini.";
    exit();
}
?>

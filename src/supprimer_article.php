<?php
include './conexion.php';
require './../class/article.php';

$db = new Database();
$article = new Article($db);

if (isset($_POST['id_article']) && !empty($_POST['id_article'])) {
    $id = $_POST['id_article'];
    $article->deletearticle($id);

    header('Location: dashbord.php'); 
    exit();
} else {
    echo "Erreur : ID de la catégorie manquant.";
}
?>

<?php
include './conexion.php';
require './../class/comentaire.php';

session_start(); 

// Vérifier que l'utilisateur est bien connecté
if (!isset($_SESSION['id_user'])) {
    die('Erreur : Vous devez être connecté pour laisser un commentaire.');
}

$id_user = $_SESSION['id_user']; 
$id_article = $_POST['id_article']; 
$contenue = $_POST['contenue']; 

// Vérification des champs
if (empty($id_article) || empty($contenue)) {
    die('Erreur : Tous les champs sont nécessaires.');
}

// Connexion à la base de données
$db = new Database();
$comentaire = new Commentaire($db); 

// Ajouter un commentaire
if ($comentaire->addCommentaire($id_user, $id_article, $contenue) ) {
    header("Location: article.php?id_article=" . $id_article);  // Rediriger vers l'article après ajout
    exit();
} else {
    die('Une erreur est survenue lors de l\'ajout du commentaire.');
}
?>

<?php
session_start();
require './conexion.php';  // Fichier de connexion à la base de données
require './../class/article.php'; 
$connect = new Database();   // Charger la classe Article
if (!isset($connect)) {
    die('La connexion à la base de données a échoué.');
}
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_user'])) {
    echo "L'utilisateur n'est pas connecté.";
    exit();
}

// Vérifier si l'ID de l'article est envoyé
if (isset($_POST['id_article'])) {
    $id_article = $_POST['id_article'];
    
    // Créer une instance de la classe Article
    $article = new Article($connect);

    // Appeler la méthode accepter() pour mettre à jour le statut
    if ($article->accepter($id_article)) {
        // Rediriger après l'acceptation
        header("Location: dashbord.php?status=success");
        exit();
    } else {
        echo "Erreur lors de l'acceptation de l'article.";
    }
} else {
    echo "ID de l'article manquant.";
}
?>

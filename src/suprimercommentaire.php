<?php
session_start();
require './conexion.php'; // Connexion à la base de données
require './../class/comentaire.php'; // Inclure la classe Commentaire

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['id_user'])) {
    echo "L'utilisateur n'est pas connecté.";
    exit();
}

$id_user = $_SESSION['id_user']; // Récupérer l'ID de l'utilisateur

// Initialisation de la classe Commentaire
$db = new Database();
$commentaire = new Commentaire($db);

// Vérifier si l'ID du commentaire a été passé en POST
if (isset($_POST['id_commentaire'])) {
    $id_commentaire = $_POST['id_commentaire'];

    // Appeler la méthode pour supprimer le commentaire
    try {
        $commentaire->deleteCommentaire($id_commentaire);
        // Rediriger vers la page des articles ou une page de confirmation
        header('Location: article.php'); // ou toute autre page
        exit();
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la suppression du commentaire : " . $e->getMessage();
    }
} else {
    echo "Aucun ID de commentaire fourni.";
}
?>

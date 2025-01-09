<?php
include './conexion.php'; 
require './../class/article.php';  
require './../class/tags.php'; 
$db = new Database();
$article = new Article($db);
$tags = new Tag($db);
$date_creation = date('Y-m-d H:i:s');

// Traitement de l'ajout de l'article
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $contrnue = $_POST['contrnue'];
    $image = $_POST['image'];
    $id_theme = $_POST['id_theme'];
    $id_tag = $_POST['id_tag']; // Ajout du tag sélectionné

    // Validation des champs du formulaire
    if (!empty($titre) && !empty($contrnue) && !empty($image) && !empty($id_theme) && !empty($id_tag)) {
        // Ajouter l'article et la relation avec le tag
        $result = $article->addArticleWithTag($image, $titre, $contrnue, $id_theme, $id_tag, 'en_attente');
        
        // Vérifier si l'ajout s'est bien passé
        if ($result) {
            // Rediriger l'utilisateur vers la page des articles
            header("Location: article.php");
            exit();
        } else {
            // Afficher un message d'erreur si l'insertion échoue
            echo "Erreur lors de l'ajout de l'article.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

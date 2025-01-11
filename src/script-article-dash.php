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
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $contrnue = $_POST['contrnue'];
    $image = $_POST['image'];
    $id_theme = $_POST['id_theme'];
    $id_tag = $_POST['id_tag']; // Ajout du tag sélectionné

    // Validation des champs du formulaire
    if (!empty($titre) && !empty($contrnue) && !empty($image) && !empty($id_theme) && !empty($id_tag)) {
        // Appeler la méthode addArticleadmin pour insérer l'article avec le statut 'accepte'
        $result = $article->addArticleadmin($image, $titre, $contrnue, $id_theme, $id_tag, 'accepte');

        // Vérifier si l'ajout s'est bien passé
        if ($result) {
            // Rediriger l'utilisateur vers la page des articles
            header("Location: dashbord.php");
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

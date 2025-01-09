<?php
include './conexion.php'; 
require './../class/article.php';
require './../class/theme.php'; 
$db = new Database();
$article = new Article($db);
$theme = new Theme($db);

if (isset($_GET['id_article'])) {
    $id_article = intval($_GET['id_article']);

    $cat = $article->getArticleById($id_article); 
    if (!$cat) {
        echo "article non trouvé.";
        exit();
    }

    $themes = $theme->getAllTheme();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $contenu = $_POST['contenu'];
        
        $updateSuccess = $article->updatearticle($contenu);
        
        if ($updateSuccess) {
            echo "Véhicule mis à jour avec succès.";
            header('Location: article.php');
            exit();
        } else {
            echo "Erreur lors de la mise à jour du véhicule.";
        }
    }
} else {
    echo "Aucun véhicule sélectionné.";
    exit;
}
?>
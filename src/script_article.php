<?php
require './conexion.php';
require './../class/article.php';
require './../class/articletag.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['titre'], $_POST['contrnue'], $_POST['id_theme'], $_POST['id_tag'])) {
        $image = $_POST['image'];
        $titre = $_POST['titre'];
        $contrnue = $_POST['contrnue'];
        $id_theme = $_POST['id_theme'];
        $id_tags = array_unique($_POST['id_tag']);  
        $date_creation = date('Y-m-d H:i:s');
        if (empty($id_tags)) {
            echo "Aucun tag sélectionné.";
            exit();
        }
        $database = new Database();
        $db = $database->getConnection();

        if (!$db) {
            echo "Erreur de connexion à la base de données.";
            exit();
        }
        $article = new Article($db);
        $article->titre = $titre;
        $article->image = $image;
        $article->contrnue = $contrnue;
        $article->id_theme = $id_theme;
        $article->statut = 'en_attente'; 
        $article->date_creation = $date_creation; 
        if ($article->create()) {
            $id_article = $db->lastInsertId();
            echo "Article ajouté avec succès. ID de l'article : $id_article";
            $articletag = new ArticleTag($db);
            foreach ($id_tags as $id_tag) {
                $articletag->id_article = $id_article;
                $articletag->id_tag = $id_tag;
                if (!$articletag->create()) {
                    echo "Erreur lors de l'ajout de la relation dans articletag.";
                    exit();
                }
            }
            header('Location: article.php');
            exit();
        } else {
            echo "Erreur lors de l'ajout de l'article.";
        }
        
    } else {
        echo "Données manquantes dans le formulaire.";
    }
}
?>

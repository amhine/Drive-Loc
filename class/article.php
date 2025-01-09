<?php

class Article {
    public $connect;

    public $id_article;
    public $titre;
    public $image;
    public $date_creation;
    public $id_theme;
    public $contrnue;
    public $id_tag;
    


    public function __construct($connect) {
        $this->connect = $connect;
    }
    public function getArticle() {
        try {
            $sql = "SELECT * FROM article";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error retrieving article: " . $e->getMessage();
            return [];
        }
    }

    public function getarticleBytheme($id_theme) {
        try {
            $sql = "SELECT * FROM article WHERE id_theme = $id_theme";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des véhicules : " . $e->getMessage();
            return [];
        }
    }

    public function getArticlesPaginated($offset, $limit) {
        $query = "SELECT * FROM article LIMIT :offset, :limit";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTotalArticles() {
        try {
            $sql = "SELECT COUNT(*) FROM article"; 
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
            return $stmt->fetchColumn(); 
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du nombre d'articles : " . $e->getMessage();
            return 0; 
        }

       
    }

    public function getArticleById($id_article) {
        $query = "SELECT * FROM article WHERE id_article = $id_article";
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // public function aaddArticle($titre, $image, $date_creation, $id_theme, $contrnue, $statut = 'en_attente') {
    //     try {
    //         $sql = "INSERT INTO `article` (`titre`, `image`, `date_creation`, `id_theme`, `contrnue`, `statut`) 
    //                 VALUES ('$titre', '$image', '$date_creation', $id_theme, '$contrnue', '$statut')";
            
    //         $stmt = $this->connect->prepare($sql);
    //         $stmt->execute();
    //     } catch (PDOException $e) {
    //         echo "Erreur lors de l'ajout de l'article: " . $e->getMessage();
    //         return false;
    //     }
    // }
    
    public function addArticleWithTag($image, $titre, $contrnue, $id_theme, $id_tag, $statut = 'en_attente') {
        try {
            $query_article = "INSERT INTO article (image, titre, contrnue, id_theme, statut) 
                              VALUES (:image, :titre, :contrnue, :id_theme, :statut)";
            $stmt_article = $this->connect->prepare($query_article);
            $stmt_article->bindParam(':image', $image);
            $stmt_article->bindParam(':titre', $titre);
            $stmt_article->bindParam(':contrnue', $contrnue);
            $stmt_article->bindParam(':id_theme', $id_theme);
            $stmt_article->bindParam(':statut', $statut);
            $stmt_article->execute();
            $id_article_query = "SELECT id_article FROM article WHERE titre = :titre AND contrnue = :contrnue";
            $stmt_id_article = $this->connect->prepare($id_article_query);
            $stmt_id_article->bindParam(':titre', $titre);
            $stmt_id_article->bindParam(':contrnue', $contrnue);
            $stmt_id_article->execute();
            $article = $stmt_id_article->fetch(PDO::FETCH_ASSOC);
            $id_article = $article['id_article'];
            $query_tag_relation = "INSERT INTO articletag (id_article, id_tag) VALUES (:id_article, :id_tag)";
            $stmt_tag = $this->connect->prepare($query_tag_relation);
            $stmt_tag->bindParam(':id_article', $id_article);
            $stmt_tag->bindParam(':id_tag', $id_tag);
            $stmt_tag->execute();
    
    
            return $id_article; 
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de l'article: " . $e->getMessage();
            return false;
        }
    }
    
    
    
    
    

    public function searchArticleByTitle($title) {
        try {
            // Requête SQL pour rechercher les articles dont le titre contient le mot-clé
            $sql = "SELECT * FROM article WHERE titre LIKE :title";
            $stmt = $this->connect->prepare($sql);
    
            // Ajouter des jokers (%) pour permettre une recherche floue
            $searchTerm = '%' . $title . '%';
    
            // Lier la variable de recherche à la requête
            $stmt->bindValue(':title', $searchTerm, PDO::PARAM_STR);
    
            // Exécuter la requête
            $stmt->execute();
    
            // Retourner les résultats sous forme de tableau associatif
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la recherche de l'article: " . $e->getMessage();
            return [];
        }
    }
    public function getTagsByArticle($id_article) {
        $sql = "SELECT tag.nom_tag 
                FROM tag 
                INNER JOIN articletag  ON tag.id_tag = articletag.id_tag
                WHERE id_article = :id_article";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id_article', $id_article);
        
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne un tableau de tags
    }
    
    
    
    
    }
    

    
    





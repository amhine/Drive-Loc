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
    public $statut;
    


    public function __construct($connect) {
        $this->connect = $connect;
    }

    public function create() {
        $query = "INSERT INTO article (titre, image, contrnue, id_theme, statut, date_creation) 
                  VALUES (:titre, :image, :contrnue, :id_theme, :statut, :date_creation)";
    
        $stmt = $this->connect->prepare($query);
    
        $stmt->bindParam(":titre", $this->titre);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":contrnue", $this->contrnue);
        $stmt->bindParam(":id_theme", $this->id_theme);
        $stmt->bindParam(":statut", $this->statut);
        $stmt->bindParam(":date_creation", $this->date_creation);
    
        if ($stmt->execute()) {
            return true;
        } else {
            print_r($stmt->errorInfo());
            return false;
        }
    }
    
    public function getArticle() {
        try {
            $sql = "SELECT * FROM article " ;
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


    public function getArticleById($id_article) {
        $query = "SELECT * FROM article WHERE id_article = $id_article";
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
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
    
    
    public function getTagsByArticle($id_article) {
        $sql = "SELECT tag.nom_tag 
                FROM tag 
                INNER JOIN articletag  ON tag.id_tag = articletag.id_tag
                WHERE id_article = :id_article";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':id_article', $id_article);
        
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    
    public function getArticlestatus() {
        try {
            $sql = "SELECT * FROM article WHERE statut='accepte'";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error retrieving article: " . $e->getMessage();
            return [];
        }
    }
    
    public function getArticlesPaginated($offset, $limit) {
        $query = "SELECT * FROM article WHERE statut = 'accepte' LIMIT :offset, :limit";
        $stmt = $this->connect->prepare($query);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTotalArticles() {
        try {
            $sql = "SELECT COUNT(*) FROM article WHERE statut = 'accepte'"; 
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
            return $stmt->fetchColumn(); 
        } catch (PDOException $e) {
            echo "Error retrieving total articles: " . $e->getMessage();
            return 0; 
        }
    }
    public function accepter($id_article) {
        $sql = "UPDATE article SET statut = 'accepte' WHERE id_article = :id_article";
        
        try {
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'acceptation de l'article: " . $e->getMessage();
            return false;
        }
    }
    public function addArticleadmin($image, $titre, $contrnue, $id_theme, $id_tag, $statut = 'accepte') {
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

    public function updatearticle($id_article, $titre, $image, $date_creation, $id_theme, $statut, $contrnue) {
        $query = "UPDATE article SET titre = :titre, image = :image, date_creation = :date_creation, id_theme = :id_theme, statut = :statut, contrnue = :contrnue WHERE id_article = :id_article";
    
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':date_creation', $date_creation);
        $stmt->bindParam(':id_theme', $id_theme);
        $stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':contrnue', $contrnue);
        $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    
    public function deletearticle($id_article) {
        $query = "DELETE FROM `article` WHERE id_article = $id_article";
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
    }
    public function searchArticlesByTitle($title) {
        $query = "SELECT * FROM article WHERE titre LIKE :title AND statut = 'accepte'";  // 'accepte' pour articles validés
        $stmt = $this->connect->connect->prepare($query);
        $stmt->bindValue(':title', '%' . $title . '%', PDO::PARAM_STR);  // Utilisation de LIKE pour la recherche
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retourner les articles trouvés
    }
  
    
    
    public function getArticlesByTheme($id_theme, $offset, $limit) {
        $query = "SELECT * FROM article WHERE id_theme = :id_theme LIMIT :offset, :limit";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_theme', $id_theme, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    
    
    }
    

    
    





<?php
class Favorites {
    private $db;
    private $conn;

    public function __construct(Database $db) {
        $this->db = $db;
        $this->conn = $this->db->getConnection();
    }

    public function isArticleInFavorites($id_user, $id_article) {
        $query = "SELECT * FROM favories WHERE id_user = :id_user AND id_article = :id_article";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0; 
    }

    public function addArticleToFavorites($id_user, $id_article) {
        if ($this->isArticleInFavorites($id_user, $id_article)) {
            return false; 
        }

        $query = "INSERT INTO favories (id_user, id_article) VALUES (:id_user, :id_article)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
        return $stmt->execute(); 
    }

    public function suppArticleToFavorites($id_user, $id_article) {
        if (!$this->isArticleInFavorites($id_user, $id_article)) {
            return false; 
        }
    
        $query = "DELETE FROM favories WHERE id_user = :id_user AND id_article = :id_article";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
        return $stmt->execute();
    }
    



    public function getFavoritesByUser($id_user) {
        $query = "SELECT article.id_article, article.titre, article.image, article.date_creation, article.contrnue
                  FROM favories
                  JOIN article ON favories.id_article = article.id_article
                  WHERE favories.id_user = :id_user";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}
?>

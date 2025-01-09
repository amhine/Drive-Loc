<?php 

class Commentaire {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addCommentaire($id_user, $id_article, $contenue) {
        $query = "INSERT INTO `commentaire` (`contenu`, `creation`, `id_article`, `id_user`) 
                  VALUES ('$contenue', NOW(), '$id_article', '$id_user')";
        
        return $this->conn->exec($query);  
    }

   
    public function getCommentairesByArticle($id_article) {
        $query = "SELECT c.id_commentaire, c.contenu, c.creation, u.nom_user
                  FROM commentaire c
                  JOIN utilisateur u ON c.id_user = u.id_user  
                  WHERE c.id_article = '$id_article'";
    
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function deleteCommentaire($id_commentaire) {
        $stmt = $this->conn->prepare("DELETE FROM commentaire WHERE id_commentaire = :id_commentaire");
        $stmt->bindParam(':id_commentaire', $id_commentaire, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return true; 
        } else {
            throw new Exception("Impossible de supprimer le commentaire.");
        }
    }
    
   
   
    public function getCommentaireById($id_commentaire) {
        $id_commentaire = $id_commentaire; 
        
        $query = "SELECT * FROM commentaire WHERE id_commentaire = $id_commentaire";
        return $this->conn->query($query)->fetch(PDO::FETCH_ASSOC);
    }

     public function updateCommentaire($id_commentaire, $new_content) {
        $query = "UPDATE commentaire SET contenu = :new_content WHERE id_commentaire = :id_commentaire";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':new_content', $new_content);
        $stmt->bindParam(':id_commentaire', $id_commentaire, PDO::PARAM_INT);
        $stmt->execute();
    }
    

    public function getCommentByArticle($id_article) {
        $query = "SELECT * FROM commentaire WHERE id_article = '$id_article'";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

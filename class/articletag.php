<?php
class ArticleTag {
    private $conn;

    public $id_article;
    public $id_tag;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO articletag (id_article, id_tag) VALUES (:id_article, :id_tag)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_article", $this->id_article);
        $stmt->bindParam(":id_tag", $this->id_tag);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Erreur lors de l'ajout de la relation dans articletag.";
            return false;
        }
    }

    // Récupérer les tags associés à un article
    public function getTagsForArticle($id_article) {
        // Exemple de requête pour récupérer les tags pour un article
        $query = "SELECT nom_tag FROM tag 
                  JOIN articletag ON tag.id_tag = articletag.id_tag
                  WHERE articletag.id_article = :id_article";
        
        $stmt = $this->conn->prepare($query); // Remplacer $conn par $this->conn
        $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourner les tags associés
    }
}
?>

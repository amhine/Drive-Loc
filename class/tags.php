
<?php
class Tag {
    private $conn;

    public $id_tag;
    public $nom_tag;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO `tag`( `nom_tag`) VALUES (:nom_tag)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nom_tag", $this->nom_tag);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAll() {
        $query = "SELECT * FROM tag" ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getNom() {
        $query = " SELECT nom_tag FROM `tag` " ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function getTagsByArticleId($id_article) {
        $query = "SELECT tag.nom_tag
                  FROM tag 
                  INNER JOIN articletag  ON tag.id_tag = articletag.id_tag
                  WHERE articletag.id_article = :id_article";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>

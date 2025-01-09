<?php
class Tag {
    private $conn;
    public $id_tag;
    public $nom_tag;

    // Constructeur
    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO tag  (nom_tag) VALUES (:nom_tag)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom_tag', $this->nom_tag);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Lire tous les tags
    public function read() {
        $query = "SELECT id_tag, nom_tag FROM tag" ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Lire un tag par son ID
    public function readOne() {
        $query = "SELECT id_tag, nom_tag FROM tag WHERE id_tag = :id_tag";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_tag", $this->id_tag);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->nom_tag = $row['nom_tag'];
            return true;
        }

        return false;
    }

    // Mettre à jour un tag
    public function update() {
        $query = "UPDATE tag SET nom_tag = :nom_tag WHERE id_tag = :id_tag";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom_tag', $this->nom_tag);
        $stmt->bindParam(':id_tag', $this->id_tag);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Supprimer un tag
    public function delete() {
        $query = "DELETE FROM tag WHERE id_tag = :id_tag";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_tag", $this->id_tag);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>

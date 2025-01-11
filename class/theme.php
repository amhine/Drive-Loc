<?php

class Theme {
    public $connect;

    public $id_theme;
    public $nom_theme;
    public $description;
   


     public function __construct($connect) {
        $this->connect = $connect;
    }
    public function addtheme($nom_theme, $description) {
        $query = "INSERT INTO theme (nom_theme, description) VALUES (:nom_theme, :description)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':nom_theme', $nom_theme);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }
    
    public function getTheme() {
        try {
            $sql = "SELECT * FROM theme";
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error retrieving categories: " . $e->getMessage();
            return [];
        }
    }
    public function getAllTheme() {
        $query = "SELECT * FROM theme";
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getthemeById($id_theme) {
        $id_theme = $id_theme; 
        
        $query = "SELECT * FROM theme WHERE id_theme = $id_theme";
        return $this->connect->query($query)->fetch(PDO::FETCH_ASSOC);
    }

    public function updatetheme($id_theme, $new_nom_theme,$new_description) {
        $query = "UPDATE theme SET nom_theme = :new_nom_theme, description = :new_description WHERE id_theme = :id_theme";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':new_nom_theme', $new_nom_theme);
        $stmt->bindParam(':new_description', $new_description);
        $stmt->bindParam(':id_theme', $id_theme);
        return $stmt->execute();
    }

    public function deletetheme($id_theme) {
        try {
            $query = "DELETE FROM theme WHERE id_theme = :id_theme";
            $stmt = $this->connect->prepare($query);
            return $stmt->execute(['id_theme' => $id_theme]);
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la theme : " . $e->getMessage();
            return false;
        }
    }
   
    

}
<?php

class Theme {
    public $connect;

    public $id_theme;
    public $nom_theme;
    public $description;
    public $image;


     public function __construct($connect) {
        $this->connect = $connect;
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



}
<?php
include './conexion.php';
require './../class/categorier.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $image = $_POST['image']; 

   
    if (!empty($nom) && !empty($description) && !empty($image)) {
        $db = new Database();
        $categorie = new Categorie($db);

        $categorie->addCategorie($nom, $description, $image);
        header("Location: dashbord.php");
        exit();
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

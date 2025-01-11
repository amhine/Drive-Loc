<?php
include './conexion.php';
require './../class/theme.php';

$connect = new Database();
$theme = new Theme($connect);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_theme = $_POST['nom_theme'];
    $description = $_POST['description'];

    if (!empty($nom_theme) && !empty($description) ) {
        $result = $theme->addtheme( $nom_theme, $description);

        if ($result) {
            header("Location: dashbord.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout de theme.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

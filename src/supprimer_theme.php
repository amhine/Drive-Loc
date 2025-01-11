<?php
include './conexion.php';
require './../class/theme.php';

$db = new Database();
$theme = new Theme($db);

if (isset($_POST['id_theme']) && !empty($_POST['id_theme'])) {
    $id = $_POST['id_theme'];
    $theme->deletetheme($id);

    header('Location: dashbord.php'); 
    exit();
} else {
    echo "Erreur : ID de la theme manquant.";
}
?>

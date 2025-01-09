<?php
session_start();
require './conexion.php';
require './../class/comentaire.php';
require './../class/article.php';

$db = new Database();
$article = new Article($db); 
$articles = $article->getArticle();

if (!isset($_SESSION['id_user'])) {
    echo "L'utilisateur n'est pas connecté.";
    exit();
}

$id_user = $_SESSION['id_user']; 
if (isset($_POST['id_article'])) {
    $id_article = $_POST['id_article']; 
} else {
    echo "Erreur : L'id de l'article est manquant.";
    exit();
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un commentaire</title>
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen m-0">
    <form action="script_comentaire.php" method="POST" enctype="multipart/form-data" id="addreservationForm">
        <div class="max-w-[800px] w-full max-h-[500px] bg-white rounded-lg shadow-lg ">
            <div class="px-8 py-4 bg-blue-400 text-white">
                <h1 class="flex justify-center font-bold text-white text-3xl">Ajouter une commentaire</h1>
            </div>
            <div class="px-8 py-6">
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="contenue">Contenu :</label>
                    <textarea class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="contenue" name="contenue" placeholder="Écrivez votre commentaire ici..." required></textarea>
                </div>

                <input type="hidden" name="id_article" value="<?php echo $id_article; ?>">
                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">

                <div class="flex justify-between mt-8">
                    <a href="article.php" class="text-white bg-red-600 w-40 rounded-lg py-3 hover:bg-red-800 cursor-pointer flex justify-center">Annuler</a>
                    <button type="submit" class="text-white bg-blue-600 w-40 rounded-lg py-3 hover:bg-blue-800 cursor-pointer">Ajouter</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>

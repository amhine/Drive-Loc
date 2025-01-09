<?php
session_start();
require './conexion.php';
require './../class/comentaire.php';

if (!isset($_SESSION['id_user'])) {
    echo "L'utilisateur n'est pas connecté.";
    exit();
}
$db=new Database();
$commentaire = new Commentaire($db);

if (isset($_GET['id_commentaire'])) {
    $id_commentaire = $_GET['id_commentaire'];
    $comment = $commentaire->getCommentaireById($id_commentaire);
    if ($_SESSION['id_user'] != $comment['id_user']) {
        echo "Vous n'êtes pas autorisé à modifier ce commentaire.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_content = $_POST['contenu'];
    $commentaire->updateCommentaire($id_commentaire, $new_content);
    header("Location: article.php?id_article=" . $comment['id_article']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
    
    
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen m-0">

    <form  method="POST" >
        <div class="max-w-[800px] w-full max-h-[500px] bg-white rounded-lg shadow-lg ">
            <div class="px-8 py-4 bg-blue-400 text-white">
                <h1 class="flex justify-center font-bold text-white text-3xl">Modifier une commentaire</h1>
            </div>
            <div class="px-8 py-6">
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="contenue">Contenu :</label>
                    <textarea class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="contenue" name="contenu"  required><?php echo ($comment['contenu']); ?></textarea>
                </div>

                <div class="flex justify-between mt-8">
                    <a href="article.php" class="text-white bg-red-600 w-40 rounded-lg py-3 hover:bg-red-800 cursor-pointer flex justify-center">Annuler</a>
                    <button type="submit" class="text-white bg-blue-600 w-40 rounded-lg py-3 hover:bg-blue-800 cursor-pointer">Mettre à jour</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>



<?php

require './conexion.php';
require './../class/theme.php';
require './../class/tags.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une article</title>
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
</head>
<body  class="bg-gray-100 flex justify-center items-center min-h-screen m-0">
    <div class="container">

        <!-- Formulaire pour ajouter une catégorie -->
        <form action="script_article.php" method="POST" id="add">
            <div class="max-w-[800px] w-full max-h-[500px] bg-white rounded-lg shadow-lg overflow-y-scroll ">
                <div class="px-8 py-4 bg-blue-400 text-white">
                    <h1 class="flex justify-center font-bold text-white text-3xl">Article</h1>
                </div>
                <div class="px-8 py-6">

                <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="url" id="photo">Images :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="url" name="image" type="text" placeholder="https://" required>
                        
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="titre" id="titre">Titre :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="titre" name="titre" type="text" placeholder="titre" required>
                        
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="contrnue">Contenu :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="contrnue" name="contrnue" type="text" placeholder="contenue" required>
                        
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="id_theme">Sélectionner un Thème :</label>
                        <select class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" 
                                id="id_theme" name="id_theme" required>
                            <option value="">Choisissez un thème</option>
                            <?php
                            $db = new Database();
                            $query = "SELECT * FROM theme";
                            $result = $db->connect->query($query);
                            while ($theme = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$theme['id_theme']}'>{$theme['nom_theme']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="id_tag">Sélectionner un Tags :</label>
                        <select class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" 
                                id="id_tag" name="id_tag" required>
                            <option value="">Choisissez un tag</option>
                            <?php
                            $db = new Database();
                            $query = "SELECT * FROM tag";
                            $result = $db->connect->query($query);
                            while ($tag = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$tag['id_tag']}'>{$tag['nom_tag']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                   

                   

                    <div class="flex justify-between mt-8">
                        <a href="article.php" class="text-white bg-red-600 w-40 rounded-lg py-3 hover:bg-red-800 cursor-pointer flex justify-center">
                            Cancel
                        </a>
                        <button type="submit" class="text-white bg-blue-600 w-40 rounded-lg py-3 hover:bg-blue-800 cursor-pointer">
                            Add
                        </button>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</body>
</html>

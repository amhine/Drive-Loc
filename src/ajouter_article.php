<?php
require './conexion.php';
require './../class/theme.php';
require './../class/tags.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un article</title>
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
    
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen m-0">
    <div class="container">
        <!-- ajouter un article -->
        <form action="script_article.php" method="POST" id="add">
            <div class="max-w-[800px] w-full max-h-[500px] bg-white rounded-lg shadow-lg overflow-y-scroll">
                <div class="px-8 py-4 bg-blue-400 text-white">
                    <h1 class="flex justify-center font-bold text-white text-3xl">Article</h1>
                </div>
                <div class="px-8 py-6">
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="image">Image :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="image" name="image" type="text" placeholder="https://" required>
                    </div>

                    
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="titre">Titre :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="titre" name="titre" type="text" placeholder="Titre" required>
                    </div>

                    
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="contrnue">Contenu :</label>
                        <textarea class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="contrnue" name="contrnue" type="text" placeholder="Contenu" required></textarea>
                    </div>

                    
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="id_theme">Sélectionner un Thème :</label>
                        <select class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="id_theme" name="id_theme" required>
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
                        <label class="block text-gray-700 font-semibold mb-2" for="id_tag">Sélectionner des Tags :</label>
                        <select class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="id_tag" name="id_tag[]"  required>
                            <option value="0">Choisissez des tags</option>
                            <?php
                            $query = "SELECT * FROM tag";
                            $result = $db->connect->query($query);
                            while ($tag = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$tag['id_tag']}'>{$tag['nom_tag']}</option>";
                            }
                            ?>
                        </select>
                        <button type="button" onclick="addTag()" class="mt-2 bg-blue-500 text-white p-2 rounded">Ajouter le tag</button>
                    </div>

                
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Tags sélectionnés :</label>
                    <ul id="tagList" class="list-disc pl-5"></ul>
                </div>

                
                <div id="tagsContainer" style="display: none;"></div>

                    
                    <div class="flex justify-between mt-8">
                        <a href="article.php" class="text-white bg-red-600 w-40 rounded-lg py-3 hover:bg-red-800 cursor-pointer flex justify-center">Cancel</a>
                        <button type="submit" class="text-white bg-blue-600 w-40 rounded-lg py-3 hover:bg-blue-800 cursor-pointer">Ajouter</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script>
function addTag() {
    var tagSelect = document.getElementById('id_tag');
    var tagList = document.getElementById('tagList');
    var selectedTag = tagSelect.options[tagSelect.selectedIndex].text;
    var selectedTagValue = tagSelect.value;

    if (selectedTagValue != '' && !document.getElementById('tag-' + selectedTagValue)) {
        var listItem = document.createElement('li');
        listItem.id = 'tag-' + selectedTagValue;
        listItem.innerHTML = selectedTag + ' <button type="button" onclick="removeTag(' + selectedTagValue + ')">X</button>';
        tagList.appendChild(listItem);

        var hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'id_tag[]';
        hiddenInput.value = selectedTagValue;
        document.getElementById('tagsContainer').appendChild(hiddenInput);
    }
}

function removeTag(tagId) {
    var tagItem = document.getElementById('tag-' + tagId);
    var tagList = document.getElementById('tagList');
    tagList.removeChild(tagItem);

    var hiddenInputs = document.getElementsByName('id_tag[]');
    for (var i = 0; i < hiddenInputs.length; i++) {
        if (hiddenInputs[i].value == tagId) {
            hiddenInputs[i].parentNode.removeChild(hiddenInputs[i]);
            break;
        }
    }
}

    </script>
</html>

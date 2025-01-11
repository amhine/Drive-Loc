<?php
include './conexion.php'; 
require './../class/article.php';
require './../class/theme.php'; 
$db = new Database();
$article = new Article($db);
$theme = new Theme($db);

if (isset($_GET['id_article'])) {
    $id_article = intval($_GET['id_article']);

    $art = $article->getarticleById($id_article); 
    if (!$art) {
        echo "article non trouvé.";
        exit();
    }

    $themes = $theme->getAllTheme();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titre = $_POST['titre'];
        $image = $_POST['image'];
        $statut = isset($_POST['statut']) ? $_POST['statut'] : 'accepte'; 
        $contrnue = $_POST['contrnue'];
        $id_theme = $_POST['id_theme']; 
        $date_creation = isset($_POST['date_creation']) ? $_POST['date_creation'] : date('Y-m-d H:i:s');  
    
        $query = "SELECT COUNT(*) FROM theme WHERE id_theme = :id_theme";
        $stmt = $db->connect->prepare($query);
        $stmt->bindParam(':id_theme', $id_theme, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();
    
        if ($count == 0) {
            echo "Le thème sélectionné n'existe pas.";
            exit();
        }
        $updateSuccess = $article->updatearticle($id_article, $titre, $image, $date_creation, $id_theme, $statut, $contrnue);
        
        if ($updateSuccess) {
            echo "Article mis à jour avec succès.";
            header('Location: dashbord.php');
            exit();
        } else {
            echo "Erreur lors de la mise à jour de l'article.";
        }
    }
    
} else {
    echo "Aucun article sélectionné.";
    exit;
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le véhicule</title>
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
</head>
<body>
   

    <form  method="POST" id="add">
            <div class="max-w-[800px] w-full max-h-[500px] bg-white rounded-lg shadow-lg overflow-y-scroll ">
                <div class="px-8 py-4 bg-blue-400 text-white">
                    <h1 class="flex justify-center font-bold text-white text-3xl">Article</h1>
                </div>
                <div class="px-8 py-6">

                <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="url" id="photo">Images :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="url" value="<?php echo ($art['image']); ?>" name="image" type="text" placeholder="https://" required>
                        
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="titre" id="titre">Titre :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="titre" value="<?php echo ($art['titre']); ?>" name="titre" type="text" placeholder="titre" required>
                        
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="contrnue">Contenu :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="contrnue" value="<?php echo ($art['contrnue']); ?>" name="contrnue" type="text" placeholder="contenue" required>
                        
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="statut">Statut :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="statut" name="statut" type="text" value="accepte" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="date_creation">Date de création :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" 
                            id="date_creation" name="date_creation" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                    </div>

                   
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="id_theme">Sélectionner un Thème :</label>
                        <select class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" 
                            id="id_theme" name="id_theme" required>
                            <option value="">Choisissez un thème</option>
                            <?php
                                foreach ($themes as $theme) {
                                    echo "<option value='{$theme['id_theme']}'" . ($art['id_theme'] == $theme['id_theme'] ? " selected" : "") . ">{$theme['nom_theme']}</option>";
                                }
                            ?>
                        </select>
                    </div>

                    
                    <!-- <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2" for="id_tag">Sélectionner un Tags :</label>
                            <select class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" 
                                    id="id_tag" name="id_tag"  required>
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
                        </div> -->
                        
                   

                   

                    <div class="flex justify-between mt-8">
                        <a href="dashbord.php" class="text-white bg-red-600 w-40 rounded-lg py-3 hover:bg-red-800 cursor-pointer flex justify-center">
                            Cancel
                        </a>
                        <button type="submit" class="text-white bg-blue-600 w-40 rounded-lg py-3 hover:bg-blue-800 cursor-pointer">
                            Add
                        </button>
                    </div>
                </div>
            </div>
            
        </form>
</body>
</html>


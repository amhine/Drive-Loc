<?php
require './conexion.php';
require './../class/theme.php';


$db=new Database();
$theme = new Theme($db);

if (isset($_GET['id_theme'])) {
    $id_theme = $_GET['id_theme'];
    $the = $theme->getthemeById($id_theme);
    
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_nom_theme = $_POST['nom_theme'];
    $new_description = $_POST['description'];
    $theme->updatetheme($id_theme, $new_nom_theme,$new_description);
    header("Location: dashbord.php");
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

    
    <form method="POST" >
            <div class="max-w-[800px] w-full max-h-[500px] bg-white rounded-lg shadow-lg  ">
                <div class="px-8 py-4 bg-blue-400 text-white">
                    <h1 class="flex justify-center font-bold text-white text-3xl">Modifier une Themes</h1>
                </div>
                <div class="px-8 py-6">

               
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="nom_theme" id="nom_theme">Titre :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="nom_theme" name="nom_theme" type="text" placeholder="titre" value=" <?php echo ($the['nom_theme']); ?>" required>
                        
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="description">Description :</label>
                        <input class="appearance-none border border-gray-400 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" id="description" name="description" type="text" placeholder="description" value=" <?php echo ($the['description']); ?>" required>
                        
                    </div>
                   
                    
                   

                   

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

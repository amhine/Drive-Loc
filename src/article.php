

<?php
session_start(); 
require './conexion.php';
require './../class/comentaire.php';
require './../class/article.php';

$db = new Database();
$article = new Article($db); 
$commentaire = new Commentaire($db);

if (!isset($_SESSION['id_user'])) {
    echo "L'utilisateur n'est pas connecté.";
    exit();
}

$id_user = $_SESSION['id_user']; 





$articles = $article->getArticle();
$articles_per_page = isset($_GET['articles_per_page']) ? (int)$_GET['articles_per_page'] : 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $articles_per_page;

$articles = $article->getArticlesPaginated($offset, $articles_per_page);


$total_articles = $article->getTotalArticles();
$total_pages = ceil($total_articles / $articles_per_page);







?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
<body>
    <nav class="bg-gray-800 ">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="index.html" class="text-white text-2xl font-bold">
                Voi<span class="text-blue-400">Ture</span>
                </a>
            </div>
            
            <!-- Hamburger Menu (mobile) -->
            <div class="md:hidden">
                <button id="menu-toggle" class="text-gray-300 focus:outline-none focus:text-white">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
                </button>
            </div>
            
            <!-- Nav Links -->
            <div id="menu" class="hidden md:flex space-x-4">
            <a href="index.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
            <a href=" categorier.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Categorier</a>
            <a href="vehicule.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Vehicule</a>
            <a href="reservation.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Reservation</a>
            <a href="avis.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Avis</a>
            <a href="theme.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Théme</a>
            <a href="article.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Article</a>
            <a href="fave.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Favoris</a>
       </div>
            </div>
        </div>
    
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-gray-800">
            <a href="index.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
            <a href=" categorier.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Categorier</a>
            <a href="vehicule.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Vehicule</a>
            <a href="reservation.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Reservation</a>
            <a href="avis.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Avis</a>
            <a href="theme.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Théme</a>
            <a href="article.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Article</a>
            <a href="fave.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Favoris</a>
        </div>
    </nav>

    <div class="flex justify-end items-center m-5">
        <a href="ajouter_article.php" class="text-white bg-blue-600 rounded-lg w-56 h-10 text-lg font-bold hover:bg-red-700 transition-colors inline-block text-center">
            Ajouter Article
        </a>
    </div>

        <!-- Formulaire de recherche -->
    <div class="flex justify-end my-4 mr-6">
        <form action="" method="GET" class="flex items-center space-x-2">
            <input type="text" name="search" id="search" placeholder="Rechercher par nom" class="px-4 py-2 border border-gray-300 rounded-md" value="<?=($search); ?>">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                <i class="fa-solid fa-search"></i>
            </button>
        </form>
    </div>

    <form method="GET" class="m-4">
        <select name="articles_per_page" id="articles_per_page" class="border rounded-md px-3 py-2">
            <option value="5" <?php echo (isset($_GET['articles_per_page']) && $_GET['articles_per_page'] == 5) ? 'selected' : ''; ?>>5</option>
            <option value="10" <?php echo (isset($_GET['articles_per_page']) && $_GET['articles_per_page'] == 10) ? 'selected' : ''; ?>>10</option>
            <option value="15" <?php echo (isset($_GET['articles_per_page']) && $_GET['articles_per_page'] == 15) ? 'selected' : ''; ?>>15</option>
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md ml-2">Appliquer</button>
    </form>


    <div id="vehicles-container" class="reservation-card bg-white border border-gray-300 rounded-lg shadow-lg p-6 hover:shadow-xl transition-transform transform hover:-translate-y-2">
        <div class="space-y-6">
            <?php foreach ($articles as $article):
            ?>
            

            <div class="flex flex-col items-center text-center"> 
                <h1 class="text-lg font-bold text-blue-600 mb-2"><?php echo ($article['titre']); ?></h1>
            </div>
            <div class="flex flex-col items-start text-left w-full">
           
                
                <img src="<?php echo ($article['image']); ?>" alt="vehicle-<?php echo ($article['titre']); ?>" class="object-cover h-96 w-full md:w-3/4 lg:w-3/4 xl:w-1/3 p-4 mx-auto mb-4 rounded-lg">

                <p class="text-sm text-gray-600 mb-4">Créé le : <?php echo ($article['date_creation']); ?> </p>
                <!-- <p class="text-sm text-gray-600 mb-4">Tags :<?php echo ($tag['nom_tag']); ?> </p> -->
       
  
                <p class="text-sm text-gray-600 mb-4"><?php echo ($article['contrnue']); ?> </p>

                <!-- Section des commentaires -->
                <div class="w-full mt-4">
                    <h2 class="text-lg font-bold text-blue-600 mb-4">Commentaires :</h2>
                
                    <!-- Affichage des commentaires -->
                    <?php 
                        $comments = $commentaire->getCommentairesByArticle($article['id_article']);
                        foreach ($comments as $comment): ?>
                    <div class="border-b border-gray-300 pb-4 mb-4">
                        <!-- Commenter's name and date -->
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="text-xs font-semibold text-gray-600"><?php echo $comment['nom_user']; ?></span>
                        <span class="text-xs text-gray-400">le <?php echo $comment['creation']; ?></span>
                    </div>
                    <!-- Comment content -->
                    <p class="text-sm text-gray-700"><?php echo $comment['contenu']; ?></p>

                    <!-- Actions pour la modification et la suppression -->
               


                    <div class="mt-auto flex justify-end gap-4">
                        <a href="modifier_comment.php?id_commentaire=<?php echo $comment['id_commentaire']; ?>" class="text-white bg-yellow-500 rounded-lg px-4 py-2 hover:bg-yellow-600 transition-colors">
                            <img src="../img/edit.png" class="h-6">
                        </a>

                        <form action="suprimercommentaire.php" method="POST">
                            <input type="hidden" name="id_commentaire" value="<?php echo $comment['id_commentaire']; ?>">
                            <button type="submit" class="text-white bg-red-600 rounded-lg px-4 py-2 hover:bg-red-700 transition-colors">
                                <img src="../img/delete.png" class="h-6">
                            </button>
                        </form>

                    </div>
                </div>
                <?php endforeach; ?>
                
        </div>
                   
        </div>

            <!-- Formulaire de commentaire -->
            <div class="w-full mt-6">
                <form action="commentaire.php" method="POST" class="flex flex-col space-y-4">
                    <input type="hidden" name="id_article" value="<?php echo $article['id_article']; ?>">
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">

                    
                    <div class="flex justify-between items-center">
                        <button type="submit" class="text-white bg-blue-600 rounded-lg w-full p-1 sm:w-auto h-10 text-lg font-bold hover:bg-blue-800 transition-colors">
                            Commenter
                        </button>
                        <a href="add_favorite.php?id_article=<?php echo $article['id_article']; ?>" class="flex items-center">
                            <img src="../img/favouri.png" alt="Ajouter aux favoris" class="h-10">
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="flex justify-center items-center space-x-2 mt-8">
    <!-- Bouton "Précédente" -->
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>&articles_per_page=<?php echo $articles_per_page; ?>" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition-colors">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
    <?php else: ?>
        <span class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md cursor-not-allowed">
            <i class="fa-solid fa-chevron-left"></i>
        </span>
    <?php endif; ?>

    <!-- Numéros de pages -->
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?php echo $i; ?>&articles_per_page=<?php echo $articles_per_page; ?>" class="px-4 py-2 <?php echo $i == $page ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800'; ?> rounded-md hover:bg-blue-500 hover:text-white transition-colors">
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>

    <!-- Bouton "Suivante" -->
    <?php if ($page < $total_pages): ?>
        <a href="?page=<?php echo $page + 1; ?>&articles_per_page=<?php echo $articles_per_page; ?>" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition-colors">
            <i class="fa-solid fa-chevron-right"></i>
        </a>
    <?php else: ?>
        <span class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md cursor-not-allowed">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
    <?php endif; ?>
</div>



    <footer class="bg-gray-800 text-gray-300 py-10 mt-12">
        <div class="container mx-auto px-4">
        <!-- Main Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
            <!-- Logo and Description -->
            <div>
                <h2 class="text-2xl font-bold text-white">
                    <a href="#" class="hover:text-amber-500">Voi<span class="text-blue-400">Ture</span></a>
                </h2>
                <p class="mt-4 text-gray-400">
                    Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.
                </p>
                <ul class="flex space-x-4 mt-5">
                    <li><a href="#" class="text-gray-400 hover:text-white"><span class="icon-twitter"></span></a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white"><span class="icon-facebook"></span></a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white"><span class="icon-instagram"></span></a></li>
                </ul>
            </div>
            <!-- Information Section -->
            <div>
                <h2 class="text-lg font-bold text-white">Information</h2>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="hover:text-white">About</a></li>
                    <li><a href="#" class="hover:text-white">Services</a></li>
                    <li><a href="#" class="hover:text-white">Terms and Conditions</a></li>
                    <li><a href="#" class="hover:text-white">Best Price Guarantee</a></li>
                    <li><a href="#" class="hover:text-white">Privacy & Cookies Policy</a></li>
                </ul>
            </div>
            <!-- Customer Support Section -->
            <div>
                <h2 class="text-lg font-bold text-white">Customer Support</h2>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="hover:text-white">FAQ</a></li>
                    <li><a href="#" class="hover:text-white">Payment Option</a></li>
                    <li><a href="#" class="hover:text-white">Booking Tips</a></li>
                    <li><a href="#" class="hover:text-white">How it Works</a></li>
                    <li><a href="#" class="hover:text-white">Contact Us</a></li>
                </ul>
            </div>
            <!-- Questions Section -->
            <div>
                <h2 class="text-lg font-bold text-white">Have a Question?</h2>
                <ul class="mt-4 space-y-3">
                    <li class="flex items-start">
                        <span class="icon-map-marker text-amber-500 mr-3"></span>
                        <span>203 Fake St. Mountain View, San Francisco, California, USA</span>
                    </li>
                    <li class="flex items-start">
                        <span class="icon-phone text-amber-500 mr-3"></span>
                        <a href="tel:+23923929210" class="hover:text-white">+2 392 3929 210</a>
                    </li>
                    <li class="flex items-start">
                        <span class="icon-envelope text-amber-500 mr-3"></span>
                        <a href="mailto:info@yourdomain.com" class="hover:text-white">info@yourdomain.com</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Copyright -->
        <div class="text-center border-t border-gray-700 pt-6">
            <p class="text-sm text-gray-400">
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with 
                <i class="icon-heart text-amber-500"></i> by 
                <a href="https://colorlib.com" target="_blank" class="hover:text-amber-500">Colorlib</a>
            </p>
        </div>
        </div>
    </footer>
</body>
</html>
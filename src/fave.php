
<?php
session_start(); 
require './conexion.php';
require './../class/favorirs.php'; 

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php"); 
    exit();
}

$id_user = $_SESSION['id_user'];

$db = new Database();
$favorites = new Favorites($db);

$articles_favoris = $favorites->getFavoritesByUser($id_user);
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
    <div class="container mx-auto p-6">

     <?php if (count($articles_favoris) > 0): ?>
        
                                
        <div class="flex flex-col items-center text-center bg-white shadow-md rounded-lg p-4 transition-transform transform hover:scale-105">
            <?php foreach ($articles_favoris as $article): ?>
                <div class=" flex justify-end">
                        
                        <a href="suprimer_favorite.php?id_article=<?php echo $article['id_article']; ?>" class="flex items-center">
                        <img src="../img/dislike.png" alt="Ajouter aux favoris" class="h-10">
                        </a>
                    </div>
                   
                <div class="flex flex-col items-center text-center">
                   
                    <h1 class="text-lg font-bold text-blue-600 mb-2"><?php echo ($article['titre']); ?></h1> 
                    
                    
                    <img src="<?php echo ($article['image']); ?>" alt="vehicle-<?php echo ($article['titre']); ?>" class="object-cover h-96 w-full md:w-3/4 lg:w-3/4 xl:w-1/3 p-4 mx-auto mb-4 rounded-lg">

                    <p class="text-sm text-gray-600 mb-4">Créé le : <?php echo ($article['date_creation']); ?> </p>
                    <p class="text-sm text-gray-600 mb-4"><?php echo ($article['contrnue']); ?> </p>

                   
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-gray-600 text-center">Vous n'avez aucun article dans vos favoris.</p>
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
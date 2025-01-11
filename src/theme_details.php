<?php
include './conexion.php'; 
require './../class/article.php'; 
require './../class/theme.php'; 

$db = new Database();
$theme = new Theme($db);
$article = new Article($db);

if (isset($_GET['id_theme'])) {
    $id_theme = intval($_GET['id_theme']); 
    $articles = $article->getarticleBytheme($id_theme);  

    if (empty($articles)) {
        $message = "Aucun article trouvé pour ce thème.";
    }
} else {
    die("Aucun thème sélectionné.");
}
?>


<!DOCTYPE html>
<html lang="fr">
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



        <div class="reservation-card bg-white border border-gray-300 rounded-lg shadow-lg p-6 hover:shadow-xl transition-transform transform hover:-translate-y-2">
                    <div class="mt-6 text-right mb-5 text-xl font-bold">
                            <a href="theme.php" class="text-blue-500 font-semibold hover:underline">Retour aux themes</a>
                        </div>
                    

                        <div class=" ">
                        <?php foreach ($articles as $article): ?>
                            <div class="flex flex-col items-center text-center">
            <h1 class="text-lg font-bold text-blue-600 mb-2"><?php echo ($article['titre']); ?></h1>
            
            <!-- Image with proper responsive handling -->
            <img src="<?php echo ($article['image']); ?>" alt="vehicle-<?php echo ($article['titre']); ?>" class="object-cover h-96 w-full md:w-3/4 lg:w-3/4 xl:w-1/3 p-4 mx-auto mb-4 rounded-lg">

            <p class="text-sm text-gray-600 mb-4 ">Créé le : <?php echo ($article['date_creation']); ?> </p>
            <p class="text-sm text-gray-600 mb-4"><?php echo ($article['contrnue']); ?> </p>

            <form action="commentaire.php" method="POST">
                <input type="hidden" name="id_vehicule" value="<?php echo $article['id_article']; ?>">
                <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>"> 
                
                <div class="flex justify-evenly gap-48 mt-4">

                    <button type="submit" class="text-white bg-blue-600 rounded-lg w-56 h-10 text-lg font-bold hover:bg-red-700 transition-colors">
                        Commenter
                    </button>
                    
                    <a href="comments.php?id_article=<?php echo $article['id_article']; ?>" class="block text-blue-600 font-semibold hover:underline">
                        Voir les commentaires
                    </a>

                    <a href="add_favorite.php?id_article=<?php echo $article['id_article']; ?>" class="flex items-center">
                        <img src="../img/favouri.png" alt="Ajouter aux favoris" class="h-10">
                    </a>
                </div>
            </form>
        </div>
<?php endforeach; ?>

            </div>
                    </div>

        </div>

        <footer class="bg-gray-800 text-gray-300 py-10 mt-8">
            <div class="container mx-auto px-4">
            <!-- Section principale -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
            <!-- Logo et description -->
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
            <!-- Section Information -->
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
            <!-- Section Support Client -->
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
            <!-- Section Questions -->
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

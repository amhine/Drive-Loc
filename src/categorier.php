<?php

require './conexion.php';
require './../class/categorier.php';

$db = new Database();
$categorie = new Categorie($db); 
$categories = $categorie->getCategories();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="input.css">
    <link rel="stylesheet" href="output.css">
</head>
<body>
    <nav class="bg-gray-800 mb-8">
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
                <a href="categorier.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">categorier</a>
                <a href="vehicule.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">vehicule</a>
                <a href="reservation.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">reservation</a>
                <a href="avis.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">avis</a>
            </div>
            </div>
        </div>
    
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-gray-800">
            <a href="index.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
            <a href=" categorier.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">categorier</a>
            <a href="vehicule.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">vehicule</a>
            <a href="reservation.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">reservation</a>
            <a href="avis.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">avis</a>
        </div>
    </nav>
    <!-- <div class="flex flex-wrap justify-center gap-6"> -->
        <!-- Card 1 -->
        <!-- <a href="/fr-fr/p/location-voiture" class="flex flex-col items-center text-center bg-white shadow-md rounded-lg p-4 transition-transform transform hover:scale-105">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Voiture</h3>
            <p class="text-sm text-gray-600 mb-4">Faites votre choix parmi nos véhicules compactes et économiques</p>
            <div class="mt-auto">
            <img src="https://images.ctfassets.net/wmdwnw6l5vg5/71jz89dFBIdA9KHrLh8T0h/17b4d734873752637d3f5dd770838f0b/city_car_fr.png" alt="vehicle-type-car" class="w-32 h-24 object-cover mx-auto">
            <span class="mt-4 block text-blue-600 font-semibold hover:underline">Voir plus</span>
            </div>
        </a> -->

        <!-- Card 2 -->
        <!-- <a href="/fr-fr/p/location-voiture/flotte/type/electrique" class="flex flex-col items-center text-center bg-white shadow-md rounded-lg p-4 transition-transform transform hover:scale-105">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Électrique / Hybride</h3>
            <p class="text-sm text-gray-600 mb-4">Découvrez notre gamme de voitures électriques et hybrides</p>
            <div class="mt-auto">
            <img src="https://images.ctfassets.net/wmdwnw6l5vg5/7eSknBlxG6vxlTW1aPj3Ao/26ad4a20195d62136c47061ae6bca45e/unnamed__4_.png" alt="zoe-hp" class=" h-24 w-32 object-cover mx-auto">
            <span class="mt-4 block text-blue-600 font-semibold hover:underline">Voir plus</span>
            </div>
        </a> -->

        <!-- Card 3 -->
        <!-- <a href="/fr-fr/p/location-voiture/flotte/type/premium" class="flex flex-col items-center text-center bg-white shadow-md rounded-lg p-4 transition-transform transform hover:scale-105">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Premium</h3>
            <p class="text-sm text-gray-600 mb-4">Découvrez les plus prestigieuses grâce à notre flotte Premium</p>
            <div class="mt-auto">
            <img src="https://images.ctfassets.net/wmdwnw6l5vg5/FKkhunbxg0hIIHkl7tOkM/fd6d1f74973199ea34f4f88d62a8408a/fr.png" alt="vehicle-type-luxury" class="w-36 h-24 object-cover mx-auto">
            <span class="mt-4 block text-blue-600 font-semibold hover:underline">Voir plus</span>
            </div>
        </a> -->

        <!-- Card 4 -->
        <!-- <a href="/fr-fr/p/location-utilitaire" class="flex flex-col items-center text-center bg-white shadow-md rounded-lg p-4 transition-transform transform hover:scale-105">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Utilitaire</h3>
            <p class="text-sm text-gray-600 mb-4">Faites votre choix parmi notre vaste gamme de modèles</p>
            <div class="mt-auto">
            <img src="https://images.ctfassets.net/wmdwnw6l5vg5/7MXwlGGHdrV8aNmF2XQLED/52bcd78865a30f0ea5c8ec8cfd5bb360/Design_sans_titre__60_-removebg-preview.png" alt="vehicle-type-van" class=" h-24 w-36 object-cover mx-auto">
            <span class="mt-4 block text-blue-600 font-semibold hover:underline">Voir plus</span>
            </div>
        </a> -->
    <!-- </div> -->

    <div class="flex flex-wrap justify-center gap-6">
        <?php foreach ($categories as $cat): ?>
            <a href="categorie_details.php?id=<?php echo $cat['id_categorie']; ?>" 
            class="flex flex-col items-center text-center bg-white shadow-md rounded-lg p-4 transition-transform transform hover:scale-105 w-1/2 md:w-1/3 lg:w-1/4">
                <h3 class="text-lg font-bold text-gray-900 mb-2"><?php echo htmlspecialchars($cat['nom']); ?></h3>
                <p class="text-sm text-gray-600 mb-4"><?php echo htmlspecialchars($cat['description']); ?></p>
                <div class="mt-auto">
                    <img src="<?php echo htmlspecialchars($cat['image']); ?>" alt="vehicle-type-<?php echo strtolower($cat['nom']); ?>" class="w-36 h-24 object-cover mx-auto">
                    <span class="mt-4 block text-blue-600 font-semibold hover:underline">Voir plus</span>
                </div>
            </a>
        <?php endforeach; ?>

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
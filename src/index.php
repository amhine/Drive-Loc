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
    <div class="relative bg-cover bg-center " style="background-image: url('../img/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="absolute inset-0 bg-black opacity-50"></div> <!-- Overlay -->
        <div class="container relative z-10">
            <div class="flex items-center justify-center h-full text-center py-24">
            <div class="w-full lg:w-2/3">
                <div class="text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Fast &amp; Easy Way To Rent A Car</h1>
                <p class="text-lg md:text-xl mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts</p>
                
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto mt-12">
        <div class="flex flex-wrap">
            <!-- Image Section -->
            <div class="w-full md:w-1/2 bg-cover bg-center" style="background-image: url('../img/about.jpg');">
            </div>

            <!-- Text Section -->
            <div class="w-full md:w-1/2 bg-white flex items-center p-6 md:p-10">
                <div class="text-gray-800">
                    <span class="block text-lg text-blue-500 font-semibold mb-2">About us</span>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Welcome to Carbook</h2>

                    <p class="mb-4">
                        A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.
                    </p>
                    <p class="mb-6">
                        On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.
                    </p>
                    <a href="#" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600 transition">
                        Search Vehicle
                    </a>
                </div>
            </div>
        </div>
    </div>


    <footer class="bg-gray-800 text-gray-300 py-10 mt-12">
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
<script>
  // Toggle mobile menu
  const menuToggle = document.getElementById("menu-toggle");
  const menu = document.getElementById("menu");
  const mobileMenu = document.getElementById("mobile-menu");

  menuToggle.addEventListener("click", () => {
    menu.classList.toggle("hidden");
    mobileMenu.classList.toggle("hidden");
  });
</script>
</html>
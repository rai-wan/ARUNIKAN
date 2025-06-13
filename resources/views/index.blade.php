<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title>Arunikan - Single Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    
<header class="bg-blue-800 text-white py-4 px-6">
    <div class="flex justify-between items-center">
     
      <a href="/dashboard" class="text-sm underline hover:text-blue-200">← Kembali ke Dashboard</a>
    </div>
  </header>


    <!-- Sticky Navbar -->
    <nav id="navbar" class="sticky top-0 bg-white shadow z-50">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto">
                <span class="text-2xl font-bold text-blue-600">Arunikan</span>
            </div>
            <!-- Links + Search + Profile -->
            <div class="flex items-center space-x-6">
                <div class="space-x-4 hidden md:flex">
                    <a href="#home" class="nav-link text-gray-700 hover:text-blue-600">Home</a>
                    <a href="/shop" class="nav-link text-gray-700 hover:text-blue-600">Shop</a>
                    <a href="#about" class="nav-link text-gray-700 hover:text-blue-600">About</a>
                </div>
                <div class="hidden md:flex items-center space-x-2">
                    <input type="text" placeholder="Search..." class="px-3 py-1 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center cursor-pointer">👤</div>
                </div>
            </div>
        </div>
    </nav>

    <!-- HOME SECTION -->
    <section id="home" class="min-h-screen flex flex-col items-center bg-blue-100 px-6 pt-24 pb-12">
        <h1 class="text-4xl font-bold mb-8 text-center">WELCOME TO ARUNIKAN</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl w-full">
            <img src="{{ asset('images/logo.png') }}" alt="Gambar Toko" class="w-full h-48 object-cover rounded">
            <div class="bg-gray-200 w-full h-48 rounded p-4 text-gray-700">
                <strong>Arunikan</strong> adalah platform jual beli ikan hias yang menghubungkan pecinta ikan dengan berbagai jenis ikan berkualitas dari supplier terpercaya. Melalui sistem yang mudah digunakan, pelanggan dapat berbelanja secara online maupun langsung di toko fisik. Kami berkomitmen menghadirkan pelayanan terbaik, ketersediaan stok yang terjamin, dan pengalaman berbelanja ikan yang menyenangkan.
            </div>
        </div>
    </section>

    

    <!-- ABOUT SECTION -->
    <section id="about" class="min-h-screen px-6 py-12 bg-gray-300">
        <h2 class="text-2xl font-semibold mb-4">Tentang Arunikan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            <div>
                <p class="text-gray-700 mb-4">Arunikan adalah toko ikan hias terpercaya yang hadir untuk memenuhi kebutuhan para pecinta ikan. Dengan berbagai pilihan ikan yang sehat, tim profesional kami selalu siap melayani Anda baik online maupun langsung di toko.</p>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Kontak Kami</h3>
                <p class="text-gray-600 mb-1">📞 <a href="tel:+628123456789" class="text-blue-600">+62 812-3456-789</a></p>
                <p class="text-gray-600 mb-1">✉️ <a href="mailto:info@arunikan.com" class="text-blue-600">info@arunikan.com</a></p>
                <div class="flex space-x-4 mt-4">
                    <a href="https://facebook.com/arunikan" target="_blank" class="text-blue-600 hover:underline">Facebook</a>
                    <a href="https://instagram.com/arunikan" target="_blank" class="text-blue-600 hover:underline">Instagram</a>
                </div>
            </div>
            <div class="bg-gray-200 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Our Vision</h3>
                <p class="text-gray-600">Menjadi platform terdepan dalam jual beli ikan hias, menghadirkan pengalaman belanja yang mudah, aman, dan memuaskan, serta membangun komunitas pecinta ikan yang solid.</p>
            </div>
        </div>
    </section>

    <!-- ScrollSpy Script -->
    <script>
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('.nav-link');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 80;
                if (window.scrollY >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });
            navLinks.forEach(link => {
                link.classList.remove('text-blue-600', 'font-semibold');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('text-blue-600', 'font-semibold');
                }
            });
        });
    </script>

</body>
</html>

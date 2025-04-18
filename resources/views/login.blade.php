<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Arunikan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-200">

    <div class="flex w-[800px] h-[500px] rounded-lg shadow-lg overflow-hidden">
        
        {{-- Bagian Kiri --}}
        <div class="w-1/2 bg-gray-800 text-white flex flex-col justify-center items-center p-8">
            <div class="w-16 h-16 bg-gray-600 rounded-full mb-6"></div>
            <h2 class="text-2xl font-bold mb-4">Hello Arunikan-ers!</h2>
            <p class="text-center mb-6">
                Arunikan is lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam auctor malesuada diam, nec rhoncus eros blandit in.
            </p>
            <p class="text-sm text-gray-400">©2025 All rights reserved</p>
        </div>

        {{-- Bagian Kanan --}}
        <div class="w-1/2 bg-white flex flex-col justify-center items-center p-10">
            <h2 class="text-xl font-semibold mb-6">Welcome Back!</h2>
            <form action="/login" method="POST" class="w-full flex flex-col items-center">
                @csrf
                <select name="actor" class="w-3/4 mb-4 p-2 border border-gray-400 rounded-full text-gray-700">
                    <option disabled selected>Choose Actor</option>
                    <option value="admin">Admin</option>
                    <option value="buyer">Buyer</option>
                    <option value="cashier">Cashier</option>
                    <option value="supplier">Supplier</option>
                </select>
                <button type="submit" class="w-3/4 bg-gray-800 text-white py-2 rounded-full hover:bg-gray-700">
                    Sign In
                </button>
            </form>
        </div>

    </div>

</body>
</html>

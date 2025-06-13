<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Arunikan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-200">

    <div class="flex w-[800px] h-[500px] rounded-lg shadow-lg overflow-hidden">
        
        {{-- Kiri --}}
        <div class="w-1/2 bg-gray-800 text-white flex flex-col justify-center items-center p-8">
            <div class="w-16 h-16 bg-gray-600 rounded-full mb-6"></div>
            <h2 class="text-2xl font-bold mb-4">Hello Arunikan-ers!</h2>
            <p class="text-center mb-6">
                Arunikan is lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam auctor malesuada diam.
            </p>
            <p class="text-sm text-gray-400">©2025 All rights reserved</p>
        </div>

        {{-- Kanan --}}
        <div class="w-1/2 bg-white flex flex-col justify-center items-center p-10">
            <h2 class="text-xl font-semibold mb-6">Welcome Back!</h2>
            <form id="loginForm" class="w-full flex flex-col items-center">
                <select name="actor" class="w-3/4 mb-4 p-2 border border-gray-400 rounded-full text-gray-700" required>
                    <option disabled selected>Choose Actor</option>
                    <option value="admin">Admin</option>
                    <option value="buyer">Buyer</option>
                    <option value="cashier">Cashier</option>
                    <option value="supplier">Supplier</option>
                </select>

                <input type="text" name="username" placeholder="Username"
                    class="w-3/4 mb-4 p-2 border border-gray-400 rounded-full text-gray-700" required>

                <input type="password" name="password" placeholder="Password"
                    class="w-3/4 mb-4 p-2 border border-gray-400 rounded-full text-gray-700" required>

                <button type="submit"
                    class="w-3/4 bg-gray-800 text-white py-2 rounded-full hover:bg-gray-700">
                    Sign In
                </button>
            </form>
        </div>

    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            const username = this.username.value;
            const password = this.password.value;

            try {
                const response = await fetch("http://127.0.0.1:8000/api/account/login/", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ username, password })
                });

                const data = await response.json();

                if (response.ok) {
                    localStorage.setItem("access_token", data.access);
                    localStorage.setItem("refresh_token", data.refresh);
                    alert("Login berhasil!");
                    window.location.href = "/dashboard";
                } else {
                    alert("Login gagal: " + (data.detail || "Periksa username/password."));
                }
            } catch (err) {
                alert("Gagal terhubung ke server Django: " + err.message);
            }
        });
    </script>
</body>
</html>

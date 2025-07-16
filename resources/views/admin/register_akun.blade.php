<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Akun | Arunikan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-xl mx-auto mt-12 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-800">Daftarkan Akun Baru</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.register.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 text-sm font-medium">Nama</label>
                <input type="text" name="nama" required class="w-full p-2 border rounded" />
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Email</label>
                <input type="email" name="email" required class="w-full p-2 border rounded" />
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Password</label>
                <input type="password" name="password" required class="w-full p-2 border rounded" />
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Role</label>
                <select name="role" required class="w-full border px-3 py-2 rounded">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                    <option value="suplayer">Suplayer</option>
                    <option value="konsumen">Konsumen</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded">Daftarkan</button>
            </div>
        </form>
    </div>
</body>
</html>

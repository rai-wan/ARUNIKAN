<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error - Arunikan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-50 flex items-center justify-center h-screen">

    <div class="bg-white border border-red-400 text-red-700 px-6 py-5 rounded shadow max-w-md w-full text-center">
        <h1 class="text-2xl font-bold mb-2">Terjadi Kesalahan</h1>
        <p class="text-sm mb-4">{{ $message }}</p>
        <a href="{{ url()->previous() }}" class="text-blue-500 hover:underline">← Kembali</a>
    </div>

</body>
</html>

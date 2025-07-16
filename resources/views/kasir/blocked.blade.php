<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting...</title>
    <script>
        // Simpan session role_error, lalu redirect setelah sedikit delay
        setTimeout(() => {
            window.location.href = "/dashboard";
        }, 100); // delay 100ms saja
    </script>
</head>
<body>
    <p>Anda bukan kasir. Mengalihkan ke dashboard...</p>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-center items-center">
  
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8 mt-8">
        <h2 class="text-2xl font-bold text-blue-700 mb-6 text-center flex items-center gap-2"><i class="fa-solid fa-user-lock"></i> Login</h2>
        <?php if (!empty($error)): ?>
            <div class="mb-4 p-2 bg-red-100 text-red-700 rounded"> <?= htmlspecialchars($error) ?> </div>
        <?php endif; ?>
        <form method="post" class="flex flex-col gap-4">
            <label class="flex flex-col text-gray-700 font-semibold">Username:
                <input type="text" name="username" required class="border rounded px-3 py-2 mt-1">
            </label>
            <label class="flex flex-col text-gray-700 font-semibold">Password:
                <input type="password" name="password" required class="border rounded px-3 py-2 mt-1">
            </label>
            <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded shadow hover:scale-105 transition flex items-center gap-2 justify-center"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
        </form>
    </div>
   
</body>
</html> 
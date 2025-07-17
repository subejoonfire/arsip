<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Sistem Arsip Surat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center min-h-screen">

    <div
        class="w-full max-w-md bg-white p-8 rounded-xl shadow-2xl transform transition-all duration-300 hover:scale-105">
        <div class="text-center mb-8">
            <i class="fas fa-archive text-6xl text-blue-600 mb-4"></i>
            <h2 class="text-3xl font-extrabold text-gray-800">Sistem Arsip Surat</h2>
            <p class="text-gray-600 mt-2">Silakan login untuk melanjutkan</p>
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline"><?= esc(session()->getFlashdata('error')) ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login/auth') ?>" method="post" class="space-y-6">
            <?= csrf_field() ?>
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-user text-gray-400"></i>
                    </span>
                    <input type="text" name="username" id="username" placeholder="Masukkan username Anda"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                        required>
                </div>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-lock text-gray-400"></i>
                    </span>
                    <input type="password" name="password" id="password" placeholder="Masukkan password Anda"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                        required>
                </div>
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold text-lg hover:bg-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1">
                <i class="fas fa-sign-in-alt mr-2"></i> Login
            </button>
        </form>
    </div>

</body>

</html>
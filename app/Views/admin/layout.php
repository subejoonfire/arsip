<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= isset($title) ? esc($title) : 'Sistem Arsip Surat Admin' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

    <style>
    .sidebar {
        transition: transform 0.3s ease-in-out;
    }

    .sidebar-overlay {
        transition: opacity 0.3s ease-in-out;
    }

    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }

    @media (min-width: 1024px) {
        #sidebar {
            transform: translateX(0) !important;
        }

        #mainContent {
            margin-left: 16rem;
        }
    }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 shadow-md fixed w-full z-30 top-0">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <button id="sidebarToggle" class="text-white text-2xl mr-4 focus:outline-none lg:hidden">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="<?= base_url('admin/dashboard') ?>" class="text-white text-xl font-bold">Sistem Arsip Surat</a>
            </div>
            <div class="flex items-center">
                <span class="text-gray-300 mr-4 hidden md:block">Halo, <?= session('nama_lengkap') ?? 'Admin' ?></span>
                <a href="<?= base_url('/logout') ?>"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Layout -->
    <div class="flex pt-16">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="bg-gray-900 text-gray-300 w-64 space-y-6 py-7 px-2 fixed left-0 top-16 transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out z-20 h-[calc(100vh-4rem)] overflow-y-auto">
            <nav>
                <?php if (session('role') === 'admin') : ?>
                <a href="<?= base_url('admin/dashboard') ?>"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <?php else: ?>
                <a href="<?= base_url('pegawai/dashboard') ?>"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <?php endif ?>

                <?php if (session('role') === 'admin') : ?>
                <div class="relative">
                    <button id="suratDropdownToggle"
                        class="w-full text-left py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white focus:outline-none flex justify-between items-center">
                        <span><i class="fas fa-envelope mr-2"></i> Manajemen Surat</span>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                    </button>
                    <div id="suratDropdown"
                        class="hidden pl-6 mt-1 space-y-1 overflow-hidden transition-all duration-300 max-h-0">
                        <a href="<?= base_url('admin/suratmasuk') ?>"
                            class="block py-2 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-inbox mr-2"></i> Surat Masuk
                        </a>
                        <a href="<?= base_url('admin/suratkeluar') ?>"
                            class="block py-2 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-paper-plane mr-2"></i> Surat Keluar
                        </a>
                    </div>
                </div>
                <a href="<?= base_url('admin/arsip') ?>"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-box mr-2"></i> Manajemen Arsip
                </a>

                <a href="<?= base_url('admin/lokasi') ?>"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-map-marker-alt mr-2"></i> Manajemen Lokasi
                </a>
                <?php else: ?>
                <a href="<?= base_url('pegawai/lokasi') ?>"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-map-marker-alt mr-2"></i> Manajemen Lokasi
                </a>
                <?php endif ?>
            </nav>
        </aside>

        <!-- Page Content -->
        <main id="mainContent" class="flex-1 p-8 transition-all duration-300 ml-0">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mainContent = document.getElementById('mainContent');
        const suratDropdownToggle = document.getElementById('suratDropdownToggle');
        const suratDropdown = document.getElementById('suratDropdown');

        sidebarToggle.addEventListener('click', function() {
            const isOpen = !sidebar.classList.contains('-translate-x-full');

            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                mainContent.classList.remove('ml-64');
                removeOverlay();
            } else {
                sidebar.classList.remove('-translate-x-full');
                mainContent.classList.add('ml-64');
                addOverlay();
            }
        });

        function addOverlay() {
            if (document.getElementById('sidebar-overlay')) return; // Prevent duplicate overlay
            const overlay = document.createElement('div');
            overlay.id = 'sidebar-overlay';
            overlay.className = 'fixed inset-0 bg-black opacity-50 z-10 lg:hidden sidebar-overlay';
            overlay.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                mainContent.classList.remove('ml-64');
                removeOverlay();
            });
            document.body.appendChild(overlay);
        }

        function removeOverlay() {
            const existingOverlay = document.getElementById('sidebar-overlay');
            if (existingOverlay) existingOverlay.remove();
        }

        suratDropdownToggle.addEventListener('click', function() {
            suratDropdown.classList.toggle('hidden');
            suratDropdownToggle.querySelector('.fa-chevron-down').classList.toggle('rotate-180');

            // Animate dropdown height
            if (suratDropdown.classList.contains('hidden')) {
                suratDropdown.style.maxHeight = '0';
            } else {
                suratDropdown.style.maxHeight = suratDropdown.scrollHeight + 'px';
            }
        });

        // Initialize dropdown height on page load if it's not hidden (e.g., if it was open on previous page)
        // This ensures the transition works correctly when the page loads with the dropdown open
        if (!suratDropdown.classList.contains('hidden')) {
            suratDropdown.style.maxHeight = suratDropdown.scrollHeight + 'px';
        } else {
            suratDropdown.style.maxHeight = '0';
        }

        // Handle resize for desktop view
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) { // Tailwind's 'lg' breakpoint
                sidebar.classList.remove('-translate-x-full');
                mainContent.classList.add('ml-64');
                removeOverlay(); // Ensure overlay is removed on desktop
            } else {
                // On smaller screens, if sidebar is open, add overlay
                if (!sidebar.classList.contains('-translate-x-full')) {
                    addOverlay();
                }
            }
        });
    });
    </script>
</body>

</html>
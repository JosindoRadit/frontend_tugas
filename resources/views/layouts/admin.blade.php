<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @yield('styles')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar -->
        <aside class="bg-gray-800 text-white w-full md:w-64 md:min-h-screen p-4">
            <div class="flex items-center justify-between md:justify-center mb-6">
                <h2 class="text-2xl font-bold">Admin Panel</h2>
                <button id="mobile-menu-button" class="md:hidden text-white">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <nav id="sidebar-menu" class="hidden md:block">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="block py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('users.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                            <i class="fas fa-users mr-2"></i> Users
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <h1 class="text-xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h1>
                    <div class="flex items-center">
                        <span class="text-gray-600 mr-2">Admin</span>
                        <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Admin">
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('sidebar-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    @yield('scripts')
</body>
</html>

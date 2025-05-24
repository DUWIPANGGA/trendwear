<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>IndoToko: Official Site</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    transitionProperty: {
                        'width': 'width',
                        'transform': 'transform'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50">
    <header class="bg-white shadow-sm fixed w-full z-50">
        <div class="flex items-center justify-between px-4 py-3">
            <!-- Sidebar Toggle Button -->
            <button class="text-gray-600 hover:text-gray-900 lg:hidden" onclick="toggleSidebar()">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <!-- Logo/Brand -->
            <div class="flex items-center">
                <a href="{{ route('dashboard.index') }}" class="flex items-center">
                    <span class="text-2xl font-bold text-gray-800">Indo</span>
                    <span class="text-2xl font-bold text-blue-600">Toko</span>
                    <span class="ml-2 text-sm text-gray-500 hidden md:inline">Admin Panel</span>
                </a>
            </div>

            <!-- Header Right Content -->
            <div class="flex items-center space-x-4">
                <!-- Search Box -->
                <div class="hidden md:flex items-center bg-gray-100 rounded-full px-3 py-1">
                    <input type="text" placeholder="Search..."
                        class="bg-transparent border-none focus:outline-none w-40 focus:w-60 transition-all duration-300">
                    <button class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <!-- Notification -->
                <div class="relative">
                    <button class="text-gray-600 hover:text-gray-900 relative">
                        <i class="fas fa-bell text-xl"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </button>
                </div>

                <!-- User Profile -->
                <div class="relative">
                    <button class="flex items-center space-x-2 focus:outline-none" onclick="toggleDropdown()">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=3498db&color=fff" alt="User Avatar"
                            class="w-8 h-8 rounded-full">
                        <span class="text-gray-700 hidden md:inline">{{ Auth::user()->name }}</span>
                    </button>
                    <ul id="userDropdown"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden">
                        <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="#"><i
                                    class="fas fa-user mr-2"></i> Profile</a></li>
                        <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="#"><i
                                    class="fas fa-cog mr-2"></i> Settings</a></li>
                        <li>
                            <hr class="border-t border-gray-200 my-1">
                        </li>
                        <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="#"><i
                                    class="fas fa-sign-out-alt mr-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <aside id="sidebar"
        class="bg-white shadow-md w-64 fixed h-full z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="border-b border-gray-200 px-4 py-3 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Menu Admin</h3>
            <button class="lg:hidden text-gray-500 hover:text-gray-700" onclick="toggleSidebar()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="p-4">
            <ul class="space-y-1">
                <li>
                    <a class="flex items-center justify-between px-3 py-2 rounded-md
        {{ request()->routeIs('dashboard.index') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50' }}"
                        href="{{ route('dashboard.index') }}">
                        <div class="flex items-center">
                            <i class="fas fa-home mr-3 text-blue-500"></i>
                            <span>Dashboard</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                    </a>
                </li>


                @php
    $isProductActive = request()->routeIs('product.*');
@endphp

<li>
    <a onclick="toggleCollapse('productsCollapse')" class="flex items-center justify-between px-3 py-2 rounded-md 
        {{ $isProductActive ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50' }}">
        <div class="flex items-center">
            <i class="fas fa-box-open mr-3 text-blue-500"></i> 
            <span>Products</span>
        </div>
        <i id="productsArrow" class="fas fa-chevron-down text-xs transition-transform duration-200 
            {{ $isProductActive ? 'rotate-180 text-blue-400' : 'text-gray-400' }}"></i>
    </a>

    <ul id="productsCollapse" class="pl-10 mt-1 space-y-1 {{ $isProductActive ? '' : 'hidden' }}">
        <li>
            <a href="{{ route('product.index') }}" class="block px-3 py-2 rounded-md 
                {{ request()->routeIs('product.index') ? 'bg-blue-100 text-blue-600' : 'text-gray-600 hover:bg-blue-50' }}">
                All Products
            </a>
        </li>
        <li>
            <a href="{{ route('product.create') }}" class="block px-3 py-2 rounded-md 
                {{ request()->routeIs('product.create') ? 'bg-blue-100 text-blue-600' : 'text-gray-600 hover:bg-blue-50' }}">
                Add New
            </a>
        </li>
    </ul>
</li>
@php
    $isCategoriesActive = request()->routeIs('categories.*');
@endphp

<li>
    <a onclick="toggleCollapse('categoriesCollapse')" class="flex items-center justify-between px-3 py-2 rounded-md 
        {{ $isCategoriesActive ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50' }}">
        <div class="flex items-center">
            <i class="fas fa-tags mr-3 text-blue-500"></i> 
            <span>Categories</span>
        </div>
        <i id="categoriesArrow" class="fas fa-chevron-down text-xs transition-transform duration-200 
            {{ $isCategoriesActive ? 'rotate-180 text-blue-400' : 'text-gray-400' }}"></i>
    </a>

    <ul id="categoriesCollapse" class="pl-10 mt-1 space-y-1 {{ $isCategoriesActive ? '' : 'hidden' }}">
        <li>
            <a href="{{ route('categories.index') }}" class="block px-3 py-2 rounded-md 
                {{ request()->routeIs('categories.index') ? 'bg-blue-100 text-blue-600' : 'text-gray-600 hover:bg-blue-50' }}">
                All Categories
            </a>
        </li>
        <li>
            <a href="{{ route('categories.create') }}" class="block px-3 py-2 rounded-md 
                {{ request()->routeIs('categories.create') ? 'bg-blue-100 text-blue-600' : 'text-gray-600 hover:bg-blue-50' }}">
                Add New
            </a>
        </li>
    </ul>
</li>


                <li>
    <a class="flex items-center justify-between px-3 py-2 rounded-md 
        {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50' }}"
        href="{{ route('users.index') }}">
        <div class="flex items-center">
            <i class="fas fa-users mr-3 text-blue-500"></i> 
            <span>Users</span>
        </div>
        <i class="fas fa-chevron-right text-xs text-gray-400"></i>
    </a>
</li>
<li>
    <a class="flex items-center justify-between px-3 py-2 rounded-md 
        {{ request()->routeIs('orders.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50' }}"
        href="{{ route('orders.index') }}">
        <div class="flex items-center">
            <i class="fas fa-shopping-cart mr-3 text-blue-500"></i> 
            <span>Orders</span>
        </div>
        <i class="fas fa-chevron-right text-xs text-gray-400"></i>
    </a>
</li>

            </ul>
        </nav>

        <div class="border-t border-gray-200 p-4 absolute bottom-0 w-full bg-white">
            <div class="flex items-center mb-4">
                <div class="mr-3">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=3498db&color=fff" alt="User Avatar"
                        class="w-10 h-10 rounded-full">
                </div>
                <div>
                    <span class="block font-medium text-gray-800">{{ Auth::user()->name }}</span>
                    <span class="block text-xs text-gray-500">Admin</span>
                </div>
            </div>
            <a href="#" class="flex items-center text-gray-600 hover:text-blue-600">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
        </div>
    </aside>

    <main class="ml-0 lg:ml-64 pt-16 min-h-screen">
        <div class="p-4 md:p-6">
            @yield('content')
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 mt-8">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="col-span-1">
                    <h1 class="text-2xl font-bold text-gray-800">Indo <span class="text-blue-600">Toko</span></h1>
                    <p class="text-gray-600 mt-2">Lorem ipsum dolor sit amet</p>
                </div>
                <div class="col-span-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Navigation</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Home</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Best Seller</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Category</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Community</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Blog</a></li>
                    </ul>
                </div>
                <div class="col-span-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Company</h3>
                    <a href="mailto:john@example.com" class="text-blue-600 hover:underline">john@example.com</a>
                    <p class="text-gray-600 mt-2">Jln. Tamansiswa, No 32 Yogyakarta Indonesia</p>
                </div>
            </div>
            <div class="border-t border-gray-200 mt-8 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500">&copy; 2023 IndoToko. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-500 hover:text-blue-600"><i
                            class='bx bxl-instagram-alt text-xl'></i></a>
                    <a href="#" class="text-gray-500 hover:text-blue-600"><i
                            class='bx bxl-facebook-circle text-xl'></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Toggle sidebar on mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        // Toggle dropdown menu
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Toggle collapse sections
        function toggleCollapse(id) {
            const collapse = document.getElementById(id);
            const arrow = document.getElementById(id.replace('Collapse', 'Arrow'));

            collapse.classList.toggle('hidden');
            arrow.classList.toggle('fa-chevron-down');
            arrow.classList.toggle('fa-chevron-right');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                const sidebar = document.getElementById('sidebar');
                const sidebarToggle = document.querySelector('[onclick="toggleSidebar()"]');

                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('userDropdown');
            const profileBtn = document.querySelector('[onclick="toggleDropdown()"]');

            if (!profileBtn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Search box focus effect
        document.querySelector('.search-box input')?.addEventListener('focus', function() {
            this.style.width = '250px';
        });

        document.querySelector('.search-box input')?.addEventListener('blur', function() {
            this.style.width = '200px';
        });
    </script>
</body>

</html>

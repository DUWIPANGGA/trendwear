<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>IndoToko: Official Site</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            /* Reset and Base Styles */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                background-color: #f5f7fa;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            /* Header Styles */
            header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                height: 60px;
                background: #fff;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                z-index: 1000;
                display: flex;
                align-items: center;
                padding: 0 20px;
            }

            /* Sidebar Styles */
            .sidebar {
                position: fixed;
                top: 60px;
                left: 0;
                bottom: 0;
                width: 250px;
                background: #2c3e50;
                color: white;
                overflow-y: auto;
                transition: all 0.3s;
                z-index: 900;
            }

            .sidebar-nav {
                padding: 15px 0;
                list-style: none;
            }

            .nav-item {
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .nav-link {
                display: flex;
                align-items: center;
                padding: 12px 20px;
                color: #ecf0f1;
                text-decoration: none;
                transition: all 0.3s;
            }

            .nav-link:hover {
                background: #34495e;
                color: #fff;
            }

            .nav-link.active {
                background: #3498db;
                color: #fff;
            }

            .nav-link i {
                margin-right: 10px;
                font-size: 18px;
            }

            /* Main Content Styles */
            main {
                flex: 1;
                margin-top: 60px;
                margin-left: 250px;
                padding: 20px;
                background-color: #f5f7fa;
                min-height: calc(100vh - 60px);
            }

            /* Card Styles */
            .card {
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                margin-bottom: 20px;
                width: 100%;
            }

            .card-header {
                padding: 15px 20px;
                border-bottom: 1px solid #eee;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .card-title {
                margin: 0;
                font-size: 1.2rem;
            }

            .card-body {
                padding: 20px;
            }

            /* Table Styles */
            table {
                width: 100%;
                border-collapse: collapse;
            }

            table th, table td {
                padding: 12px 15px;
                text-align: left;
                border-bottom: 1px solid #eee;
            }

            table th {
                background-color: #f8f9fa;
                font-weight: 600;
            }

            /* Footer Styles */
            footer {
                background: #2c3e50;
                color: white;
                padding: 15px;
                text-align: center;
                margin-left: 250px;
            }

            /* Responsive Styles */
            @media (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                }
                
                .sidebar.active {
                    transform: translateX(0);
                }
                
                main, footer {
                    margin-left: 0;
                }
                
                .sidebar-toggle {
                    display: block !important;
                }
            }

            /* Toggle Button */
            .sidebar-toggle {
                display: none;
                background: none;
                border: none;
                color: #333;
                font-size: 20px;
                cursor: pointer;
                margin-right: 15px;
            }
            /* Sidebar Styles */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 280px;
        background: #2c3e50;
        color: white;
        overflow-y: auto;
        transition: all 0.3s;
        z-index: 1000;
        transform: translateX(-100%);
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .sidebar-header {
        padding: 20px;
        background: #1a252f;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .sidebar-title {
        font-size: 1.2rem;
        margin: 0;
        color: #fff;
    }

    .sidebar-close {
        background: none;
        border: none;
        color: #fff;
        font-size: 1.2rem;
        cursor: pointer;
    }

    .sidebar-nav {
        padding: 15px 0;
    }

    .nav-item {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .nav-link {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: #ecf0f1;
        text-decoration: none;
        transition: all 0.3s;
        position: relative;
    }

    .nav-link:hover {
        background: #34495e;
        color: #fff;
    }

    .nav-link.active {
        background: #3498db;
        color: #fff;
    }

    .nav-link i:first-child {
        margin-right: 10px;
        font-size: 1rem;
        width: 20px;
        text-align: center;
    }

    .arrow-icon {
        margin-left: auto;
        font-size: 0.8rem;
        transition: transform 0.3s;
    }

    .nav-link.collapsed .arrow-icon {
        transform: rotate(-90deg);
    }

    .sub-menu {
        list-style: none;
        padding-left: 0;
        background: #1a252f;
    }

    .sub-item a {
        display: block;
        padding: 10px 20px 10px 50px;
        color: #b8c7ce;
        text-decoration: none;
        transition: all 0.3s;
    }

    .sub-item a:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.1);
    }

    .sidebar-footer {
        padding: 20px;
        background: #1a252f;
        margin-top: auto;
    }

    .user-info {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 10px;
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-details {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 600;
        font-size: 0.9rem;
    }

    .user-role {
        font-size: 0.8rem;
        color: #b8c7ce;
    }

    .logout-btn {
        display: flex;
        align-items: center;
        color: #ecf0f1;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 4px;
        transition: all 0.3s;
    }

    .logout-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .logout-btn i {
        margin-right: 8px;
    }

    /* Responsive Styles */
    @media (min-width: 992px) {
        .sidebar {
            transform: translateX(0);
        }
        
        main, footer {
            margin-left: 280px;
        }
        
        .sidebar-close {
            display: none;
        }
    }
    /* Header Styles */
    .admin-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        z-index: 1100;
        display: flex;
        align-items: center;
        padding: 0 20px;
    }

    .header-container {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .sidebar-toggle {
        background: none;
        border: none;
        color: #2c3e50;
        font-size: 1.2rem;
        cursor: pointer;
        margin-right: 15px;
        display: none;
    }

    .header-brand {
        display: flex;
        align-items: center;
    }

    .brand-link {
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .brand-logo {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
    }

    .brand-logo-highlight {
        font-size: 1.5rem;
        font-weight: 700;
        color: #3498db;
    }

    .brand-subtitle {
        font-size: 0.8rem;
        color: #7f8c8d;
        margin-left: 10px;
        padding-left: 10px;
        border-left: 1px solid #bdc3c7;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .search-box {
        position: relative;
        display: flex;
        align-items: center;
    }

    .search-box input {
        padding: 8px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        width: 200px;
        transition: all 0.3s;
    }

    .search-box input:focus {
        outline: none;
        border-color: #3498db;
        width: 250px;
    }

    .search-btn {
        position: absolute;
        right: 10px;
        background: none;
        border: none;
        color: #7f8c8d;
        cursor: pointer;
    }

    .header-notification {
        position: relative;
    }

    .notification-btn {
        background: none;
        border: none;
        color: #2c3e50;
        font-size: 1.2rem;
        cursor: pointer;
        position: relative;
    }

    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #e74c3c;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .header-profile {
        display: flex;
        align-items: center;
    }

    .profile-btn {
        display: flex;
        align-items: center;
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 20px;
        transition: all 0.3s;
    }

    .profile-btn:hover {
        background: #f8f9fa;
    }

    .profile-btn img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin-right: 8px;
    }

    .profile-name {
        font-size: 0.9rem;
        color: #2c3e50;
    }

    /* Dropdown Menu */
    .dropdown-menu {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        padding: 5px 0;
    }

    .dropdown-item {
        padding: 8px 15px;
        font-size: 0.9rem;
        color: #2c3e50;
        display: flex;
        align-items: center;
    }

    .dropdown-item:hover {
        background: #f8f9fa;
        color: #3498db;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .sidebar-toggle {
            display: block;
        }
        
        .search-box input {
            width: 150px;
        }
        
        .search-box input:focus {
            width: 180px;
        }
        
        .brand-subtitle {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .search-box {
            display: none;
        }
        
        .header-brand {
            margin-left: 10px;
        }
        
        .profile-name {
            display: none;
        }
    }

        </style>
    @vite([
    'resources/sass/app.scss',
    'resources/js/app.js',
    'resources/views/themes/indotoko/assets/css/main.css',
    'resources/views/themes/indotoko/assets/plugins/jqueryui/jquery-ui.css',
    'resources/views/themes/indotoko/assets/js/main.js',
    'resources/views/themes/indotoko/assets/plugins/jqueryui/jquery-ui.min.js',
    ])
</head>

<body>
    {{-- <header class="mb-10"> --}}
        <header class="admin-header">
            <div class="header-container">
                <!-- Sidebar Toggle Button -->
                <button class="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                
                <!-- Logo/Brand -->
                <div class="header-brand">
                    <a href="{{ route('dashboard.index') }}" class="brand-link">
                        <span class="brand-logo">Indo</span>
                        <span class="brand-logo-highlight">Toko</span>
                        <span class="brand-subtitle">Admin Panel</span>
                    </a>
                </div>
                
                <!-- Header Right Content -->
                <div class="header-right">
                    <!-- Search Box -->
                    <div class="search-box">
                        <input type="text" placeholder="Search...">
                        <button class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <!-- Notification -->
                    <div class="header-notification">
                        <button class="notification-btn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                    </div>
                    
                    <!-- User Profile -->
                    <div class="header-profile dropdown">
                        <button class="profile-btn dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=3498db&color=fff" alt="User Avatar">
                            <span class="profile-name">Administrator</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
    {{-- </header> --}}
    
    <aside class="sidebar">
        <div class="sidebar-header">
            <h3 class="sidebar-title">Menu Admin</h3>
            <button class="sidebar-close d-lg-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="sidebar-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.index') }}">
                        <i class="fas fa-home"></i> Dashboard
                        <i class="fas fa-chevron-right arrow-icon"></i>
                    </a>
                </li>
                
                <!-- Products Section -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-toggle="collapse" href="#productsCollapse">
                        <i class="fas fa-box-open"></i> Products
                        <i class="fas fa-chevron-down arrow-icon"></i>
                    </a>
                    <div class="collapse" id="productsCollapse">
                        <ul class="sub-menu">
                            <li class="sub-item">
                                <a href="{{ route('product.index') }}">All Products</a>
                            </li>
                            <li class="sub-item">
                                <a href="{{ route('product.create') }}">Add New</a>
                            </li>
                            <li class="sub-item">
                                <a href="#">Categories</a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <!-- Categories Section -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-toggle="collapse" href="#categoriesCollapse">
                        <i class="fas fa-tags"></i> Categories
                        <i class="fas fa-chevron-down arrow-icon"></i>
                    </a>
                    <div class="collapse" id="categoriesCollapse">
                        <ul class="sub-menu">
                            <li class="sub-item">
                                <a href="{{ route('categories.index') }}">All Categories</a>
                            </li>
                            <li class="sub-item">
                                <a href="{{ route('categories.create') }}">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('users.index') }}">
                        <i class="fas fa-users"></i> Users
                        <i class="fas fa-chevron-right arrow-icon"></i>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-shopping-cart"></i> Orders
                        <i class="fas fa-chevron-right arrow-icon"></i>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-chart-line"></i> Reports
                        <i class="fas fa-chevron-right arrow-icon"></i>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-cog"></i> Settings
                        <i class="fas fa-chevron-right arrow-icon"></i>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=3498db&color=fff" alt="User Avatar">
                </div>
                <div class="user-details">
                    <span class="user-name">Administrator</span>
                    <span class="user-role">Super Admin</span>
                </div>
            </div>
            <a href="#" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>

    <main>
        @yield('content')
    </main>
    
    <footer>
        <div class="container pt-5">
          <div class="row row-content">
            <div class="col-md-6">
              <h1 class="logo-brand">Indo <span>Toko</span></h1>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <div class="col-md-3 mt-4 mt-sm-0">
              <h3 class="mb-3">Navigation</h3>
              <ul class="p-0">
                <li><a href="#">Home</a></li>
                <li class="mt-3"><a href="#">Best Seller</a></li>
                <li class="mt-3"><a href="#">Category</a></li>
                <li class="mt-3"><a href="#">Comunity</a></li>
                <li class="mt-3"><a href="#">Blog</a></li>
              </ul>
            </div>
            <div class="col-md-3 mt-4 mt-sm-0">
              <h3 class="mb-3">Company</h3>
              <a href="#">john@example.com</a>
              <p>Jln. Tamansiswa, No 32 Yogyakarta Indonesia</p>
            </div>
          </div>
          <div class="row row-copy mt-4 mt-sm-0">
            <div class="col-md-6">
              <p>&copy; 2023 IndoToko. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-sm-end">
              <a href="#"><i class='bx bxl-instagram-alt' ></i></a>
              <a href="#"><i class='bx bxl-facebook-circle' ></i></a>
            </div>
          </div>
        </div>
      </footer>

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Mobile sidebar toggle
            $('.sidebar-toggle').click(function() {
                $('.sidebar').toggleClass('active');
            });
            
            // Close sidebar when clicking outside on mobile
            $(document).click(function(e) {
                if ($(window).width() <= 768) {
                    if (!$(e.target).closest('.sidebar, .sidebar-toggle').length) {
                        $('.sidebar').removeClass('active');
                    }
                }
            });
        });
        $(document).ready(function() {
    // Toggle sidebar on button click
    $('.sidebar-toggle').click(function() {
        $('.sidebar').toggleClass('active');
    });
    
    // Close sidebar when clicking close button
    $('.sidebar-close').click(function() {
        $('.sidebar').removeClass('active');
    });
    
    // Close sidebar when clicking outside on mobile
    $(document).click(function(e) {
        if ($(window).width() < 992) {
            if (!$(e.target).closest('.sidebar, .sidebar-toggle').length) {
                $('.sidebar').removeClass('active');
            }
        }
    });
    
    // Prevent collapse from closing when clicking inside
    $('.sidebar-nav').on('click', '.nav-link', function(e) {
        if ($(this).hasClass('collapsed') || $(this).attr('data-bs-toggle') === 'collapse') {
            e.preventDefault();
            $(this).toggleClass('collapsed');
            $($(this).attr('href')).collapse('toggle');
        }
    });
});
$(document).ready(function() {
    // Toggle sidebar
    $('.sidebar-toggle').click(function() {
        $('.sidebar').toggleClass('active');
    });
    
    // Close sidebar when clicking outside on mobile
    $(document).click(function(e) {
        if ($(window).width() < 992) {
            if (!$(e.target).closest('.sidebar, .sidebar-toggle').length) {
                $('.sidebar').removeClass('active');
            }
        }
    });
    
    // Initialize dropdowns
    $('.dropdown-toggle').dropdown();
    
    // Search box focus effect
    $('.search-box input').focus(function() {
        $(this).css('width', '250px');
    }).blur(function() {
        $(this).css('width', '200px');
    });
});
    </script>
</body>
</html>
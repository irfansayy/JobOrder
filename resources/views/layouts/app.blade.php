<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Job Order System') }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0f766e',
                        secondary: '#6366f1',
                        accent: '#10b981',
                    }
                }
            }
        }
    </script>
    
    <!-- Custom Styles -->
    <style>
        /* Soft Gradient Backgrounds */
        .gradient-soft-blue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-soft-teal {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
        }
        
        .gradient-soft-purple {
            background: linear-gradient(135deg, #818cf8 0%, #c084fc 100%);
        }
        
        .gradient-soft-green {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        }
        
        .gradient-soft-slate {
            background: linear-gradient(135deg, #475569 0%, #64748b 100%);
        }
        
        .gradient-soft-indigo {
            background: linear-gradient(135deg, #6366f1 0%, #818cf8 100%);
        }
        
        /* Select2 Styling */
        .select2-container--default .select2-selection--single {
            background: white;
            border: 2px solid #e2e8f0 !important;
            border-radius: 0.5rem !important;
            height: 48px !important;
            padding: 0.5rem 1rem !important;
            font-size: 1rem;
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
        }
        
        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--single {
            border-color: #14b8a6 !important;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1) !important;
            outline: none !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 32px !important;
            padding-left: 0 !important;
            padding-right: 30px !important;
            color: #334155;
            font-weight: 500;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #94a3b8 !important;
            font-weight: normal;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px !important;
            right: 10px !important;
            top: 1px !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #64748b transparent transparent transparent !important;
            border-width: 6px 5px 0 5px !important;
        }
        
        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #64748b transparent !important;
            border-width: 0 5px 6px 5px !important;
        }
        
        /* Dropdown */
        .select2-dropdown {
            border: 2px solid #14b8a6 !important;
            border-radius: 0.5rem !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
            margin-top: 4px !important;
            overflow: hidden;
        }
        
        .select2-container--default .select2-results__option {
            padding: 0.75rem 1rem !important;
            transition: all 0.15s ease;
            font-size: 0.95rem;
            color: #334155;
        }
        
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%) !important;
            color: white !important;
        }
        
        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #d1fae5 !important;
            color: #065f46 !important;
            font-weight: 600;
        }
        
        .select2-container--default .select2-results__option[aria-selected=true]:hover {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%) !important;
            color: white !important;
        }
        
        /* Search Box */
        .select2-search--dropdown {
            padding: 0.75rem !important;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .select2-search--dropdown .select2-search__field {
            border: 2px solid #e2e8f0 !important;
            border-radius: 0.375rem !important;
            padding: 0.5rem 0.75rem !important;
            font-size: 0.875rem !important;
            transition: all 0.2s;
            color: #334155;
        }
        
        .select2-search--dropdown .select2-search__field:focus {
            border-color: #14b8a6 !important;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1) !important;
            outline: none !important;
        }
        
        /* Error State */
        .has-error .select2-selection {
            border-color: #f43f5e !important;
        }
        
        /* Animation */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }
        
        .select2-dropdown {
            animation: slideDown 0.2s ease-out;
        }
        
        .animate-slideDown {
            animation: slideDown 0.3s ease-out;
        }
        
        .animate-slideInLeft {
            animation: slideInLeft 0.3s ease-out;
        }
        
        /* Mobile sidebar overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 35;
            transition: opacity 0.3s;
        }
        
        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }
        
        /* Ensure mobile topbar is always visible */
        .mobile-topbar {
            display: flex !important;
        }
        
        @media (min-width: 640px) {
            .mobile-topbar {
                display: none !important;
            }
        }
        
        /* Smooth transitions */
        * {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Prevent scroll when sidebar open on mobile */
        body.sidebar-open {
            overflow: hidden;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-slate-50 via-gray-50 to-slate-100 min-h-screen">
    <!-- Mobile Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Mobile Top Bar (Always visible on mobile) -->
    <div class="mobile-topbar fixed top-0 left-0 right-0 z-50 items-center justify-between p-4 bg-white border-b border-slate-200 shadow-md">
        <button onclick="toggleSidebar()" class="p-2 text-slate-700 hover:text-teal-600 focus:outline-none active:scale-95 transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <h1 class="text-lg font-bold bg-gradient-to-r from-teal-600 to-emerald-600 bg-clip-text text-transparent">
            @yield('title', 'Dashboard')
        </h1>
        <div class="relative w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md overflow-hidden">
            <div class="absolute inset-0 gradient-soft-teal"></div>
            <span class="relative z-10">{{ substr(Auth::user()->name, 0, 1) }}</span>
        </div>
    </div>

    <div class="min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform duration-300 -translate-x-full sm:translate-x-0 shadow-xl">
            <!-- Soft Gradient Overlay -->
            <div class="absolute inset-0 gradient-soft-slate opacity-95"></div>
            
            <!-- Content -->
            <div class="relative h-full px-3 py-4 overflow-y-auto pb-20">
                <!-- Close button for mobile -->
                <button onclick="toggleSidebar()" class="absolute top-4 right-4 text-white hover:text-gray-200 sm:hidden focus:outline-none p-2 active:scale-95 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <div class="flex items-center justify-center mb-8 pt-4">
                    <h2 class="text-xl font-bold text-white drop-shadow-lg">
                        <i class="fas fa-clipboard-list mr-2"></i>Job Order System
                    </h2>
                </div>
                
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="{{ route('dashboard') }}" 
                           class="flex items-center p-3 text-white rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white bg-opacity-25 shadow-lg' : '' }}">
                            <i class="fas fa-home w-6"></i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('job-orders.index') }}" 
                           class="flex items-center p-3 text-white rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 {{ request()->routeIs('job-orders.*') ? 'bg-white bg-opacity-25 shadow-lg' : '' }}">
                            <i class="fas fa-tasks w-6"></i>
                            <span class="ml-3">Job Orders</span>
                        </a>
                    </li>
                    
                    <!-- MASTER DATA Dropdown -->
                    <li class="pt-4 mt-4 border-t border-white border-opacity-20">
                        <button type="button" 
                            class="flex items-center w-full p-3 text-white rounded-lg hover:bg-white hover:bg-opacity-20 transition-all duration-200 {{ request()->is('master-data/*') ? 'bg-white bg-opacity-25 shadow-lg' : '' }}"
                            onclick="toggleDropdown('masterDataDropdown')">
                            <i class="fas fa-database w-6"></i>
                            <span class="flex-1 ml-3 text-left">Master Data</span>
                            <i class="fas fa-chevron-down transition-transform duration-200" id="masterDataIcon"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <ul id="masterDataDropdown" class="hidden py-2 space-y-2 mt-2">
                            <li>
                                <a href="{{ route('master-data.brands.index') }}" 
                                   class="flex items-center p-3 pl-11 text-white text-opacity-90 rounded-lg hover:bg-white hover:bg-opacity-20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('master-data.brands.*') ? 'bg-white bg-opacity-20 text-white' : '' }}">
                                    <i class="fas fa-tag w-5 mr-2"></i>
                                    <span>Brands</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{ route('master-data.customer-services.index') }}" 
                                   class="flex items-center p-3 pl-11 text-white text-opacity-90 rounded-lg hover:bg-white hover:bg-opacity-20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('master-data.customer-services.*') ? 'bg-white bg-opacity-20 text-white' : '' }}">
                                    <i class="fas fa-user-tie w-5 mr-2"></i>
                                    <span>Customer Service</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{ route('master-data.products.index') }}" 
                                   class="flex items-center p-3 pl-11 text-white text-opacity-90 rounded-lg hover:bg-white hover:bg-opacity-20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('master-data.products.*') ? 'bg-white bg-opacity-20 text-white' : '' }}">
                                    <i class="fas fa-box w-5 mr-2"></i>
                                    <span>Products</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{ route('master-data.production-statuses.index') }}" 
                                   class="flex items-center p-3 pl-11 text-white text-opacity-90 rounded-lg hover:bg-white hover:bg-opacity-20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('master-data.production-statuses.*') ? 'bg-white bg-opacity-20 text-white' : '' }}">
                                    <i class="fas fa-cogs w-5 mr-2"></i>
                                    <span>Production Status</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{ route('master-data.order-types.index') }}" 
                                   class="flex items-center p-3 pl-11 text-white text-opacity-90 rounded-lg hover:bg-white hover:bg-opacity-20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('master-data.order-types.*') ? 'bg-white bg-opacity-20 text-white' : '' }}">
                                    <i class="fas fa-list w-5 mr-2"></i>
                                    <span>Order Types</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{ route('master-data.order-priorities.index') }}" 
                                   class="flex items-center p-3 pl-11 text-white text-opacity-90 rounded-lg hover:bg-white hover:bg-opacity-20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('master-data.order-priorities.*') ? 'bg-white bg-opacity-20 text-white' : '' }}">
                                    <i class="fas fa-exclamation-circle w-5 mr-2"></i>
                                    <span>Order Priorities</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                
                <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white border-opacity-20">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full p-3 text-white rounded-lg hover:bg-rose-500 hover:bg-opacity-90 transition-all duration-200 backdrop-blur-sm">
                            <i class="fas fa-sign-out-alt w-6"></i>
                            <span class="ml-3">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="p-4 sm:ml-64 pt-20 sm:pt-4">
            <!-- Header -->
            <div class="relative bg-white rounded-xl shadow-sm mb-6 p-4 sm:p-6 border border-slate-200 overflow-hidden">
                <!-- Subtle gradient overlay -->
                <div class="absolute top-0 right-0 w-64 h-64 gradient-soft-teal opacity-5 blur-3xl rounded-full"></div>
                
                <div class="relative flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-xl sm:text-3xl font-bold bg-gradient-to-r from-slate-700 to-slate-900 bg-clip-text text-transparent">
                            @yield('title', 'Dashboard')
                        </h1>
                        <p class="text-slate-600 mt-1 text-xs sm:text-base">@yield('subtitle', 'Welcome to Job Order System')</p>
                    </div>
                    <div class="hidden sm:flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-slate-700 font-semibold">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="relative w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg overflow-hidden">
                            <div class="absolute inset-0 gradient-soft-teal"></div>
                            <span class="relative z-10">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alerts -->
            @if(session('success'))
            <div class="relative bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 text-emerald-800 p-4 mb-6 rounded-lg shadow-sm overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 gradient-soft-green opacity-10 blur-2xl rounded-full"></div>
                <div class="relative flex items-center">
                    <i class="fas fa-check-circle mr-3 text-xl text-emerald-600"></i>
                    <p class="font-medium text-sm sm:text-base">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="relative bg-gradient-to-r from-rose-50 to-pink-50 border-l-4 border-rose-500 text-rose-800 p-4 mb-6 rounded-lg shadow-sm overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-rose-400 opacity-10 blur-2xl rounded-full"></div>
                <div class="relative flex items-center">
                    <i class="fas fa-exclamation-circle mr-3 text-xl text-rose-600"></i>
                    <p class="font-medium text-sm sm:text-base">{{ session('error') }}</p>
                </div>
            </div>
            @endif

            <!-- Content -->
            <div class="bg-white rounded-xl shadow-sm p-3 sm:p-6 border border-slate-200">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts tetap sama seperti sebelumnya -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('select:not([readonly]):not([disabled])').each(function() {
                var $select = $(this);
                var placeholder = $select.find('option[value=""]').text() || 
                                $select.data('placeholder') || 
                                'Select an option';
                
                $select.select2({
                    theme: 'default',
                    width: '100%',
                    placeholder: placeholder,
                    allowClear: false,
                    dropdownAutoWidth: true,
                    minimumResultsForSearch: 5,
                    language: {
                        noResults: function() {
                            return "No results found";
                        },
                        searching: function() {
                            return "Searching...";
                        }
                    }
                });
            });

            $('select.border-red-500').each(function() {
                $(this).next('.select2-container').addClass('has-error');
            });
            
            $('select').on('invalid', function() {
                $(this).next('.select2-container').addClass('has-error');
            });
            
            $('select').on('change', function() {
                if(this.validity.valid) {
                    $(this).next('.select2-container').removeClass('has-error');
                }
            });
        });
        
        // Toggle mobile sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const body = document.body;
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('active');
            body.classList.toggle('sidebar-open');
            
            if (!sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.add('animate-slideInLeft');
                setTimeout(() => {
                    sidebar.classList.remove('animate-slideInLeft');
                }, 300);
            }
        }
        
        // Toggle dropdown
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const icon = document.getElementById('masterDataIcon');
            
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                dropdown.classList.add('animate-slideDown');
                icon.style.transform = 'rotate(180deg)';
            } else {
                dropdown.classList.add('hidden');
                dropdown.classList.remove('animate-slideDown');
                icon.style.transform = 'rotate(0deg)';
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            if (currentPath.includes('/master-data/')) {
                const dropdown = document.getElementById('masterDataDropdown');
                const icon = document.getElementById('masterDataIcon');
                if (dropdown) {
                    dropdown.classList.remove('hidden');
                    icon.style.transform = 'rotate(180deg)';
                }
            }
        });
        
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 640) {
                    toggleSidebar();
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Job Order System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-soft-slate {
            background: linear-gradient(135deg, #475569 0%, #64748b 100%);
        }
        
        .gradient-soft-teal {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-100 via-gray-50 to-slate-200 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-slate-200">
            <!-- Header -->
            <div class="relative overflow-hidden p-8 text-white text-center">
                <div class="absolute inset-0 gradient-soft-slate opacity-90"></div>
                <div class="relative">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
                        <i class="fas fa-clipboard-list text-4xl text-teal-600"></i>
                    </div>
                    <h1 class="text-3xl font-bold mb-2 drop-shadow-lg">Job Order System</h1>
                    <p class="text-white text-opacity-80">Sign in to continue</p>
                </div>
            </div>

            <!-- Form -->
            <div class="p-8">
                @if ($errors->any())
                <div class="bg-gradient-to-r from-rose-50 to-pink-50 border-l-4 border-rose-500 text-rose-700 p-4 mb-6 rounded-lg">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle mr-3 mt-0.5 text-rose-600"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                            <p class="text-sm">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Input -->
                    <div class="mb-6">
                        <label for="email" class="block text-slate-700 font-semibold mb-2">
                            <i class="fas fa-envelope mr-2 text-teal-600"></i>Email / Username
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none"
                            placeholder="Enter your email">
                    </div>

                    <!-- Password Input -->
                    <div class="mb-6">
                        <label for="password" class="block text-slate-700 font-semibold mb-2">
                            <i class="fas fa-lock mr-2 text-teal-600"></i>Password
                        </label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none"
                            placeholder="Enter your password">
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-6 flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-teal-600 border-slate-300 rounded focus:ring-teal-500">
                            <span class="ml-2 text-slate-700 text-sm">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-teal-600 hover:text-teal-800 font-semibold transition">
                            Forgot Password?
                        </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                        class="relative w-full text-white font-bold py-3 px-4 rounded-lg transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg overflow-hidden group">
                        <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
                        <span class="relative"><i class="fas fa-sign-in-alt mr-2"></i>Sign In</span>
                    </button>
                </form>

                <!-- Register Link -->
                @if (Route::has('register'))
                <div class="mt-6 text-center">
                    <p class="text-slate-600 text-sm">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-teal-600 hover:text-teal-800 font-semibold transition">
                            Register here
                        </a>
                    </p>
                </div>
                @endif

                <!-- Info Box -->
                <div class="mt-6 p-4 bg-teal-50 rounded-lg border border-teal-200">
                    <p class="text-sm text-slate-700 text-center">
                        <i class="fas fa-info-circle text-teal-600 mr-2"></i>
                        Default Login: <strong class="text-slate-900">admin@joborder.com</strong> / <strong class="text-slate-900">password</strong>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6 text-slate-600">
            <p class="text-sm">
                <i class="fas fa-copyright mr-1"></i>2024 Job Order System. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
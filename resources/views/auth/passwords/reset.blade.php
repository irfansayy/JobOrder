<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Job Order System</title>
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
        <!-- Reset Password Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-slate-200">
            <!-- Header -->
            <div class="relative overflow-hidden p-8 text-white text-center">
                <div class="absolute inset-0 gradient-soft-slate opacity-90"></div>
                <div class="relative">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
                        <i class="fas fa-lock-open text-4xl text-teal-600"></i>
                    </div>
                    <h1 class="text-3xl font-bold mb-2 drop-shadow-lg">New Password</h1>
                    <p class="text-white text-opacity-80">Create a secure password</p>
                </div>
            </div>

            <!-- Form -->
            <div class="p-8">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Input -->
                    <div class="mb-4">
                        <label for="email" class="block text-slate-700 font-semibold mb-2">
                            <i class="fas fa-envelope mr-2 text-teal-600"></i>Email Address
                        </label>
                        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('email') border-rose-500 @enderror"
                            placeholder="Enter your email">
                        @error('email')
                        <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="mb-4">
                        <label for="password" class="block text-slate-700 font-semibold mb-2">
                            <i class="fas fa-lock mr-2 text-teal-600"></i>New Password
                        </label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none @error('password') border-rose-500 @enderror"
                            placeholder="Enter new password">
                        @error('password')
                        <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="mb-6">
                        <label for="password-confirm" class="block text-slate-700 font-semibold mb-2">
                            <i class="fas fa-lock mr-2 text-teal-600"></i>Confirm Password
                        </label>
                        <input id="password-confirm" type="password" name="password_confirmation" required
                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition duration-200 outline-none"
                            placeholder="Confirm new password">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                        class="relative w-full text-white font-bold py-3 px-4 rounded-lg transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg overflow-hidden group">
                        <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
                        <span class="relative"><i class="fas fa-check mr-2"></i>Reset Password</span>
                    </button>
                </form>

                <!-- Back to Login -->
                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-teal-600 hover:text-teal-800 font-semibold transition">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Login
                    </a>
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
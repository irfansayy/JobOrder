<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - Job Order System</title>
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
        <!-- Verify Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-slate-200">
            <!-- Header -->
            <div class="relative overflow-hidden p-8 text-white text-center">
                <div class="absolute inset-0 gradient-soft-slate opacity-90"></div>
                <div class="relative">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
                        <i class="fas fa-envelope-open-text text-4xl text-teal-600"></i>
                    </div>
                    <h1 class="text-3xl font-bold mb-2 drop-shadow-lg">Verify Your Email</h1>
                    <p class="text-white text-opacity-80">Check your inbox</p>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                @if (session('resent'))
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-emerald-600"></i>
                        <p class="text-sm">A fresh verification link has been sent to your email address.</p>
                    </div>
                </div>
                @endif

                <div class="text-center mb-6">
                    <p class="text-slate-700 mb-4">
                        Before proceeding, please check your email for a verification link.
                    </p>
                    <p class="text-slate-600 text-sm">
                        If you did not receive the email, click the button below.
                    </p>
                </div>

                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" 
                        class="relative w-full text-white font-bold py-3 px-4 rounded-lg transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg overflow-hidden group">
                        <span class="absolute inset-0 gradient-soft-teal group-hover:opacity-90"></span>
                        <span class="relative"><i class="fas fa-paper-plane mr-2"></i>Resend Verification Email</span>
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
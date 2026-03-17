@guest
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sumbar Fakta - Cerdas, Tajam, Terpercaya</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.jpg') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .bg-sumbar {
            background-color: #b70000;
        }

        .text-sumbar {
            color: #b70000;
        }

        .border-sumbar {
            border-color: #b70000;
        }

        .focus-sumbar:focus {
            border-color: #b70000;
            ring-color: #b70000;
        }

        /* Animasi fade in untuk box login */
        .animate-fade-up {
            animation: fadeUp 0.5s ease-out forwards;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <header class="bg-white py-6 border-b shadow-sm">
        <div class="container mx-auto px-4 text-center">
            <div class="cursor-pointer inline-block" onclick="window.location='/'">
                <h1 class="text-4xl md:text-5xl font-black italic tracking-tighter">
                    <span class="text-sumbar">SUMBAR</span><span class="text-gray-900">FAKTA</span>
                </h1>
                <p class="text-[10px] tracking-[0.4em] uppercase font-bold text-gray-400">Cerdas, Tajam, Terpercaya</p>
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden animate-fade-up">

            <div class="bg-sumbar py-6 text-center">
                <h2 class="text-white text-xl font-black uppercase italic tracking-widest">Panel Redaksi</h2>
                <p class="text-white/70 text-xs font-medium">Silahkan login untuk mengelola berita</p>
            </div>

            <div class="p-8">
                @if (session('error'))
                <div class="alert-box mb-6 bg-red-50 border-l-4 border-red-500 p-4 flex justify-between items-center transition-all">
                    <p class="text-sm text-red-700 font-bold">{{ session('error') }}</p>
                    <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">&times;</button>
                </div>
                @endif

                @if (session('success'))
                <div class="alert-box mb-6 bg-green-50 border-l-4 border-green-500 p-4 flex justify-between items-center">
                    <p class="text-sm text-green-700 font-bold">{{ session('success') }}</p>
                    <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">&times;</button>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-wider text-gray-500 mb-2">Username</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" name="username" autofocus required class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-sumbar transition-all text-sm" placeholder="Masukkan username">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-wider text-gray-500 mb-2">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password" id="password" required class="w-full pl-10 pr-12 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-sumbar transition-all text-sm" placeholder="••••••••">
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-sumbar transition">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-sumbar hover:bg-red-800 text-white font-black py-3 rounded-lg shadow-lg shadow-red-500/30 transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest italic text-sm">
                            Masuk Ke Sistem <i class="fas fa-sign-in-alt ml-2"></i>
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <a href="/" class="text-[11px] font-bold text-gray-400 hover:text-sumbar uppercase tracking-widest transition">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-6 text-center border-t bg-white">
        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.3em]">&copy; 2026 Sumbar Fakta. Hak Cipta Dilindungi.</p>
    </footer>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }

        // Auto hide alert after 4 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert-box');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 4000);

        // Keamanan: Disable klik kanan & F12 (Sesuai kode awal Anda)
        document.addEventListener('contextmenu', e => e.preventDefault());
        document.addEventListener('keydown', function(e) {
            if (e.key === 'F12' || (e.ctrlKey && (e.key === 'U' || e.key === 'I' || e.key === 'S'))) {
                e.preventDefault();
            }
        });

    </script>
</body>
</html>
@endguest

@auth
<script>
    window.location = "/admin/home";

</script>
@endauth

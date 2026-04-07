<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- MENGAMBIL TITLE DARI DATABASE --}}
    <title>{{ $setting->title ?? 'Sumbar Fakta' }}</title>

    @if($setting && $setting->favicon)
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $setting->favicon) }}">
    @else
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Roboto, sans-serif;
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

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        html {
            scroll-behavior: smooth;
        }

    </style>
</head>
<body class="bg-gray-50 text-gray-900">

    <div class="bg-white border-b py-2 hidden md:block">
        <div class="container mx-auto px-4 flex justify-between items-center text-[11px] font-bold text-gray-500 uppercase tracking-wider">
            {{-- MENAMPILKAN TANGGAL HARI INI SECARA DINAMIS --}}
            <div>{{ now()->translatedFormat('l, d F Y') }}</div>

            <div class="flex items-center space-x-4">
                <a href="https://www.facebook.com/login" target="_blank" class="hover:text-sumbar"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/accounts/login" target="_blank" class="hover:text-sumbar"><i class="fab fa-instagram"></i></a>
                <a href="https://www.youtube.com/ServiceLogin?service=youtube" target="_blank" class="hover:text-sumbar"><i class="fab fa-youtube"></i></a>
                <a href="https://twitter.com/login" target="_blank" class="hover:text-sumbar"><i class="fab fa-twitter"></i></a>
                {{-- MENGAMBIL EMAIL DARI DATABASE --}}
                <span class="border-l pl-4 tracking-normal font-normal">Hubungi Kami: {{ $setting->email ?? '-' }}</span>
            </div>
        </div>
    </div>

    <header class="bg-white py-6">
        <div class="container mx-auto px-4 flex flex-col lg:flex-row justify-between items-center gap-6">
            <div class="text-center lg:text-left shrink-0 cursor-pointer" onclick="location.href='/'">

                {{-- LOGIKA JUDUL DINAMIS BERDASARKAN TITLE DI DATABASE --}}
                <h1 class="text-5xl font-black italic tracking-tighter">
                    @if($setting && $setting->title)
                    @php
                    $words = explode(' ', $setting->title);
                    $firstWord = $words[0];
                    $remainingWords = implode(' ', array_slice($words, 1));
                    @endphp
                    <span class="text-sumbar">{{ $firstWord }}</span><span class="text-gray-900">{{ $remainingWords }}</span>
                    @else
                    <span class="text-sumbar">SUMBAR</span><span class="text-gray-900">FAKTA</span>
                    @endif
                </h1>

                {{-- MENGAMBIL TAGLINE DARI DATABASE --}}
                <p class="text-[10px] tracking-[0.4em] uppercase font-bold text-gray-400">
                    {{ $setting->tagline ?? 'Cerdas, Tajam, Terpercaya' }}
                </p>
            </div>

            <div class="container mx-auto flex items-center justify-between py-4">

                {{-- MENGAMBIL LOGO DARI DATABASE --}}
                @if($setting && $setting->logo)
                <a href="{{ url('/') }}">
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo Website" class="h-12 w-auto object-contain">
                </a>
                @else
                <div class="h-12 flex items-center text-gray-400 italic">
                    Logo Website
                </div>
                @endif
            </div>
        </div>
    </header>

    <nav class="bg-sumbar sticky top-0 z-50 shadow-md">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <ul class="flex items-center overflow-x-auto no-scrollbar py-3 space-x-6 text-white text-sm font-bold uppercase whitespace-nowrap">
                <li><a href="{{ url('/') }}" class="hover:bg-black/10 px-2 py-1 transition">Home</a></li>
                <li><a href="{{ url('/') }}#politik" class="hover:bg-black/10 px-2 py-1 transition">Politik</a></li>
                <li><a href="{{ url('/') }}#ekonomi" class="hover:bg-black/10 px-2 py-1 transition">Ekonomi</a></li>
                <li><a href="{{ url('/') }}#pendidikan" class="hover:bg-black/10 px-2 py-1 transition">Pendidikan</a></li>
                <li><a href="{{ url('/') }}#hukum" class="hover:bg-black/10 px-2 py-1 transition">Hukum & Kriminal</a></li>
                <li>
                    <a href="{{ url('/') }}#tv" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 px-3 py-1 rounded transition border border-white/20">
                        <i class="fas fa-tv text-[12px]"></i>
                        <span>TV</span>
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500 border border-white/50"></span>
                        </span>
                    </a>
                </li>
            </ul>
            <div class="flex items-center space-x-4">
                <input id="searchInput" type="text" placeholder="Cari berita..." class="hidden md:block px-3 py-1 text-xs rounded border-none focus:ring-2 focus:ring-red-400 outline-none">
                <div onclick="searchFunction()" class="text-white px-2 cursor-pointer hover:scale-110 transition"><i class="fas fa-search"></i></div>
            </div>
        </div>
    </nav>

    <div class="bg-gray-100 border-b">
        <div class="container mx-auto px-4 py-2 flex items-center">
            <span class="bg-gray-800 text-white text-[10px] font-bold px-2 py-1 uppercase italic mr-4 shrink-0 tracking-widest">
                Terkini
            </span>
            <marquee class="text-sm font-medium text-gray-600" onmouseover="this.stop();" onmouseout="this.start();">
                @forelse($running_news as $news)
                <span class="mx-4">
                    <span class="text-sumbar font-bold"></span>
                    {{ Str::limit(strip_tags($news->content), 100, '...') }}
                </span>
                @empty
                <span>Belum ada berita terbaru hari ini...</span>
                @endforelse
            </marquee>
        </div>
    </div>



    <main class="container mx-auto px-4 py-10 max-w-5xl">

        <h1 class="text-4xl font-black mb-8 border-l-8 border-sumbar pl-4">
            Box Redaksi {{ $setting->title }}
        </h1>

        {{-- STRUKTUR REDAKSI --}}
        <div class="bg-white shadow rounded-xl p-6 mb-8">
            <h2 class="font-bold text-xl mb-6 text-sumbar">
                Struktur Redaksi
            </h2>

            <div class="space-y-4">
                @forelse($redaksis as $item)
                <div class="border-b pb-2">
                    <p class="font-bold text-gray-800">{{ $item->nama }}</p>
                    <p class="text-gray-600 text-sm">{{ $item->jabatan }}</p>
                    <p class="text-gray-500 text-xs">{{ $item->email }}</p>
                </div>
                @empty
                <p class="text-gray-400 italic">
                    Data redaksi belum tersedia
                </p>
                @endforelse
            </div>
        </div>

    </main>

    <footer class="bg-white border-t mt-16 py-10 text-center">
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.3em]">&copy; {{ date('Y') }} {{ $setting->title ?? 'Sumbar Fakta' }}. Hak Cipta Dilindungi.</p>
    </footer>


    <script>
        function searchFunction() {
            const input = document.getElementById('searchInput');
            const query = input.value.trim();

            if (input.classList.contains('hidden')) {
                input.classList.remove('hidden');
                input.focus();
            } else if (query !== "") {
                window.location.href = "{{ route('news.search') }}?q=" + encodeURIComponent(query);
            } else {
                input.classList.add('hidden');
            }
        }

        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const query = this.value.trim();
                if (query !== "") {
                    window.location.href = "{{ route('news.search') }}?q=" + encodeURIComponent(query);
                }
            }
        });

    </script>

</body>
</html>

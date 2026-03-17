<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- MENGAMBIL TITLE DARI DATABASE --}}
    <title>{{ $setting->title}}</title>

    {{-- MENGAMBIL FAVICON DARI DATABASE --}}
    @if($setting && $setting->favicon)
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $setting->favicon) }}">
    @else
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $setting->favicon) }}">
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
                <span class="border-l pl-4 tracking-normal font-normal">Hubungi Kami: {{ $setting->email}}</span>
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
                    // Pecah kalimat menjadi array berdasarkan spasi
                    $words = explode(' ', $setting->title);
                    // Ambil kata pertama
                    $firstWord = $words[0];
                    // Ambil sisa katanya (jika ada)
                    $remainingWords = implode(' ', array_slice($words, 1));
                    @endphp

                    <span class="text-sumbar">{{ $firstWord }}</span><span class="text-gray-900">{{ $remainingWords }}</span>
                    @else
                    {{-- Default jika data di database kosong --}}
                    <span class="text-sumbar">SUMBAR</span><span class="text-gray-900">FAKTA</span>
                    @endif
                </h1>

                {{-- MENGAMBIL TAGLINE DARI DATABASE --}}
                <p class="text-[10px] tracking-[0.4em] uppercase font-bold text-gray-400">
                    {{ $setting->tagline ?? 'Cerdas, Tajam, Terpercaya' }}
                </p>
            </div>

            <div class="w-full max-w-[728px]">
                {{-- MENGAMBIL BANNER IKLAN DARI DATABASE --}}
                @if($setting && $setting->iklan)
                <a href="#" target="_blank">
                    <img src="{{ asset('storage/' . $setting->iklan) }}" alt="Iklan Header" class="w-full h-[90px] object-cover rounded shadow-sm border border-gray-100 hover:opacity-90 transition">
                </a>
                @else
                <div class="w-full h-[90px] bg-gray-100 flex items-center justify-center text-gray-400 italic rounded">
                    Space Iklan
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
                    {{-- Mengambil cuplikan Konten (bukan Judul) --}}
                    <span class="text-sumbar font-bold"></span>
                    {{ Str::limit(strip_tags($news->content), 100, '...') }}
                </span>
                @empty
                <span>Belum ada berita terbaru hari ini...</span>
                @endforelse
            </marquee>
        </div>
    </div>

    <main class="container mx-auto px-4 py-12 min-h-[60vh]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8">
                <div class="mb-10 border-b-4 border-sumbar w-fit pb-2">
                    <h2 class="text-3xl font-black italic uppercase tracking-tighter">
                        <span class="bg-sumbar text-white px-2 mr-2">H</span> Hasil Pencarian:
                        <span class="text-sumbar">"{{ $query }}"</span>
                    </h2>
                </div>

                @if($results->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($results as $news)
                    <article class="group bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition duration-300 border border-gray-100">
                        <div class="relative h-44 overflow-hidden bg-gray-200">
                            <img src="{{ asset('storage/' . $news->image_url) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="{{ $news->title }}">
                            <span class="absolute top-3 left-3 bg-sumbar text-white text-[10px] font-bold px-2 py-1 uppercase tracking-wider">{{ $news->category ?? 'Berita' }}</span>
                        </div>
                        <div class="p-4">
                            <a href="{{ url('news/'.$news->id) }}">
                                <h3 class="text-lg font-black leading-tight uppercase hover:text-sumbar transition">{{ Str::limit($news->title, 80) }}</h3>
                            </a>
                            <p class="text-[10px] text-gray-400 uppercase mt-2">{{ \Carbon\Carbon::parse($news->release_date)->translatedFormat('d F Y') }}</p>
                            <p class="text-sm text-gray-600 mt-3 line-clamp-3">{!! Str::limit(strip_tags($news->content), 120) !!}</p>
                            <div class="mt-3">
                                <a href="{{ url('news/'.$news->id) }}" class="text-xs font-black text-sumbar uppercase border-b-2 border-sumbar/20 hover:border-sumbar">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $results->appends(['q' => $query])->links() }}
                </div>
                @else
                <div class="text-center py-24 bg-white rounded-xl border-2 border-dashed border-gray-200">
                    <i class="fas fa-search text-6xl text-gray-100 mb-6"></i>
                    <h3 class="text-2xl font-black italic text-gray-400 uppercase tracking-tighter">Berita Tidak Ditemukan</h3>
                    <p class="text-gray-400 mt-2">Maaf, kami tidak dapat menemukan berita dengan kata kunci "{{ $query }}"</p>
                    <a href="/" class="mt-8 inline-block bg-sumbar text-white px-8 py-3 rounded text-xs font-black uppercase tracking-widest hover:bg-black transition shadow-lg">Kembali Ke Beranda</a>
                </div>
                @endif
            </div>

            {{-- SIDEBAR --}}
            <aside class="lg:col-span-4 space-y-6">
                {{-- JADWAL SHOLAT --}}
                <div class="bg-white border-t-4 border-sumbar shadow-sm overflow-hidden border-radius-7 mb-6">
                    {{-- Header: Link Utama ke IslamicFinder --}}
                    <div class="bg-sumbar p-3 text-white flex justify-between items-center">
                        <a href="https://www.islamicfinder.org/world/indonesia/padang/prayer-times/" target="_blank" class="hover:text-gray-200 flex items-center group transition">
                            <h3 class="font-black uppercase text-xs tracking-widest italic flex items-center">
                                <i class="fas fa-mosque mr-2 group-hover:scale-110 transition"></i>
                                Jadwal Sholat {{ $settings->city_name ?? 'Padang' }}
                            </h3>
                            <i class="fas fa-external-link-alt text-[8px] ml-2 opacity-70"></i>
                        </a>
                        <span class="text-[9px] font-bold opacity-80 uppercase">
                            {{ \Carbon\Carbon::now()->translatedFormat('d M Y') }}
                        </span>
                    </div>

                    <div class="p-4">
                        {{-- Info Tambahan ala IslamicFinder --}}
                        <div class="flex items-center justify-between mb-3 px-1">
                            <span class="text-[9px] font-bold text-gray-400 uppercase italic">Metode: Kemenag RI</span>
                            <a href="https://www.islamicfinder.org/islamic-calendar/" target="_blank" class="text-[9px] font-bold text-sumbar hover:underline">
                                <i class="fas fa-calendar-alt"></i> Kalender Hijriah
                            </a>
                        </div>

                        <div class="grid grid-cols-3 gap-2 text-center">
                            @php
                            // Data tetap diambil dari database admin agar sinkron
                            $jadwal = [
                            'Subuh' => $settings->subuh ?? '05:04',
                            'Dzuhur' => $settings->dzuhur ?? '12:26',
                            'Ashar' => $settings->ashar ?? '15:35',
                            'Maghrib' => $settings->maghrib ?? '18:31',
                            'Isya' => $settings->isya ?? '19:39',
                            ];
                            @endphp

                            @foreach($jadwal as $waktu => $jam)
                            <div class="{{ $waktu == 'Maghrib' ? 'bg-sumbar/5 border-sumbar/20' : 'bg-gray-50 border-gray-100' }} p-2 rounded border transition hover:shadow-md group">
                                <p class="text-[9px] uppercase font-bold {{ $waktu == 'Maghrib' ? 'text-sumbar' : 'text-gray-400' }}">{{ $waktu }}</p>
                                <p class="text-sm font-black {{ $waktu == 'Maghrib' ? 'text-sumbar' : 'text-gray-800' }}">{{ $jam }}</p>
                            </div>
                            @endforeach

                            {{-- Link ke Fitur IslamicFinder lainnya (Misal: Qibla/Weather) --}}
                            <a href="https://www.islamicfinder.org/qibla-direction/" target="_blank" class="bg-gray-50 p-2 rounded border border-gray-100 flex flex-col justify-center items-center hover:bg-green-50 transition">
                                <i class="fas fa-compass text-green-600 text-xs"></i>
                                <p class="text-[9px] font-bold mt-1 text-gray-700 uppercase">Kiblat</p>
                            </a>
                        </div>

                        {{-- Tombol Footer Widget --}}
                        <a href="https://www.islamicfinder.org" target="_blank" class="mt-4 block text-center bg-gray-100 hover:bg-gray-200 text-gray-600 py-1.5 rounded text-[10px] font-bold uppercase transition">
                            Lihat Detail di IslamicFinder
                        </a>
                    </div>
                </div>

                {{-- TERPOPULER --}}
                <div class="bg-white p-5 border-t-4 border-sumbar shadow-sm">
                    <div class="flex items-center justify-between mb-6 border-b pb-2">
                        <h3 class="font-black uppercase text-sm italic text-sumbar">Terpopuler</h3>
                        <i class="fas fa-fire text-orange-500"></i>
                    </div>
                    @php
                    $popularPosts = $posts->where('category', 'Populer')->take(3);
                    if ($popularPosts->isEmpty()) {
                    $popularPosts = $posts->take(3);
                    }
                    @endphp
                    <div class="space-y-6">
                        @forelse($popularPosts as $popular)
                        <div class="flex gap-4 items-start group cursor-pointer">
                            <span class="text-3xl font-black text-gray-100 group-hover:text-sumbar transition leading-none">{{ sprintf('%02d', $loop->iteration) }}</span>
                            <div>
                                <p class="text-sm font-bold group-hover:text-sumbar transition leading-snug">{{ Str::limit($popular->title, 70) }}</p>
                                <span class="text-[10px] text-gray-400">{{ $popular->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-gray-500 text-[12px]">Belum ada posting Terpopuler.</div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded shadow-lg overflow-hidden border relative">

                    <!-- Label Iklan -->
                    <span class="text-[9px] bg-gray-800 text-white px-2 py-1 rounded absolute top-2 right-2">
                        ADS
                    </span>

                    <!-- Gambar Iklan -->
                    <a href="https://www.tokopedia.com" target="_blank">
                        <img src="https://images.unsplash.com/photo-1607082349566-187342175e2f" alt="Promo Belanja Online" class="w-full h-48 object-cover">
                    </a>

                    <!-- Konten Iklan -->
                    <div class="p-4">

                        <h4 class="font-bold text-sm mb-2">
                            Promo Belanja Online Terbesar!
                        </h4>

                        <p class="text-xs text-gray-600 mb-3">
                            Nikmati berbagai promo menarik mulai dari elektronik, fashion, hingga kebutuhan rumah tangga.
                            Diskon hingga <b>70%</b> dan gratis ongkir untuk berbagai produk pilihan.
                        </p>

                        <!-- Tombol -->
                        <a href="https://www.tokopedia.com" target="_blank" class="block text-center bg-green-600 text-white text-xs font-semibold py-2 rounded hover:bg-green-700 transition">
                            Lihat Promo
                        </a>

                        <!-- Garis -->
                        <hr class="my-4">

                        <!-- Iklan kedua -->
                        <a href="https://www.traveloka.com" target="_blank">
                            <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470" alt="Promo Liburan" class="w-full h-40 object-cover rounded mb-3">
                        </a>

                        <h4 class="font-bold text-sm mb-1">
                            Promo Tiket & Hotel Murah
                        </h4>

                        <p class="text-xs text-gray-600 mb-3">
                            Rencanakan liburan Anda sekarang dengan harga spesial.
                            Dapatkan diskon tiket pesawat dan hotel hingga 50%.
                        </p>

                        <a href="https://www.traveloka.com" target="_blank" class="block text-center bg-blue-600 text-white text-xs font-semibold py-2 rounded hover:bg-blue-700 transition">
                            Pesan Sekarang
                        </a>

                    </div>

                </div>
            </aside>
        </div>
    </main>

    <footer class="bg-[#f8fafc] text-slate-700 pt-16 pb-8 border-t-8 border-sumbar">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            <div>
                <h2 class="text-5xl font-black italic tracking-tighter mb-4">
                    @if($setting && $setting->title)
                    @php
                    $words = explode(' ', trim($setting->title));
                    $firstWord = $words[0];
                    $remainingWords = count($words) > 1 ? implode(' ', array_slice($words, 1)) : '';
                    @endphp

                    <span class="text-sumbar">{{ $firstWord }}</span>
                    @if($remainingWords)
                    <span class="text-slate-800">&nbsp;{{ $remainingWords }}</span>
                    @endif
                    @else
                    <span class="text-sumbar">SUMBAR</span>
                    <span class="text-slate-800">&nbsp;FAKTA</span>
                    @endif
                </h2>
                <p class="text-[10px] tracking-[0.4em] uppercase font-bold text-gray-400">
                    {{ $setting->tagline ?? 'Cerdas, Tajam, Terpercaya' }}
                </p>
            </div>

            <div>
                <h4 class="font-bold uppercase mb-6 text-sm text-slate-900 tracking-[0.2em] border-b-2 border-sumbar w-fit pb-1">Navigasi Cepat</h4>
                <ul class="text-[11px] text-slate-500 space-y-3 font-bold uppercase tracking-widest">
                    <li class="hover:text-sumbar transition-colors cursor-pointer" onclick="window.scrollTo(0,0)">Halaman Depan</li>
                    <li class="hover:text-sumbar transition-colors cursor-pointer"><a href="{{ url('/') }}#politik">Kanal Politik</a></li>
                    <li class="hover:text-sumbar transition-colors cursor-pointer"><a href="{{ url('/') }}#ekonomi">Kanal Ekonomi</a></li>
                    <li class="hover:text-sumbar transition-colors cursor-pointer"><a href="{{ url('/') }}#pendidikan">Kanal Pendidikan</a></li>
                    <li class="hover:text-sumbar transition-colors cursor-pointer"><a href="{{ url('/') }}#tv">Kanal TV</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold uppercase mb-6 text-sm text-slate-900 tracking-widest">Layanan Redaksi</h4>
                <div class="flex flex-col gap-3">
                    <div class="mt-2 bg-white p-3 rounded-lg border border-slate-200 shadow-sm">
                        <p class="text-[10px] text-slate-400 font-bold uppercase mb-1">Hubungi Kami:</p>
                        <p class="text-[11px] text-slate-700 font-black uppercase">{{ $setting->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 border-t border-slate-200 pt-8 text-center">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.3em]">&copy; 2026 Sumbar Fakta. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <script>
        function searchFunction() {
            const input = document.getElementById('searchInput');
            const query = input.value.trim();

            // 1. Jika input sedang tersembunyi, tampilkan dan fokus
            if (input.classList.contains('hidden')) {
                input.classList.remove('hidden');
                input.focus();
            }
            // 2. Jika input sudah tampil DAN ada teksnya, langsung cari
            else if (query !== "") {
                window.location.href = "{{ route('news.search') }}?q=" + encodeURIComponent(query);
            }
            // 3. Jika input tampil tapi kosong, sembunyikan kembali
            else {
                input.classList.add('hidden');
            }
        }

        // Menangani tekan tombol Enter
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

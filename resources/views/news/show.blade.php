<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} | {{ $setting->title ?? 'Sumbar Fakta' }}</title>

    @if($setting && $setting->favicon)
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

        .prose img {
            border-radius: 0.5rem;
            margin: 2rem auto;
        }

    </style>
</head>
<body class="bg-gray-50 text-gray-900">

    {{-- TOPBAR --}}
    <div class="bg-white border-b py-2 hidden md:block">
        <div class="container mx-auto px-4 flex justify-between items-center text-[11px] font-bold text-gray-500 uppercase tracking-wider">
            <div>{{ now()->translatedFormat('l, d F Y') }}</div>
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:text-sumbar"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-sumbar"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-sumbar"><i class="fab fa-youtube"></i></a>
                <span class="border-l pl-4 tracking-normal font-normal">Hubungi Kami: {{ $setting->email ?? '-' }}</span>
            </div>
        </div>
    </div>

    {{-- HEADER & LOGO --}}
    <header class="bg-white py-6">
        <div class="container mx-auto px-4 flex flex-col lg:flex-row justify-between items-center gap-6">
            <div class="text-center lg:text-left shrink-0 cursor-pointer" onclick="location.href='/'">
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

    {{-- NAVIGATION --}}
    <nav class="bg-sumbar sticky top-0 z-50 shadow-md">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <ul class="flex items-center overflow-x-auto no-scrollbar py-3 space-x-6 text-white text-sm font-bold uppercase whitespace-nowrap">
                <li><a href="{{ url('/') }}" class="hover:bg-black/10 px-2 py-1 transition">Home</a></li>
                <li><a href="{{ url('/') }}#politik" class="hover:bg-black/10 px-2 py-1 transition">Politik</a></li>
                <li><a href="{{ url('/') }}#ekonomi" class="hover:bg-black/10 px-2 py-1 transition">Ekonomi</a></li>
                <li><a href="{{ url('/') }}#pendidikan" class="hover:bg-black/10 px-2 py-1 transition">Pendidikan</a></li>
                <li><a href="{{ url('/') }}#hukum" class="hover:bg-black/10 px-2 py-1 transition">Hukum & Kriminal</a></li>
                <li>
                    <a href="{{ url('/') }}#tv" class="flex items-center gap-2 bg-white/10 px-3 py-1 rounded">
                        <i class="fas fa-tv text-[12px]"></i> TV LIVE
                    </a>
                </li>
            </ul>
            <div class="flex items-center space-x-4">
                <input id="searchInput" type="text" placeholder="Cari berita..." class="hidden md:block px-3 py-1 text-xs rounded border-none outline-none">
                <div onclick="searchFunction()" class="text-white px-2 cursor-pointer hover:scale-110 transition"><i class="fas fa-search"></i></div>
            </div>
        </div>
    </nav>

    {{-- RUNNING TEXT --}}
    <div class="bg-gray-100 border-b">
        <div class="container mx-auto px-4 py-2 flex items-center">
            <span class="bg-gray-800 text-white text-[10px] font-bold px-2 py-1 uppercase italic mr-4 shrink-0">Terkini</span>
            <marquee class="text-sm font-medium text-gray-600" onmouseover="this.stop();" onmouseout="this.start();">
                @forelse($running_news as $rn)
                <span class="mx-4"><span class="text-sumbar font-bold">●</span> {{ $rn->title }}</span>
                @empty
                <span>Selamat Datang di Portal Berita Sumbar Fakta</span>
                @endforelse
            </marquee>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <main class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- ARTIKEL DETAIL --}}
            <div class="lg:col-span-8">
                <article class="bg-white p-6 md:p-10 rounded-lg shadow-sm border border-gray-100">

                    {{-- BREADCRUMB --}}
                    <nav class="flex text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-6">
                        <a href="/" class="hover:text-sumbar">Home</a>
                        <span class="mx-2">/</span>
                        <span class="text-sumbar">{{ $post->category }}</span>
                    </nav>

                    {{-- JUDUL --}}
                    <h1 class="text-3xl md:text-5xl font-black italic uppercase leading-tight tracking-tighter mb-6">
                        {{ $post->title }}
                    </h1>

                    {{-- META: AUTHOR & TANGGAL --}}
                    <div class="flex flex-wrap items-center gap-6 border-y border-gray-100 py-4 mb-8 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-sumbar rounded-full flex items-center justify-center text-white">
                                <i class="fas fa-user text-[10px]"></i>
                            </div>
                            <span>Oleh: <span class="text-gray-900">{{ $post->author ?? 'Redaksi' }}</span></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="far fa-calendar-alt text-sumbar"></i>
                            {{-- Gunakan release_date sesuai field di database --}}
                            <span>{{ \Carbon\Carbon::parse($post->release_date)->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="far fa-eye text-sumbar"></i>
                            <span>{{ number_format($post->views) }} Dilihat</span>
                        </div>
                    </div>

                    {{-- MEDIA: VIDEO ATAU GAMBAR --}}
                    <div class="mb-10">
                        @if($post->type === 'video' && $post->video_url)
                        <div class="aspect-video w-full rounded-lg overflow-hidden shadow-lg">
                            @php
                            $embedUrl = str_replace(
                            ['watch?v=', 'youtu.be/'],
                            ['embed/', 'youtube.com/embed/'],
                            $post->video_url
                            );
                            @endphp
                            <iframe class="w-full h-full" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                        @elseif($post->image_url)
                        <img src="{{ asset('storage/' . $post->image_url) }}" alt="{{ $post->title }}" class="w-full h-auto rounded-lg shadow-lg">
                        <p class="mt-3 text-xs italic text-gray-500 border-l-4 border-sumbar pl-3">{{ $post->title }}</p>
                        @endif
                    </div>

                    {{-- ISI BERITA --}}
                    <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
                        {!! $post->content !!}
                    </div>

                </article>
            </div>

            {{-- SIDEBAR --}}
            <aside class="lg:col-span-4 space-y-10">

                {{-- JADWAL SHOLAT --}}
                <div class="bg-white border-t-4 border-sumbar shadow-sm">
                    <div class="bg-sumbar p-3 text-white">
                        <h3 class="font-black uppercase text-xs italic flex items-center">
                            <i class="fas fa-mosque mr-2"></i> Jadwal Sholat {{ $setting->city_name ?? 'Padang' }}
                        </h3>
                    </div>
                    <div class="p-4 grid grid-cols-3 gap-2">
                        @php
                        $jadwal = [
                        'Subuh' => $setting->subuh ?? '05:04',
                        'Dzuhur' => $setting->dzuhur ?? '12:26',
                        'Ashar' => $setting->ashar ?? '15:35',
                        'Maghrib' => $setting->maghrib ?? '18:31',
                        'Isya' => $setting->isya ?? '19:39',
                        ];
                        @endphp
                        @foreach($jadwal as $waktu => $jam)
                        <div class="bg-gray-50 border p-2 rounded text-center">
                            <p class="text-[9px] uppercase font-bold text-gray-400">{{ $waktu }}</p>
                            <p class="text-sm font-black text-gray-800">{{ $jam }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- BERITA TERPOPULER --}}
                <div class="bg-white p-5 border-t-4 border-sumbar shadow-sm">
                    <div class="flex items-center justify-between mb-6 border-b pb-2">
                        <h3 class="font-black uppercase text-sm italic text-sumbar">Terpopuler</h3>
                        <i class="fas fa-fire text-orange-500"></i>
                    </div>
                    <div class="space-y-6">
                        @forelse($posts->sortByDesc('views')->take(5) as $popular)
                        <a href="{{ route('news.show', $popular->slug) }}" class="flex gap-4 items-start group block">
                            <span class="text-3xl font-black text-gray-100 group-hover:text-sumbar transition leading-none">
                                {{ sprintf('%02d', $loop->iteration) }}
                            </span>
                            <div>
                                <p class="text-sm font-bold group-hover:text-sumbar transition leading-snug">
                                    {{ Str::limit($popular->title, 60) }}
                                </p>
                                <span class="text-[10px] text-gray-400">{{ $popular->created_at->diffForHumans() }}</span>
                            </div>
                        </a>
                        @empty
                        <p class="text-sm text-gray-400 text-center">Belum ada berita.</p>
                        @endforelse
                    </div>
                </div>

                {{-- IKLAN SIDEBAR --}}
                <div class="w-full">

                    @if(!empty($setting?->iklan))

                    <img src="{{ asset('storage/'.$setting->iklan) }}" alt="Iklan Header" class="w-full h-auto rounded shadow-sm border border-gray-100">

                    @else

                    <div class="w-full py-10 bg-gray-100 flex items-center justify-center text-gray-400 italic rounded">
                        Space Iklan
                    </div>

                    @endif

                </div>

            </aside>
        </div>
    </main>

    {{-- FOOTER --}}
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

            <a href="{{ route('frontend.redaksi') }}">
                <div>
                    <h4 class="font-bold uppercase mb-6 text-sm text-slate-900 tracking-widest">
                        Box Redaksi
                    </h4>

                    <div class="flex flex-col gap-3">
                        <div class="mt-2 bg-white p-3 rounded-lg border border-slate-200 shadow-sm hover:bg-slate-50 transition">

                            <p class="text-[10px] text-slate-400 font-bold uppercase mb-1">
                                Hubungi Kami:
                            </p>

                            <p class="text-[11px] text-slate-700 font-black uppercase">
                                {{ $setting->email ?? '-' }}
                            </p>

                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="container mx-auto px-4 border-t border-slate-200 pt-8 text-center">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.3em]">&copy; {{ date('Y') }} {{ $setting->title ?? 'Sumbar Fakta' }}. Hak Cipta Dilindungi.</p>
        </div>
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

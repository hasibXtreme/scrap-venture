<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ScrapVenture — Verified Scrap Collectors Directory</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                            950: '#052e16',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8faf8;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col text-slate-800 antialiased selection:bg-brand-500 selection:text-white">

    <!-- Top Navigation Header -->
    <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-emerald-100/80 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('collectors.index') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-brand-600 to-teal-700 flex items-center justify-center shadow-lg shadow-brand-600/20 group-hover:scale-105 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="font-extrabold text-xl tracking-tight text-slate-900">Scrap<span class="text-brand-600">Venture</span></span>
                        <span class="hidden sm:inline-block text-[10px] font-bold tracking-wider uppercase px-2 py-0.5 rounded-full bg-brand-100 text-brand-800 border border-brand-200">Eco Network</span>
                    </div>
                    <p class="text-xs text-slate-500 font-medium hidden sm:block">Sustainable Scrap Marketplace</p>
                </div>
            </a>

            <!-- Right Nav Actions -->
            <div class="flex items-center gap-3 sm:gap-4">
                <a href="#products-section" class="hidden sm:inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-brand-700 px-3 py-2 rounded-xl hover:bg-slate-100 transition">
                    <svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span>Scrap Rates</span>
                </a>
                <a href="{{ route('collectors.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 active:bg-brand-800 text-white font-semibold text-sm transition-all shadow-md shadow-brand-600/20 hover:shadow-lg hover:shadow-brand-600/30 hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Join as Collector</span>
                </a>

                @auth
                    <div class="flex items-center gap-2 border-l border-slate-200 pl-3 sm:pl-4">
                        <a href="{{ route('admin.collectors.index') }}" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                            <svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span>Admin Portal</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition" title="Logout">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-semibold text-slate-600 hover:text-brand-700 px-3 py-2 rounded-xl hover:bg-emerald-50 transition border border-transparent hover:border-emerald-200">
                        Admin Access
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

        <!-- Flash Success Alert -->
        @if(session('success'))
            <div id="flash-banner" class="mb-8 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-center justify-between shadow-sm animate-fade-in">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-sm">{{ session('success') }}</p>
                        <p class="text-xs text-emerald-700">Thank you for helping us promote recycling and waste reduction!</p>
                    </div>
                </div>
                <button onclick="document.getElementById('flash-banner').remove()" class="text-emerald-500 hover:text-emerald-800 p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        <!-- Hero Section -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-emerald-950 to-teal-900 text-white p-8 sm:p-12 mb-10 shadow-xl shadow-emerald-950/10">
            <!-- Decorative Subtle Foliage Patterns -->
            <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute right-1/3 -top-10 w-48 h-48 bg-teal-400/10 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-500/20 border border-brand-400/30 text-brand-300 text-xs font-semibold uppercase tracking-wider mb-4">
                    <svg class="w-3.5 h-3.5 text-brand-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L9.5 7.5L3.5 8.5L8 12.5L6.5 18.5L12 15.5L17.5 18.5L16 12.5L20.5 8.5L14.5 7.5L12 2Z"/>
                    </svg>
                    Verified Collector Network
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white mb-4">
                    Connect with Local <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-300 via-emerald-200 to-teal-300">Scrap Collectors</span>
                </h1>
                <p class="text-slate-300 text-base sm:text-lg font-normal mb-6 leading-relaxed">
                    Easily locate certified recycling partners in your neighborhood. Turn your recyclable materials into cash while contributing to a cleaner environment.
                </p>

                <!-- Key Badges -->
                <div class="flex flex-wrap items-center gap-4 text-xs font-medium text-slate-300">
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-3 py-1.5 rounded-xl border border-white/10">
                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Admin Authenticated</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-3 py-1.5 rounded-xl border border-white/10">
                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>Direct Phone Contact</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-3 py-1.5 rounded-xl border border-white/10">
                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        <span>Instant Area Search</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search & Filter Controls -->
        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-emerald-100 mb-8 space-y-4">
            <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
                <!-- Search Box -->
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="search-input" 
                        placeholder="Search collectors by name or location (e.g. Alex, Dhaka)..." 
                        class="w-full pl-11 pr-10 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 focus:bg-white text-sm transition-all"
                        onkeyup="filterCollectors()"
                    >
                    <button 
                        id="clear-search" 
                        onclick="clearSearch()" 
                        class="hidden absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600"
                        title="Clear search"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Collector Counter -->
                <div class="shrink-0 flex items-center justify-between sm:justify-end gap-3 text-xs font-semibold text-slate-500">
                    <span class="bg-brand-50 text-brand-800 px-3 py-2 rounded-xl border border-brand-100 inline-flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                        <span id="results-count">{{ count($collectors) }}</span> Collectors Available
                    </span>
                </div>
            </div>

            <!-- Location Filter Tags (Built dynamically from collectors) -->
            <div id="location-tags-container" class="pt-2 border-t border-slate-100 flex items-center gap-2 overflow-x-auto pb-1 text-xs">
                <span class="text-slate-400 font-semibold uppercase tracking-wider text-[10px] shrink-0 mr-1">Locations:</span>
                <button onclick="filterByLocation('')" class="location-pill active px-3 py-1.5 rounded-lg bg-brand-600 text-white font-medium shrink-0 transition" data-location="">All</button>
                @php
                    $uniqueLocations = $collectors->pluck('location')->unique()->filter()->values();
                @endphp
                @foreach($uniqueLocations as $loc)
                    <button onclick="filterByLocation('{{ strtolower($loc) }}')" class="location-pill px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium shrink-0 transition" data-location="{{ strtolower($loc) }}">
                        📍 {{ $loc }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Collectors Grid -->
        <div id="collectors-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($collectors as $collector)
                <div 
                    class="collector-card bg-white rounded-2xl p-6 border border-emerald-100/70 shadow-sm hover:shadow-xl hover:shadow-brand-950/5 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between relative group overflow-hidden"
                    data-name="{{ strtolower($collector->name) }}"
                    data-location="{{ strtolower($collector->location) }}"
                >
                    <!-- Top Subtle Accent Line on Hover -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-brand-500 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                    <div>
                        <!-- Header Row: Verified Badge -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs font-bold shadow-xs">
                                <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Verified Collector
                            </div>

                            <span class="text-[11px] font-semibold text-slate-400 flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                            </span>
                        </div>

                        <!-- Collector Profile Header -->
                        <div class="flex items-start gap-4 mb-5">
                            <!-- Avatar -->
                            <div class="shrink-0 relative">
                                @if($collector->picture)
                                    <img src="{{  $collector->picture }}" alt="{{ $collector->name }}" class="w-20 h-20 rounded-2xl object-cover shadow-sm ring-4 ring-slate-100/80 group-hover:ring-brand-100 transition-all">
                                @else
                                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-brand-500 to-teal-700 text-white font-extrabold text-2xl flex items-center justify-center shadow-sm ring-4 ring-slate-100/80 group-hover:ring-brand-100 transition-all">
                                        {{ strtoupper(substr($collector->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="absolute -bottom-1 -right-1 bg-white p-1 rounded-full shadow-sm">
                                    <div class="w-4 h-4 rounded-full bg-brand-500 flex items-center justify-center text-white text-[9px]">✓</div>
                                </div>
                            </div>

                            <!-- Info -->
                            <div class="flex-grow min-w-0">
                                <h3 class="font-bold text-lg sm:text-xl text-slate-900 truncate leading-snug group-hover:text-brand-700 transition-colors">
                                    {{ $collector->name }}
                                </h3>
                                <div class="mt-1.5 inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-100 max-w-full truncate">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="truncate">{{ $collector->location }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Action Call Button -->
                    <div class="pt-4 border-t border-slate-100 mt-2 space-y-2">
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Contact Collector</span>
                        <div class="flex items-center gap-2">
                            <a 
                                href="tel:{{ $collector->phone }}" 
                                class="flex-grow inline-flex items-center justify-center gap-2.5 px-4 py-3 rounded-xl bg-brand-600 hover:bg-brand-700 active:bg-brand-800 text-white font-bold text-sm shadow-md shadow-brand-600/20 hover:shadow-lg hover:shadow-brand-600/30 transition-all active:scale-[0.98]"
                            >
                                <svg class="w-4 h-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="tracking-wide">{{ $collector->phone }}</span>
                            </a>
                            <button 
                                onclick="copyPhone('{{ $collector->phone }}', this)" 
                                class="p-3 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-brand-700 transition shrink-0 border border-slate-200/80 hover:border-emerald-200"
                                title="Copy Phone Number"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty state when no collectors exist at all -->
                <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-dashed border-slate-200 p-8">
                    <div class="w-16 h-16 rounded-full bg-brand-50 text-brand-600 mx-auto flex items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">No Verified Collectors Found</h3>
                    <p class="text-slate-500 text-sm max-w-md mx-auto mb-6">Be the first collector to join our sustainable network in your region!</p>
                    <a href="{{ route('collectors.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-semibold text-sm shadow-md transition">
                        <span>Register as Collector</span> &rarr;
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Empty Filter State (Hidden by default, shown by JS when search yields 0 matches) -->
        <div id="no-search-results" class="hidden py-16 text-center bg-white rounded-3xl border border-dashed border-slate-200 p-8 my-6">
            <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">No collectors match your search</h3>
            <p class="text-slate-500 text-sm mb-4">Try searching with a different name or location keyword.</p>
            <button onclick="clearSearch()" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition">
                Clear Filters
            </button>
        </div>

        <!-- Scrap Products & Market Rates Catalog Section -->
        <div id="products-section" class="mt-16 scroll-mt-24">
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-50 border border-brand-200/80 text-brand-700 text-xs font-bold uppercase tracking-wider mb-2">
                        ♻️ Market Rates Catalog
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Accepted <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-teal-600">Scrap Materials & Rates</span>
                    </h2>
                    <p class="text-slate-500 text-sm mt-1">Explore current market pricing guidelines for recyclable materials accepted across our network.</p>
                </div>

                @auth
                    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 text-white font-semibold text-xs hover:bg-slate-800 transition shadow-sm">
                        <span>Manage Products in Admin</span> &rarr;
                    </a>
                @endauth
            </div>

            <!-- Products Grid -->
            @if(isset($products) && count($products) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <div class="bg-white rounded-2xl p-5 border border-emerald-100/80 shadow-xs hover:shadow-xl hover:shadow-brand-950/5 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                            <!-- Subtle Top Hover Line -->
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-brand-500 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                            <div>
                                <!-- Image & Badges -->
                                <div class="relative w-full h-44 rounded-xl overflow-hidden mb-4 bg-slate-100 border border-slate-100">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-emerald-50 to-teal-100 text-slate-400">
                                            <svg class="w-8 h-8 mb-1 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-[11px] font-semibold text-slate-500">Recyclable Material</span>
                                        </div>
                                    @endif

                                    <!-- Category Pill -->
                                    <div class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full bg-slate-900/80 backdrop-blur-md text-emerald-300 text-[11px] font-bold border border-white/10">
                                        {{ $product->category }}
                                    </div>
                                </div>

                                <!-- Title & Description -->
                                <h3 class="font-bold text-base text-slate-900 group-hover:text-brand-700 transition-colors mb-1">
                                    {{ $product->product_name }}
                                </h3>
                                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-3">
                                    {{ $product->description }}
                                </p>
                            </div>

                            <!-- Footer Price Row -->
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Benchmark Rate</span>
                                <div class="inline-flex items-center gap-1 text-brand-700 font-extrabold text-sm bg-brand-50 px-2.5 py-1 rounded-lg border border-brand-200/60">
                                    <span>${{ number_format($product->price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-12 text-center bg-white rounded-3xl border border-dashed border-slate-200 p-8">
                    <div class="w-14 h-14 rounded-full bg-brand-50 text-brand-600 mx-auto flex items-center justify-center mb-3">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-1">Scrap Material Rates Coming Soon</h3>
                    <p class="text-slate-500 text-xs max-w-md mx-auto">Material listings and standard pricing rates are currently being updated.</p>
                </div>
            @endif
        </div>

        <!-- Join Banner Callout -->
        <div class="mt-16 bg-gradient-to-r from-brand-50 via-emerald-50 to-teal-50 rounded-3xl p-8 sm:p-10 border border-brand-200/60 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="max-w-xl text-center md:text-left">
                <span class="text-xs font-extrabold uppercase tracking-wider text-brand-700 bg-brand-100 px-3 py-1 rounded-full">Recycling Partner</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2 mb-2">Are you a scrap collector?</h2>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Join ScrapVenture today to get verified, gain local visibility, and connect directly with households and businesses looking to sell recyclable scrap.
                </p>
            </div>
            <a href="{{ route('collectors.create') }}" class="shrink-0 inline-flex items-center gap-2.5 px-6 py-3.5 rounded-2xl bg-brand-600 hover:bg-brand-700 active:bg-brand-800 text-white font-bold text-sm shadow-lg shadow-brand-600/25 hover:shadow-xl transition-all hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                <span>Join Collector Family</span>
            </a>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500 font-medium">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-lg bg-brand-600 text-white flex items-center justify-center text-xs font-bold">SV</div>
                <span>© {{ date('Y') }} ScrapVenture. All rights reserved.</span>
            </div>
            <p class="text-slate-400">Promoting Eco-Friendly Scrap Collection & Recycling</p>
        </div>
    </footer>



    <!-- Client-Side Search & Filter JavaScript -->
    <script>
        let selectedLocation = '';

        function filterCollectors() {
            const query = document.getElementById('search-input').value.toLowerCase().trim();
            const clearBtn = document.getElementById('clear-search');
            const cards = document.querySelectorAll('.collector-card');
            const noResults = document.getElementById('no-search-results');
            let visibleCount = 0;

            if (query.length > 0) {
                clearBtn.classList.remove('hidden');
            } else {
                clearBtn.classList.add('hidden');
            }

            cards.forEach(card => {
                const name = card.getAttribute('data-name') || '';
                const location = card.getAttribute('data-location') || '';

                const matchesQuery = name.includes(query) || location.includes(query);
                const matchesLocation = !selectedLocation || location.includes(selectedLocation);

                if (matchesQuery && matchesLocation) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('results-count').innerText = visibleCount;

            if (visibleCount === 0 && cards.length > 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        }

        function filterByLocation(loc) {
            selectedLocation = loc.toLowerCase().trim();
            
            // Update active pill styling
            document.querySelectorAll('.location-pill').forEach(pill => {
                if (pill.getAttribute('data-location') === selectedLocation) {
                    pill.classList.remove('bg-slate-100', 'text-slate-700', 'hover:bg-slate-200');
                    pill.classList.add('bg-brand-600', 'text-white');
                } else {
                    pill.classList.remove('bg-brand-600', 'text-white');
                    pill.classList.add('bg-slate-100', 'text-slate-700', 'hover:bg-slate-200');
                }
            });

            filterCollectors();
        }

        function clearSearch() {
            document.getElementById('search-input').value = '';
            filterByLocation('');
        }

        function copyPhone(phone, btn) {
            navigator.clipboard.writeText(phone).then(() => {
                const originalHTML = btn.innerHTML;
                btn.innerHTML = `<svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>`;
                btn.classList.add('bg-emerald-100', 'border-emerald-300');
                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                    btn.classList.remove('bg-emerald-100', 'border-emerald-300');
                }, 1500);
            });
        }
    </script>

    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal — Collector Verification</title>
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
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800 antialiased font-sans flex flex-col">

    <!-- Top Admin Navigation Header -->
    <header class="bg-slate-900 text-white border-b border-slate-800 sticky top-0 z-30 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brand-500 text-slate-950 flex items-center justify-center font-black text-xl shadow-md">
                    SV
                </div>
                <div>
                    <h1 class="font-extrabold text-lg text-white leading-tight">Admin Portal</h1>
                    <p class="text-xs text-slate-400">Collector Verification & Directory Management</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-200 hover:text-white bg-slate-800 hover:bg-slate-700 px-4 py-2.5 rounded-xl border border-slate-700 transition">
                    <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span>Products & Rates</span>
                </a>
                <a href="{{ route('collectors.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-emerald-400 hover:text-emerald-300 bg-slate-800 hover:bg-slate-700 px-4 py-2.5 rounded-xl border border-slate-700 transition">
                    <span>Public Directory</span> &rarr;
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 transition" title="Logout">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <!-- Flash Success Notification -->
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-900 rounded-2xl flex items-center gap-3 shadow-xs">
                <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0">
                    ✓
                </div>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Stats Overview Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <!-- Pending Review Card -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/80 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-amber-700 uppercase tracking-wider mb-1">Awaiting Review</p>
                    <p class="text-3xl font-extrabold text-slate-900">{{ $pendingcollectors->count() }}</p>
                    <p class="text-xs text-slate-500 mt-1">Collector applications pending</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Active Verified Card -->
            <div class="bg-white rounded-2xl p-6 border border-emerald-200/80 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-emerald-700 uppercase tracking-wider mb-1">Active Verified</p>
                    <p class="text-3xl font-extrabold text-slate-900">{{ $verifiedcollectors->count() }}</p>
                    <p class="text-xs text-slate-500 mt-1">Visible on public directory</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
            </div>

            <!-- Total Applications Card -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs flex items-center justify-between sm:col-span-2 lg:col-span-1">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Total Submissions</p>
                    <p class="text-3xl font-extrabold text-slate-900">{{ $pendingcollectors->count() + $verifiedcollectors->count() }}</p>
                    <p class="text-xs text-slate-500 mt-1">Total registered collectors</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-600 flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Approval Table -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 bg-amber-50/60 border-b border-amber-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-500 text-white flex items-center justify-center font-bold text-sm shadow-xs">
                        ⏳
                    </div>
                    <div>
                        <h2 class="font-extrabold text-lg text-slate-900">Pending Review Applications</h2>
                        <p class="text-xs text-slate-500">Approve to make verified profiles public or reject invalid applications</p>
                    </div>
                </div>
                <span class="text-xs font-bold text-amber-800 bg-amber-100 px-3 py-1 rounded-full">
                    {{ $pendingcollectors->count() }} Pending
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider">
                            <th class="py-4 px-6 font-bold">Collector Photo</th>
                            <th class="py-4 px-6 font-bold">Full Name</th>
                            <th class="py-4 px-6 font-bold">Phone Number</th>
                            <th class="py-4 px-6 font-bold">Location</th>
                            <th class="py-4 px-6 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($pendingcollectors as $collector)
                            <tr class="hover:bg-amber-50/30 transition">
                                <td class="py-4 px-6">
                                    @if($collector->picture)
                                        <img src="{{ asset('storage/' . $collector->picture) }}" alt="{{ $collector->name }}" class="w-12 h-12 rounded-xl object-cover shadow-xs border border-slate-200">
                                    @else
                                        <div class="w-12 h-12 bg-slate-200 text-slate-600 rounded-xl flex items-center justify-center font-bold">
                                            {{ strtoupper(substr($collector->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 px-6 font-bold text-slate-900">{{ $collector->name }}</td>
                                <td class="py-4 px-6 font-semibold text-slate-700">
                                    <a href="tel:{{ $collector->phone }}" class="hover:text-brand-600 flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        {{ $collector->phone }}
                                    </a>
                                </td>
                                <td class="py-4 px-6 text-slate-600">
                                    <span class="inline-flex items-center gap-1 bg-slate-100 text-slate-700 text-xs px-2.5 py-1 rounded-lg">
                                        📍 {{ $collector->location }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <form action="{{ route('admin.collectors.verify', $collector) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-brand-600 hover:bg-brand-700 active:bg-brand-800 text-white px-4 py-2 rounded-xl font-bold text-xs inline-flex items-center gap-1.5 shadow-sm transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Approve & Verify
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.collectors.destroy', $collector) }}" method="POST" class="inline" onsubmit="return confirm('Reject and remove this collector application?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 px-3.5 py-2 rounded-xl font-semibold text-xs transition">
                                            Reject
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-500 text-sm">
                                    No collector applications currently awaiting verification.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Verified Collectors Table -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 bg-emerald-50/60 border-b border-emerald-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-sm shadow-xs">
                        ✓
                    </div>
                    <div>
                        <h2 class="font-extrabold text-lg text-slate-900">Active Verified Collectors Directory</h2>
                        <p class="text-xs text-slate-500">Currently published on the public search index</p>
                    </div>
                </div>
                <span class="text-xs font-bold text-emerald-800 bg-emerald-100 px-3 py-1 rounded-full">
                    {{ $verifiedcollectors->count() }} Verified
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider">
                            <th class="py-4 px-6 font-bold">Collector Photo</th>
                            <th class="py-4 px-6 font-bold">Full Name</th>
                            <th class="py-4 px-6 font-bold">Phone Number</th>
                            <th class="py-4 px-6 font-bold">Location</th>
                            <th class="py-4 px-6 font-bold text-right">Verification Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($verifiedcollectors as $collector)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-4 px-6">
                                    @if($collector->picture)
                                        <img src="{{ asset('storage/' . $collector->picture) }}" alt="{{ $collector->name }}" class="w-10 h-10 rounded-xl object-cover shadow-xs border border-slate-200">
                                    @else
                                        <div class="w-10 h-10 bg-emerald-100 text-emerald-800 rounded-xl flex items-center justify-center font-bold text-xs">
                                            {{ strtoupper(substr($collector->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 px-6 font-bold text-slate-900">{{ $collector->name }}</td>
                                <td class="py-4 px-6 text-slate-700 font-semibold">{{ $collector->phone }}</td>
                                <td class="py-4 px-6 text-slate-600">📍 {{ $collector->location }}</td>
                                <td class="py-4 px-6 text-right">
                                    <span class="bg-emerald-100 text-emerald-800 border border-emerald-200 text-xs px-3 py-1 rounded-full font-bold inline-flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Verified Active
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-500 text-sm">
                                    No verified collectors currently active in system.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-6 mt-8">
        <div class="max-w-7xl mx-auto px-4 text-center text-xs text-slate-400 font-medium">
            ScrapVenture Admin Management System &bull; Eco Network
        </div>
    </footer>
</body>
</html>
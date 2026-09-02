<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal — Manage Products & Scrap Rates</title>
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
<body class="min-h-screen bg-slate-100 text-slate-800 antialiased font-sans flex flex-col selection:bg-brand-500 selection:text-white">

    <!-- Top Admin Navigation Header -->
    <header class="bg-slate-900 text-white border-b border-slate-800 sticky top-0 z-30 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brand-500 text-slate-950 flex items-center justify-center font-black text-xl shadow-md">
                    SV
                </div>
                <div>
                    <h1 class="font-extrabold text-lg text-white leading-tight">Admin Portal</h1>
                    <p class="text-xs text-slate-400">Scrap Products & Material Rates Management</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.collectors.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-200 hover:text-white bg-slate-800 hover:bg-slate-700 px-4 py-2.5 rounded-xl border border-slate-700 transition">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Collectors Portal</span>
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

    <!-- Main Content Container -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <!-- Flash Success Notification -->
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-900 rounded-2xl flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 font-bold">
                        ✓
                    </div>
                    <p class="font-bold text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Header Action & Overview Stats -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-xs">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-50 border border-brand-200 text-brand-700 text-xs font-bold uppercase tracking-wider mb-2">
                    📦 Product Management
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Scrap Products & Rates</h2>
                <p class="text-slate-500 text-sm mt-1">Manage accepted scrap materials, descriptions, categories, and unit pricing.</p>
            </div>

            <div>
                <a href="{{ route('admin.products.createwindow') }}" class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-2xl bg-brand-600 hover:bg-brand-700 active:bg-brand-800 text-white font-bold text-sm shadow-md shadow-brand-600/25 hover:shadow-lg transition-all active:scale-[0.98]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Add New Product</span>
                </a>
            </div>
        </div>

        <!-- Products Grid / Table -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-slate-800">All Product Listings</h3>
                    <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600 text-xs font-bold">{{ $products->count() }} Items</span>
                </div>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                    @foreach ($products as $product)
                        <div class="bg-slate-50/70 hover:bg-white rounded-2xl p-5 border border-slate-200/80 hover:border-brand-300 hover:shadow-xl hover:shadow-brand-950/5 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                            <!-- Top Subtle Hover Line -->
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-brand-500 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                            <div>
                                <!-- Image Preview & Category Badge -->
                                <div class="relative w-full h-48 rounded-xl overflow-hidden mb-4 bg-slate-100 border border-slate-200/80">
                                    @if ($product->image)
                                        <img src="{{ $product->image }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400">
                                            <svg class="w-10 h-10 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-xs font-semibold">No Image Uploaded</span>
                                        </div>
                                    @endif

                                    <!-- Category Pill -->
                                    <div class="absolute top-3 left-3 px-3 py-1 rounded-full bg-slate-900/80 backdrop-blur-md text-emerald-300 text-xs font-bold border border-white/10 shadow-xs">
                                        {{ $product->category }}
                                    </div>

                                    <!-- Price Badge -->
                                    <div class="absolute bottom-3 right-3 px-3 py-1.5 rounded-xl bg-brand-600 text-white font-extrabold text-xs shadow-md">
                                        ${{ number_format($product->price, 2) }}
                                    </div>
                                </div>

                                <!-- Product Info -->
                                <h4 class="font-bold text-lg text-slate-900 group-hover:text-brand-700 transition-colors mb-1">
                                    {{ $product->product_name }}
                                </h4>
                                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-4">
                                    {{ $product->description }}
                                </p>
                            </div>

                            <!-- Actions Row -->
                            <div class="pt-4 border-t border-slate-200/80 flex items-center justify-between gap-3">
                                <a href="{{ route('admin.products.updatewindow', $product->id) }}" class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-slate-100 hover:bg-brand-50 text-slate-700 hover:text-brand-700 font-semibold text-xs transition border border-slate-200 hover:border-brand-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    <span>Edit</span>
                                </a>

                                <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="flex-1 inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-red-50 hover:bg-red-100 text-red-700 font-semibold text-xs transition border border-red-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="py-16 text-center p-8">
                    <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-1">No Products Added Yet</h4>
                    <p class="text-slate-500 text-xs max-w-sm mx-auto mb-6">Start building your recyclable materials catalog by adding your first product.</p>
                    <a href="{{ route('admin.products.createwindow') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs shadow-md transition">
                        <span>Add Product</span> &rarr;
                    </a>
                </div>
            @endif
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
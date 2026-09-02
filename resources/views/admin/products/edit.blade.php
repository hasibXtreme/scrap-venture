<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product — ScrapVenture Admin</title>
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
<body class="min-h-screen bg-slate-900 text-slate-800 antialiased flex flex-col justify-between font-sans selection:bg-brand-500 selection:text-white">

    <!-- Top Navigation Bar -->
    <div class="max-w-7xl mx-auto w-full p-6 flex items-center justify-between">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition">
            &larr; Back to Products List
        </a>
        <div class="flex items-center gap-2 text-xs text-slate-400">
            <span class="w-2 h-2 rounded-full bg-brand-500"></span> Admin Portal
        </div>
    </div>

    <!-- Center Edit Card Form -->
    <main class="flex-grow flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl p-8 sm:p-10 border border-slate-100 relative overflow-hidden">
            <!-- Top Gradient Accent Line -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-brand-500 via-teal-500 to-brand-600"></div>

            <!-- Form Title Header -->
            <div class="mb-8 border-b border-slate-100 pb-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-800 text-xs font-bold uppercase tracking-wider mb-3">
                    ✏️ Edit Listing
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Update Product: {{ $product->product_name }}</h1>
                <p class="text-slate-500 text-xs mt-1">Modify material details, unit pricing, or update the picture.</p>
            </div>

            <!-- Error Banner -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 text-xs font-semibold space-y-1">
                    <div class="flex items-center gap-2 text-red-900 font-bold mb-1">
                        <svg class="w-4 h-4 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Please fix the validation errors below:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 text-red-700 pl-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Product Form -->
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Product Name & Category Row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Product Name -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Product Name
                        </label>
                        <input 
                            type="text" 
                            name="product_name" 
                            value="{{ old('product_name', $product->product_name) }}" 
                            placeholder="Product Name"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 focus:bg-white transition"
                        >
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Category
                        </label>
                        <input 
                            type="text" 
                            name="category" 
                            value="{{ old('category', $product->category) }}" 
                            placeholder="Category"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 focus:bg-white transition"
                        >
                    </div>
                </div>

                <!-- Price Input -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Unit Rate / Price ($)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 font-bold text-sm">
                            $
                        </div>
                        <input 
                            type="number" 
                            step="0.01"
                            name="price" 
                            value="{{ old('price', $product->price) }}" 
                            placeholder="0.00"
                            class="w-full pl-8 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 focus:bg-white transition"
                        >
                    </div>
                </div>

                <!-- Current Picture & Replacement -->
                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200/80 space-y-4">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Current Product Image
                    </label>
                    
                    <div class="flex items-center gap-4">
                        @if ($product->image)
                            <img src="{{ $product->image }}" alt="Current Image" class="w-20 h-20 rounded-xl object-cover border border-slate-200 shadow-xs">
                        @else
                            <div class="w-20 h-20 rounded-xl bg-slate-200 flex items-center justify-center text-slate-400 text-xs font-semibold">
                                No Image
                            </div>
                        @endif

                        <div class="flex-grow">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Replace Image (Optional)</label>
                            <input 
                                type="file" 
                                name="image" 
                                accept="image/*"
                                class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition"
                            >
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Description
                    </label>
                    <textarea 
                        name="description" 
                        rows="3" 
                        placeholder="Description..."
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 focus:bg-white transition"
                    >{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Form Action Buttons -->
                <div class="pt-4 flex items-center gap-3">
                    <button 
                        type="submit" 
                        class="flex-1 py-3.5 px-6 rounded-2xl bg-brand-600 hover:bg-brand-700 active:bg-brand-800 text-white font-bold text-sm shadow-lg shadow-brand-600/25 hover:shadow-xl transition-all active:scale-[0.98]"
                    >
                        Update Product
                    </button>
                    <a 
                        href="{{ route('admin.products.index') }}" 
                        class="px-6 py-3.5 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm transition"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="p-6 text-center text-xs text-slate-500 font-medium">
        © {{ date('Y') }} ScrapVenture Admin Management System
    </footer>

</body>
</html>
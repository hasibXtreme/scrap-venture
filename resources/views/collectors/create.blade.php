<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register as a Collector — ScrapVenture</title>
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
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased flex flex-col font-sans">

    <!-- Header Navigation -->
    <header class="bg-white border-b border-emerald-100/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('collectors.index') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-brand-600 to-teal-700 flex items-center justify-center shadow-md shadow-brand-600/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>
                <span class="font-extrabold text-xl text-slate-900">Scrap<span class="text-brand-600">Venture</span></span>
            </a>
            <a href="{{ route('collectors.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-brand-700 bg-slate-100 hover:bg-emerald-50 px-3.5 py-2 rounded-xl border border-slate-200 hover:border-emerald-200 transition">
                &larr; Back to Directory
            </a>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-grow flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-xl bg-white rounded-3xl shadow-xl shadow-brand-950/5 border border-emerald-100 p-6 sm:p-10 my-6">

            <!-- Title & Header -->
            <div class="text-center mb-8">
                <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-600 mx-auto flex items-center justify-center mb-3 border border-brand-100 shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Join Our Collector Family</h1>
                <p class="text-slate-500 text-sm mt-1">Register your profile to get verified and receive scrap pick-up requests</p>
            </div>

            <!-- Error Banners -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 text-sm">
                    <div class="font-bold flex items-center gap-2 mb-1 text-red-900">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Please fix the following issues:
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-xs text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration Form -->
            <form action="{{ route('collectors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- Name Field -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            placeholder="e.g. Alex Turner"
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 focus:bg-white transition"
                        >
                    </div>
                </div>

                <!-- Phone Field -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Phone Number <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="phone" 
                            value="{{ old('phone') }}" 
                            required 
                            placeholder="e.g. +880 1712345678"
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 focus:bg-white transition"
                        >
                    </div>
                </div>

                <!-- Location Field -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Operating Location <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="location" 
                            value="{{ old('location') }}" 
                            required 
                            placeholder="e.g. Dhaka, Gulshan"
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 focus:bg-white transition"
                        >
                    </div>
                </div>

                <!-- Upload Picture Dropzone -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Profile / ID Picture <span class="text-red-500">*</span></label>
                    <div class="relative border-2 border-dashed border-slate-200 hover:border-brand-500 bg-slate-50/50 hover:bg-emerald-50/30 rounded-2xl p-6 text-center transition cursor-pointer group" id="upload-box">
                        <input 
                            type="file" 
                            name="picture" 
                            id="picture-input"
                            accept="image/*" 
                            required
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            onchange="previewImage(event)"
                        >
                        <div id="upload-placeholder" class="flex flex-col items-center">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-400 group-hover:bg-brand-100 group-hover:text-brand-600 flex items-center justify-center mb-2 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-700 group-hover:text-brand-700">Click or drag photo here to upload</p>
                            <p class="text-xs text-slate-400 mt-1">PNG, JPG, WEBP up to 2MB</p>
                        </div>

                        <!-- Image Preview Container -->
                        <div id="preview-container" class="hidden flex-col items-center">
                            <img id="image-preview" src="#" alt="Preview" class="w-24 h-24 rounded-2xl object-cover shadow-sm mb-2 ring-4 ring-brand-100">
                            <span class="text-xs font-semibold text-brand-700" id="file-name">Photo selected</span>
                            <span class="text-[10px] text-slate-400">Click to replace photo</span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button 
                        type="submit" 
                        class="w-full py-4 px-6 rounded-2xl bg-brand-600 hover:bg-brand-700 active:bg-brand-800 text-white font-bold text-base shadow-lg shadow-brand-600/25 hover:shadow-xl transition-all active:scale-[0.98] flex items-center justify-center gap-2"
                    >
                        <span>Submit Registration</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Return Link -->
            <div class="text-center mt-6">
                <a href="{{ route('collectors.index') }}" class="text-xs font-semibold text-slate-500 hover:text-brand-700">
                    Return to Public Directory
                </a>
            </div>
        </div>
    </main>

    <script>
        function previewImage(event) {
            const input = event.target;
            const placeholder = document.getElementById('upload-placeholder');
            const previewContainer = document.getElementById('preview-container');
            const imagePreview = document.getElementById('image-preview');
            const fileName = document.getElementById('file-name');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    fileName.innerText = input.files[0].name;
                    placeholder.classList.add('hidden');
                    previewContainer.classList.remove('hidden');
                    previewContainer.classList.add('flex');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
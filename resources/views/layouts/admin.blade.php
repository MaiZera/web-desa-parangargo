<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100" x-data="{ sidebarOpen: false }">
    <!-- Root Container: Flex Row, Full Screen, No Window Scroll -->
    <div class="flex h-screen overflow-hidden" style="height: 100vh; overflow: hidden;">

        <!-- DESKTOP SIDEBAR (Visible on all screens now as requested) -->
        <aside class="flex md:flex flex-col w-64 shrink-0 bg-white border-r border-gray-200 h-full">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 border-b border-gray-100 shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <x-application-logo class="w-8 h-8 text-indigo-600 fill-current" />
                    <span class="text-xl font-bold text-gray-900 tracking-tight">Desa Parangargo</span>
                </a>
            </div>

            <!-- Navigation -->
            <div class="flex-1 overflow-y-auto p-4 space-y-1">


                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    Dashboard
                </a>

                <div class="px-2 mt-6 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Content
                    Management</div>

                <a href="{{ route('admin.announcements.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.announcements.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                        </path>
                    </svg>
                    Pengumuman
                </a>

                <!-- Berita Dropdown -->
                <div x-data="{ open: {{ request()->routeIs('admin.news.*') || request()->routeIs('admin.categories.*') ? 'true' : 'false' }} }"
                    class="relative">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.news.*') || request()->routeIs('admin.categories.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                            Berita
                        </div>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6">
                            </path>
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1" class="mt-2 space-y-1 pl-11"
                        style="display: none;">
                        <a href="{{ route('admin.news.index') }}"
                            class="block px-4 py-2 text-sm {{ request()->routeIs('admin.news.*') ? 'text-emerald-600 bg-emerald-50' : 'text-gray-600 hover:text-emerald-600 hover:bg-gray-50' }} rounded-lg transition-colors">
                            Daftar Berita
                        </a>
                        <a href="{{ route('admin.categories.index') }}"
                            class="block px-4 py-2 text-sm {{ request()->routeIs('admin.categories.*') ? 'text-emerald-600 bg-emerald-50' : 'text-gray-600 hover:text-emerald-600 hover:bg-gray-50' }} rounded-lg transition-colors">
                            Kategori Berita
                        </a>
                    </div>
                </div>

                <a href="{{ route('admin.galeri.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.galeri.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Galeri Foto
                </a>

                <a href="{{ route('admin.umkm.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.umkm.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    UMKM
                </a>

                <a href="{{ route('admin.banners.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.banners.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Banner Slider
                </a>

                <a href="{{ route('admin.sponsors.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.sponsors.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    Sponsor
                </a>

                <a href="{{ route('admin.feedback.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.feedback.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                        </path>
                    </svg>
                    Feedback
                </a>

                <a href="{{ route('admin.transparency.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.transparency.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Transparansi
                </a>

                <a href="{{ route('admin.agendas.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.agendas.*') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Agenda / Kalender
                </a>

                <!-- Tentang Desa Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-xl transition-colors text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            Tentang Desa
                        </div>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6">
                            </path>
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1" class="mt-2 space-y-1 pl-11"
                        style="display: none;">
                        <a href="{{ route('admin.profile-desa.edit') }}"
                            class="block px-4 py-2 text-sm {{ request()->routeIs('admin.profile-desa.*') ? 'text-emerald-600 bg-emerald-50' : 'text-gray-600 hover:text-emerald-600 hover:bg-gray-50' }} rounded-lg transition-colors">
                            Profile Desa
                        </a>
                        <a href="{{ route('admin.demografis.edit') }}"
                            class="block px-4 py-2 text-sm {{ request()->routeIs('admin.demografis.*') ? 'text-emerald-600 bg-emerald-50' : 'text-gray-600 hover:text-emerald-600 hover:bg-gray-50' }} rounded-lg transition-colors">
                            Demografis
                        </a>
                        <a href="{{ route('admin.staff.index') }}"
                            class="block px-4 py-2 text-sm {{ request()->routeIs('admin.staff.*') ? 'text-emerald-600 bg-emerald-50' : 'text-gray-600 hover:text-emerald-600 hover:bg-gray-50' }} rounded-lg transition-colors">
                            Struktur Desa
                        </a>
                        <!-- <a href="#"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-emerald-600 hover:bg-gray-50 rounded-lg transition-colors">
                            Maps
                        </a> -->
                        <a href="{{ route('admin.contact-info.edit') }}"
                            class="block px-4 py-2 text-sm {{ request()->routeIs('admin.contact-info.*') ? 'text-emerald-600 bg-emerald-50' : 'text-gray-600 hover:text-emerald-600 hover:bg-gray-50' }} rounded-lg transition-colors">
                            Kontak Desa
                        </a>
                    </div>
                </div>

                <a href="#"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                        </path>
                    </svg>
                    Layanan Publik
                </a>
            </div>

            <!-- User Profile -->
            <div class="p-4 border-t border-gray-100 flex-shrink-0">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50">
                    <div
                        class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold shrink-0">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- MOBILE SIDEBAR (Fixed overlay, hidden on desktop) -->
        <div x-cloak x-show="sidebarOpen" class="relative z-50 md:hidden" role="dialog" aria-modal="true">
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80" @click="sidebarOpen = false">
            </div>

            <div class="fixed inset-0 flex">
                <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-300 transform"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                    class="relative mr-16 flex w-full max-w-xs flex-1">
                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Mobile Sidebar Content (Duplicate of Desktop for now, can be extracted to partial) -->
                    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4">
                        <div class="flex h-16 shrink-0 items-center">
                            <x-application-logo class="w-8 h-8 text-indigo-600 fill-current" />
                            <span class="ml-2 text-xl font-bold text-gray-900 tracking-tight">Desa Parangargo</span>
                        </div>
                        <nav class="flex flex-1 flex-col">
                            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                <li>
                                    <ul role="list" class="-mx-2 space-y-1">
                                        <li>
                                            <a href="{{ route('dashboard') }}"
                                                class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-600' : 'text-gray-700 hover:text-emerald-600 hover:bg-gray-50' }}">
                                                <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('dashboard') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-600' }}"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                                </svg>
                                                Dashboard
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Column: Header + Content -->
        <div class="flex flex-1 flex-col overflow-hidden">
            <!-- Header (Flex Item) -->
            <header
                class="flex h-16 flex-shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">


                <!-- Breadcrumbs / Title -->
                <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                    <div class="flex items-center gap-x-4">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900">{{ $header ?? '' }}</h1>
                    </div>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center gap-x-4 lg:gap-x-6">
                    <!-- Search -->
                    <!-- <div class="relative hidden sm:block">
                        <svg class="pointer-events-none absolute left-3 top-2.5 h-5 w-5 text-gray-400"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                clip-rule="evenodd" />
                        </svg>
                        <input type="text"
                            class="block w-full rounded-md border-0 py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            placeholder="Search...">
                    </div> -->

                    <div class="h-6 w-px bg-gray-200" aria-hidden="true"></div>

                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <button type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button"
                            aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <div class="flex items-center">
                                <div
                                    class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="hidden lg:flex lg:items-center">
                                    <span class="ml-4 text-sm font-semibold leading-6 text-gray-900"
                                        aria-hidden="true">{{ Auth::user()->name }}</span>
                                </span>
                            </div>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-y-auto bg-gray-100 p-8">
                {{ $slot }}
            </main>
            </main>
        </div>
    </div>
    @stack('scripts')
</body>

</html>
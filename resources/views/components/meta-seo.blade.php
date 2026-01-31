@props([
    'title' => 'Desa Parangargo - Website Resmi Pemerintah Desa Parangargo, Kabupaten Malang',
    'description' => 'Website Resmi Pemerintah Desa Parangargo, Kabupaten Malang. Informasi layanan publik, berita desa, transparansi anggaran, UMKM, dan partisipasi masyarakat.',
    'keywords' => 'desa parangargo, kabupaten malang, pemerintah desa, layanan publik, transparansi desa, berita desa, umkm desa',
    'image' => null,
    'url' => null,
    'type' => 'website',
    'author' => 'Pemerintah Desa Parangargo',
    'publishedTime' => null,
    'modifiedTime' => null,
    'schema' => null,
])

@php
    $fullTitle = $title;
    $canonicalUrl = $url ?? url()->current();
    $ogImage = $image ?? asset('images/logo.png');
    
    // Ensure absolute URL for image
    if ($ogImage && !str_starts_with($ogImage, 'http')) {
        $ogImage = url($ogImage);
    }
@endphp

{{-- Basic Meta Tags --}}
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="{{ $author }}">
<meta name="robots" content="index, follow">
<meta name="language" content="Indonesian">
<meta name="revisit-after" content="7 days">

{{-- Canonical URL --}}
<link rel="canonical" href="{{ $canonicalUrl }}">

{{-- Open Graph / Facebook --}}
<meta property="og:type" content="{{ $type }}">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="Desa Parangargo">
<meta property="og:locale" content="id_ID">

@if($publishedTime)
    <meta property="article:published_time" content="{{ $publishedTime }}">
@endif

@if($modifiedTime)
    <meta property="article:modified_time" content="{{ $modifiedTime }}">
@endif

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $fullTitle }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $ogImage }}">
<meta name="twitter:site" content="@desaparangargo">
<meta name="twitter:creator" content="@desaparangargo">

{{-- Favicon --}}
<link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

{{-- Additional SEO Tags --}}
<meta name="rating" content="general">
<meta name="distribution" content="global">
<meta name="geo.region" content="ID-JI">
<meta name="geo.placename" content="Parangargo, Kabupaten Malang">

{{-- Structured Data (JSON-LD) --}}
@if($schema)
    <script type="application/ld+json">
        {!! $schema !!}
    </script>
@endif

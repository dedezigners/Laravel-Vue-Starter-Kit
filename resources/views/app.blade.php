<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/png" href="/assets/images/favicon.png">

    <link rel="stylesheet" href="/assets/de-splash.css">

    <!-- Scripts -->
    @routes
    @vite([
    "resources/js/app.ts",
    "resources/js/{$page['component']}.vue",
    "resources/scss/styles.scss",
    ])
    @inertiaHead
</head>

<body class="de-splash">
    @inertia

    <div class="de-splash__content">
        <div class="line"></div>
        <div class="line line--3"></div>
        <div class="line line--45"></div>
        <div class="line line--6"></div>
        <div class="line line--15"></div>
        <div class="line line--75"></div>
        <br>
        <div class="de-splash__inner">
            <span>Loading</span>
            <span class="dot">.</span>
            <span class="dot">.</span>
            <span class="dot">.</span>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EarnRef') }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#0b0c10] text-white">

    <!-- BG GLOW -->
    <div class="fixed top-[-150px] right-[-100px] w-[600px] h-[600px] bg-green-400/20 blur-[120px] rounded-full"></div>
    <div class="fixed bottom-0 left-[-150px] w-[500px] h-[500px] bg-green-300/10 blur-[120px] rounded-full"></div>

    <section class="min-h-screen flex flex-col items-center justify-center text-center px-6">

        <div
            class="px-4 py-1 text-xs font-semibold uppercase tracking-widest rounded-full bg-green-400/10 text-green-400 border border-green-400/20 mb-8">
            🚀 Earn With Referral
        </div>

        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight max-w-3xl mb-6 logo">
            Refer Friends.<br>
            <span class="text-green-400">Earn Money.</span><br>
            Grow Fast.
        </h1>

        <p class="text-gray-400 max-w-xl mb-10">
            Start earning by inviting your friends. Build your network and increase your income easily.
        </p>

        <div class="flex gap-4 flex-wrap justify-center">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="px-6 py-3 rounded-xl bg-green-400 text-black font-semibold shadow-lg hover:scale-105">
                    Go Dashboard →
                </a>
            @else
                <a href="{{ route('register') }}"
                    class="px-6 py-3 rounded-xl bg-green-400 text-black font-semibold shadow-lg hover:scale-105">
                    Start Now →
                </a>

                <a href="{{ route('login') }}"
                    class="px-6 py-3 rounded-xl border border-white/10 hover:border-green-400 hover:text-green-400">
                    Log in
                </a>
            @endauth
        </div>

    </section>

</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EarnRef') }}</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#0b0c10] text-white">

    <!-- BG -->
    <div class="fixed top-[-150px] right-[-100px] w-[600px] h-[600px] bg-green-400/20 blur-[120px] rounded-full"></div>
    <div class="fixed bottom-0 left-[-150px] w-[500px] h-[500px] bg-green-300/10 blur-[120px] rounded-full"></div>

    <div class="flex min-h-screen relative z-10">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-black/40 border-r border-white/10 backdrop-blur-xl p-6 flex flex-col justify-between">

            <!-- TOP -->
            <div>
                <!-- LOGO -->
                <a href="/" class="flex items-center gap-0 text-2xl font-extrabold logo mb-10">
                    <span class="text-white">Earn</span>
                    <span class="text-green-400">Ref</span>
                </a>

                <!-- MENU -->
                <nav class="space-y-2 text-sm">

                    <!-- DASHBOARD -->
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->is('dashboard*') ? 'bg-green-400/10 text-green-400 shadow-[0_0_15px_rgba(111,255,176,0.2)] border border-green-400/20' : 'hover:bg-white/5 hover:text-green-400' }}">

                        <span>📊</span>
                        <span>Dashboard</span>
                    </a>

                    <!-- REFERRALS -->
                    @hasrole('user')
                        <a href="{{ route('referrals') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                            {{ request()->is('referrals*') ? 'bg-green-400/10 text-green-400 shadow-[0_0_15px_rgba(111,255,176,0.2)] border border-green-400/20' : 'hover:bg-white/5 hover:text-green-400' }}">
                            <span>👥</span>
                            <span>Referrals</span>
                        </a>
                    @endhasrole

                    @hasrole('admin')
                        <a href="{{ route('users.index') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                            {{ request()->is('users*') ? 'bg-green-400/10 text-green-400 shadow-[0_0_15px_rgba(111,255,176,0.2)] border border-green-400/20' : 'hover:bg-white/5 hover:text-green-400' }}">
                            <span>👥</span>
                            <span>Users</span>
                        </a>
                    @endhasrole

                    <!-- PROFILE -->
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                    {{ request()->is('profile*') ? 'bg-green-400/10 text-green-400 shadow-[0_0_15px_rgba(111,255,176,0.2)] border border-green-400/20' : 'hover:bg-white/5 hover:text-green-400' }}">

                        <span>⚙️</span>
                        <span>Profile</span>
                    </a>

                </nav>
            </div>

            <!-- BOTTOM -->
            <div class="border-t border-white/10 pt-4">

                <div class="text-sm text-gray-400 mb-3">
                    {{ auth()->user()->name }}
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-400 text-sm hover:text-red-300 transition">
                        Logout →
                    </button>
                </form>

            </div>

        </aside>

        <!-- CONTENT -->
        <main class="flex-1 p-8">

            {{ $slot }}

        </main>

    </div>

</body>

</html>

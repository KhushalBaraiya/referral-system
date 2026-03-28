<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — {{ config('app.name', 'EarnRef') }}</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#0b0c10] text-white min-h-screen flex items-center justify-center px-6">

    <!-- BG GLOW -->
    <div class="fixed top-[-150px] right-[-100px] w-[600px] h-[600px] bg-green-400/20 blur-[120px] rounded-full"></div>
    <div class="fixed bottom-0 left-[-150px] w-[500px] h-[500px] bg-green-300/10 blur-[120px] rounded-full"></div>

    <!-- LOGIN CARD -->
    <div class="w-full max-w-md relative z-10">

        <!-- LOGO -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-0 text-2xl font-extrabold logo">
                <span class="text-white">Earn</span><span class="text-green-400">Ref</span>
            </a>
        </div>

        <!-- FORM -->
        <div class="bg-white/5 border border-white/10 backdrop-blur-xl rounded-2xl p-8 shadow-xl">

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- EMAIL -->
                <div>
                    <label class="text-sm text-gray-400 mb-1 block">Email</label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-3 rounded-lg bg-black/40 border border-white/10 focus:border-green-400 focus:ring-2 focus:ring-green-400/20 outline-none transition"
                        placeholder="Enter your email">
                </div>

                <!-- PASSWORD -->
                <div class="relative">
                    <label class="text-sm text-gray-400 mb-1 block">Password</label>

                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-3 pr-12 rounded-lg bg-black/40 border border-white/10 focus:border-green-400 focus:ring-2 focus:ring-green-400/20 outline-none transition"
                        placeholder="Enter your password">

                    <!-- TOGGLE BUTTON -->
                    <button type="button" onclick="togglePassword('password', this)"
                        class="absolute right-3 top-[38px] text-gray-400 hover:text-green-400 text-sm">
                        👁
                    </button>
                </div>

                <!-- REMEMBER + FORGOT -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-400">
                        <input type="checkbox" name="remember" class="accent-green-400">
                        Remember me
                    </label>

                    {{-- <a href="#" class="text-green-400 hover:underline">Forgot password?</a> --}}
                </div>

                <!-- LOGIN BUTTON -->
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-green-400 text-black font-semibold shadow-lg hover:scale-105 hover:shadow-green-400/40 transition">
                    Login →
                </button>

            </form>

            <!-- REGISTER -->
            <p class="text-center text-gray-400 text-sm mt-6">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-green-400 hover:underline">Register</a>
            </p>
        </div>
    </div>

    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);

            if (input.type === "password") {
                input.type = "text";
                btn.innerText = "🙈";
            } else {
                input.type = "password";
                btn.innerText = "👁";
            }
        }
    </script>
</body>

</html>

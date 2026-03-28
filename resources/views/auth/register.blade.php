<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register — {{ config('app.name', 'EarnRef') }}</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#0b0c10] text-white min-h-screen flex items-center justify-center px-6">

    <!-- BG -->
    <div class="fixed top-[-150px] right-[-100px] w-[600px] h-[600px] bg-green-400/20 blur-[120px] rounded-full"></div>
    <div class="fixed bottom-0 left-[-150px] w-[500px] h-[500px] bg-green-300/10 blur-[120px] rounded-full"></div>

    <div class="w-full max-w-md relative z-10">

        <!-- LOGO -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-0 text-2xl font-extrabold logo">
                <span class="text-white">Earn</span><span class="text-green-400">Ref</span>
            </a>
        </div>

        <!-- CARD -->
        <div class="bg-white/5 border border-white/10 backdrop-blur-xl rounded-2xl p-8 shadow-xl">

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- NAME -->
                <div>
                    <label class="text-sm text-gray-400 mb-1 block">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 rounded-lg bg-black/40 border 
                    @error('name') border-red-500 @else border-white/10 @enderror
                    focus:border-green-400 focus:ring-2 focus:ring-green-400/20 outline-none transition"
                        placeholder="Enter your name">

                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="text-sm text-gray-400 mb-1 block">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-lg bg-black/40 border 
                    @error('email') border-red-500 @else border-white/10 @enderror
                    focus:border-green-400 focus:ring-2 focus:ring-green-400/20 outline-none transition"
                        placeholder="Enter your email">

                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PASSWORD -->
                <div class="relative">
                    <label class="text-sm text-gray-400 mb-1 block">Password</label>

                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-3 pr-12 rounded-lg bg-black/40 border 
                    @error('password') border-red-500 @else border-white/10 @enderror
                    focus:border-green-400 focus:ring-2 focus:ring-green-400/20 outline-none transition"
                        placeholder="Create password">

                    <button type="button" onclick="togglePassword('password', this)"
                        class="absolute right-3 top-[38px] text-gray-400 hover:text-green-400 text-sm">
                        👁
                    </button>

                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- CONFIRM PASSWORD -->
                <div class="relative">
                    <label class="text-sm text-gray-400 mb-1 block">Confirm Password</label>

                    <input type="password" id="confirm_password" name="password_confirmation" required
                        class="w-full px-4 py-3 pr-12 rounded-lg bg-black/40 border
                    @error('password_confirmation') border-red-500 @else border-white/10 @enderror
                    focus:border-green-400 focus:ring-2 focus:ring-green-400/20 outline-none transition"
                        placeholder="Confirm password">

                    <button type="button" onclick="togglePassword('confirm_password', this)"
                        class="absolute right-3 top-[38px] text-gray-400 hover:text-green-400 text-sm">
                        👁
                    </button>

                    @error('password_confirmation')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-green-400 text-black font-semibold shadow-lg hover:scale-105 hover:shadow-green-400/40 transition">
                    Create Account →
                </button>

            </form>

            <!-- LOGIN -->
            <p class="text-center text-gray-400 text-sm mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-green-400 hover:underline">Login</a>
            </p>

        </div>

    </div>

    <!-- SCRIPT -->
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

<x-app-layout>

    <h1 class="text-3xl font-bold mb-8 logo">Profile Settings</h1>

    <div class="grid lg:grid-cols-2 gap-6">

        <!-- PROFILE UPDATE -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur">

            <h2 class="text-lg font-semibold mb-1">Profile Information</h2>
            <p class="text-gray-400 text-sm mb-6">Update your name and email</p>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                @csrf
                @method('patch')

                <!-- NAME -->
                <div>
                    <label class="text-sm text-gray-400 mb-1 block">Name</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                        class="w-full px-4 py-3 rounded-lg bg-black/40 border 
                        @error('name') border-red-500 @else border-white/10 @enderror
                        focus:border-green-400 focus:ring-2 focus:ring-green-400/20 outline-none">

                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="text-sm text-gray-400 mb-1 block">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                        class="w-full px-4 py-3 rounded-lg bg-black/40 border 
                        @error('email') border-red-500 @else border-white/10 @enderror
                        focus:border-green-400 focus:ring-2 focus:ring-green-400/20 outline-none">

                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- SAVE BUTTON -->
                <button type="submit"
                    class="px-6 py-3 rounded-xl bg-green-400 text-black font-semibold hover:scale-105 transition">
                    Save Changes →
                </button>

                @if (session('status') === 'profile-updated')
                    <p class="text-green-400 text-sm mt-2">Profile updated successfully ✔</p>
                @endif
            </form>

        </div>

        <!-- DELETE ACCOUNT -->
        <div class="bg-white/5 border border-red-500/20 rounded-2xl p-6 backdrop-blur">

            <h2 class="text-lg font-semibold text-red-400 mb-1">Delete Account</h2>
            <p class="text-gray-400 text-sm mb-6">
                Once deleted, your account cannot be recovered.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('DELETE')

                <!-- PASSWORD -->
                <div>
                    <label class="text-sm text-gray-400 mb-1 block">Confirm Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 rounded-lg bg-black/40 border 
                        @error('password') border-red-500 @else border-white/10 @enderror
                        focus:border-red-400 focus:ring-2 focus:ring-red-400/20 outline-none"
                        placeholder="Enter password">

                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- DELETE BUTTON -->
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-red-500 text-white font-semibold hover:scale-105 transition">
                    Delete Account
                </button>

            </form>

        </div>

    </div>

</x-app-layout>

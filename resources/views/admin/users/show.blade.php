<x-app-layout>

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold logo">
            User <span class="text-green-400">Details</span>
        </h1>
        <p class="text-gray-400 text-sm mt-1">
            Detailed referral performance overview
        </p>
    </div>

    <!-- GRID -->
    <div class="grid lg:grid-cols-3 gap-6">

        <!-- PROFILE (MATCH DASHBOARD STYLE) -->
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur text-center">

            <!-- AVATAR -->
            <div
                class="w-16 h-16 mx-auto rounded-full bg-green-400/20 flex items-center justify-center text-2xl font-bold text-green-400 mb-4">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <h2 class="text-lg font-semibold">{{ $user->name }}</h2>
            <p class="text-gray-400 text-sm">{{ $user->email }}</p>

            <div class="mt-4 text-sm text-gray-400 space-y-1">
                <p>
                    Referred By:
                    <span class="text-green-400">
                        {{ $user->parent?->name ?? 'Direct' }}
                    </span>
                </p>

                <p>
                    Joined:
                    {{ $user->created_at->diffForHumans() }}
                </p>
            </div>

        </div>

        <!-- STATS -->
        <div class="lg:col-span-2 grid md:grid-cols-2 gap-6">

            <!-- TOTAL REF -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur">
                <p class="text-gray-400 text-sm">Total Referrals</p>
                <h2 class="text-3xl font-bold mt-1">{{ $totalReferrals }}</h2>
            </div>

            <!-- TOTAL INCOME -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur">
                <p class="text-gray-400 text-sm">Total Earnings</p>
                <h2 class="text-3xl font-bold text-green-400 mt-1">
                    ₹{{ $totalIncome }}
                </h2>
            </div>

            <!-- LEVEL CARD (SAME AS DASHBOARD) -->
            <div
                class="md:col-span-2 rounded-2xl border border-green-400/20 bg-green-400/10 p-6 relative overflow-hidden">

                <!-- GLOW -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-green-400/20 blur-3xl rounded-full"></div>

                <div class="relative z-10">

                    <div class="flex justify-between mb-2">
                        <p class="text-gray-400 text-sm">Max Level</p>

                        <span class="px-3 py-1 text-xs rounded-full bg-green-400 text-black font-bold">
                            LEVEL {{ $maxLevel }}
                        </span>
                    </div>

                    <h2 class="text-4xl font-bold text-green-400">
                        Level {{ $maxLevel }} 🚀
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <!-- REFERRALS -->
    <div class="mt-10">

        <h2 class="text-xl font-semibold mb-4">Referral Tree</h2>

        <div class="bg-white/5 border border-white/10 rounded-2xl backdrop-blur overflow-hidden">

            <!-- RESPONSIVE TABLE -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm min-w-[600px]">

                    <thead class="border-b border-white/10 text-gray-400">
                        <tr>
                            <th class="p-4 text-left">User</th>
                            <th class="p-4 text-left">Email</th>
                            <th class="p-4 text-left">Level</th>
                            <th class="p-4 text-left">Joined</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($referrals as $item)
                            <tr class="border-b border-white/5 hover:bg-white/5 transition">

                                <td class="p-4 font-medium">
                                    {{ $item['user']->name }}
                                </td>

                                <td class="p-4 text-gray-400 break-all">
                                    {{ $item['user']->email }}
                                </td>

                                <td class="p-4">
                                    <span class="px-2 py-1 text-xs rounded-lg bg-green-400/10 text-green-400">
                                        Level {{ $item['level'] }}
                                    </span>
                                </td>

                                <td class="p-4 text-gray-400">
                                    {{ $item['user']->created_at->diffForHumans() }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-gray-400">
                                    No referrals found 🚀
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

    </div>

</x-app-layout>

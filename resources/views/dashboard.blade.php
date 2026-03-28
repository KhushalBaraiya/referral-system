<x-app-layout>

    @php
        $hour = now()->hour;
        $greeting = $hour < 12 ? 'Good Morning ☀️' : ($hour < 18 ? 'Good Afternoon 🌤️' : 'Good Evening 🌙');
    @endphp

    @hasrole('user')

        <!-- HEADER -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold logo">
                {{ $greeting }}, {{ auth()->user()->name }}
            </h1>
            <p class="text-gray-400 text-sm mt-1">
                Here’s your referral performance
            </p>
        </div>

        <!-- GRID -->
        <div class="grid lg:grid-cols-3 gap-6">

            <!-- PROFILE -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur text-center">

                <div
                    class="w-16 h-16 mx-auto rounded-full bg-green-400/20 flex items-center justify-center text-2xl font-bold text-green-400 mb-4">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <h2 class="text-lg font-semibold">{{ auth()->user()->name }}</h2>
                <p class="text-gray-400 text-sm">{{ auth()->user()->email }}</p>

                <a href="{{ route('profile.edit') }}"
                    class="mt-5 inline-block px-4 py-2 text-sm rounded-lg bg-green-400 text-black font-semibold hover:scale-105 transition">
                    Edit Profile →
                </a>

            </div>

            <!-- STATS -->
            <div class="lg:col-span-2 grid md:grid-cols-2 gap-6">

                <!-- TOTAL REF -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur">
                    <p class="text-gray-400 text-sm">Total Referrals</p>
                    <h2 class="text-3xl font-bold">{{ $totalReferrals }}</h2>
                </div>

                <!-- TOTAL INCOME -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur">
                    <p class="text-gray-400 text-sm">Total Earnings</p>
                    <h2 class="text-3xl font-bold text-green-400">₹{{ $totalIncome }}</h2>
                </div>

                <!-- LEVEL -->
                <div class="md:col-span-2 rounded-2xl border border-green-400/20 bg-green-400/10 p-6">

                    <div class="flex justify-between mb-2">
                        <p class="text-gray-400 text-sm">Current Level</p>
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

        <!-- RECENT REFERRALS -->
        <div class="mt-10">

            <h2 class="text-xl font-semibold mb-4">Recent Referrals</h2>

            <!-- NO HORIZONTAL SCROLL -->
            <div class="bg-white/5 border border-white/10 rounded-2xl backdrop-blur">

                <table class="w-full text-sm table-auto">
                    <thead class="border-b border-white/10 text-gray-400">
                        <tr>
                            <th class="p-4 text-left">Name</th>
                            <th class="p-4 text-left">Email</th>
                            <th class="p-4 text-left">Joined</th>
                            <th class="p-4 text-left">Level</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($referrals as $item)
                            <tr class="border-b border-white/5 hover:bg-white/5">

                                <td class="p-4">{{ $item['user']->name }}</td>

                                <td class="p-4 text-gray-400 break-all">
                                    {{ $item['user']->email }}
                                </td>

                                <td class="p-4">
                                    {{ $item['user']->created_at->diffForHumans() }}
                                </td>

                                <td class="p-4 text-green-400">
                                    Level {{ $item['level'] }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-400">
                                    No referrals yet 🚀
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>

        </div>

    @endhasrole

    @hasrole('admin')
        <!-- HEADER -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold logo">{{ $greeting }}, Admin 👑</h1>
            <p class="text-gray-400 text-sm mt-1">Manage your platform overview</p>
        </div>

        <!-- STATS GRID -->
        <div class="grid md:grid-cols-4 gap-6">

            <!-- TOTAL USERS -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur hover:border-green-400 transition">
                <p class="text-gray-400 text-sm">Total Users</p>
                <h2 class="text-3xl font-bold text-green-400">120</h2>
            </div>

            <!-- TODAY USERS -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur hover:border-green-400 transition">
                <p class="text-gray-400 text-sm">Today Registrations</p>
                <h2 class="text-3xl font-bold">8</h2>
            </div>

            <!-- TOTAL REFERRALS -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur hover:border-green-400 transition">
                <p class="text-gray-400 text-sm">Total Referrals</p>
                <h2 class="text-3xl font-bold">340</h2>
            </div>

            <!-- TOTAL EARNINGS -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur hover:border-green-400 transition">
                <p class="text-gray-400 text-sm">Total Earnings</p>
                <h2 class="text-3xl font-bold text-green-400">₹25,000</h2>
            </div>

        </div>

        <!-- RECENT USERS -->
        <div class="mt-10">

            <h2 class="text-xl font-semibold mb-4">Recent Users</h2>

            <div class="bg-white/5 border border-white/10 rounded-2xl backdrop-blur overflow-hidden">

                <table class="w-full text-sm">
                    <thead class="border-b border-white/10 text-gray-400">
                        <tr>
                            <th class="p-4 text-left">Name</th>
                            <th class="p-4 text-left">Email</th>
                            <th class="p-4 text-left">Joined</th>
                        </tr>
                    </thead>

                    <tbody>

                        <!-- STATIC -->
                        <tr class="border-b border-white/5 hover:bg-white/5">
                            <td class="p-4">Rahul Patel</td>
                            <td class="p-4 text-gray-400">rahul@gmail.com</td>
                            <td class="p-4">2 hours ago</td>
                        </tr>

                        <tr class="border-b border-white/5 hover:bg-white/5">
                            <td class="p-4">Amit Shah</td>
                            <td class="p-4 text-gray-400">amit@gmail.com</td>
                            <td class="p-4">1 day ago</td>
                        </tr>

                        <tr class="hover:bg-white/5">
                            <td class="p-4">Neha Jain</td>
                            <td class="p-4 text-gray-400">neha@gmail.com</td>
                            <td class="p-4">2 days ago</td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        <!-- RECENT REFERRALS -->
        <div class="mt-10">

            <h2 class="text-xl font-semibold mb-4">Recent Referrals</h2>

            <div class="bg-white/5 border border-white/10 rounded-2xl backdrop-blur overflow-hidden">

                <table class="w-full text-sm">
                    <thead class="border-b border-white/10 text-gray-400">
                        <tr>
                            <th class="p-4 text-left">User</th>
                            <th class="p-4 text-left">Referred By</th>
                            <th class="p-4 text-left">Joined</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr class="border-b border-white/5 hover:bg-white/5">
                            <td class="p-4">Ravi</td>
                            <td class="p-4 text-green-400">Rahul</td>
                            <td class="p-4">Today</td>
                        </tr>

                        <tr class="border-b border-white/5 hover:bg-white/5">
                            <td class="p-4">Kiran</td>
                            <td class="p-4 text-green-400">Amit</td>
                            <td class="p-4">Yesterday</td>
                        </tr>

                        <tr class="hover:bg-white/5">
                            <td class="p-4">Priya</td>
                            <td class="p-4 text-green-400">Neha</td>
                            <td class="p-4">2 days ago</td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>
    @endhasrole
</x-app-layout>

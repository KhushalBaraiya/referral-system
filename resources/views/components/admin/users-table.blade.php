<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

new class extends Component {
    use WithPagination;

    public string $search = '';

    // Reset page when search updates
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    // Computed property (BEST in Livewire 4)
    public function getUsersProperty()
    {
        return User::query()
            ->with('parent:id,name')
            ->select('id', 'name', 'email', 'parent_id', 'created_at')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")->orWhere('email', 'like', "%{$this->search}%");
                });
            })
            ->latest()
            ->paginate(10);
    }
};
?>

<div class="mt-10">

    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Recent Referrals</h2>

        <!-- Search -->
        <input type="text" wire:model.live="search" placeholder="Search user..."
            class="px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <!-- Table -->
    <div class="bg-white/5 border border-white/10 rounded-2xl backdrop-blur overflow-hidden">

        <table class="w-full text-sm">
            <thead class="border-b border-white/10 text-gray-400">
                <tr>
                    <th class="p-4 text-left">User</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Referred By</th>
                    <th class="p-4 text-left">Joined</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($this->users as $user)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition">

                        <td class="p-4 font-medium">{{ $user->name }}</td>

                        <td class="p-4 text-gray-400">{{ $user->email }}</td>

                        <td class="p-4 text-green-400">
                            {{ $user->parent?->name ?? 'Direct' }}
                        </td>

                        <td class="p-4 text-gray-400">
                            {{ $user->created_at->diffForHumans() }}
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-400">
                            No users found 🚀
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $this->users->links() }}
    </div>

</div>

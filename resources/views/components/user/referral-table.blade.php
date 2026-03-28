<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

new class extends Component {
    use WithPagination;

    public string $search = '';

    public bool $showModal = false;

    public $name = '';
    public $email = '';
    public $password = '';

    protected $paginationTheme = 'tailwind';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->reset(['name', 'email', 'password']);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'parent_id' => Auth::id(),
        ]);

        $user->assignRole('user');

        $this->closeModal();

        $this->reset(['name', 'email', 'password']);
        $this->resetPage();

        session()->flash('success', 'User created successfully 🚀');
    }

    public function getUsersProperty()
    {
        return User::query()
            ->with('parent:id,name')
            ->where('parent_id', Auth::id())
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

    <!-- FLASH -->
    @if (session()->has('success'))
        <div class="mb-4 p-3 rounded-xl bg-green-400/10 border border-green-400/20 text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">

        <h2 class="text-2xl font-bold">
            My <span class="text-green-400">Referrals</span>
        </h2>

        <div class="flex gap-3">

            <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search user..."
                class="px-4 py-2 rounded-xl bg-black/40 border border-white/10 text-sm 
                focus:border-green-400 focus:ring-2 focus:ring-green-400/20 outline-none">

            <button wire:click="openModal"
                class="px-5 py-2 rounded-xl bg-green-400/10 text-green-400 border border-green-400/20
                hover:bg-green-400 hover:text-black transition shadow-[0_0_20px_rgba(111,255,176,0.2)]">
                + Add User
            </button>

        </div>
    </div>

    <!-- TABLE -->
    <div class="bg-black/40 border border-white/10 rounded-2xl backdrop-blur-xl overflow-hidden">

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
                        <td class="p-4 text-green-400">{{ $user->parent?->name ?? 'Direct' }}</td>
                        <td class="p-4 text-gray-400">{{ $user->created_at->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-400">
                            No users found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $this->users->links() }}
    </div>

    <!-- MODAL -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center" x-data="{ open: true }" x-show="open"
            x-transition.opacity>

            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

            <div x-show="open" x-transition.scale
                class="relative w-full max-w-md p-6 rounded-2xl 
                bg-black/40 border border-white/10 backdrop-blur-xl
                shadow-[0_0_40px_rgba(111,255,176,0.15)]">

                <h2 class="text-xl font-semibold mb-5">
                    Add <span class="text-green-400">Referral</span>
                </h2>

                <div class="space-y-4">

                    <input type="text" wire:model="name" placeholder="Name"
                        class="w-full px-4 py-3 rounded-lg bg-black/40 border border-white/10
                        focus:border-green-400 focus:ring-2 focus:ring-green-400/20">

                    @error('name')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror

                    <input type="email" wire:model="email" placeholder="Email"
                        class="w-full px-4 py-3 rounded-lg bg-black/40 border border-white/10
                        focus:border-green-400 focus:ring-2 focus:ring-green-400/20">

                    @error('email')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror

                    <input type="password" wire:model="password" placeholder="Password"
                        class="w-full px-4 py-3 rounded-lg bg-black/40 border border-white/10
                        focus:border-green-400 focus:ring-2 focus:ring-green-400/20">

                    @error('password')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror

                </div>

                <div class="flex justify-end gap-3 mt-6">

                    <button wire:click="closeModal" class="px-4 py-2 rounded-lg bg-white/5 border border-white/10">
                        Cancel
                    </button>

                    <button wire:click="save"
                        class="px-5 py-2 rounded-lg bg-green-400 text-black font-medium
                        shadow-[0_0_15px_rgba(111,255,176,0.4)]">
                        Save
                    </button>

                </div>

            </div>
        </div>
    @endif

</div>

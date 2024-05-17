<x-filament-widgets::widget>
    <x-filament::section>
    <div class="flex flex-col md:flex-row items-center justify-between">
    <div>
    <h1 class="text-2xl font-semibold text-gray-900">Hello, {{ auth()->user()->name }} 👋</hjson>
    <p class="text-gray-600">Welcome back to your admin dashboard.</p>
</div>
        <a href="{{ route('workstation.index') }}" class="bg-blue-200 text-blue-500 py-2 px-4 rounded-md hover:bg-blue-300 transition-colors duration-300">Return to general user area -></a>
    </div>

    </x-filament::section>
</x-filament-widgets::widget>

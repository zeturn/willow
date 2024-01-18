@extends('layouts.page')

@section('content')
<div class="container mx-auto mt-12 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <h2 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">
                    {{ __('Demo Version') }}: {{ $version->name }}
                </h2>

                <div class="border-t border-gray-200 pt-6">
                    <!-- Description -->
                    <div class="bg-gray-50 px-4 py-5 dark:bg-gray-700">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">
                            {{ __('Description') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">
                            {{ $version->description }}
                        </dd>
                    </div>
                    <!-- Content -->
                    <div class="bg-white px-4 py-5 dark:bg-gray-800">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">
                            {{ __('Content') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">
                            <div class="bg-gray-200 p-4 rounded dark:bg-gray-600">
                                {{ $version->content }}
                            </div>
                        </dd>
                    </div>

                    @if($version->status == 1550)
                    <div class="flex space-x-4 mt-4">
                        <a href="{{ route('entry.branch.changeDemoVersion', [$version->branch->id, $version->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-200 ease-in-out">
                            {{ __('Convert to demo version') }}
                        </a>

                        <a href="{{ route('entry.branch.VersionAccept', [$version->branch->id, $version->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-200 ease-in-out">
                            {{ __('Version Accept') }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                <div class="mb-6">
                    <a href="{{ route('entry.branch.show.showDemoVersion', $version->branch->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 ease-in-out">
                        < {{ __('Back to Branch') }}
                    </a>
                </div>
                <!-- Author and Created At --> 
                <dl>
                    <div class="mb-4">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Author') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <x-user-name-and-avatar :user-id="$version->author->id" class="w-8 h-8 rounded-full" />
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Created At') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $version->created_at->format('d M, Y') }}
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Associated Walls and Wall Creation Form -->
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                @forelse($walls as $wall)
                    <a href="{{ route('wall.show', $wall->id) }}" class="text-lg text-blue-500 hover:text-blue-600 transition duration-200 mb-4 block">{{ $wall->name }}</a>
                @empty
                    <p class="text-gray-600">{{ __('No related walls') }}</p>
                @endforelse

                <!-- Wall Creation Form -->
                @if(auth()->check())
                <form action="{{ route('entry.version.createEWLink', $version->id) }}" method="POST" class="mt-6">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Wall Name') }}:</label>
                        <input type="text" id="name" name="name" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="mb-4">
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Wall Slug') }}:</label>
                        <input type="text" id="slug" name="slug" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Wall Description') }}:</label>
                        <textarea id="description" name="description" required class="appearance-none bg-gray-200 border border-gray-400 rounded p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>

                    <input type="submit" value="{{ __('Create Link') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                </form>
                @else
                    <!-- Not Authenticated User Message -->
                    <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                        <h2 class="text-xl font-semibold mb-4 text-gray-700">Authentication Required</h2>
                        <p class="text-sm text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">log in</a> to create new content.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

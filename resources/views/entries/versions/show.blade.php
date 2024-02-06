@extends('layouts.page')

@section('content')
<div class="container mx-auto mt-12 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">

            <nav class="flex justify-between">
                <ol class="inline-flex items-center mb-3 space-x-3 text-sm text-neutral-500 [&_.active-breadcrumb]:text-neutral-500/80 sm:mb-0">
                    <li class="flex items-center h-full"><a href="{{ url('/') }}" class="py-1 hover:text-neutral-900"><svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" /><path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" /></svg></a></li>  
                    <span class="mx-2 text-gray-400">/</span>
                    <li><a href="{{ route('entry.show.explanation', $version->branch->entry->id) }}" class="inline-flex items-center py-1 font-normal hover:text-neutral-900 focus:outline-none">{{ $version->branch->entry?->name }}</a></li>
                    <span class="mx-2 text-gray-400">/</span>
                    <li><a href="{{ route('entry.branch.show.showDemoVersion', $version->branch->id) }}" class="inline-flex items-center py-1 font-normal hover:text-neutral-900 focus:outline-none">{{ $version->branch?->id }}</a></li>
                    <span class="mx-2 text-gray-400">/</span>
                    <li><a class="inline-flex items-center py-1 font-normal rounded cursor-default active-breadcrumb focus:outline-none"> {{ $version->name }}</a></li>
                </ol>
            </nav>

                <h2 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">
                    {{ __('Version') }}: {{ $version->name }}
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

                    @if($version->status == 1301111545)
                    <a href="{{ route('entry.version.contentCensorShow', $version->id) }}" class="block bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 transition">
                        需要内容审核
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
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

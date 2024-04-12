{{-- entries/branches/show/show-editors.blade.php --}}
@extends('entries.branches.show.branch')

@section('action-button')
    {{-- Custom action button specific to Editors view --}}
@endsection

@section('entry-content')
<!--Trans:240412 Finish:All-->
    <div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
        {{-- Owner Section with Title --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">{{__('basic.Owner')}}</h2>
            <div class="border-b border-gray-200 mb-4 dark:border-gray-700"></div>
            <div class="flex items-center space-x-4 p-4">
                <x-user-name-and-avatar :user-id="$owner->id" class="w-12 h-12 rounded-full" />
            </div>
        </div>

        {{-- Editors Section with Title --}}
        <div>
            <h2 class="text-xl font-semibold mb-2">{{__('basic.Editors')}}</h2>
            <div class="border-b border-gray-200 mb-4 dark:border-gray-700"></div>
            <div class="flex flex-wrap -mx-4">
                <div class="w-full lg:w-3/4 px-4">
                    <ul class="flex flex-wrap -mx-2">
                        @foreach($editors as $editor)
                            <li class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-2">
                                <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 flex items-center space-x-4">
                                    <x-user-name-and-avatar :user-id="$editor->id" class="w-10 h-10 rounded-full" />
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-full lg:w-1/4 px-4 mt-6 lg:mt-0">
                    {{-- Sidebar content (if any) --}}
                </div>
            </div>
        </div>
    </div>
    {{-- Additional content --}}
@endsection

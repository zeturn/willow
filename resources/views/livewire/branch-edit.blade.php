<div class="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
    <div class="flex flex-wrap -mx-4">
        <!-- Main Column -->
        <div class="w-full px-4">
            <div class="bg-white rounded-lg p-6 dark:border-gray-700 dark:bg-gray-800 mb-4">
                @if ($step == 1)
                    <div class="flex flex-col space-y-2">
                        <button wire:click="loadPublicBranchVersions" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Change Public Branch') }}
                        </button>
                        <button wire:click="createNewBranch" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Create New Branch') }}
                        </button>
                    </div>
                @elseif ($step == 2 || $step == 3)
                    <div class="flex flex-col space-y-2">
                        @foreach ($versions as $version)
                            <button wire:click="selectVersion('{{ $version->id }}')" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ $version->name }}
                            </button>
                        @endforeach
                    </div>
                @elseif ($step == 4 || $step == 5)
                <div class="flex flex-row space-x-2">
                    <div class="w-1/2">
                        @foreach ($branches as $branch)
                            <button wire:click="selectBranch('{{ $branch->id }}')" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block w-50">
                                {{ $branch->id }}
                            </button>
                        @endforeach
                    </div>

                    <div class="w-1/2">
                        @foreach ($versions as $version)
                            <button wire:click="selectVersion('{{ $version->id }}')" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block w-25">
                                {{ $version->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                @endif

                <div class="preview-area w-full bg-gray-100 p-4 border border-gray-300 rounded">
                    @if ($selectedVersion)
                        <div>
                            <h3 class="font-bold mb-2">{{ __('Branch Name: ') }}{{ $selectedVersion->name }}</h3>
                            <p class="font-bold mb-2">{{ $selectedVersion->content }}</p>
                            <!-- Display other information about the branch -->
                        </div>
                    @else
                        <div>
                            <p class="text-gray-700">{{ __('Creating a new branch...') }}</p>
                            <!-- Logic for creating a new branch -->
                        </div>
                    @endif
                </div>

                

                                <!-- Sidebar content here -->
                <button wire:click="startTask()" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Create and Edit') }}
                </button>
            </div>
        </div>

    </div>
</div>

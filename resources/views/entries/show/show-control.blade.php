@extends('entries.show.entry') {{-- 确保使用了正确的布局文件 --}}

@section('entry-content')
    @auth
        <div>
            <div class="max-w-4xl mx-auto p-6 bg-white rounded-md">
                <h1 class="text-2xl font-semibold mb-4">
                    General Zone
                </h1>
                <div class="divide-y divide-gray-200">
                        <!-- Section: Change repository visibility -->
                        <div class="py-4">
                            <div class="flex flex-col sm:flex-row justify-between items-start">
                                    <div>
                                        <h2 class="text-sm font-medium">
                                            create new branch
                                        </h2>
                                        <p class="text-xs">
                                            从空白开始构建
                                        </p>
                                    </div>
                                    <a href="{{ route('entry.branch.create', $entry->id) }}" class="mt-4 sm:mt-0 inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 bg-white text-blue-600 hover:bg-blue-600 hover:text-white border border-gray-300">
                                        create
                                    </a>
                            </div>

                        </div>

                        <div class="py-4">

                            <div class="flex flex-col sm:flex-row justify-between items-start">
                                    <div>
                                        <h2 class="text-sm font-medium">
                                            查看该版本的词条分支
                                        </h2>
                                        <p class="text-xs">
                                            查看该版本（demo）的词条分支
                                        </p>
                                    </div>
                                    <a href="{{ route('entry.branch.list', ['entryId' => $entryId ]) }}" class="mt-4 sm:mt-0 inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 bg-white text-blue-600 hover:bg-blue-600 hover:text-white border border-gray-300">
                                        check
                                    </a>
                            </div>

                        </div>
                            
                        <div class="py-4">

                            <div class="flex flex-col sm:flex-row justify-between items-start">
                                    <div>
                                        <h2 class="text-sm font-medium">
                                            查看当前用户的词条分支
                                        </h2>
                                        <p class="text-xs">
                                            查看当前用户的词条分支
                                        </p>
                                    </div>
                                    <a href="{{ route('entry.branchUser.brancheslist', ['userId' => $userId, 'branchId' => $demoBranch->id, 'entryId' => $entryId ]) }}"  class="mt-4 sm:mt-0 inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 bg-white text-blue-600 hover:bg-blue-600 hover:text-white border border-gray-300">
                                        check
                                    </a>
                            </div>

                        </div>

                    </div>

                <!-- Other sections similar to above -->
                <!-- ... -->
                </div>
            </div>

            <div class="max-w-4xl mx-auto p-6 bg-white rounded-md">
                <h1 class="text-2xl font-semibold mb-4">
                    Danger Zone
                </h1>
                <div class="divide-y divide-gray-200">
                        <!-- Section: Change repository visibility -->
                        <div class="py-4">
                            <div class="flex flex-col sm:flex-row justify-between items-start">

                                    <div>
                                        <h2 class="text-sm font-medium">
                                            Soft deletion
                                        </h2>
                                        <p class="text-xs">
                                            Execute soft delete procedure.
                                        </p>
                                    </div>
                                    <form action="{{ route('entry.delete', $entry->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mt-4 sm:mt-0 inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 bg-white text-red-600 hover:bg-red-600 hover:text-white border border-gray-300">
                                        Soft delete
                                    </button>
                                    </form> 
                            </div>
                        </div>

                        <!-- Section: Change repository visibility -->
                        <div class="py-4">
                            <div class="flex flex-col sm:flex-row justify-between items-start">

                                    <div>
                                        <h2 class="text-sm font-medium">
                                            Deletion
                                        </h2>
                                        <p class="text-xs">
                                            Execute delete procedure.
                                        </p>
                                    </div>
                                    <form action="{{ route('entry.delete', $entry->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mt-4 sm:mt-0 inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 bg-white text-red-600 hover:bg-red-600 hover:text-white border border-gray-300">
                                        delete
                                    </button>
                                    </form> 
                            </div>
                        </div>

                <!-- Other sections similar to above -->
                <!-- ... -->
                </div>
            </div>
        </div>
    @endauth
@endsection
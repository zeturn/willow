<div class="bg-white rounded-lg dark:border-gray-700 dark:bg-gray-800 mb-4">

    <div x-data="{ modalOpen: false }"
    @keydown.escape.window="modalOpen = false"
    :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">

    <div class="mb-6">
        <!-- Display Comments -->
        @forelse($LFcomments as $comment)
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700 pb-4">
                <x-user-name-and-avatar :user-id="$comment->user->id" class="flex items-center space-x-3 mb-2" />
                <div class="text-xs text-gray-600 dark:text-gray-400 mt-2 mb-3">
                <span>Created: {{ optional($comment)->created_at ? $comment->created_at->diffForHumans() : 'Unknown' }}</span>
                <span>Updated: {{ optional($comment)->updated_at ? $comment->updated_at->diffForHumans() : 'Unknown' }}</span>

                </div>
                <p class=text-gray-500 dark:text-gray-400">{{ $comment->content }}</p>
                <button @click="modalOpen=true;$wire.getChildrenComments('{{ $comment->id }}')" @click="openModal('{{ $comment->id }}')" class="inline-flex items-center justify-center px-2 py-2 text-sm font-medium transition-colors bg-white rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">评论</button>

            </div>
        @empty
            <p class="text-gray-500 dark:text-gray-400">No comments yet.</p>
        @endforelse
        <!-- Pagination -->
        <div class="mt-4">
            {{ $LFcomments->links() }}
        </div>
    </div>

    <template x-teleport="body">
        <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
        <div x-show="modalOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="modalOpen=false;$wire.closeModal()" class="absolute inset-0 w-full h-full bg-white backdrop-blur-sm bg-opacity-70"></div>
        <div x-show="modalOpen"
            x-trap.inert.noscroll="modalOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
            class="relative w-full py-6 bg-white border shadow-lg px-7 sm:max-w-lg sm:rounded-lg">
            <div class="flex items-center justify-between pb-3">
                <h3 class="text-lg font-semibold">回复</h3>
                <button @click="modalOpen=false;$wire.closeModal()" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>  
                </button>
            </div>
            <div class="relative w-auto pb-8 max-h-96 overflow-y-auto overscroll-none">
                    @if($LFcomment)
                        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                            <x-user-name-and-avatar :user-id="$LFcomment->user->id" class="flex items-center space-x-3 mb-2" />
                            <p class="text-gray-500 dark:text-gray-400">{{ $LFcomment->content }}</p>
                            <div class="text-xs text-gray-600 dark:text-gray-400">
                            </div>
                            <button @click="$wire.selectComment('{{ $LFcomment->id }}','{{ $LFcomment->user->id }}')" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">回复</button>
                        </div>
                    @endif


                    <div id="reply-modal" x-data="{ isLoading: false }" x-ref="commentModal" @scroll="$refs.commentModal.scrollTop + $refs.commentModal.clientHeight >= $refs.commentModal.scrollHeight ? isLoading = true : ''" x-cloak>
                        @forelse($LScomments as $comment)
                        <div class="mb-4 border-b border-gray-200 dark:border-gray-700 pb-4">
                            <x-user-name-and-avatar :user-id="$comment->user->id" class="flex items-center space-x-3 mb-2" />
                            <p class="text-gray-500 dark:text-gray-400">{{ $comment->content }}</p>
                                <div class="text-xs text-gray-600 dark:text-gray-400">
                                    <button @click="$wire.selectComment('{{ $comment->id }}','{{ $comment->user->id }}')" @click="openModal('{{ $comment->id }}','{{ $comment->user->id }}')" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-gray-50 focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">回复</button>
                                </div>
                        </div>  
                        @empty
                            No comments yet.
                        @endforelse

                        <div x-data="{
                                observe () {
                                    let observer = new IntersectionObserver((entries) => {
                                        entries.forEach(entry => {
                                            if (entry.isIntersecting) {
                                                @this.call('loadMoreComments')
                                            }
                                        })
                                    }, {
                                        root: null
                                    })
                                    observer.observe(this.$el)
                                }
                            }"
                            x-init="observe"
                        ></div>
                        </div>

                    </div>
                    <!-- Check if user is authenticated -->
                    @if($commentBoadrd)
                        @if (auth()->check())
                            <!-- Add New Comment Form -->
                            <div class="bg-white rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <h2 class="text-md font-semibold mr-2">Add New Comment to</h2>
                                <x-user-name-and-avatar :user-id="$selectedCommentUserId" class="flex items-center space-x-3"/>
                            </div>
                            
                                <form action="{{ route('comment.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="topic_id" value="{{ $topicId }}">
                                    <input type="hidden" name="parent_id" value="{{ $selectedCommentId }}">
                                    <!-- Comment Field -->
                                    <div class="mb-4">
                                        <label for="content" class="block text-sm font-medium text-gray-700">Comment</label>
                                        <textarea name="content" id="content" rows="4" class="mt-1 p-2 w-full border rounded-lg" required></textarea>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="mt-4">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-lg">
                                            Post Comment
                                        </button>
                                    </div>
                                </form>


                            </div>
                        @else
                            <!-- Not Authenticated User Message -->
                            <div class="bg-white rounded-lg p-6">
                                <h2 class="text-xl font-semibold mb-4 text-gray-700">Authentication Required</h2>
                                <p class="text-sm text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">log in</a> to post a comment.</p>
                            </div>
                        @endif
                    @endif
            </div>
        </div>
    </template>

</div>
</div>
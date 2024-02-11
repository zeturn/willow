<header class="text-gray-600 body-font">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center mb-4 md:mb-0"  href="{{ url('/') }}">
      <span class="ml-3 text-blue-500 font-semibold text-3xl">memeGit </span>
    </a>

    <nav x-data="{
        navigationMenuOpen: false,
        navigationMenu: '',
        navigationMenuCloseDelay: 200,
        navigationMenuCloseTimeout: null,
        navigationMenuLeave() {
            let that = this;
            this.navigationMenuCloseTimeout = setTimeout(() => {
                that.navigationMenuClose();
            }, this.navigationMenuCloseDelay);
        },
        navigationMenuReposition(navElement) {
            this.navigationMenuClearCloseTimeout();
            this.$refs.navigationDropdown.style.left = navElement.offsetLeft + 'px';
            this.$refs.navigationDropdown.style.marginLeft = (navElement.offsetWidth/2) + 'px';
        },
        navigationMenuClearCloseTimeout(){
            clearTimeout(this.navigationMenuCloseTimeout);
        },
        navigationMenuClose(){
            this.navigationMenuOpen = false;
            this.navigationMenu = '';
        } }" class="relative md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400	flex flex-wrap items-center text-base justify-center z-50">
        <div class="relative">
            <ul class="flex items-center justify-center flex-1 p-1 list-none rounded-md text-neutral-700 group">
                <li>
                    <button
                        :class="{ 'bg-neutral-100' : navigationMenu=='entry-card', 'hover:bg-neutral-100' : navigationMenu!='entry-card' }" @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='entry-card'" @mouseleave="navigationMenuLeave()" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors rounded-md hover:text-neutral-900 focus:outline-none disabled:opacity-50 disabled:pointer-events-none group w-max">
                        <span>{{ __('Entry')}}</span> 
                        <svg :class="{ '-rotate-180' : navigationMenuOpen==true && navigationMenu == 'entry-card' }" class="relative top-[1px] ml-1 h-3 w-3 ease-out duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                </li>
                <li>
                    <button 
                        :class="{ 'bg-neutral-100' : navigationMenu=='discuss-card', 'hover:bg-neutral-100' : navigationMenu!='discuss-card' }" @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='discuss-card'" @mouseleave="navigationMenuLeave()" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors rounded-md hover:text-neutral-900 focus:outline-none disabled:opacity-50 disabled:pointer-events-none bg-background hover:bg-neutral-100 group w-max">
                        <span>{{ __('Discuss')}}</span>
                        <svg :class="{ '-rotate-180' : navigationMenuOpen==true && navigationMenu == 'discuss-card' }" class="relative top-[1px] ml-1 h-3 w-3 ease-out duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                </li>
                <li>
                    <button 
                        :class="{ 'bg-neutral-100' : navigationMenu=='category-card', 'hover:bg-neutral-100' : navigationMenu!='category-card' }" @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='category-card'" @mouseleave="navigationMenuLeave()" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors rounded-md hover:text-neutral-900 focus:outline-none disabled:opacity-50 disabled:pointer-events-none bg-background hover:bg-neutral-100 group w-max">
                        <span>{{ __('Category')}}</span>
                        <svg :class="{ '-rotate-180' : navigationMenuOpen==true && navigationMenu == 'category-card' }" class="relative top-[1px] ml-1 h-3 w-3 ease-out duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                </li>

                <li>
                    <a href="/search" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors rounded-md hover:text-neutral-900 focus:outline-none disabled:opacity-50 disabled:pointer-events-none bg-background hover:bg-neutral-100 group w-max">
                    {{ __('Search')}}
                    </a>
                </li>
            </ul>
        </div>
        <div x-ref="navigationDropdown" x-show="navigationMenuOpen"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            @mouseover="navigationMenuClearCloseTimeout()" @mouseleave="navigationMenuLeave()"
            class="absolute top-0 pt-3 duration-200 ease-out -translate-x-1/2 translate-y-11" x-cloak>

            <div class="flex justify-center w-auto h-auto overflow-hidden bg-white border rounded-md shadow-sm border-neutral-200/70">

                <!-- Entry -->
                <div x-show="navigationMenu == 'entry-card'" class="flex items-stretch justify-center w-full max-w-2xl p-6 gap-x-3">
                    <div class="w-72">
                        <a href="{{ url('/entry') }}" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">Index</span>
                            <span class="block font-light leading-5 opacity-50">Main page of entry index.</span>
                        </a>
                        <a href="{{ url('/entry/create') }}" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">Create Entry</span>
                            <span class="block leading-5 opacity-50">Entry Create Page</span>
                        </a>
                        <a href="{{ route('censor.tasks.list.entry') }}" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">Censor List</span>
                            <span class="block leading-5 opacity-50">Censor List Page</span>
                        </a>
                    </div>
                </div>
                <!-- Discuss -->
                <div x-show="navigationMenu == 'discuss-card'" class="flex items-stretch justify-center w-full p-6">
                    <div class="w-72">
                        <a href="{{ route('wall.index') }}" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">Wall index</span>
                            <span class="block font-light leading-5 opacity-50">index of wall</span>
                        </a>
                        <a href="{{ route('censor.tasks.list.entry') }}" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">Censor List</span>
                            <span class="block font-light leading-5 opacity-50">Censor List Page</span>
                        </a>
                    </div>
                </div>
                <!-- Category -->
                <div x-show="navigationMenu == 'category-card'" class="flex items-stretch justify-center w-full p-6">
                    <div class="w-72">
                        <a href="{{ route('categories.index') }}" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">Category Index</span>
                            <span class="block font-light leading-5 opacity-50">Main page of category index.</span>
                        </a>
                        <a href="{{ route('trees.index') }}" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">Tree</span>
                            <span class="block font-light leading-5 opacity-50">Main page of category index.</span>
                        </a>
                        <a href="{{ route('dag.index') }}" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">DAG</span>
                            <span class="block leading-5 opacity-50">Main page of DAG index.</span>
                        </a>
                    </div>
                    <div class="w-72">
                        <a href="{{ route('nodes.index') }}" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">Node</span>
                            <span class="block font-light leading-5 opacity-50">Main page of node index.</span>
                        </a>
                        <a href="{{ route('edges.index') }}" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100">
                            <span class="block mb-1 font-medium text-black">Edge</span>
                            <span class="block leading-5 opacity-50">Main page of edge index.</span>
                        </a>

                    </div>
                </div>
            
            </div>
        </div>
    </nav>

    @guest
      <button class="inline-flex items-center border-0 py-1 px-4 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
        <a href="{{ route('login') }}">{{ __('Login')}}</a>
      </button>
      <button class="inline-flex items-center border-0 py-1 px-4 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
        <a href="{{ route('register') }}">{{ __('Register')}}</a>
      </button>
    @else
        @if(Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div class="ms-3 relative">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                    @else
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                {{ Auth::user()->name }}

                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                    @endif
                </x-slot>

                <x-slot name="content">
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Account') }}
                    </div>

                    <x-dropdown-link href="{{ route('workstation.index') }}">
                        {{ __('Workstation') }}
                    </x-dropdown-link>

                    <x-dropdown-link href="{{ route('profile.show') }}">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </x-dropdown-link>
                    @endif

                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-dropdown-link href="{{ route('logout') }}"
                                    @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
        @else
          <span>{{ Auth::user()->name }}</span>
        @endif
    @endguest
  </div>
</header>

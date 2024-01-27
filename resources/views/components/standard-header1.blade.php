<header class="text-gray-600 body-font">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center mb-4 md:mb-0"  href="{{ url('/') }}">
      <span class="ml-3 text-blue-500 font-semibold text-3xl">memeGit </span>
    </a>

    <!--nav class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400	flex flex-wrap items-center text-base justify-center">
      <a class="mr-5  rounded hover:text-blue-500" href="{{ url('/entry') }}">Entry</a>
      <a class="mr-5  rounded hover:text-blue-500" href="{{ url('/wall') }}">Discuss</a>
      <a class="mr-5  rounded hover:text-blue-500" href="{{ route('categories.index') }}">Category</a>
      <a class="mr-5  rounded hover:text-blue-500">API</a>
    </nav-->

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
        }
    }"
    class="relative md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400	flex flex-wrap items-center text-base justify-center">
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
                <a href="#_" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors rounded-md hover:text-neutral-900 focus:outline-none disabled:opacity-50 disabled:pointer-events-none bg-background hover:bg-neutral-100 group w-max">
                {{ __('Documentation')}}
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
      <a href="{{ route('workstation.index') }}">
        @if(Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-full">
        @else
          <span>{{ Auth::user()->name }}</span>
        @endif
      </a>
    @endguest
  </div>
</header>

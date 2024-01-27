<header class="text-gray-600 body-font">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center mb-4 md:mb-0"  href="{{ url('/') }}">
      <span class="ml-3 text-blue-500 font-semibold text-3xl">memeGit </span>
    </a>
    <nav class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400	flex flex-wrap items-center text-base justify-center">
      <a class="mr-5  rounded hover:text-blue-500" href="{{ url('/entry') }}">Entry</a>
      <a class="mr-5  rounded hover:text-blue-500" href="{{ url('/wall') }}">Discuss</a>
      <a class="mr-5  rounded hover:text-blue-500" href="{{ route('categories.index') }}">Category</a>
      <a class="mr-5  rounded hover:text-blue-500">API</a>
    </nav>

    @guest
      <button class="inline-flex items-center border-0 py-1 px-4 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
        <a href="{{ route('login') }}">Login</a>
      </button>
      <button class="inline-flex items-center border-0 py-1 px-4 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
        <a href="{{ route('register') }}">Register</a>
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

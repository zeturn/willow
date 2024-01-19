<header class="text-gray-600 body-font">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center mb-4 md:mb-0 " href="{{ url('/') }}">
      <span class="ml-3 text-blue-500 text-lg">memeGit</span>
    </a>
    <div class="md:mr-auto md:ml-4 md:py-1 md:pl-4 flex flex-wrap items-center text-base justify-center">
      <!-- 这里我删除了三个链接 -->
      <a class="mr-5 hover:text-gray-900"></a>
    </div>

    @guest
      <!-- 搜索框添加在这里 -->
      <input type="text" placeholder="Search" class="border rounded py-1 px-3 mr-4">
      <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
        <a href="{{ route('login') }}">Login</a>
      </button>
      <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
        <a href="{{ route('register') }}">Register</a>
      </button>
    @else
      <a href="{{ route('workstation.index') }}">
        @if(Auth::user()->avatar)
          <img src="{{ Auth::user()->avatar }}" alt="avatar" class="rounded-full h-10 w-10">
        @else
          <span>{{ Auth::user()->name }}</span>
        @endif
      </a>
    @endguest
  </div>
</header>

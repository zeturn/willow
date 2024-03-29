@extends('layouts.guard')

@section('title')
    {{ __('Verify Email') }}
@endsection

@section('description', 'youxianbyanzheng')
@section('keywords', '迷因, meme, HollowData, memeGit')

@section('content')
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-1/3">
        <h1 class="text-3xl font-bold mb-6">Change Email</h1>

        <form action="{{ route('change.email') }}" method="post" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div>
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Current Email:</label>
                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div>
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div>
                <label for="new_email" class="block text-gray-700 text-sm font-bold mb-2">New Email:</label>
                <input type="email" id="new_email" name="new_email" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Change Email</button>
            </div>
        </form>
    </div>
</body>
@endsection

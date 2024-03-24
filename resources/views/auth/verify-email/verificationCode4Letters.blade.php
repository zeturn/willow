@extends('layouts.guard')

@section('title')
    {{ __('Verify Email') }}
@endsection

@section('description', 'youxianbyanzheng')
@section('keywords', '迷因, meme, HollowData, memeGit')


@section('content')
<livewire:verify-email.verification-code-4-letters />
@endsection
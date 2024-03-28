@extends('layouts.guard')

@section('title')
    {{ __('Verify Email (Change)') }}
@endsection

@section('description', 'youxianbyanzheng')
@section('keywords', '迷因, meme, HollowData, memeGit')


@section('content')
<livewire:change-email.verification-code-6-digits :emailVerification="$emailVerification" />
@endsection
@extends('layouts.page')

@section('title')
    {{ __('Explore meme') }}
@endsection

@section('description', 'memeGit是一个人文条目数据库，你可以在这里了解、创建和分享你的文化基因！这里针对迷因的特性针对设计了版本管理工具，帮助任何人轻松的向任何迷因提出自己的理解。')
@section('keywords', '迷因, meme, HollowData, memeGit')


@section('content')

<livewire:explore.entry-waterfall />

@endsection

@extends('master.main')

@section('content')
<div class="w-full md:w-11/12 mx-auto pb-8 space-y-4">
    <div class="mx-5 my-3 text-sm">
    <a href="" class=" text-red-600 font-bold tracking-widest">{{ $article->post->subject->title }}</a>
    </div>
    <div class="w-full text-gray-800 text-4xl px-5 font-bold leading-none">
        {{ $article->post->title }}
    </div>

    <div class="w-full text-gray-500 px-5 pb-5 pt-2">

    </div>

    <div class="mx-5 flex justify-center">
        @if ($article->media)
            <iframe src="{{ asset( Storage::url($article->media->path) ) }}" class="w-5/6 h-96 items-center"></iframe>
        @else

        @endif
    </div>

    <div class="w-full text-gray-600 text-normal mx-5">
        <p class="border-b py-3">{{ $article->post->resume }}</p>
    </div>

    <div class="px-5 w-full mx-auto">
        {{ $article->body }}
    </div>

    <div class="w-full text-gray-600 font-thin italic px-5 pt-3">
        Par <strong class="text-gray-700">{{ $article->post->author->first_name }} {{ $article->post->author->last_name }}</strong><br>
        {{ $article->created_at }}<br>
        {{-- Updated: 07/17/2020 10:33 AM EDT --}}
    </div>
    @can('publish')
    <form action="{{ route('articles.update', $article->id) }}" method="POST">
        @method('PUT')
        @csrf

        <button type="submit"  class="bg-blue-300 hover:bg-blue-100 shadow-sm rounded-lg px-2 transition duration-400 w-1/6 content-center py-2 m-5 font-bold text-white hover:text-gray-500">
            <i class="far fa-share-square pr-2"></i>
            publier
        </button>
    </form>

    @elsecan('send')

    <form action="{{ route('articles.update', $article->id) }}" method="POST">
        @method('PUT')
        @csrf

        <button type="submit"  class="bg-blue-300 hover:bg-blue-100 shadow-sm rounded-lg px-2 transition duration-400 w-1/6 content-center py-2 m-5 font-bold text-white hover:text-gray-500">
            <i class="far fa-share-square pr-2"></i>
            Enoyé
        </button>
    </form>

    @endcan
</div>
@endsection

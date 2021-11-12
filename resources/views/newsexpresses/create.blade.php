@extends('master.main')

@section('content')
<h1 class="text-xl">Création d'un article</h1>
<form action="{{ route('newsexpresses.store') }}" method="POST">

    @csrf

    <div class="m-3">
        <textarea class="bg-white rounded-md shadow-sm w-full p-2 outline-none h-18 font-extrabold text-3xl"
            type="text"
            id=tilte
            name=title
            placeholder="Entrez le titre de l'article ici...."
            required
            onChange='autoGrow'
        ></textarea>
    </div>

    <div class="m-3">
        <textarea class="bg-white rounded-md shadow-sm w-full p-2 outline-none h-18"
        id=body
        name=body
        placeholder='Entrez votre résumé ici...'
        onInput='autoGrow'
        ></textarea>
    </div>

    {{-- @can('edit-article') --}}
        <button type="submit" class="bg-blue-300 hover:bg-blue-100 shadow-sm rounded-lg transition duration-400 w-1/6 content-center py-2 m-5 font-bold text-white hover:text-gray-500">
            <i class="far fa-save pr-2"></i>
            Sauvegarder
        </button>
    {{-- @endcan --}}

</form>

@endsection

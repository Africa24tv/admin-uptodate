@extends('master.main')

@section('content')
    <h1 class="text-xl">Mise à jour de la permission</h1>
    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="m-3">
            <textarea class="bg-white rounded-md shadow-lg w-full p-2 outline-none h-18 font-extrabold text-3xl"
                type="text"
                name=name
                placeholder="Entrez le titre du permission ici...."
                required
                onChange='autoGrow'
            >{{ $permission->name }}</textarea>
        </div>
        <button type="submit" class="bg-blue-300 hover:bg-blue-100 shadow-lg rounded-lg transition duration-400 w-1/6 content-center py-2 m-5 font-bold text-white hover:text-gray-500">
            <i class="far fa-share-square pr-2"></i>
            Mise à jour
        </button>
    </form>
@endsection

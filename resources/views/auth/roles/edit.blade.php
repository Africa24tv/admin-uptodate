@extends('master.main')

@section('content')
    <h1 class="text-xl">Mise à jour du role</h1>
    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="m-3">
            <textarea class="bg-white rounded-md shadow-lg w-full p-2 outline-none h-18 font-extrabold text-3xl"
                type="text"
                name=name
                placeholder="Entrez le titre du permission ici...."
                required
                onChange='autoGrow'
            >{{ $role->name }}</textarea>
        </div>

        <div class="bg-white block m-3 space-y-2 rounded-md shadow-sm p-2">
            <label class="w-full pr-2 font-light" for="category">Sélectionnez les permissions</label>
            <hr />
            <div class="grid grid-cols-3 gap-4">
                @foreach ($permissions as $permission)
                @if ($role->permissions->contains($permission))
                <p class="flex flex-row space-x-2">
                    <span>{{ $permission->name }}</span>
                    <div class="bg-white border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                        <input type="checkbox" class="opacity-0 absolute" value="{{ $permission->id }}" name="permissions[]" checked>
                        <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                    </div>
                </p>
                @else
                <p class="flex flex-row space-x-2">
                    <span>{{ $permission->name }}</span>
                    <div class="bg-white border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                        <input type="checkbox" class="opacity-0 absolute" value="{{ $permission->id }}" name="permissions[]">
                        <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                    </div>
                </p>
                @endif
                @endforeach
            </div>
        </div>

        <button type="submit" class="bg-blue-300 hover:bg-blue-100 shadow-lg rounded-lg transition duration-400 w-1/6 content-center py-2 m-5 font-bold text-white hover:text-gray-500">
            <i class="far fa-share-square pr-2"></i>
            Mise à jour
        </button>
        <button onclick="window.location='{{ url()->previous() }}'" class="bg-red-300 hover:bg-red-100 shadow-lg rounded-lg transition duration-400 w-1/6 content-center py-2 m-5 font-bold text-white hover:text-gray-500">
            <i class="fas fa-trash-alt pr-2"></i>
            Annuler
        </button>
    </form>

    <style>
    input:checked + svg {
        display: block;
    }
    </style>
@endsection

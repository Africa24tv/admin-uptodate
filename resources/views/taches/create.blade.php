@extends('master.main')

@section('content')
    <h1 class="text-xl">Création d'une taches</h1>
    <form action="{{ route('taches.store') }}" method="POST">

        @csrf
        <div class="m-3">
            <textarea class="bg-white rounded-md shadow-lg w-full p-2 outline-none h-18 font-extrabold text-3xl"
                type="text"
                id=tilte
                name=title
                placeholder="Entrez le titre du tache ici...."
                required
                onChange='autoGrow'
            ></textarea>
        </div>

        <div class="m-3">
            <textarea class="bg-white rounded-md shadow-sm w-full p-2 outline-none h-18"
            id=resume
            name=resume
            placeholder='Entrez votre résumé ici...'
            onInput='autoGrow'
            ></textarea>
        </div>

        <div class="flex flex-row w-full">
            <div class="w-1/3">
                <div class="bg-white block m-3 space-y-2 rounded-md shadow-sm p-2">
                    <label class="w-full pr-2 font-light" for="level">Priorité</label>
                    <hr />
                    <select class="w-full border-gray-700 rounded-md focus:outline-none" id="level" name="level" onChange={changeType}>
                        <option >normale</option>
                        <option value="standard">faible</option>
                        <option>elevée</option>
                    </select>
                </div>
            </div>

            <div class="w-2/3">
                <div class="bg-white block m-3 space-y-2 rounded-md shadow-sm p-2">
                    <label class="w-full pr-2 font-light" for="acteur">Intervenants</label>
                    <hr />
                    <div class="flex flex-wrap">
                        @foreach ($users as $user)
                        <p class="flex flex-row space-x-8">
                            <span class="px-1">{{ $user->first_name }} {{ $user->last_name }}</span>
                            <div class="bg-white border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                                <input type="checkbox" class="opacity-0 absolute" value="{{ $user->id }}" name="users[]">
                                <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                            </div>
                        </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="bg-blue-300 hover:bg-blue-100 shadow-lg rounded-lg transition duration-400 w-1/6 content-center py-2 m-5 font-bold text-white hover:text-gray-500">
            <i class="far fa-save pr-2"></i>
            Valider
        </button>
    </form>

    <style>
    input:checked + svg {
        display: block;
    }
    </style>
@endsection

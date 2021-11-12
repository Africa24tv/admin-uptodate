@extends('master.main')

@section('content')
<h1 class="text-xl">Création du sujet</h1>
    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="m-3">
            <textarea class="bg-white rounded-md shadow-lg w-full p-2 outline-none h-18 font-extrabold text-3xl"
                type="text"
                id=tilte
                name=title
                placeholder="Entrez le titre du sujet ici...."
                required
                onChange='autoGrow'
            >{{ $subject->title }}</textarea>
        </div>

        <div class="bg-white block m-3 space-y-2 rounded-md shadow-lg p-2">
            <label class="w-full pr-2 font-light" htmlFor="category">Sélectionner son type</label>
            <hr />
            <select
                class="w-full border-gray-700 rounded-md focus:outline-none text-gray-400"
                id='type' name='type'
            >
                @foreach ($types as $type)
                    @if ($subject->type_id === $type->id)
                        <option value='{{ $type->id }}' selected class="text-gray-900">{{ $type->title }}</option>
                    @else
                        <option value='{{ $type->id }}' class="text-gray-900">{{ $type->title }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="m-3">
            <textarea class="border-b-2 focus:outline-none rounded-md shadow-lg p-3.5 w-full"
                type="text" id="resume" name="resume" placeholder="Saisissez le résumé..."
            >{{ $subject->resume }}</textarea>
        </div>

        {{-- <div class="mx-6 my-3">
            <label class="inline-flex items-center">
                <span>Est une sous catégorie ? </span>
                <input class="m-4 h-6 w-6" type="checkbox"
                onChange='handleCheckChange'/>
            </label>
        </div> --}}

        <div class="bg-white block m-3 space-y-2 rounded-md shadow-lg p-2">
            <label class="w-full pr-2 font-light" htmlFor="category">Sélectionner la catégorie parent</label>
            <hr />
            <select
                class="w-full border-gray-700 rounded-md focus:outline-none text-gray-400"
                id='parent' name='parent'
            >
                <option>...</option>
                @foreach ($categories as $categorie)
                    @if ($subject->subject_id === $categorie->id)
                        <option value='{{ $categorie->id }}' selected class="text-gray-900">{{ $categorie->title }}</option>
                    @else
                        <option value='{{ $categorie->id }}' class="text-gray-900">{{ $categorie->title }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-300 hover:bg-blue-100 shadow-lg rounded-lg transition duration-400 w-1/6 content-center py-2 m-5 font-bold text-white hover:text-gray-500">
            <i class="far fa-save pr-2"></i>
            Mettre à jour
        </button>
    </form>

    <script>
        function autoGrow(e) {
            e.target.style.height = (e.target.scrollHeight)+"px";
        }
    </script>
@endsection

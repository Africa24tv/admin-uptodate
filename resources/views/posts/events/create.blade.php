@extends('master.main')

@section('content')
<h1 class="text-xl">Création de l'Évènements</h1>
<form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">

    @csrf

    <div class="inline-flex items-center w-full">
        <div class="w-full">
            <div class="bg-white block m-3 space-y-2 rounded-md shadow-sm p-2">
                <label class="w-full pr-2 font-light" for="category">Sélectionnez la catégorie</label>
                <hr />
                <select
                    class="w-full border-gray-700 rounded-md focus:outline-none text-gray-400"
                    id='subject' name='subject'
                >
                    <option selected>...</option>
                    @foreach ($categories as $categorie)
                    <option value='{{ $categorie->id }}' class="text-gray-900">{{ $categorie->title }}</option>

                    @endforeach
                </select>
            </div>
        </div>
        <div class="w-full">
            <div class="bg-white block m-3 space-y-2 rounded-md shadow-sm p-2">
                <label class="w-full pr-2 font-light">Télécharger l'image de couverture</label>
                <hr />

                <div class="border border-dashed border-gray-500 rounded-md relative">
                    <input class="cursor-pointer relative block opacity-0 w-full h-full p-6 z-50"
                        type="file" title="Image de couverture" id="fichier" name="fichier" accept="image/*"
                        onChange={handleChange}
                    />
                <div class="text-center absolute top-0 right-0 left-0 bottom-0 m-auto">

                        <p class="">

                            Dépossez un fichier<br/> ou <br/>
                            <span class="bg-red-400 text-white m-2 px-2 py-1 rounded shadow-md hover:bg-red-50">Selectionner un fichier</span>
                        </p>
                        <p class="p-6 font-semibold"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-3">
        <textarea class="bg-white rounded-md shadow-sm w-full p-2 outline-none h-18 font-extrabold text-3xl"
            type="text"
            id=tilte
            name=title
            placeholder="Entrez l'évènemnet ...."
            required
            onChange='autoGrow'
        ></textarea>
    </div>

    <div class="flex flex-row m-3 space-x-4">
        <div class="w-full">
            <textarea class="bg-white rounded-md shadow-sm w-full p-2 outline-none h-18"
            id=resume
            name=resume
            placeholder='Entrez votre résumé ici...'
            onInput='autoGrow'
            ></textarea>
        </div>

        <div class="bg-white w-full rounded-md shadow-lg px-4 py-2 flex flex-col space-y-2">
            <label class="font-light">Localisation</label>
            <hr class=""/>
            <input type="text" class="p-2" name='location' placeholder="Entrez la localisation de l'évènement... "/>
        </div>
    </div>

    <div class="flex flex-row space-x-4 m-3">
        <div class="bg-white shadow-lg rounded-md flex flex-col space-y-4 px-4 pb-2 w-full">
            <div class="space-y-2">
                <label class="font-light">Début de l'Évènements</label>
                <hr class="" />
            </div>
            <div class="flex flex-row justify-center text-xl space-x-4">
                <input type="date" name="start_date" class="w-1/2 outline-none cursor-pointer font-light"/>
                <input type="time" name="start_time"class="w-1/2 outline-none cursor-pointer font-light border-l-2 border-gray-600 pl-6"/>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-md flex flex-col space-y-4 px-4 pb-2 w-full">
            <div class="space-y-2">
                <label class="font-light">Fin de L'Évènements</label>
                <hr class="" />
            </div>
            <div class="flex flex-row justify-center text-xl space-x-4">
                <input type="date" name="end_date" class="w-1/2 outline-none cursor-pointer font-light"/>
                <input type="time" name="end_time"class="w-1/2 outline-none cursor-pointer font-light border-l-2 border-gray-600 pl-6"/>
            </div>
        </div>
    </div>

    <div class="flex flex-row m-3 space-x-4">
        <div class="bg-white rounded-md shadow-lg w-1/2 px-4 py-2 flex flex-col space-y-2">
            <label class="font-light">Organisateur</label>
            <hr class=""/>
            <input type="text" class="p-2" name='organisateur'  placeholder="Entrez le nom de l'organisateur... "/>
        </div>

        <div class="bg-white rounded-md shadow-lg w-1/2 px-4 py-2 flex flex-col space-y-2">
            <label class="font-light">Lien</label>
            <hr class=""/>
            <input type="url" class="p-2" name='link' placeholder="Entrez le nom de l'organisateur... "/>
        </div>
    </div>

    <button type="submit" class="bg-blue-300 hover:bg-blue-100 shadow-lg rounded-lg transition duration-400 w-1/6 content-center py-2 m-5 font-bold text-white hover:text-gray-500">
        <i class="far fa-share-square pr-2"></i>
        Publier
    </button>
</form>

<script>
    function autoGrow(e) {
        e.target.style.height = (e.target.scrollHeight)+"px";
    }
</script>
@endsection

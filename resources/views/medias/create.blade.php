@extends('master.main')

@section('content')
<h1 class="text-xl">Création d'un média</h1>
    <form  action="{{ route('medias.store') }}" method="POST" enctype="multipart/form-data">

        @csrf
        <div class="m-3">
            <textarea class="bg-white rounded-md shadow-lg w-full p-2 outline-none h-18 font-extrabold text-3xl"
                type="text"
                id=tilte
                name=title
                placeholder="Entrez le titre du média ici...."
                required
                onChange='autoGrow'
            ></textarea>
        </div>

        <div class="bg-white block m-3 space-y-2 rounded-md shadow-sm p-2">
            <label class="w-full pr-2 font-light">Télécharger le média</label>
            <hr />

                <div class="border border-dashed border-gray-500 rounded-md relative">
                    <input class="cursor-pointer relative block opacity-0 w-full h-full p-6 z-50"
                        type="file" title="Image de couverture" id="fichier" name="fichier" accept="video/*"
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
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
        </div>

        <button type="submit" class="bg-white text-gray-700 hover:bg-blue-100 shadow-lg font-semibold rounded-lg transition duration-400 w-1/6 content-center py-2 m-5 font-boldhover:text-gray-500">
            <i class="far fa-save pr-2"></i>
            Enregistrer
        </button>
    </form>

    <script>
        function autoGrow(e) {
            e.target.style.height = (e.target.scrollHeight)+"px";
        }
    </script>
@endsection

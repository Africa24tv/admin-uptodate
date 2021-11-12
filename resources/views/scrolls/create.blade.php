@extends('master.main')

@section('content')
    <h1 class="text-xl">Création du scroll</h1>
    <form action="{{ route('scrolls.store') }}" method="POST">

        @csrf
        <div class="m-3">
            <textarea class="bg-white rounded-md shadow-lg w-full p-2 outline-none h-18 font-extrabold text-3xl"
                type="text"
                id=tilte
                name=title
                placeholder="Entrez le titre du scroll ici...."
                required
                onChange='autoGrow'
            ></textarea>
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

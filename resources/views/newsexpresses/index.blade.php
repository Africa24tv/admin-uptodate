@extends('master.main')

@section('content')
<h1>Liste des newsexpresses</h1>
<section class="container mx-auto p-6 font-mono">
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">

    <div class="flex flex-row items-center bg-white">

        <div class="w-3/5 flex flex-row items-center">
            <input type="search" class="py-1 px-3  mx-2 rounded-tl outline-none w-full" name="search" placeholder="Rechercher..."/>
            <i class="fas fa-search"></i>
        </div>
        @can('create-newsexpress')
        <div class="flex flex-row ml-auto">
            <a href="{{ route('newsexpresses.create') }}">
                <button
                    class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-green-500 rounded-md hover:bg-blue-700 focus:outline-none focus:bg-gray-600">
                    <i class="fas fa-plus"></i> NOUVEAU
                </button>
            </a>
        </div>
        @endcan
    </div>

    <div class="w-full overflow-x-auto md:overflow-x-hidden">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="text-center px-4">N°</th>
            <th class="px-4 py-3 w-full">Titre</th>
            <th class="px-4 py-3">actions</th>
          </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($newsexpresses as $i => $newsexpress)
            {{-- {{ dd($scroll->author) }} --}}
                <tr class="text-gray-700">
                    <td class="text-center border px-3">{{ ++$i }}</td>
                    <td class="px-4 py-3 border">
                        <div class="flex items-center text-sm">
                            {{ $newsexpress->title }}
                        </div>
                    </td>

                    <td class="px-4 py-3 text-sm border text-center">
                        <div class="justify-center">
                            <form action="{{ route('newsexpresses.destroy', $newsexpress->id) }}" method="post" class="flex flex-row space-x-4">
                                @method('DELETE')
                                @csrf
                                <a class="text-blue-500 outline-none transform ease-in-out duration-200 hover:scale-125" href="{{ route('newsexpresses.edit', $newsexpress->id) }}"><i class="fas fa-edit"></i></a>
                                <button class="text-red-500 outline-none transform ease-in-out duration-200 hover:scale-125" type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        {{ $newsexpresses->links() }}
      </table>
    </div>
  </div>
</section>
@endsection

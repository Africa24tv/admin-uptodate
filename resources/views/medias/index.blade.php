@extends('master.main')

@section('content')
<h1>Liste des médias</h1>
<section class="container mx-auto p-6 font-mono">
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">

    <div class="flex justify-end mt-6">
            <a href="{{ route('medias.create') }}">
                <button
                    class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-green-500 rounded-md hover:bg-blue-700 focus:outline-none focus:bg-gray-600">
                    <i class="fas fa-plus"></i> NOUVEAU
                </button>
            </a>
        </div>

    <div class="w-full overflow-x-auto md:overflow-x-hidden">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="text-center">N°</th>
            <th class="px-4 w-3/5 py-3">Titre</th>
            <th class="px-4 py-3">Code</th>
            <th class="px-4 w-2/12 py-3">Auteur</th>
            <th class="px-4 py-3">actions</th>
          </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($medias as $i => $media)
                <tr class="text-gray-700">
                    <td class="text-center border">{{ ++$i }}</td>
                    <td class="px-4 py-3 border">
                        <div class="flex items-center text-sm">
                            {{ $media->title }}
                        </div>
                    </td>
                    <td class="px-4 py-3 text-ms font-semibold border flex flex-row">
                        <span id="value{{ $media->id }}">{{ $media->id }}</span>
                        <i class="fas fa-copy ml-auto cursor-pointer" onclick="copy({{ $media->id }})"></i>
                    </td>
                    <td class="px-4 py-3 text-ms font-semibold border">{{ $media->author->first_name }} {{ $media->author->last_name }}</td>

                    <td class="px-4 py-3 text-sm border text-center">
                        <div>
                            <form action="{{ route('medias.destroy', $media->id) }}" class="flex flex-row space-x-4" method="post">
                                @method('DELETE')
                                @csrf
                                <a class="text-blue-500 outline-none transform ease-in-out duration-200 hover:scale-125" href="{{ route('medias.edit', $media->id) }}"><i class="fas fa-edit"></i></a>
                                <button class="text-red-500 outline-none transform ease-in-out duration-200 hover:scale-125" type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        {{ $medias->links() }}
      </table>
    </div>
  </div>
</section>

<script>
function copy(value)
{
    navigator.clipboard.writeText(value)
    alert("Code copié : " + value);
}
</script>
@endsection

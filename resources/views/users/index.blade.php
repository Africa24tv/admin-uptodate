@extends('master.main')

@section('content')
<h1>Liste des utilisateurs</h1>
<section class="container mx-auto p-6 font-mono">
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">

    <div class="flex flex-row items-center">
        <div>
            <select class="py-2 px-16 rounded outline-none">
                <option>Personnels</option>
                <option>Internautes</option>
            </select>
        </div>
        <div class="flex ml-auto">
            <a href="{{ route('users.create') }}">
                <button
                    class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-green-500 rounded-md hover:bg-blue-700 focus:outline-none focus:bg-gray-600">
                    <i class="fas fa-plus"></i> NOUVEAU
                </button>
            </a>
        </div>
    </div>

    <div class="w-full overflow-x-auto md:overflow-x-hidden">
      <table class="w-full">
        <thead>
          <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="text-center">N°</th>
            <th class="px-4 py-3">Titre</th>
            <th class="px-4 py-3">Rôles</th>
            <th class="px-4 py-3">Productivité</th>
            <th class="px-4 py-3">actions</th>
          </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($users as $i => $user)
            {{-- {{ dd($user->author) }} --}}
                <tr class="text-gray-700">
                    <td class="text-center border">{{ ++$i }}</td>
                    <td class="px-4 py-3 border">
                        <div class="flex items-center text-sm">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </div>
                    </td>
                    <td class="px-4 py-3 text-ms font-semibold border">
                        <ul class="flex flex-row list-disc space-x-4">
                        @foreach ($user->roles as $role)
                            <li class="pr-3">{{ $role->name }}</li>
                        @endforeach
                        </ul>
                    </td>

                    <td class="border px-4">{{ $user->productivites() }} %</td>

                    <td class="px-4 py-3 text-sm border text-center">
                        <div class="flex flex-row space-x-4">
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <a class="text-blue-500 outline-none transform ease-in-out duration-200 hover:scale-125" href="{{ route('users.edit', $user->id) }}"><i class="fas fa-edit"></i></a>
                                <button class="text-red-500 outline-none transform ease-in-out duration-200 hover:scale-125" type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        {{ $users->links() }}
      </table>
    </div>
  </div>
</section>
@endsection

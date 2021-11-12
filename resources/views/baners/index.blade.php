@extends('master.main')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="fa fa-bar-chart-o fa-fw"></i>
						Liste de Bannières
					</h3>
				</div>

            </div>
        </div>
    </div>
</div>

<section class="container mx-auto p-6 font-mono">
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">

    <div class="flex justify-end mt-6">
            <a href="{{ route('baners.create') }}">
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
            <th class="px-4 py-3">Date de Mise en production</th>
            <th class="px-4 py-3">actions</th>
          </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($baners as $i => $baner)
            {{-- {{ dd($baner->author) }} --}}
                <tr class="text-gray-700">
                    <td class="text-center border">{{ ++$i }}</td>
                    <td class="px-4 py-3 border">
                        <div class="flex items-center text-sm">
                            {{ Carbon\Carbon::parse($baner->created_at)->format('l jS F Y \\à H:i')}}
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm border text-center">
                        <div>
                            <form action="{{ route('baners.destroy', $baner->id) }}" class="flex flex-row space-x-4" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="text-red-500 outline-none transform ease-in-out duration-200 hover:scale-125" type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        {{ $baners->links() }}
      </table>
    </div>
  </div>
</section>
@endsection

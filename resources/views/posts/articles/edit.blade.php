@extends('master.main')

@section('content')
    <h1 class="text-xl">Édition d'un article</h1>
    <form action="{{ route('articles.update', $article->id) }}" method="POST" encType="multipart/form-data">

        @csrf

        <div class="bg-white block m-3 space-y-2 rounded-md shadow-sm p-2">
            <label class="w-full pr-2 font-light" htmlFor="category">Type d'article</label>
            <hr />
            <select class="w-full border-gray-700 rounded-md focus:outline-none" id="type" name="type" onChange={changeType}>
                <option disabled defaultValue>Sélectionnez un type</option>
                <option value="standard">Standard</option>
                <option>Image</option>
                <option value="video">Video</option>
                <option value="audio">Audio</option>
            </select>
        </div>

        <div class="m-3">
            <textarea class="bg-white rounded-md shadow-sm w-full p-2 outline-none h-18 font-extrabold text-3xl" type="text"
                id=tilte name=title placeholder="Entrez le titre de l'article ici...." required
                oninput='autoGrow()'>{{ $article->post->title }}</textarea>
        </div>

        <div class="m-3">
            <textarea class="bg-white rounded-md shadow-sm w-full p-2 outline-none h-18" id=resume name=resume
                placeholder='Entrez votre résumé ici...' oninput="autoGrow()">{{ $article->post->resume }}</textarea>
        </div>

        <div class="bg-white block m-3 space-y-2 rounded-md shadow-sm p-2">
            <label class="w-full pr-2 font-light" for="category">Sélectionnez la catégorie</label>
            <hr />
            <select class="w-full border-gray-700 rounded-md focus:outline-none text-gray-400" id='subject' name='subject'>
                <option selected>...</option>
                @foreach ($categories as $categorie)
                    @if ($categorie->id == $article->post->subject_id)
                    <option value='{{ $categorie->id }}' class="text-gray-900" selected>{{ $categorie->title }}</option>

                    @else
                    <option value='{{ $categorie->id }}' class="text-gray-900">{{ $categorie->title }}</option>

                    @endif

                @endforeach
            </select>
        </div>

        <div class="bg-white block m-3 space-y-2 rounded-md shadow-sm p-2">
            <label class="w-full pr-2 font-light">Télécharger l'image de couverture</label>
            <hr />

            <div class="border border-dashed border-gray-500 rounded-md relative">
                <input class="cursor-pointer relative block opacity-0 w-full h-full p-6 z-50" type="file"
                    title="Image de couverture" id="fichier" name="fichier" accept="image/*" onChange={handleChange} />
                <div class="text-center absolute top-0 right-0 left-0 bottom-0 m-auto">

                    <p class="">

                        Dépossez un fichier<br /> ou <br />
                        <span class="bg-red-400 text-white m-2 px-2 py-1 rounded shadow-md hover:bg-red-50">Selectionner un
                            fichier</span>
                    </p>
                    <p class="p-6 font-semibold"></p>
                </div>
            </div>
        </div>

        <div class="bg-white block m-3 space-y-2 rounded-md shadow-sm p-2">
            <label class="w-full pr-2">Coller le code du fichier Média</label>
            <hr />
            <input class="outline-none font-bold w-full p-3" type="number" id="media" name="media"
                placeholder="ex:[0000000001]" value="{{ $article->media_id }}"/>
        </div>

        <div class="bg-white block m-3 space-y-2 rounded-md shadow-sm p-2">

            <div x-data="markdown()" x-init="
                        convertHtmlToMarkdown();
                        codeMirrorEditor = CodeMirror.fromTextArea($refs.input, {
                            mode: 'markdown',
                            theme: 'default',
                            lineWrapping: true
                        });

                        codeMirrorEditor.setValue(content);
                        codeMirrorEditor.setSize('100%', height);
                        setTimeout(function() {
                            codeMirrorEditor.refresh();
                        }, 1);

                        codeMirrorEditor.on('change', () => content = codeMirrorEditor.getValue())
                    " class="relative" x-cloak>
                <div class="bg-gray-50 border border-b-0 border-gray-300 top-0 left-0 right-0 block rounded-t-md">
                    <button type="button" class="py-2 px-4 inline-block text-gray-400 font-semibold"
                        :class="{ 'text-indigo-600': tab === 'write' }"
                        x-on:click.prevent="tab = 'write'; showConvertedMarkdown = false">Rédiger</button>
                    <button type="button" class="py-2 px-4 inline-block text-gray-400 font-semibold"
                        :class="{ 'text-indigo-600': tab === 'preview' && showConvertedMarkdown === true }"
                        x-on:click.prevent="tab = 'preview'; convertedMarkdown()">Prévisualiser</button>
                </div>

                <div x-show="! showConvertedMarkdown">
                    <div>
                        <textarea id="text" x-ref="input" x-model.debounce.750ms="content" class="hidden"
                            name="content">{{ $article->body }}</textarea>
                    </div>
                </div>

                <div x-show="showConvertedMarkdown">
                    <div x-html="convertedContent"
                        class="w-full prose max-w-none prose-indigo leading-6 rounded-b-md shadow-sm border border-gray-300 p-5 bg-white overflow-y-auto"
                        :style="`height: ${height}; max-width: 100%`"></div>
                </div>
            </div>

        </div>


        @can('edit-article')
            <button type="submit"
                class="bg-blue-300 hover:bg-blue-100 shadow-sm rounded-lg transition duration-400 w-1/6 content-center py-2 m-5 font-bold text-white hover:text-gray-500">
                <i class="far fa-save pr-2"></i>
                Sauvegarder
            </button>
        @endcan

        <a
            class="bg-blue-300 hover:bg-blue-100 shadow-sm rounded-lg px-2 transition duration-400 w-1/6 content-center py-2 m-5 font-bold text-white hover:text-gray-500">
            <i class="far fa-share-square pr-2"></i>
            Envoyé
        </a>

        @can('publish')
            <button type="submit"
                class="bg-blue-300 hover:bg-blue-100 shadow-sm rounded-lg px-2 transition duration-400 w-1/6 content-center py-2 m-5 font-bold text-white hover:text-gray-500">
                <i class="far fa-share-square pr-2"></i>
                publier
            </button>
        @endcan
    </form>

    <script>
        function autoGrow(e) {
            e.target.style.height = (e.target.scrollHeight) + "px";
        }
    </script>


    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.59.2/lib/codemirror.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codemirror@5.59.2/mode/markdown/markdown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/turndown@7.0.0/dist/turndown.min.js"></script>
    <script src="https://unpkg.com/marked@0.3.6/lib/marked.js"></script>
    <script>
        function markdown() {
            return {
                height: '500px',
                tab: 'write',
                content: '',
                showConvertedMarkdown: false,
                convertedContent: '',
                convertedMarkdown() {
                    this.showConvertedMarkdown = true;
                    this.convertedContent = marked(this.content, {
                        sanitize: false
                    });
                },
                convertHtmlToMarkdown() {
                    turndownService = new TurndownService({
                        headingStyle: 'atx',
                        codeBlockStyle: 'fenced'
                    });

                    this.content = turndownService.turndown(``);
                }
            }
        }
    </script>
@endsection

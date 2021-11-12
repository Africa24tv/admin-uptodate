<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tailwind Admin Starter Template : Tailwind Toolbox</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <!--Replace with your tailwind.css once created-->
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <!--Totally optional :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"
        integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://unpkg.com/@tailwindcss/typography@0.2.x/dist/typography.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@5.59.2/lib/codemirror.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <style>
        html {
            scroll-behavior: smooth;
            font-family: 'Space Grotesk', sans-serif;
        }
        .cursive {
            font-family: 'Nanum Pen Script', cursive;
        }
        [x-cloak] { display: none; }

        .CodeMirror-focused {
            border-radius: .375rem;
            outline: 2px solid transparent;
            outline-offset: 2px;
            --tw-ring-opacity: 0.5;
            --tw-ring-color: rgba(199, 210, 254, var(--tw-ring-opacity));
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
        }
        .CodeMirror {
            padding: 0.75rem;
            font-family: inherit;
            font-size: inherit;
            border-bottom-left-radius: .375rem;
            border-bottom-right-radius: .375rem;
            --tw-border-opacity: 1;
            border: 1px solid rgba(209, 213, 219, var(--tw-border-opacity));
        }
        .CodeMirror.CodeMirror-focused {
            --tw-border-opacity: 1;
            border-color: rgba(165, 180, 252, var(--tw-border-opacity));
        }

        .cm-s-default .cm-header,
        .cm-s-default .cm-variable-2 {
            color: rgb(31, 41, 55);
        }
    </style>

</head>


<body class="bg-gray-100 font-sans leading-normal tracking-normal flex flex-row space-x-3">

    <!--Nav-->

    @include('master.sidebar')

    <div class="flex flex-col space-y-2 w-full">

        <div class="flex flex-col md:pl-64">

            @if(count($errors) > 0)
            <div class="p-1">
                @foreach($errors->all() as $error)
                <div class="alert alert-warning alert-danger fade show" role="alert">{{$error}} <button type="button" class="close"
                        data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></div>
                @endforeach
            </div>
            @endif

            @if (session('success'))

                <div class="flex bg-green-100 rounded-lg p-4 mb-4 text-sm text-green-700" role="alert">
                    <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                {{-- {{ dd(session('error')); }} --}}
                <div class="flex bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700" role="alert">
                    <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        <span class="font-medium">{{session('error')}}</span>
                    </div>
                </div>
            @endif

            @yield('content')

        </div>
    </div>




    @include('master.scripts')


</body>

</html>

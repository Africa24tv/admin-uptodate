<div class="fixed flex flex-col top-0 left-0 w-64 bg-white h-full border-r invisible md:visible">
    <div class="flex items-center justify-center h-14 border-b">
        <div>AFRICA 24</div>
    </div>
    <div class="overflow-y-auto overflow-x-hidden flex-grow">
        <ul class="flex flex-col py-4 space-y-1">
            <li class="px-5">
                <div class="flex flex-row items-center h-8">
                    <div class="text-sm font-light tracking-wide text-gray-500">Menu</div>
                </div>
            </li>
            @can('view-dashoard')
            <li>
                <a href="/">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-tachometer-alt"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Tableau de bord</span>
                </div>
                </a>
            </li>
            @endcan

            @can('list-taches')
            <li>
                <a href="{{ route('taches.index') }}">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-tasks"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Tâches</span>
                </div>
                </a>
            </li>
            @endcan

            @can('list-mes-taches')
            <li>
                <a href="{{ route('taches.index') }}">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-tasks"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Tâches</span>
                </div>
                </a>
            </li>
            @endcan

            @can('list-scrolls')
            <li>
                <a href="{{ route('scrolls.index') }}">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-fire"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Scrolls</span>
                </div>
                </a>
            </li>

            @endcan

            <li>
                <a href="{{ route('baners.index') }}">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-ad"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Bannières</span>
                </div>
                </a>
            </li>

            @can('list-sujets')
            <li>
                <a href="{{ route('subjects.index') }}">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-layer-group"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Sujets</span>
                </div>
                </a>
            </li>

            @endcan

            @can('list-sujets')
            <li>
                <a href="{{ route('newsexpresses.index') }}">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-layer-group"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">newsExpress</span>
                </div>
                </a>
            </li>

            @endcan

            @can('list-articles')
            <li>
                <a href="{{ route('articles.index') }}">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-newspaper"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Articles</span>
                </div>
                </a>
            </li>

            @endcan

            @can('list-mes-articles')
            <li>
                <a href="{{ route('articles.index') }}">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-newspaper"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Articles</span>
                </div>
                </a>
            </li>

            @endcan

            @can('list-events')
            <li>
                <a href="{{ route('events.index') }}">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-calendar-alt"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Évènements</span>
                </div>
                </a>
            </li>
            @endcan

            @can('list-medias')
            <li>
                <a href="{{ route('medias.index') }}">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-film"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Médias</span>
                </div>
                </a>
            </li>
            @endcan

            @can('list-types')
            <li>
                <a href="{{ route('types.index') }}">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-th-large"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Types</span>
                </div>
                </a>
            </li>
            @endcan

            @can('list-users')
            <li>
                <a href="{{ route('users.index') }}">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-users-cog"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Comptes</span>
                </div>
                </a>
            </li>
            @endcan

            @can('list-roles')
            <li>
                <a href="{{ route('roles.index') }}">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-user-tag"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Rôles</span>
                </div>
                </a>
            </li>
            @endcan

            @can('list-permissions')
            <li>
                <a href="{{ route('permissions.index') }}">
                <div
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-key"></i>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Permissions</span>
                </div>
                </a>
            </li>
            @endcan

            <li>
                <form method="POST" action="{{ route('logout') }}"
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    @csrf

                    <span class="inline-flex justify-center items-center ml-4">
                        <i class="fas fa-sign-out-alt"></i>
                    </span>
                    <a href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Déconnexion') }}
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>

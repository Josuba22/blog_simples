<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $postagem->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Links de login/logout (iguais aos da view index.blade.php) --}}
                    @if (Route::has('login'))
                    <div class="sm:fixed-top sm:right-0 p-6 text-right z-10">
                            @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 ml-4">
                                    {{ __('Log Out') }}
                                </button>
                            </form>

                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        @endauth
                    </div>
                    @endif

                    <img src="{{ asset('storage/' . $postagem->imagem) }}" alt="{{ $postagem->titulo }}" class="w-full mb-4">

                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">Like</button>
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">Deslike</button>
                        </div>
                        <div>
                            Comentários: {{ $postagem->comentarios->count() }}
                        </div>
                    </div>

                    <h2 class="text-lg font-semibold mb-2">Comentários</h2>
                    @foreach ($postagem->comentarios as $comentario)
                        <p class="mb-2">{{ $comentario->conteudo }}</p>
                    @endforeach


                    <form action="{{ route('comentarios.armazenar', $postagem) }}" method="POST" class="mt-4">
                        @csrf
                        <textarea name="conteudo" rows="3" class="w-full border rounded p-2" placeholder="Escreva seu comentário"></textarea>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Comentar</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

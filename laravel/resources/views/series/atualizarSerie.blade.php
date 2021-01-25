<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        
        <div class="flex">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                    {{ __('Editar Série Selecionada') }}
                </h2>
            </div>

            <div class="flex ml-64">
                <button class="mr-2 button button-listar"> <a href="{{route('listarSeries')}}">Listar</a></button>
                <button class="ml-2 button button-inserir"> <a href="{{route('inserirSerie')}}">Inserir</a> </button>
            </div> 
        </div> 
    </x-slot>

    <x-guest-layout>
        <x-auth-card>
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <x-slot name="logo">
            </x-slot>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{Request::url()}}/salvar" enctype="multipart/form-data">
                @csrf
                
                <!-- ID -->
                <div>
                    <x-label for="id" :value="__('Id')" />

                    <x-input id="id" class="block mt-1 w-full" value="{{$serie->id}}" type="text" name="id" required readonly/>
                </div>

                <!-- Título -->
                <div>
                    <x-label for="titulo" :value="__('Título')" />

                    <x-input id="titulo" class="block mt-1 w-full" value="{{$serie->titulo}}" type="text" name="titulo" required autofocus />
                </div>
                
                <!-- Ano de Lançamento -->
                <div class="mt-4">
                    <x-label for="ano_lancamento" :value="__('Ano de Lançamento')" />

                    <x-input id="ano_lancamento" class="block mt-1 w-full" value="{{$serie->ano_lancamento}}" type="text" name="ano_lancamento" required />
                </div>
                
                <!-- Diretor -->
                <div class="mt-4">
                    <x-label for="temporadas" :value="__('Quantidade de Temporadas')" />

                    <x-input id="temporadas" class="block mt-1 w-full" value="{{$serie->temporadas}}" type="text" name="temporadas" required />
                </div>
                
                <!-- Sinopse -->
                <div class="mt-4">
                    <x-label for="sinopse" :value="__('Sinopse da Série')" />

                    <textarea id="sinopse" class="block mt-1 w-full border-2" rows="10" type="text" name="sinopse" required />{{$serie->sinopse}}</textarea>
                </div>
                
                <!-- Imagem atual -->
                <div class="mt-4 items-center justify-center" >
                    <x-label for="imagem" :value="__('Imagem Atual')" />
                    
                    <img src=" {{$arquivo}}" width="300" height="400">
                </div>
                
                <!-- Imagem Atual -->
                <div class="mt-4">
                    <x-input id="imagem_atual" class="block mt-1 w-full" value="{{$serie->imagem}}" type="hidden" name="imagem_atual" required/>
                </div>
                
                <!-- Imagem -->
                <div class="mt-4">
                    <x-label for="imagem" :value="__('Imagem')" />

                    <x-input id="imagem" class="block mt-1 w-full" type="file" name="imagem" />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <button class="ml-3 button button1"> 
                        {{ __('Salvar') }}
                    <button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
    
</x-app-layout>

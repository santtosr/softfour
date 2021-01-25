<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        
        <div class="flex">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                    {{ __('Criar novo Comentário') }}
                </h2>
            </div>

            <div class="flex ml-80">
                <button class="mr-2 button button-listar"> <a href="{{route('listarComentarios')}}?id={{$id_obra}}&categoria={{$categoria}}">Listar</a></button>
                <button class="ml-2 button button-inserir"> <a href="{{route('inserirComentario')}}?id={{$id_obra}}&categoria={{$categoria}}">Inserir</a> </button>
            </div> 
        </div> 
        
    </x-slot>

    <x-guest-layout>
        <div class="card-0 border">
            <div class="title-0"> {{ $obra->titulo }} </div>

            <div class="row">
                <div class="col-img">
                    <img class="img-0" src=" {{$obra->imagem}}" width="300" height="400">
                </div>
                <div class="col-3">
                    <p> <strong>Data de Lançamento:</strong> {{ $obra->ano_lancamento }}</p>
                    @if($categoria == "F")
                        <p class="mt-1"> <strong>Diretor:</strong> {{ $obra->diretor }}</p><br>
                    @elseif(@categoria == "S")
                        <p class="mt-1"> <strong>Temporadas:</strong> {{ $obra->temporadas }}</p><br>
                    @else
                        <p class="mt-1"> <strong>Autor:</strong> {{ $obra->autor }}</p><br>
                    @endif
                    <p><strong>Sinópse:</strong> {{ $obra->sinopse }}</p>
                </div>
            </div>
        </div>
        
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

            <form method="POST" action="{{Request::url()}}/registrar" enctype="multipart/form-data">
                @csrf

                <!-- Comentário -->
                <div>
                    <x-label for="comentario" :value="__('Novo Comentário')" />

                    <textarea id="sinopse" class="block mt-1 w-full border-2" rows="10" type="text" name="comentario" required autofocus/> </textarea>
                </div>
                
                <!-- Categoria -->
                <div class="mt-4">
                    <x-input id="categoria" class="block mt-1 w-full" value="{{ $categoria }}" type="hidden" name="categoria" required />
                </div>
                
                <!-- Id da Obra -->
                <div class="mt-4">
                    <x-input id="id_obra" class="block mt-1 w-full" value="{{ $id_obra }}"  type="hidden" name="id_obra" required />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <button class="ml-3 button button1"> 
                        {{ __('Registrar Comentário') }}
                    <button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
    
</x-app-layout>


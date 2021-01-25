<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        
        <div class="flex">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                    {{ __('Lista de Filmes Cadastrados') }}
                </h2>
            </div>

            <div class="flex ml-64">
                <button class="mr-2 button button-listar"> <a href="{{route('listarFilmes')}}">Listar</a></button>
                <button class="ml-2 button button-inserir"> <a href="{{route('inserirFilme')}}">Inserir</a> </button>
            </div> 
        </div> 
    </x-slot>
    
    @foreach ($filmes as $filme)
        <div class="card-0 border">
            <div class="title-0"> {{ $filme->titulo }} </div>
            
            <div class="row">
                <div class="col-img">
                    <img class="img-0" src=" {{$filme->imagem}}" width="300" height="400">
                </div>
                <div class="col-3">
                    <p> <strong>Data de Lançamento:</strong> {{ $filme->ano_lancamento }}</p>
                    <p class="mt-1"> <strong>Diretor:</strong> {{ $filme->diretor }}</p><br>
                    <p><strong>Sinópse:</strong> {{ $filme->sinopse }}</p>
                </div>
            </div>
            
            <div class="row-0">
                <a href="{{route('atualizarFilme')}}?id={{$filme->id}}" class="link-0">Editar</a>
                <a href="{{route('deletarFilme')}}?id={{$filme->id}}" class="link-0">Excluir</a>
                
                <div class="col-botao">
                    <button class="button3">
                        <a href="{{route('listarComentarios')}}?id={{$filme->id}}&categoria=F">Comentários</a>
                    <button>
                    
                    <button class="ml-2 button4">
                        <a href="{{route('inserirComentario')}}?id={{$filme->id}}&categoria=F">Novo Comentário</a>
                    <button>                    
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>



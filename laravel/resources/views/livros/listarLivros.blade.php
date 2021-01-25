<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        
        <div class="flex">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                    {{ __('Lista de Livros Cadastrados') }}
                </h2>
            </div>

            <div class="flex ml-64">
                <button class="mr-2 button button-listar"> <a href="{{route('listarLivros')}}">Listar</a></button>
                <button class="ml-2 button button-inserir"> <a href="{{route('inserirLivro')}}">Inserir</a> </button>
            </div> 
        </div> 
    </x-slot>
    
    @foreach ($livros as $livro)
        <div class="card-0 border">
            <div class="title-0"> {{ $livro->titulo }} </div>
            
            <div class="row">
                <div class="col-img">
                    <img class="img-0" src=" {{$livro->imagem}}" width="300" height="400">
                </div>
                <div class="col-3">
                    <p> <strong>Data de Lançamento:</strong> {{ $livro->ano_lancamento }}</p>
                    <p class="mt-1"> <strong>Autor:</strong> {{ $livro->autor }}</p><br>
                    <p><strong>Sinópse:</strong> {{ $livro->sinopse }}</p>
                </div>
            </div>
            
            <div class="row-0">
                <a href="{{route('atualizarLivro')}}?id={{$livro->id}}" class="link-0">Editar</a>
                <a href="{{route('deletarLivro')}}?id={{$livro->id}}" class="link-0">Excluir</a>
                
                <div class="col-botao">
                    <button class="button3">
                        <a href="{{route('listarComentarios')}}?id={{$livro->id}}&categoria=L">Comentários</a>
                    <button>
                    
                    <button class="ml-2 button4">
                        <a href="{{route('inserirComentario')}}?id={{$livro->id}}&categoria=L">Novo Comentário</a>
                    <button>                    
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>



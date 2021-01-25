<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        
        <div class="flex">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                    {{ __('Comentários Cadastrados') }}
                </h2>
            </div>

            <div class="flex ml-80">
                <button class="mr-2 button button-listar"> <a href="{{route('listarComentarios')}}?id={{$id_obra}}&categoria={{$categoria}}">Listar</a></button>
                <button class="ml-2 button button-inserir"> <a href="{{route('inserirComentario')}}?id={{$id_obra}}&categoria={{$categoria}}">Inserir</a> </button>
            </div> 
        </div> 
    </x-slot>
    
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
                <p><strong>Sinópse:</strong> {{ $obra->sinopse }}</p><br>
            </div>
        </div>
    </div>
    
    <div class="mt-6 items-center justify-center flex">
        <table>
            <tbody class="bg-white text-gray-700">
                @if (is_null($comentarios) || count($comentarios) === 0)
                <tr>
                    <td colspan="3" class="border text-center h-24">Nenhum comentario cadastrado ainda</td>
                </tr>
                @else
                    @foreach ($comentarios as $comentario)
                    <tr>                   
                        <td> 
                            <textarea class="mt-1 w-full border-2" rows="10" cols="100" type="text"/>{{ $comentario->comentario }}</textarea> 
                            
                            <button class="mr-1 ml-1 button3"> 
                                <a href="{{route('atualizarComentario')}}?id={{$comentario->id}}&id_obra={{$id_obra}}&categoria={{$categoria}}">Editar</a>
                            <button>
            
                            <button class="mr-1 ml-1 button4">
                                <a href="{{route('deletarComentario')}}?id={{$comentario->id}}&id_obra={{$id_obra}}&categoria={{$categoria}}">Deletar</a>
                            <button><br><br>
                        </td>
                    </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
</x-app-layout>



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\Filme;
use App\Models\Serie;
use App\Models\Livro;
use App\Models\Utils;

class ComentariosController extends Controller
{
    public function inserirComentario(Request $request) {
        $categoria = $_GET['categoria'];
        $id_obra = $_GET['id'];

        $obra = $this->buscarObra($categoria, $id_obra);
        
        $obra->imagem =  Utils::getPathImagens() . $obra->imagem;
        
        return view('comentarios/criarComentario', compact('categoria', 'id_obra', 'obra'));
    }
    
    public function registrarComentario(Request $request) {
        $request->validate([
            'categoria' => 'required|string|max:1',
            'id_obra' => 'required|integer',
            'comentario' => 'required|string'
        ]);
        
        try{          
            $dadosDoFormulario = array(
                'categoria' => $request->categoria,
                'id_obra' => $request->id_obra,
                'comentario' => $request->comentario,
            );
            
            $comentario = new Comentario();
            $comentario->criarComentario($dadosDoFormulario);
            return redirect('/comentarios/listar?id=' . "$request->id_obra" . '&categoria=' . "$request->categoria");
        } catch (Exception $ex) {
            throw $ex;
        }  
    }
    
    public function listarComentarios(Request $request) {
        $categoria = $_GET['categoria'];
        $id_obra = $_GET['id'];        
        
        $obra = $this->buscarObra($categoria, $id_obra);
        
        $obra->imagem =  Utils::getPathImagens() . $obra->imagem;
        
        $comentario = new Comentario();
        $comentarios = $comentario->listarComentariosDaObra($id_obra, $categoria);

        return view('comentarios/listarComentarios', compact('id_obra', 'categoria', 'comentarios', 'obra'));
    }
    
    
    public function viewAtualizar(Request $request) {
        $id = $_GET['id'];

        $comentario = Comentario::find($id); 
        $id_obra = $comentario->id_obra;
        $categoria = $comentario->categoria;
                
        return view('comentarios/atualizarComentario', compact('id_obra', 'categoria', 'comentario'));
    }
    
    public function atualizarComentario(Request $request) {        
        $request->validate([
            'id_obra' => 'required|integer',
            'comentario' => 'required|string'
        ]);
        
        try{          
            $dadosDoFormulario = array(
                'id' => $request->id,
                'comentario' => $request->comentario,
            );
            
            $comentario = new Comentario();
            $comentario->atualizarComentario($dadosDoFormulario);
            return redirect('/comentarios/listar?id=' . "$request->id_obra" . '&categoria=' . "$request->categoria");
        } catch (Exception $ex) {
            throw $ex;
        }  
    }
    
    private function buscarObra($categoria, $id_obra) {
        if($categoria == "F"){
            $obra = Filme::find($id_obra);
        }
        elseif($categoria == "S"){
            $obra = Serie::find($id_obra);
        }
        else{
            $obra = Livro::find($id_obra);
        }
        
        return $obra;
    }
   
}

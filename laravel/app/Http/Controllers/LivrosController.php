<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Utils;
use Illuminate\Support\Facades\File;

class LivrosController extends Controller
{
    public function registrarLivro(Request $request) {
        $request->validate([
            'titulo' => 'required|string|max:50',
            'imagem' => 'required|max:2048',
            'ano_lancamento' => 'required|string|max:4',
            'autor' => 'required|string|max:50',
            'sinopse' => 'required|string'
        ]);
        
        try{
            $filename = date('YmdHms') . '.jpg';
            request()->file('imagem')->storeAs('imagens', $filename);
            
            $dadosDoFormulario = array(
                'titulo' => $request->titulo,
                'imagem' => $filename,
                'ano_lancamento' => $request->ano_lancamento,
                'autor' => $request->autor,
                'sinopse' => $request->sinopse,
            );
            
            $livro = new Livro();
            $livro->criarlivro($dadosDoFormulario);
            return redirect('/livros/listar');
        } catch (Exception $ex) {
            throw $ex;
        }  
    }
    
    public function listarLivros() {
        $livro = new Livro();
        
        $livros = $livro->listarlivros();
        
        foreach ($livros as $f){
            $f->imagem =  Utils::getPathImagens() . $f->imagem;
        }
        
        return view('livros/listarlivros', compact('livros'));
    }
    
    public function deletarLivro(Request $request) {
        $id = $_GET['id'];
        $livro = new Livro();
        
        try{
            File::delete(Utils::getPathImagens() . $request->image);
            
            $livro->deletarlivro($id);
        } catch (Exception $ex) {
            throw $ex;
        }
        
        return redirect('/livros/listar');
    }
    
    public function viewAtualizar(Request $request) {
        $id = $_GET['id'];
        $livro = livro::find($id); 
        
        $arquivo =  Utils::getPathImagens() . $livro->imagem;
        
        return view('livros/atualizarlivro', compact('livro', 'arquivo'));
    }
    
    public function atualizarLivro(Request $request) {        
        $request->validate([
            'titulo' => 'required|string|max:50',
            'ano_lancamento' => 'required|string|max:50',
            'autor' => 'required|string|max:50',
            'sinopse' => 'required|string'
        ]);
        
        try{
            if(request()->hasFile('imagem')){
                $filename = date('YmdHms') . '.jpg';
                request()->file('imagem')->storeAs('imagens', $filename);
            }
            else{
                $filename = $request->imagem_atual;
            }
            
            $dadosDoFormulario = array(
                'id' => $request->id,
                'titulo' => $request->titulo,
                'imagem' => $filename,
                'ano_lancamento' => $request->ano_lancamento,
                'autor' => $request->autor,
                'sinopse' => $request->sinopse,
            );
            
            $livro = new Livro();
            $livro->atualizarlivro($dadosDoFormulario);
            return redirect('/livros/listar');
        } catch (Exception $ex) {
            throw $ex;
        }  
    }
}



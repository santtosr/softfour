<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filme;
use App\Models\Utils;
use Illuminate\Support\Facades\File;

class FilmesController extends Controller
{
    public function registrarFilme(Request $request) {
        $request->validate([
            'titulo' => 'required|string|max:50',
            'imagem' => 'required|max:2048',
            'ano_lancamento' => 'required|string|max:4',
            'diretor' => 'required|string|max:50',
            'sinopse' => 'required|string'
        ]);
        
        try{
            $filename = date('YmdHms') . '.jpg';
            request()->file('imagem')->storeAs('imagens', $filename);
            
            $dadosDoFormulario = array(
                'titulo' => $request->titulo,
                'imagem' => $filename,
                'ano_lancamento' => $request->ano_lancamento,
                'diretor' => $request->diretor,
                'sinopse' => $request->sinopse,
            );
            
            $filme = new Filme();
            $filme->criarFilme($dadosDoFormulario);
            return redirect('/filmes/listar');
        } catch (Exception $ex) {
            throw $ex;
        }  
    }
    
    public function listarFilmes() {
        $filme = new Filme();
        
        $filmes = $filme->listarFilmes();
        
        foreach ($filmes as $f){
            $f->imagem =  Utils::getPathImagens() . $f->imagem;
        }
        
        return view('filmes/listarFilmes', compact('filmes'));
    }
    
    public function deletarFilme(Request $request) {
        $id = $_GET['id'];
        $filme = new Filme();
        
        try{
            File::delete(Utils::getPathImagens() . $request->image);
            
            $filme->deletarFilme($id);
        } catch (Exception $ex) {
            throw $ex;
        }
        
        return redirect('/filmes/listar');
    }
    
    public function viewAtualizar(Request $request) {
        $id = $_GET['id'];
        $filme = Filme::find($id); 
        
        $arquivo =  Utils::getPathImagens() . $filme->imagem;
        
        return view('filmes/atualizarFilme', compact('filme', 'arquivo'));
    }
    
    public function atualizarFilme(Request $request) {        
        $request->validate([
            'titulo' => 'required|string|max:50',
            'ano_lancamento' => 'required|string|max:50',
            'diretor' => 'required|string|max:50',
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
                'diretor' => $request->diretor,
                'sinopse' => $request->sinopse,
            );
            
            $filme = new Filme();
            $filme->atualizarFilme($dadosDoFormulario);
            return redirect('/filmes/listar');
        } catch (Exception $ex) {
            throw $ex;
        }  
    }
}

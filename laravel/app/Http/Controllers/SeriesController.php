<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\Utils;
use Illuminate\Support\Facades\File;

class SeriesController extends Controller
{
    public function registrarSerie(Request $request) {
        $request->validate([
            'titulo' => 'required|string|max:50',
            'imagem' => 'required|max:2048',
            'ano_lancamento' => 'required|string|max:4',
            'temporadas' => 'required|string|max:2',
            'sinopse' => 'required|string'
        ]);
        
        try{
            $filename = date('YmdHms') . '.jpg';
            request()->file('imagem')->storeAs('imagens', $filename);
            
            $dadosDoFormulario = array(
                'titulo' => $request->titulo,
                'imagem' => $filename,
                'ano_lancamento' => $request->ano_lancamento,
                'temporadas' => $request->temporadas,
                'sinopse' => $request->sinopse,
            );
            
            $serie = new Serie();
            $serie->criarSerie($dadosDoFormulario);
            return redirect('/series/listar');
        } catch (Exception $ex) {
            throw $ex;
        }  
    }
    
    public function listarSeries() {
        $serie = new Serie();
        
        $series = $serie->listarSeries();
        
        foreach ($series as $s){
            $s->imagem =  Utils::getPathImagens() . $s->imagem;
        }
        
        return view('series/listarSeries', compact('series'));
    }
    
    public function deletarSerie(Request $request) {
        $id = $_GET['id'];
        $serie = new Serie();
        
        try{
            File::delete(Utils::getPathImagens() . $request->image);
            
            $serie->deletarSerie($id);
        } catch (Exception $ex) {
            throw $ex;
        }
        
        return redirect('/series/listar');
    }
    
    public function viewAtualizar(Request $request) {
        $id = $_GET['id'];
        $serie = Serie::find($id); 
        
        $arquivo =  Utils::getPathImagens() . $serie->imagem;
        
        return view('series/atualizarSerie', compact('serie', 'arquivo'));
    }
    
    public function atualizarSerie(Request $request) {        
        $request->validate([
            'titulo' => 'required|string|max:50',
            'ano_lancamento' => 'required|string|max:4',
            'temporadas' => 'required|string|max:2',
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
                'temporadas' => $request->temporadas,
                'sinopse' => $request->sinopse,
            );
            
            $serie = new Serie();
            $serie->atualizarSerie($dadosDoFormulario);
            return redirect('/series/listar');
        } catch (Exception $ex) {
            throw $ex;
        }  
    }
}


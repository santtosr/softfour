<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Filme extends Model
{
    protected $fillable = [
        'titulo',
        'imagem',
        'ano_lancamento',
        'diretor',
        'sinopse'
    ];
    
    public function criarFilme($dados)
    {      
        try {
            DB::beginTransaction();
            $novoFilme = new Filme;
            $novoFilme->titulo = $dados['titulo'];
            $novoFilme->imagem = $dados['imagem'];
            $novoFilme->ano_lancamento = $dados['ano_lancamento'];
            $novoFilme->diretor = $dados['diretor'];
            $novoFilme->sinopse = $dados['sinopse'];
            $novoFilme->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    
    public function listarFilmes() {
        return DB::table('filmes')->orderBy('created_at')->get();
    }
    
    public function deletarFilme($id) {
        DB::table('filmes')->where('id', $id)->delete();
    }
    
    public function atualizarFilme($dados) {        
       
        try {
            $filme = Filme::find($dados['id']);
            
            $filme->titulo = $dados['titulo'];
            $filme->imagem = $dados['imagem'];
            $filme->ano_lancamento = $dados['ano_lancamento'];
            $filme->diretor = $dados['diretor'];
            $filme->sinopse = $dados['sinopse'];

            $filme->save();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

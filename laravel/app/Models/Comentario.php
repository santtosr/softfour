<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Comentario extends Model
{
    protected $fillable = [
        'categoria',
        'id_obra',
        'comentario',
    ];
    
    public function criarComentario($dados)
    {      
        try {
            DB::beginTransaction();
            $novoComentario = new Comentario;
            $novoComentario->categoria = $dados['categoria'];
            $novoComentario->id_obra = $dados['id_obra'];
            $novoComentario->comentario = $dados['comentario'];
            $novoComentario->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    
    public function listarComentariosDaObra($id_obra, $categoria) {
        return DB::table('comentarios')->where('id_obra', $id_obra)->where('categoria', $categoria)
                ->orderBy('created_at')->get();
    }
    
    public function deletarComentario(Request $request) {
        $id = $_GET['id'];
        $id_obra = $_GET['id_obra'];
        $categoria = $_GET['categoria'];
        DB::table('comentarios')->where('id', $id)->delete();
        return redirect('/comentarios/listar?id=' . $id_obra . "&categoria=" . $categoria);
    }
    
    public function atualizarComentario($dados) {        
       
        try {
            $comentario = Comentario::find($dados['id']);
            $comentario->comentario = $dados['comentario'];

            $comentario->save();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

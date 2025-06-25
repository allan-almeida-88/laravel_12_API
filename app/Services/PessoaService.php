<?php

namespace App\Services;

use App\Repositories\PessoaRepository;
use Illuminate\Support\Facades\Redis;

class PessoaService {

    public function findAll() {
        $pessoas = PessoaRepository::findAll();
        
        return $pessoas;
    }

    public function findById($id) {
        $model = json_decode(Redis::get("pessoa:id_$id"), true);
        if(is_null($model)) {
            $model = PessoaRepository::findById($id);
            Redis::hset('pessoas', "id_$model->id", $model);
            // Redis::expire('pessoas', 60);
        }

        return $model;
    }

    public function save($params) {
        return PessoaRepository::save($params);
    } 

    public function update($request) {
        if(!isset($params['id']) || empty($params['id']) || !is_numeric($params['id'])) {
            $request->validate([
                'id' => ['required', 'integer']
            ], [
                'id.required'   => 'O campo "ID" é de preenchimento obrigatório.',
                'id.integer'    => 'O campo "ID" dever ser numérico.'
            ]);
        }

        $pessoa = PessoaRepository::update($request->all());
        Redis::hset('pessoas', "id_$pessoa->id", json_encode($pessoa));
        
        return $pessoa;
    }

    public function delete($id) {
        Redis::hDel('pessoas', "id_$id");
        return PessoaRepository::delete($id);
    }

}
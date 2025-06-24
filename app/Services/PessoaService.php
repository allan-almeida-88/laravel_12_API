<?php

namespace App\Services;

use App\Repositories\PessoaRepository;
use Illuminate\Support\Facades\Redis;

class PessoaService {

    public function findAll() {
        return PessoaRepository::findAll();
    }

    public function findById($id) {
        $model = json_decode(Redis::get("pessoa:id_$id"), true);
        if(is_null($model)) {
            $model = PessoaRepository::findById($id);
            Redis::setex("pessoa:id_$model->id", 60, $model);
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
        
        return PessoaRepository::update($request->all());
    }

    public function delete($id) {
        return PessoaRepository::delete($id);
    }

}
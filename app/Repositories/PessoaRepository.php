<?php

namespace App\Repositories;

use App\Models\Pessoa;

class PessoaRepository
{
    public static function findAll() {
        return Pessoa::query()
            ->orderBy('id')
            ->simplePaginate(10);
    }

    public static function findById($id) {
        return Pessoa::findOrFail($id);
    }

    public static function save($params) {
        return Pessoa::create($params);
    }

    public static function update($params) {
        $model = Pessoa::findOrFail($params['id']);

        if(!is_null($model)) {
            if($model->fill($params)->save()) {
                return $model;
            }
        }

        return null;
    }

    public static function delete($id) {
        $model = Pessoa::findOrFail($id);
        if(!is_null($model)) {
            $modelDeleted = $model;
            $model->delete();
            return $modelDeleted;
        }
        return [];
    }
}
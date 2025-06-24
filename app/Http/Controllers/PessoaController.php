<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Http\Resources\PessoaResource;
use App\Models\Pessoa;
use App\Services\PessoaService;
use Exception;
use Illuminate\Http\Request;


class PessoaController extends Controller
{
    private $_pessoaService;
    public function __construct(PessoaService $pessoaService) {
        $this->_pessoaService = $pessoaService;
    }

    public function findAll() {
        return PessoaResource::collection($this->_pessoaService->findAll());
    }

    public function findById($id) {
        return new PessoaResource($this->_pessoaService->findById($id));
    }

    public function save(PessoaRequest $request) {
        return new PessoaResource($this->_pessoaService->save($request->all()));
    }

    public function update(PessoaRequest $request) {
        try {
            $data = new PessoaResource($this->_pessoaService->update($request));
        } catch(\Exception $e) {
            $data = [
                'status'    => 0,
                'data'      => [],
                'message'   => 'Erro ao realizar consulta'
            ];
        }

       return $data;
    }

    public function delete($id) {
        return $this->_pessoaService->delete($id);
    }


}

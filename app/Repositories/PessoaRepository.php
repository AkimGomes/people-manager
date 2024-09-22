<?php

namespace App\Repositories;

use App\Models\Pessoa;

class PessoaRepository implements PessoaRepositoryInterface
{
    public function all()
    {
        return Pessoa::orderBy('nome')->get();
    }

    public function create(array $data): Pessoa
    {
        return Pessoa::create($data);
    }
    
    public function update(Pessoa $pessoa, array $data): Pessoa
    {
        $pessoa->update($data);
        return $pessoa;
    }

    public function delete(Pessoa $pessoa)
    {
        return $pessoa->delete();
    }
}

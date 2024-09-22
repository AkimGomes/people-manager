<?php

namespace App\Repositories;

use App\Models\Pessoa;

interface PessoaRepositoryInterface
{
    public function all();
    public function create(array $data): Pessoa;
    public function update(Pessoa $pessoa, array $data): Pessoa;
    public function delete(Pessoa $pessoa);
}

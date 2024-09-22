<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PessoaRequest;
use App\Models\Pessoa;
use App\Repositories\PessoaRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PessoaController extends Controller
{
    protected $pessoaRepository;
    public function __construct(PessoaRepositoryInterface $pessoaRepository)
    {
        $this->pessoaRepository = $pessoaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * Recupera todas as pessoas cadastradas no banco de dados e as ordena pelo nome.
     * Retorna uma resposta JSON com o status e a lista de pessoas.
     */
    public function index(): JsonResponse
    {
        $pessoas = $this->pessoaRepository->all();

        return response()->json([
            "status" => true,
            "pessoas" => $pessoas,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * Recebe os dados de uma nova pessoa via PessoaRequest,
     * inicia uma transação para garantir a integridade dos dados.
     * Tenta criar um novo registro de pessoa e retorna uma mensagem de sucesso
     * ou de erro, caso a criação falhe.
     */
    public function store(PessoaRequest $request): JsonResponse
    {
        DB::beginTransaction();
        
        try {
            $pessoa = $this->pessoaRepository->create([
                "nome" => $request->nome,
                "email" => $request->email,
                "telefone" => $request->telefone,
            ]);

            DB::commit();
            
            return response()->json([
                "status" => true,
                "pessoa" => $pessoa,
                "messsage" => "Usuário cadastrado com sucesso!"
            ], 201);

        }catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => "Pessoa não foi cadastrada!",
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * Retorna os detalhes de uma pessoa específica em formato JSON.
     */
    public function show(Pessoa $pessoa): JsonResponse
    {
        return response()->json([
            "status" => true,
            "pessoa" => $pessoa,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * Atualiza os dados de uma pessoa existente com base nos dados
     * fornecidos no PessoaRequest. Inicia uma transação e tenta realizar
     * a atualização, retornando uma mensagem de sucesso ou de erro.
     */
    public function update(PessoaRequest $request, Pessoa $pessoa): JsonResponse
    {
        DB::beginTransaction();

        try{

            $pessoa = $this->pessoaRepository->update($pessoa, [
                "nome" => $request->nome,
                "email" => $request->email,
                "telefone" => $request->telefone,
            ]);

            DB::commit();

            return response()->json([
                "status" => true,
                "pessoa" => $pessoa,
                "message" => "Pessoa editada com sucesso!",
            ], 200);

        } catch (Exception $e) {
            DB::rollBack();

            // Retorna json com código e mensagem de falha no cadastro
            return response()->json([
                "status" => false,
                "message" => "Pessoa não foi editada!",
            ], 400);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * Remove uma pessoa do banco de dados. Tenta deletar a pessoa
     * e retorna uma mensagem de sucesso ou de erro em caso de falha.
     */
    public function destroy(Pessoa $pessoa): JsonResponse
    {
        try{
            $this->pessoaRepository->delete($pessoa);
            return response()->json([
                "status" => true,
                "pessoa" => $pessoa,
                "message" => "Pessoa foi apagada com sucesso!",
            ], 200);

        } catch(Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Pessoa não foi apagado!",
            ], 400);
        }
    }
}

<?php

namespace Tests\Unit;

use App\Models\Pessoa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PessoaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $pessoa;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pessoa = Pessoa::create([
            "nome" => "Alice",
            "email" => "alice@teste.com",
            "telefone" => "11992032134",
        ]);
        
        Pessoa::create([
            "nome" => "Bob",
            "email" => "bob@teste.com",
            "telefone" => "11992032135",
        ]);
    }

    /**
     * Testa a busca de todas as pessoas criadas.
     *
     * Verifica se a resposta contém as pessoas Alice e Bob,
     * e se o status da resposta é 200.
     */
    public function test_busca_todas_as_pessoas_criadas(): void
    {
        $response = $this->getJson('/api/pessoas');
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);

        $response->assertJsonFragment([
            'nome' => 'Alice',
            'email' => 'alice@teste.com',
            'telefone' => '11992032134',
        ]);
        $response->assertJsonFragment([
            'nome' => 'Bob',
            'email' => 'bob@teste.com',
            'telefone' => '11992032135',
        ]);

        $this->assertArrayHasKey('pessoas', $response->json());
        $this->assertCount(2, $response->json('pessoas'));
    }

    /**
     * Testa a busca por uma pessoa específica.
     *
     * Verifica se a resposta contém os dados da pessoa Alice,
     * e se o status da resposta é 200.
     */
    public function test_busca_por_pessoa_especifica(): void
    {
        $response = $this->getJson('/api/pessoas/' . $this->pessoa->id);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);    

        $response->assertJsonFragment([
            'nome' => 'Alice',
            'email' => 'alice@teste.com',
            'telefone' => '11992032134',
        ]);

        $this->assertArrayHasKey('pessoa', $response->json());
    }
    
    /**
     * Testa o salvamento de uma nova pessoa.
     *
     * Verifica se a pessoa é criada corretamente no banco de dados
     * e se os dados estão corretos.
     */
    public function test_salva_pessoa_corretamente(): void
    {
        $pessoa = Pessoa::create([
            "nome" => "Pessoa de Teste POST",
            "email" => "email@teste.com",
            "telefone" => "11992032134",
        ]);

        $pessoaPost = Pessoa::find($pessoa->id);
        $this->assertNotNull($pessoaPost);

        $this->assertEquals('Pessoa de Teste POST', $pessoa->nome);
        $this->assertEquals('email@teste.com', $pessoa->email);
        $this->assertEquals('11992032134', $pessoa->telefone);

    }
    
    /**
     * Testa a atualização de uma pessoa existente.
     *
     * Verifica se os dados da pessoa são atualizados corretamente
     * e se a resposta é 200.
     */
    public function test_atualiza_pessoa_corretamente(): void
    {
        $dados_atualizados = [
            "nome" => "Alice Atualizada",
            "email" => "alice_atualizada@teste.com",
            "telefone" => "11992032136",
        ];

        $response = $this->putJson('/api/pessoas/' . $this->pessoa->id, $dados_atualizados);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => 'Pessoa editada com sucesso!']);

        $this->pessoa->refresh();
        $this->assertEquals('Alice Atualizada', $this->pessoa->nome);
        $this->assertEquals('alice_atualizada@teste.com', $this->pessoa->email);
        $this->assertEquals('11992032136', $this->pessoa->telefone);
    }

    /**
     * Testa a atualização de uma pessoa com dados inválidos.
     *
     * Verifica se a resposta retorna status 422 para dados
     * de entrada que não são válidos.
     */
    public function test_atualiza_pessoa_com_dados_errados(): void
    {
        $dados_atualizados_com_erros = [
            "nome" => "",
            "email" => "email_invalido",
            "telefone" => "11999231342",
        ];

        $response = $this->putJson('/api/pessoas/' . $this->pessoa->id, $dados_atualizados_com_erros);
        $response->assertStatus(422);
        $response->assertJson(['status' => false]);
    }

    /**
     * Testa a deleção de uma pessoa.
     *
     * Verifica se a pessoa é removida corretamente do banco de dados
     * e se a resposta indica sucesso.
     */
    public function test_deleta_pessoa(): void
    {
        $response = $this->deleteJson('/api/pessoas/' . $this->pessoa->id);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => 'Pessoa foi apagada com sucesso!']);

        $this->assertDatabaseMissing('pessoas', [
            'id' => $this->pessoa->id,
            'nome' => 'Alice',
        ]);
    }

}

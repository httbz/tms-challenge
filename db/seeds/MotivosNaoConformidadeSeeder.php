<?php

use Phinx\Seed\AbstractSeed;

class MotivosNaoConformidadeSeeder extends AbstractSeed
{
    public function run(): void
    {
        $this->table('motivos_nao_conformidade')->insert([
            ['codigo' => 'AVARIA_PRODUTO', 'descricao' => 'Produto com avaria ou dano', 'ativo' => 1],
            ['codigo' => 'NAO_ENTREGUE', 'descricao' => 'Destinatário ausente', 'ativo' => 1],
            ['codigo' => 'ENDERECO_INCORRETO', 'descricao' => 'Endereço incorreto ou não localizado', 'ativo' => 1],
            ['codigo' => 'RECUSADO', 'descricao' => 'Recusado pelo destinatário', 'ativo' => 1],
            ['codigo' => 'EXTRAVIO', 'descricao' => 'Produto extraviado', 'ativo' => 1],
            ['codigo' => 'OUTROS', 'descricao' => 'Outros motivos', 'ativo' => 1],
        ])->saveData();
    }
}

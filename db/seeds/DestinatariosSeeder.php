<?php

use Phinx\Seed\AbstractSeed;

class DestinatariosSeeder extends AbstractSeed
{
    public function getDependencies(): array
    {
        return ['RemetentesSeeder'];
    }

    public function run(): void
    {
        $this->table('destinatarios')->insert([
            [
                'cpf_cnpj'    => '12345678901',
                'nome'        => 'João da Silva',
                'logradouro'  => 'Rua das Flores',
                'numero'      => '123',
                'complemento' => null,
                'bairro'      => 'Centro',
                'cidade'      => 'Porto Alegre',
                'uf'          => 'RS',
                'cep'         => '90010000',
            ],
            [
                'cpf_cnpj'    => '98765432100',
                'nome'        => 'Maria Oliveira',
                'logradouro'  => 'Av. Brasil',
                'numero'      => '456',
                'complemento' => 'Apto 3',
                'bairro'      => 'Jardim América',
                'cidade'      => 'Florianópolis',
                'uf'          => 'SC',
                'cep'         => '88010000',
            ],
            [
                'cpf_cnpj'    => '11222333000181',
                'nome'        => 'Empresa Gama Ltda',
                'logradouro'  => 'Rod. BR-101',
                'numero'      => '1000',
                'complemento' => null,
                'bairro'      => 'Industrial',
                'cidade'      => 'Joinville',
                'uf'          => 'SC',
                'cep'         => '89200000',
            ],
        ])->saveData();
    }
}

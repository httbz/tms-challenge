<?php

use Phinx\Seed\AbstractSeed;

class TransportadorasSeeder extends AbstractSeed
{
    public function run(): void
    {
        $this->table('transportadoras')->insert([
            ['cnpj' => '12345678000195', 'nome_fantasia' => 'Transportes Rápido Ltda', 'deleted_at' => null],
            ['cnpj' => '98765432000110', 'nome_fantasia' => 'Cargas do Sul S.A.',      'deleted_at' => null],
            ['cnpj' => '11222333000181', 'nome_fantasia' => 'Logística Norte Ltda',    'deleted_at' => '2024-11-01 10:00:00'],
        ])->saveData();
    }
}

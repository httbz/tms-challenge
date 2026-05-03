<?php

use Phinx\Seed\AbstractSeed;

class RemetentesSeeder extends AbstractSeed
{
    public function getDependencies(): array
    {
        return ['TransportadorasSeeder'];
    }

    public function run(): void
    {
        $this->table('remetentes')->insert([
            ['cnpj' => '45678901000123', 'nome' => 'Indústria Alfa Ltda', 'cidade' => 'São Paulo', 'uf' => 'SP'],
            ['cnpj' => '78901234000156', 'nome' => 'Comércio Beta S.A.',  'cidade' => 'Curitiba',  'uf' => 'PR'],
        ])->saveData();
    }
}

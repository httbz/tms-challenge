<?php

use Phinx\Seed\AbstractSeed;

class OcorrenciasSeeder extends AbstractSeed
{
    public function getDependencies(): array
    {
        return ['EntregasSeeder'];
    }

    public function run(): void
    {
        $this->table('ocorrencias')->insert([
            ['id_entrega' => 1, 'status' => 'CRIADA',       'descricao' => 'Entrega cadastrada no sistema',     'cidade' => 'São Paulo',  'uf' => 'SP'],
            ['id_entrega' => 1, 'status' => 'COLETADA',     'descricao' => 'Carga coletada no remetente',       'cidade' => 'São Paulo',  'uf' => 'SP'],
            ['id_entrega' => 1, 'status' => 'EM_TRANSITO',  'descricao' => 'Em rota para destino',              'cidade' => 'Curitiba',   'uf' => 'PR'],
            ['id_entrega' => 2, 'status' => 'CRIADA',       'descricao' => 'Entrega cadastrada no sistema',     'cidade' => 'Curitiba',   'uf' => 'PR'],
            ['id_entrega' => 3, 'status' => 'CRIADA',       'descricao' => 'Entrega cadastrada no sistema',     'cidade' => 'São Paulo',  'uf' => 'SP'],
            ['id_entrega' => 3, 'status' => 'COLETADA',     'descricao' => 'Carga coletada no remetente',       'cidade' => 'São Paulo',  'uf' => 'SP'],
            ['id_entrega' => 3, 'status' => 'EM_TRANSITO',  'descricao' => 'Em rota para destino',              'cidade' => 'Joinville',  'uf' => 'SC'],
            ['id_entrega' => 3, 'status' => 'SAIU_ENTREGA', 'descricao' => 'Saiu para entrega ao destinatário', 'cidade' => 'Joinville',  'uf' => 'SC'],
            ['id_entrega' => 3, 'status' => 'ENTREGUE',     'descricao' => 'Entrega realizada com sucesso',     'cidade' => 'Joinville',  'uf' => 'SC'],
        ])->saveData();
    }
}

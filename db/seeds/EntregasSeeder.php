<?php

use Phinx\Seed\AbstractSeed;

class EntregasSeeder extends AbstractSeed
{
    public function getDependencies(): array
    {
        return ['TransportadorasSeeder', 'RemetentesSeeder', 'DestinatariosSeeder'];
    }

    public function run(): void
    {
        $this->table('entregas')->insert([
            [
                'codigo'            => 'BRD-2024-00001',
                'id_transportadora' => 1,
                'id_remetente'      => 1,
                'id_destinatario'   => 1,
                'status'            => 'EM_TRANSITO',
                'data_prazo'        => '2024-12-20',
                'peso_kg'           => 12.50,
                'volumes'           => 3,
            ],
            [
                'codigo'            => 'BRD-2024-00002',
                'id_transportadora' => 1,
                'id_remetente'      => 2,
                'id_destinatario'   => 2,
                'status'            => 'CRIADA',
                'data_prazo'        => '2024-12-20',
                'peso_kg'           => 5.00,
                'volumes'           => 1,
            ],
            [
                'codigo'            => 'BRD-2024-00003',
                'id_transportadora' => 2,
                'id_remetente'      => 1,
                'id_destinatario'   => 3,
                'status'            => 'ENTREGUE',
                'data_prazo'        => '2024-12-18',
                'peso_kg'           => 30.00,
                'volumes'           => 7,
            ],
        ])->saveData();
    }
}

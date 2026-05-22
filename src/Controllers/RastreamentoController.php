<?php

namespace App\Controllers;

use App\Database;
use PDO;

class RastreamentoController
{
    public static function track(array $params): ?array
  {
    $db = Database::connection();
    $data = body();

        $stmt = $db->prepare('
            SELECT *
            FROM entregas
            WHERE codigo = ?
        ');
        $stmt->execute([$data['codigo']]);
        $row = $stmt->fetch();

        if (!$row) {
            json(['erro' => 'Código de rastreio inválido'], 404);
        }

        $id = $row['id'];
        $stmt = $db->prepare('SELECT * FROM ocorrencias WHERE id_entrega = ? ORDER BY created_at ASC');
        $stmt->execute([$id]);
        $ocorrencias = $stmt->fetchAll();

        return [
            'id'         => (int) $row['id'],
            'codigo'     => $row['codigo'],
            'status'     => $row['status'],
            'data_prazo' => $row['data_prazo'],
            'updated_at' => $row['updated_at'],
            'rastreamento' => array_map(fn($o) => [
                'id'        => (int) $o['id'],
                'status'    => $o['status'],
                'descricao' => $o['descricao'],
                'cidade'    => $o['cidade'],
                'uf'        => $o['uf'],
                'data'      => $o['created_at'],
            ], $ocorrencias),
        ];
    }

}

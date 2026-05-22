<?php

namespace App\Controllers;

use App\Database;
use PDO;

class NaoConformidadesController
{
    public static function index(array $params): void
    {
        $db    = Database::connection();
        $where = ['1=1'];
        $binds = [];

        if (!empty($_GET['codigo'])) {
            $where[] = 'codigo = ?';
            $binds[] = $_GET['codigo'];
        }

        if (!empty($_GET['descricao'])) {
            $where[] = 'descricao = ?';
            $binds[] = $_GET['descricao'];
        }

        $sql = '
            SELECT id, codigo, descricao
            FROM motivos_nao_conformidade
            WHERE ativo = 1 
            ORDER BY id DESC
        ';

        $stmt = $db->prepare($sql);
        $stmt->execute($binds);
        $rows = $stmt->fetchAll();

        json(array_map(fn($r) => [
            'id'         => (int) $r['id'],
            'codigo'     => $r['codigo'],
            'descricao'     => $r['descricao']
        ], $rows));
  }

}

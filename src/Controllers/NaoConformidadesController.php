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
 public static function store(array $params): void
  {
    $data = body();
    $db = Database::connection();

    //Realizando validações antes de inserir os dados
    foreach (['id_motivo'] as $campo) {
      if (empty($data[$campo])) {
          json(['erro' => "Campo obrigatório: {$campo}"], 422);
      }
    }

    $stmt = $db->prepare('SELECT id, ativo FROM motivos_nao_conformidade WHERE id = ?');
    $stmt->execute([$data['id_motivo']]);
    $rows = $stmt->fetch();
    if (!$rows) {
        json(['erro' => 'Motivo de não conformidade não encontrado'], 404);
    }

    $ativo = $rows['ativo'];
    if (!$ativo) {
        json(['erro' => 'Não é possível registrar uma não conformidade com um motivo inativo'], 422);
    }

    $stmt = $db->prepare('SELECT id FROM entregas WHERE id = ?');
    $stmt->execute([$data['id_entrega']]);
    if (!$stmt->fetch()) {
           json(['erro' => 'Entrega não localizada'], 404);
    }

    //Inserindo os dados 
    $stmt = $db->prepare('
      INSERT INTO nao_conformidades (id_entrega, id_motivo, descricao)
      VALUES (?, ?, ?)
      ');
    $stmt->execute([
      (int) $data['id_entrega'],
      (int) $data['id_motivo'],
      $data['descricao']
    ]);

    //Inserindo log
        $id = $db->lastInsertId();

        $stmt = $db->prepare('INSERT INTO ocorrencias (id_entrega, status, descricao, cidade, uf) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$id, 'CRIADA', 'Não conformidade cadastrada no sistema', '', '']);

        json(self::findById($db, (int) $id), 201);
  }

  public static function show(array $params) :void
  {
    $db = Database::connection();
    $ref = $params['id'];
    
    //validações
      if (str_starts_with(strtoupper($ref), 'BRD-')) {
        $stmt = $db->prepare('SELECT id FROM entregas WHERE codigo = ?');
        $stmt->execute([strtoupper($ref)]);
        $row = $stmt->fetch();
        if (!$row) {
            json(['erro' => 'Entrega não encontrada'], 404);
        }
     $id = (int) $row['id']; 
    } else {
     $id = (int) $ref;
    }
      
    $stmt = $db->prepare('SELECT n.*,
                                 m.codigo AS motivo_codigo, m.descricao as motivo_descricao,
                                 e.codigo 
      FROM nao_conformidades n 
      JOIN motivos_nao_conformidade m ON n.id_motivo = m.id
      JOIN entregas e ON n.id_entrega = e.id
      WHERE n.id_entrega = ?');
    $stmt->execute([$id]);
    $naoConformidade = $stmt->fetchAll();

    if (isset($naoConformidade[0]) && is_array($naoConformidade[0])) {
      // Array de array
      $dados = $naoConformidade;
    } else {
      $dados = [$naoConformidade];
    }

    json(array_map(fn($n) => [
        'id' => $n['id'],
        'codigo' => $n['codigo'],
        'descricao' => $n['descricao'],
        'created_at' => $n['created_at'],
        'motivo' => [
            'codigo' => $n['motivo_codigo'],
            'descricao' => $n['motivo_descricao']
        ]
    ], $dados));
  }

}

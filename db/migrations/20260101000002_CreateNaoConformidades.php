<?php

use Phinx\Migration\AbstractMigration;

class CreateNaoConformidades extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
      CREATE TABLE nao_conformidades
      (
                id            INT UNSIGNED     AUTO_INCREMENT PRIMARY KEY,
                id_entrega    INT UNSIGNED     NOT NULL,
                id_motivo     INT UNSIGNED     NOT NULL,
                descricao     VARCHAR(500)     NULL,
                created_at    DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (id_entrega) REFERENCES entregas(id),
                FOREIGN KEY (id_motivo) REFERENCES motivos_nao_conformidade(id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
    }

    public function down(): void
    {
        $this->execute('DROP TABLE IF EXISTS nao_conformidades');
    }
}

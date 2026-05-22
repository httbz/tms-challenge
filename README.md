# TMS Challenge

API REST desenvolvida em PHP para gerenciamento de entregas, transportadoras e não conformidades.

---

# Tecnologias Utilizadas

- PHP 8.4
- MySQL 8
- Docker + Docker Compose
- Phinx (migrations e seeders)
- Composer

---

# Estrutura do Projeto

```txt
.
├── db/
│   ├── migrations/
│   └── seeds/
├── public/
│   └── index.php
├── src/
│   ├── Controllers/
│   │   ├── EntregaController.php
│   │   ├── NaoConformidadesController.php
│   │   ├── RastreamentoController.php
│   │   └── TransportadoraController.php
│   ├── Database.php
│   └── Router.php
├── BUGFIX.md
├── BUG_REPORT.md
├── Dockerfile
├── README.md
├── composer.json
├── composer.lock
├── docker-compose.yml
└── phinx.php
```

---

# Como rodar o projeto

## Pré-requisitos

Você pode rodar o projeto de duas formas:

### Sem Docker

- PHP >= 8.4
- Composer
- MySQL 8+

### Com Docker

- Docker
- Docker Compose

---

# Instalação

```bash
git clone https://github.com/httbz/tms-challenge.git
cd tms-challenge
```

Instale as dependências:

```bash
composer install
```

Crie o arquivo `.env`:

```bash
cp .env.example .env
```

Configure as variáveis do banco no `.env`.

Exemplo:

```env
DB_HOST=mysql
DB_PORT=3306
DB_NAME=db_test
DB_USER=app
DB_PASS=app
```

---

# Rodando com Docker

## Subir containers

```bash
docker compose up -d --build
```

Verificar containers:

```bash
docker compose ps
```

---

## Rodar migrations

```bash
docker compose exec app bash
```

Depois:

```bash
vendor/bin/phinx migrate
```

---

## Rodar seeders

```bash
vendor/bin/phinx seed:run
```

---

## Acessar aplicação

A aplicação ficará disponível em:

```txt
http://localhost:8000
```

---

## phpMyAdmin

Caso esteja configurado no `docker-compose.yml`:

```txt
http://localhost:8080
```

---

# Rodando sem Docker

## Subir servidor PHP

```bash
php -S 0.0.0.0:8000 -t public
```

Acesse:

```txt
http://localhost:8000
```

---

# Migrations

Executar migrations:

```bash
vendor/bin/phinx migrate
```

---

# Seeders

Executar todos os seeders:

```bash
vendor/bin/phinx seed:run
```

---

# Endpoints

## Transportadoras

### Listar transportadoras

```http
GET /transportadoras
```

---

### Criar transportadora

```http
POST /transportadoras
Content-Type: application/json

{
  "cnpj": "12345678000195",
  "nome_fantasia": "Transportadora XPTO"
}
```

---

### Inativar transportadora

```http
POST /transportadoras/{id}/inativar
```

---

### Reativar transportadora

```http
POST /transportadoras/{id}/reativar
```

---

# Entregas

## Criar entrega

```http
POST /entregas
Content-Type: application/json

{
  "id_transportadora": 1,
  "id_remetente": 2,
  "id_destinatario": 3,
  "data_prazo": "2026-06-22",
  "peso_kg": 0.5,
  "volumes": 2
}
```

---

# Exemplo de Resposta de Erro

```json
{
  "error": "Não é possível registrar uma entrega em uma transportadora inativada"
}
```

---

## Listar entregas

```http
GET /entregas
```

---

## Buscar entrega por ID

```http
GET /entregas/{id}
```

---

# Não conformidades

## Listar motivos

```http
GET /motivos-nao-conformidade
```

---

## Registrar não conformidade

```http
POST /entregas/{id}/nao-conformidade
Content-Type: application/json

{
  "id_entrega": 2,
  "id_motivo": 1,
  "descricao": "Volume avariado"
}
```

---

# Regras de Negócio

- Não é permitido criar entregas para transportadoras inativas
- Não conformidades precisam possuir um motivo válido
- Transportadoras podem ser reativadas posteriormente
- As validações são feitas no backend
- O banco possui constraints e chaves estrangeiras para garantir integridade

---

# Decisões Técnicas

## Controllers separados por domínio

Cada recurso possui seu próprio controller:

- `EntregaController`
- `TransportadoraController`
- `NaoConformidadeController`

Que facilita na manutenção, escalabilidade e leitura do projeto

---

## Dockerização

O projeto pode ser executado totalmente isolado via Docker.

Benefícios:

- ambiente padronizado
- facilidade para onboarding
- menos problemas de compatibilidade

---

## Validações 

Todas validações, como por ex. a de transportadora inativa e ativa, são realizadas no backend

---

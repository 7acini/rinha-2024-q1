
# Rinha Backend 2024 Q1

API RESTful desenvolvida em Laravel 10, com containerização Docker, atendendo os requisitos mínimos da Rinha de Backend 2024 Q1:

* Load Balancer (porta 9999) com algoritmo round robin (Nginx).
* 2 instâncias da API para alta disponibilidade e concorrência.
* Banco de dados PostgreSQL.
* Limitação total de recursos (CPU e memória) conforme regras da Rinha.

---

## Estrutura do Projeto

* **Laravel 12**: Framework PHP utilizado para desenvolvimento da API.
* **Docker**: Containerização da aplicação, banco e load balancer.
* **docker-compose.yml**: Orquestração dos containers (API, DB, Nginx).
* **nginx.conf**: Configuração do load balancer para proxy reverso e round robin.
* **script.sql**: Script de criação e popular inicial do banco PostgreSQL.
* **Seeders Laravel**: Para popular tabelas `users` e `clientes`.

---

## Rotas da API

| Método | URI                         | Descrição                        | Restrição     |
| ------ | --------------------------- | -------------------------------- | ------------- |
| POST   | `/clientes/{id}/transacoes` | Registra transações para cliente | `id` numérico |
| GET    | `/clientes/{id}/extrato`    | Consulta extrato do cliente      | `id` numérico |

---

## Models

* **User**: Representa usuários do sistema (ex: administradores).
* **Cliente**: Representa clientes com `nome`, `limite`, `saldo`.
* **Transacao** (planejado): Guarda as transações feitas pelos clientes.

---

## Banco de Dados

* **PostgreSQL** rodando em container separado.
* **Tabelas principais**:

  * `users`
  * `clientes`
  * `transacoes` (futura implementação)
* **Dados iniciais** são inseridos via `script.sql` e seeders Laravel.
* A coluna `saldo` não é populada inicialmente para refletir saldo atual em zero.

---

## Dockerização

### docker-compose.yml

* Define 4 serviços:

  * **api01**: Instância 1 da API Laravel.
  * **api02**: Instância 2 da API Laravel.
  * **db**: Banco PostgreSQL.
  * **nginx**: Load balancer configurado para porta 9999.

### Limites de recursos

* CPU total: 1.5 cores (divididos entre serviços).
* Memória total: 550 MB.
* Cada serviço possui limites específicos conforme o padrão da Rinha.

---

## Configuração do Nginx (Load Balancer)

* Proxy reverso na porta 9999.
* Balanceamento round robin entre `api01:8080` e `api02:8080`.
* Sem logs para performance.
* Configuração em `nginx.conf`.

---

## Processo de Desenvolvimento

1. Definição das rotas e controllers para endpoints.
2. Modelagem das entidades e migrations.
3. Criação dos seeders para dados iniciais.
4. Containerização dos serviços com Docker e Docker Compose.
5. Testes locais com o load balancer na porta 9999.
6. Ajustes de performance para obedecer limites da Rinha.
7. Preparação para testes Gatling.

---

## Comandos Importantes

* Build dos containers (buildx com plataforma linux/amd64):

  ```
  docker buildx build --platform linux/amd64 -t 7acini/rinha-2024-q1:latest .
  ```
* Iniciar containers:

  ```
  docker-compose up -d
  ```
* Parar containers:

  ```
  docker-compose down
  ```
* Rodar seeders Laravel:

  ```
  php artisan db:seed
  ```
* Ver logs:

  ```
  docker-compose logs -f
  ```

---

## Observações

* API deve estar pronta em até 40s para responder o endpoint `/clientes/1/extrato`.
* Código preparado para escalar horizontalmente via múltiplas instâncias.
* Limitação de recursos aplicada para evitar ultrapassar quota da Rinha.
* Testes de performance realizados com Gatling (setup externo).
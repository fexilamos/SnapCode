# Trabalho Final SDEV — Gestão de Serviços Fotográficos <Snap>

Este projeto é um sistema completo desenvolvido em **Laravel 12.x** para a gestão de serviços fotográficos, materiais, colaboradores e registos de eventos (casamentos, batizados, comunhões, etc).

---

## Índice
- [Funcionalidades](#funcionalidades)
- [Requisitos](#requisitos)
- [Instalação Rápida](#instalação-rápida)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Autenticação e Permissões](#autenticação-e-permissões)
- [Base de Dados e Seeds](#base-de-dados-e-seeds)
- [Autores](#autores)
- [Estrutura da Base de Dados (Resumo)](#estrutura-da-base-de-dados-resumo)

---

## Funcionalidades
- Gestão de funcionários, materiais e serviços/eventos.
- Registo e histórico de avarias, perdas e equipamento em manutenção.
- Alocação de materiais e funcionários a eventos/serviços.
- Registo de check-in e check-out de materiais.
- Navegação otimizada.
- Dashboard exclusivo para funcionários externos (nível 3), mostrando apenas os seus serviços.
- Restrições de acesso por nível de utilizador (admin/gestor, colaborador interno e  externo).
- Exportação de detalhes de serviço para PDF.
- Estrutura de rotas protegidas e organizadas por nível de acesso.

---

## Requisitos

- **PHP** >= 8.2
- **Composer**
- **Node.js** >= 18
- **npm** >= 9
- **MySQL** ou **MariaDB**
- **Extensões PHP**: pdo, mbstring, openssl, tokenizer, xml, ctype, json, bcmath, fileinfo, gd

### Pacotes PHP/Laravel
- `laravel/framework` ^12.0
- `barryvdh/laravel-dompdf` ^3.1 (exportação PDF)
- `laravel/tinker`
- `fakerphp/faker` (dev)
- `laravel/breeze` (dev, autenticação)
- `laravel/pail` (dev)
- `laravel/pint` (dev)
- `laravel/sail` (dev)
- `mockery/mockery` (dev)
- `nunomaduro/collision` (dev)
- `phpunit/phpunit` (dev)

### Pacotes JS/Frontend
- `vite` ^6.2
- `tailwindcss` ^3.1
- `@tailwindcss/forms`
- `@tailwindcss/vite`
- `alpinejs`
- `axios`
- `laravel-vite-plugin`
- `postcss`
- `bootstrap` ^5.3
- `@fullcalendar/core`, `daygrid`, `interaction`, `list`, `multimonth`, `timegrid`
- `react-icons`

---

## Instalação Rápida

1. **Clonar o repositório**
    ```bash
    git clone https://github.com/fexilamos/TrabalhoFinalSDEV
    cd TrabalhoFinalSDEV
    ```
2. **Instalar dependências PHP**
    ```bash
    composer install
    ```
3. **Instalar dependências JS**
    ```bash
    npm install
    ```
4. **Copiar e configurar variáveis de ambiente**
    ```bash
    cp .env.example .env
    # Edite o .env conforme a sua base de dados local
    ```
5. **Gerar chave da aplicação**
    ```bash
    php artisan key:generate
    ```
6. **Migrar e popular a base de dados**
    ```bash
    php artisan migrate --seed
    ```
7. **Compilar assets front-end**
    ```bash
    npm run build
    ```
8. **Iniciar o servidor**
    ```bash
    php artisan serve
    ```

---

## Estrutura do Projeto
- `app/Models` — Modelos Eloquent para cada entidade (Funcionário, Material, Serviço, etc).
- `app/Http/Controllers` — Controladores organizados por funcionalidade.
- `app/Http/Middleware/CheckNivel.php` — Middleware de controlo de permissões por nível de utilizador.
- `database/migrations` — Migrações para estrutura da base de dados.
- `database/seeders` — Seeds de dados para testes e desenvolvimento.
- `routes/web.php` — Rotas do projeto, agrupadas por nível de acesso.
- `resources/views` — Views Blade para todas as funcionalidades.

---

## Autenticação e Permissões
- **Autenticação:**
  Utiliza sistema de login do Laravel (Breeze).
- **Permissões por nível:**
  Cada utilizador pertence a um **Funcionário** com um determinado **nível** (`cod_nivel`).
  As permissões de acesso são controladas pelo middleware personalizado `CheckNivel`, aplicado nas rotas.

  | Nível | Acesso                                                  |
  |-------|---------------------------------------------------------|
  | 1     | Administrador (acesso total)                            |
  | 2     | Funcionario Interno (acesso a gestão de recursos)       |
  | 3     | Funcionario externo (acesso restrito aos seus serviços) |

- **Redirecionamento automático:**
  Após login, funcionários externos (nível 3) são redirecionados para o seu dashboard exclusivo.

## Base de Dados e Seeds
O projeto utiliza **migrações Laravel** para criar automaticamente toda a estrutura da base de dados necessária ao sistema.

1. **Migrar a base de dados:**
    ```bash
    php artisan migrate
    ```
2. **Popular com dados de exemplo (seeds):**
    ```bash
    php artisan db:seed
    ```
- Os seeds criam dados base como funções, estados, níveis, alguns materiais, etc.
- Pode editar ou criar novos seeders em `database/seeders/` para acrescentar dados fictícios para testes e demonstração.

## Estrutura da Base de Dados (Resumo)

O sistema utiliza uma base de dados relacional com as principais tabelas e relações:

- **Funcionarios**: Dados dos colaboradores (nome, contacto, nível, função, estado, etc)
- **Users**: Utilizadores para autenticação (ligados a um funcionário)
- **Nivel**: Tipos de acesso (1=Admin, 2=Interno, 3=Externo)
- **Funcao**: Funções dos funcionários (fotógrafo, editor, etc)
- **Material**: Inventário de equipamentos (categoria, marca, modelo, estado, localização, etc)
- **Material_Estado**: Estados possíveis do material (ativo, avariado, perdido, manutenção)
- **Categoria, Marca, Modelo**: Tabelas auxiliares para o material
- **Servicos**: Eventos/serviços fotográficos (cliente, tipo, local, datas, observações)
- **TiposServico**: Tipos de evento (casamento, batizado, comunhão, corporativo, etc)
- **Localizacoes**: Locais dos eventos
- **Clientes**: Dados dos clientes
- **Avarias**: Registo de avarias de material (com histórico e observações)
- **Perdas**: Registo de perdas de material
- **Servico_Funcionario**: Tabela pivô para alocação de funcionários a serviços (com datas de alocação)
- **Servico_Equipamento**: Tabela pivô para alocação de materiais a serviços
- **Check-in/Check-out**: Registos de entrada/saída de recursos em serviços

> **Nota:** Todas as tabelas principais têm migrações e seeds de exemplo. As relações entre entidades (ex: um serviço tem muitos funcionários e materiais) são feitas via tabelas pivô.

## Autores
Projeto desenvolvido por:
- **Bruna Silva**
- **Tiago Cardona**
- **Luis Mago**

Curso: **CESAE Digital — Software Developer**

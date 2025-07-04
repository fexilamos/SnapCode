# <SnapCode/> — Gestão de Serviços Fotográficos 

Este projeto é um sistema backend desenvolvido em **Laravel 12.x** para a gestão de serviços fotográficos, materiais, funcionários e registos de eventos (casamentos, batizados, etc).  
Foi criado como projeto final do curso de Desenvolvimento de Software, focando-se em boas práticas, segurança e separação de responsabilidades.

---

## Índice
- [Descrição Geral](#descrição-geral)
- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Geração de PDFs (Snappy)](#geração-de-pdfs-snappy)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Autenticação e Permissões](#autenticação-e-permissões)
- [Utilização](#utilização)
- [Base de Dados e Seeds](#base-de-dados-e-seeds)
- [Autores](#autores)

---

## Descrição Geral

O sistema permite:
- Gerir funcionários, materiais e serviços fotográficos.
- Controlar avarias e perdas de equipamento.
- Alocar materiais e funcionários a eventos/serviços.
- Registar check-in e check-out de recursos.
- Garantir acesso diferenciado por nível de utilizador (admin, gestor, operador).

---

## Requisitos

- PHP >= 8.2
- Composer
- MySQL ou MariaDB
- Node.js (para assets front-end, se aplicável)
- [Laravel 12.x](https://laravel.com/)
- Extensão PHP `mbstring` e `dom`
- **wkhtmltopdf** (para geração de PDFs com Snappy)

---

## Instalação

1. **Clonar o repositório**
    ```bash
    git clone <url-do-repo>
    cd TrabalhoFinalSDEV
    ```

2. **Instalar dependências**
    ```bash
    composer install
    ```

3. **Copiar e configurar variáveis de ambiente**
    ```bash
    cp .env.example .env
    # Editar .env conforme a base de dados local
    ```

4. **Gerar chave da aplicação**
    ```bash
    php artisan key:generate
    ```

5. **Migrar e popular a base de dados**
    ```bash
    php artisan migrate --seed
    ```

6. **(Opcional) Compilar assets front-end**
    ```bash
    npm install
    npm run build
    ```

7. **Iniciar o servidor**
    ```bash
    php artisan serve
    ```

---

## Geração de PDFs (Snappy)

Este projeto utiliza a biblioteca **Snappy** para gerar PDFs (ex: relatórios de serviços).

### Instalação do Snappy

1. **Instalar a dependência via Composer:**
    ```bash
    composer require barryvdh/laravel-snappy
    ```

2. **Instalar o `wkhtmltopdf` no sistema:**

   **Ubuntu/Debian:**
   ```bash
   sudo apt install wkhtmltopdf
   ```

   **Mac (via Homebrew):**
   ```bash
   brew install Caskroom/cask/wkhtmltopdf
   ```

   **Windows:**
   - Transferir o instalador: [https://wkhtmltopdf.org/downloads.html](https://wkhtmltopdf.org/downloads.html)
   - Adicionar o caminho do executável ao `PATH` do sistema.

3. **Configurar o serviço (se necessário)** no ficheiro `config/snappy.php` (pode ser publicado com `php artisan vendor:publish`).

4. **Testar geração de PDF**
    ```php
    use Barryvdh\Snappy\Facades\SnappyPdf;

    return SnappyPdf::loadView('pdf.servico', $data)->download('servico.pdf');
    ```

---

## Estrutura do Projeto

- `app/Models` — Modelos Eloquent para cada entidade (Funcionário, Material, Serviço, etc).
- `app/Http/Controllers` — Controladores organizados por funcionalidade.
- `app/Http/Middleware/CheckNivel.php` — Middleware de controlo de permissões por nível de utilizador.
- `database/migrations` — Migrações para estrutura da base de dados.
- `database/seeders` — Seeds de dados para testes e desenvolvimento.
- `routes/web.php` — Rotas do projeto, agrupadas por nível de acesso.

---

## Autenticação e Permissões

- **Autenticação:**  
  Utiliza sistema de login do Laravel (guard padrão).
- **Permissões por nível:**  
  Cada utilizador pertence a um **Funcionário** com um determinado **nível** (`cod_nivel`).  
  As permissões de acesso são controladas pelo middleware personalizado `CheckNivel`, aplicado nas rotas:

  | Nível | Acesso                                |
  |-------|---------------------------------------|
  | 1     | Administrador (acesso total)          |
  | 2     | Gestor (acesso a gestão de recursos)  |
  | 3     | Operador (acesso restrito aos seus serviços) |

  **Exemplo de proteção nas rotas:**
  ```php
  Route::middleware(['auth', 'nivel:1,2'])->group(function () {
      Route::get('/servicos', [ServicoController::class, 'index']);
      // ...
  });
  ```

---

## Utilização

Após autenticação no sistema, cada utilizador terá acesso às funcionalidades conforme o seu nível de permissão:

### Funcionários
- Listar todos os funcionários
- Criar novo funcionário
- Editar ou eliminar funcionários existentes

### Materiais
- Listar todos os materiais disponíveis
- Adicionar novos materiais ao inventário
- Consultar detalhes, editar ou remover materiais
- Registar perdas ou avarias nos materiais

### Serviços/Eventos
- Criar novos serviços (ex: casamentos, batizados, eventos empresariais)
- Associar clientes aos serviços
- Alocar materiais e funcionários a cada serviço
- Registar check-in e check-out de recursos associados
- Visualizar detalhes completos de cada serviço/evento

### Check-in/Check-out
- Atribuir e remover materiais ou funcionários de um serviço com datas de entrada e saída

**Nota:**  
Cada ação só está disponível se o nível de permissão do utilizador permitir. Utilizadores de nível 3, por exemplo, apenas veem e gerem os serviços a que estão alocados.

---

## Base de Dados e Seeds

O projeto utiliza **migrações Laravel** para criar automaticamente toda a estrutura da base de dados necessária ao sistema.

### Como usar:

1. **Migrar a base de dados:**
    ```bash
    php artisan migrate
    ```

2. **Popular com dados de exemplo (seeds):**
    ```bash
    php artisan db:seed
    ```

- Os seeds criam dados base como funções, estados, níveis, alguns materiais, etc.
- Podes editar ou criar novos seeders em `database/seeders/` para acrescentar dados fictícios para testes e demonstração.

> **Sugestão:**  
> Após o seed, podes aceder com um utilizador admin ou criar o teu próprio.

---

## Autores

Projeto desenvolvido por:
- **Bruna Silva**
- **Luis Mago**
- **Tiago Cardona**
Curso: **CESAE Digital — Software Developer**

# TrabalhoFinalSDEV
Trabalho final Software Developer Cesae 2025



Ideia para Projeto Final


Ao longo dos  anos em que trabalhei na área da fotografia, identifiquei um problema recorrente. Colaborei com diversas empresas que oferecem um vasto leque de serviços e que, frequentemente, recorrem a colaboradores externos. Sempre que os fotógrafos ou videógrafos se deslocam para um serviço, é comum faltar material essencial e raramente se consegue identificar o responsável.
 


A Solução

Desenvolver uma web app que permita catalogar de forma detalhada todo o material fotográfico e videográfico, bem como a informação dos colaboradores internos e externos.

Funcionalidades principais:

Gestão de Material:
Catálogo detalhado do equipamento, incluindo câmaras, lentes, tampas, baterias, mochilas, cartões de memória, entre outros.

Gestão de Colaboradores:
Registo de nome, contacto, função (fotógrafo, videógrafo ou ambos), indicação se utiliza material próprio, e tipos de eventos em que se destaca (ex.: o colaborador A tem melhor desempenho em casamentos, o colaborador B em comunhões).

Registo de Serviços:
Para cada serviço (casamento, batizado, sessão corporativa, etc.), é possível associar os colaboradores atribuídos e o equipamento transportado.
No início do serviço, o colaborador faz o check-in do material que leva consigo; no final do dia, realiza o check-out, validando o retorno de todos os itens.

Histórico e Diagnóstico de Problemas:
O gestor pode consultar facilmente quem participou em cada serviço e que material foi utilizado. Esta funcionalidade torna-se especialmente útil na fase de edição — se forem detetados problemas nas imagens (ex.: fotografias desfocadas, ficheiros corrompidos), será possível cruzar dados para perceber se a origem do problema é uma falha técnica (de hardware) ou humana.

A base de dados será estruturada de forma a garantir flexibilidade e escalabilidade, permitindo adicionar novos tipos de material, funções de colaboradores e categorias de serviços conforme necessário.






IDEIAS / Funcionalidades
- Criar 3 níveis de acesso: Administrador(acesso total), Funcionário Interno(consultas de serviços, report de avarias/perdas),  e Funcionário Externo (penas consulta).
- 
- Implementar um sistema de base de dados para gerir:

    - Fotógrafos e colaboradores, com contactos e informação relevante (ex: estilo, funções: videógrafo, fotógrafo, ambos, etc).

    - Material (lentes, tampas de lente, máquinas, baterias, tripés, etc).

- Associar cada serviço/evento a um fotógrafo/videógrafo e ao respectivo material utilizado.
  
- Associar códigos a cada elemento do material para uma gestão eficiente do stock e rastrear possíveis avarias e/ou perdas de material.

- Possibilidade de pesquisar, após o serviço, todo o material que foi utilizado.

- Implementar sistema para gerar PDFs com instruções sobre proximo serviço.

- Criar apoio visual a cada "pack" de material, fotografia "top down" para identificar cada material usado.
 
- Para funcionários internos e externos, registar os serviços em que participaram e o respectivo saldo/salário (€).



 





Primeiro esboço via chatgpt

Estou a realizar um trabalho de final de curso na área de desenvolvimento de software. O projeto consiste em criar uma web app para a gestão de uma empresa de fotografia. Idealmente, pretendemos criar uma base de dados com todo o material utilizado nas reportagens fotográficas, bem como os colaboradores internos e externos, entre outros.

Pretendemos também guardar na base de dados todos os serviços realizados, sendo que cada serviço estará associado a funcionários e ao material utilizado. Gostaríamos ainda que a web app permitisse, para cada funcionário, realizar o check-out do material levado após o serviço, de forma a verificar se falta algum material.
Que tipo de abordagem devemos seguir? Estavamos a pensar em Mysql+Laravel 



A tua abordagem com MySQL e Laravel é excelente para este tipo de projeto! Laravel é um dos frameworks PHP mais modernos, com ótimas ferramentas para autenticação, gestão de permissões, ligação a bases de dados e construção rápida de web apps robustas. MySQL é uma base de dados relacional muito estável e largamente suportada. Vou deixar-te aqui um esquema de abordagem que te pode ajudar a estruturar o trabalho e o projeto.

1. Planeamento do Projeto
Análise de requisitos: Lista todas as funcionalidades necessárias, tipos de utilizadores, fluxos principais (exemplo: check-out/check-in de material, registo de serviços, gestão de colaboradores, etc.).

Desenho da base de dados: Esboça as tabelas principais e as relações entre elas.

Protótipo UI/UX: Cria esboços de como será a navegação e as páginas principais (podes usar Figma, papel, etc.).

2. Modelação da Base de Dados
De forma geral, vais precisar de tabelas como:

users (funcionários, internos/externos)

materials (equipamento de fotografia, acessórios, etc.)

services (reportagens, eventos, etc.)

material_service (pivot: material usado em cada serviço)

user_service (pivot: funcionários associados a cada serviço)

checkouts (controlo de saída/entrada de material por serviço)

users
- id
- name
- type (interno/externo)
- ...

materials
- id
- name
- description
- serial_number
- ...

services
- id
- title
- date
- description
- ...

material_service
- id
- material_id
- service_id

user_service
- id
- user_id
- service_id

checkouts
- id
- user_id
- material_id
- service_id
- checked_out_at
- checked_in_at








3. Back-end com Laravel
Eloquent Models: Cada tabela tem o seu modelo, com relações bem definidas (hasMany, belongsToMany, etc.).

Controllers: Um para cada área (MaterialController, ServiceController, UserController, etc.).

Autenticação & Autorização: Usa o sistema built-in do Laravel, que permite gerir permissões facilmente (por exemplo, só certos utilizadores podem fazer check-out de material).

APIs/Views: Se quiseres uma SPA, podes usar Laravel como API + frontend em Vue.js, ou então o tradicional Blade/Laravel Livewire.

4. Front-end
Laravel Blade: Simples e eficaz para muitos projetos, já vem integrado.

Laravel Livewire: Para interfaces reativas sem sair do Laravel.

Vue.js: Se quiseres algo mais dinâmico/SPA.

5. Funcionalidades-chave a considerar
Gestão de stock de material (o que está disponível, em serviço, manutenção, etc.)

Histórico de serviços e de material utilizado

Check-out e check-in de material (com alertas se faltar algo ao devolver)

Gestão de utilizadores e permissões.

Notificações (opcional): Por exemplo, se um material não for devolvido a tempo.

6. Sugestão de workflow para o check-out/check-in
Quando um serviço é criado, associa-se o material e os colaboradores.

Antes do serviço, cada colaborador faz o check-out do material que vai levar.

No regresso, realiza-se o check-in: regista-se o material devolvido, marcando automaticamente o que ficou em falta.

Podes depois gerar relatórios automáticos de material em falta ou histórico de movimentos.

7. Vantagens da stack MySQL + Laravel
Documentação e comunidade muito forte

Ferramentas built-in para autenticação e permissões

Facilidade de escalar e migrar para produção

Migrations do Laravel facilitam criar e evoluir a base de dados

8. Outros conselhos
Começa por modelar bem os dados (é meio caminho andado!)

Usa seeders/factories para gerar dados de teste

Testa as relações entre tabelas com Eloquent logo desde início

Documenta bem o processo (é ótimo para o relatório final!)






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






IDEIAS:


sistema de base de dados para gerir fotógrafos, material
implementar sistema para gerar PDF's com instrucoes 
base de dados com contactos e informação de fotógrafo/colaborador, campos de informacao como estilo, funcoes (videografo, fotografo, ambos, etc)
Cada serviço é associado a um fotógrafo/videografo e o seu respectivo material
criar código em c# para escrever/exportar registos em CSV
Com uma base de dados podemos por exemplo descobrir que fotografo foi para o servico X e que material usou. 
também podemos usar a pesquisa nos dias após o serviço para confirmar que cartoes foram usados para cada serviço
Cada material(lente, tampas de lente, máquinas, baterias, tripés, etc) teria uma etiqueta com codigo de barras(??)
No inicio de cada servico o fotógrafo faz scan usando o telemovel a cada material que vai levar
No fim do serviço tem que confirmar que todo material voltou
Aplicação construida para android

Usar Figma para design de layout 





Primeiro esboço via chatgpt


1. Estrutura da Base de Dados:

Tabelas Essenciais:
Fotógrafos/Videógrafos: (ID, Nome, Contacto, Especialidade)
Material: (ID, Nome, Tipo, Número de Série, Código de Barras/QR Code)
Serviços: (ID, Data, Local, Descrição, Fotógrafo/Videógrafo ID)
ServiçoMaterial: (Serviço ID, Material ID, Quantidade, Estado (Levado/Devolvido))
Cartões de Memória: (ID, Número de Série, Capacidade, Serviço ID)

Relacionamentos:
Estabeleçer relações claras entre as tabelas para garantir a integridade dos dados. Por exemplo, um serviço está associado a um fotógrafo e vários itens de material

Códigos de Barras/QR Codes:
  - A utilização de códigos de barras ou QR codes é uma excelente ideia para agilizar o processo de registo de material. Certifique-se de que a aplicação Android seja capaz de ler estes códigos.


2. Funcionalidades da Aplicação Android:

Registo de Material:
Permitir o registo de novos itens de material na base de dados, incluindo a geração de códigos de barras/QR codes.
Check-in/Check-out de Material:
Implementar a funcionalidade de leitura de códigos de barras/QR codes para registar a saída e o retorno de material.
Permitir a confirmação visual do material através de fotos.
Associação de Material a Serviços:
Permitir que os fotógrafos associem o material utilizado a cada serviço.
Registo de cartões de memória usados.
Consulta de Histórico:
Permitir a consulta do histórico de serviços e do material utilizado em cada um.
Permitir a consulta de que cartões foram usados em cada serviço.
Gestão de Fotógrafos/Videógrafos:
Permitir o registo e a gestão de informações dos fotógrafos/videógrafos.
Relatórios:
Gerar relatórios sobre o material mais utilizado, os fotógrafos mais requisitados, etc.
Notificações:
Enviar notificações sobre material não devolvido ou cartões de memória que precisam ser verificados.
3. Tecnologias:

Base de Dados:
SQLite (para armazenamento local no dispositivo Android) ou MySQL/PostgreSQL (para um servidor centralizado).
Aplicação Android:
Kotlin ou Java (linguagens de programação Android).
Biblioteca de leitura de códigos de barras/QR codes (por exemplo, Zxing).
Servidor (Opcional):
Node.js, Python/Django ou .NET (para um servidor centralizado).
API REST (para comunicação entre a aplicação Android e o servidor).
4. Melhorias Adicionais:

Sincronização na Nuvem:
Implementar a sincronização de dados com um servidor na nuvem para garantir a segurança e a acessibilidade dos dados.
Integração com Calendário:
Integrar a aplicação com o calendário do dispositivo para facilitar o agendamento de serviços.
Gestão de Manutenção:
Adicionar funcionalidades para registar e gerir a manutenção do material.
5. Considerações Importantes:

Interface do Utilizador (UI):
Desenvolver uma interface intuitiva e fácil de usar para a aplicação Android.
Segurança:
Implementar medidas de segurança para proteger os dados da base de dados.
Testes:
Realizar testes exaustivos para garantir a funcionalidade e a estabilidade da aplicação.
Ao considerar estas sugestões, você poderá criar um projeto final robusto e valioso para a gestão de fotógrafos e material.














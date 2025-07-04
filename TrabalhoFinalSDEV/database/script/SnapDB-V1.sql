SET FOREIGN_KEY_CHECKS = 0;

-- Tabelas Base
CREATE TABLE Marca (
  cod_marca INT PRIMARY KEY,
  marca VARCHAR(50)
);

CREATE TABLE Categoria (
  cod_categoria VARCHAR(50) PRIMARY KEY,
  categoria VARCHAR(50)
);

CREATE TABLE Modelo (
  cod_modelo INT PRIMARY KEY,
  modelo VARCHAR(250)
);

CREATE TABLE Material_Estado (
  cod_estado INT PRIMARY KEY AUTO_INCREMENT,
  estado_nome VARCHAR(50) UNIQUE
);

CREATE TABLE Material (
  cod_material VARCHAR(25) PRIMARY KEY,
  cod_categoria VARCHAR(50) NOT NULL,
  cod_marca INT NOT NULL,
  cod_modelo INT NOT NULL,
  num_serie VARCHAR(25) NOT NULL,
  cod_estado INT NOT NULL,
  observacoes VARCHAR(500),
  FOREIGN KEY (cod_categoria) REFERENCES Categoria(cod_categoria),
  FOREIGN KEY (cod_marca) REFERENCES Marca(cod_marca),
  FOREIGN KEY (cod_modelo) REFERENCES Modelo(cod_modelo),
  FOREIGN KEY (cod_estado) REFERENCES Material_Estado(cod_estado)
);

CREATE TABLE Nivel (
  cod_nivel INT PRIMARY KEY,
  nivel VARCHAR(25)
);

CREATE TABLE Funcao (
  cod_funcao INT PRIMARY KEY,
  funcao VARCHAR(50)
);

CREATE TABLE Funcionario_Estado (
  cod_estado INT PRIMARY KEY AUTO_INCREMENT,
  estado_nome VARCHAR(50) UNIQUE
);

CREATE TABLE Funcionarios (
  cod_funcionario INT PRIMARY KEY AUTO_INCREMENT,
  cod_nivel INT NOT NULL,
  nome VARCHAR(70) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  mail VARCHAR(255),
  morada VARCHAR(255),
  cod_funcao INT NOT NULL,
  cod_estado INT NOT NULL,
  pilota_drone BOOLEAN DEFAULT FALSE,
  tem_equipamento_proprio BOOLEAN DEFAULT FALSE,
  FOREIGN KEY (cod_nivel) REFERENCES Nivel(cod_nivel),
  FOREIGN KEY (cod_funcao) REFERENCES Funcao(cod_funcao),
  FOREIGN KEY (cod_estado) REFERENCES Funcionario_Estado(cod_estado)
);

CREATE TABLE TiposServico (
  cod_tipo_servico INT PRIMARY KEY AUTO_INCREMENT,
  nome_tipo VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE Localizacoes (
  cod_local_servico INT PRIMARY KEY AUTO_INCREMENT,
  nome_local VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE Clientes (
  cod_cliente INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  telefone VARCHAR(255),
  mail VARCHAR(255)
);

CREATE TABLE Servicos (
  cod_servico INT PRIMARY KEY AUTO_INCREMENT,
  cod_cliente INT NOT NULL,
  cod_tipo_servico INT NOT NULL,
  cod_local_servico INT,
  data_inicio DATE NOT NULL,
  data_fim DATE NOT NULL,
  nome_servico VARCHAR(255),
  FOREIGN KEY (cod_cliente) REFERENCES Clientes(cod_cliente),
  FOREIGN KEY (cod_tipo_servico) REFERENCES TiposServico(cod_tipo_servico),
  FOREIGN KEY (cod_local_servico) REFERENCES Localizacoes(cod_local_servico)
);

CREATE TABLE Avarias (
  cod_avaria INT PRIMARY KEY AUTO_INCREMENT,
  cod_material VARCHAR(25) NOT NULL,
  cod_servico INT,
  data_registo DATE NOT NULL,
  observacoes VARCHAR(500),
  FOREIGN KEY (cod_material) REFERENCES Material(cod_material),
  FOREIGN KEY (cod_servico) REFERENCES Servicos(cod_servico)
);

CREATE TABLE Perdas (
  cod_perda INT PRIMARY KEY AUTO_INCREMENT,
  cod_material VARCHAR(25) NOT NULL,
  cod_servico INT,
  data_registo DATE NOT NULL,
  observacoes VARCHAR(500),
  FOREIGN KEY (cod_material) REFERENCES Material(cod_material),
  FOREIGN KEY (cod_servico) REFERENCES Servicos(cod_servico)
);

-- Tabelas Detalhe de Serviços
CREATE TABLE Servico_Detalhes_Casamento (
  cod_servico INT PRIMARY KEY,
  fotos BOOLEAN,
  video BOOLEAN,
  drone BOOLEAN,
  sde BOOLEAN,
  fotos_convidados BOOLEAN,
  num_convidados_fotos INT,
  venda_fotos BOOLEAN,
  hora_chegada_casa_noivo VARCHAR(10),
  hora_saida_casa_noivo VARCHAR(10),
  nome_noivo VARCHAR(40),
  morada_noivo VARCHAR(100),
  agregado_noivo VARCHAR(50),
  info_extra_noivo VARCHAR(500),
  hora_chegada_casa_noiva VARCHAR(10),
  nome_noiva VARCHAR(40),
  morada_noiva VARCHAR(100),
  agregado_noiva VARCHAR(50),
  info_extra_noiva VARCHAR(500),
  morada_igreja VARCHAR(100),
  instrucoes_igreja VARCHAR(200),
  ordem_entrada VARCHAR(100),
  coro BOOLEAN,
  coro_localizacao VARCHAR(50),
  ordem_leituras VARCHAR(100),
  oferta_ramo BOOLEAN,
  grupo_exterior BOOLEAN,
  instrucoes_saida_igreja VARCHAR(200),
  info_extra_igreja VARCHAR(500),
  nome_quinta VARCHAR(40),
  morada_quinta VARCHAR(100),
  instrucoes_quinta VARCHAR(200),
  timeline VARCHAR(400),
  FOREIGN KEY (cod_servico) REFERENCES Servicos(cod_servico) ON DELETE CASCADE
);

CREATE TABLE Servico_Detalhes_Batizado (
  cod_servico INT PRIMARY KEY,
  fotos BOOLEAN,
  video BOOLEAN,
  drone BOOLEAN,
  sde BOOLEAN,
  fotos_convidados BOOLEAN,
  num_convidados_fotos INTEGER,
  venda_fotos BOOLEAN,
  hora_chegada_casa_bebe VARCHAR(10),
  hora_saida_casa_bebe VARCHAR(10),
  nome_bebe VARCHAR(40),
  morada_bebe VARCHAR(100),
  agregado_bebe VARCHAR(50),
  info_extra_bebe VARCHAR(500),
  morada_igreja VARCHAR(100),
  instrucoes_igreja VARCHAR(200),
  coro BOOLEAN,
  coro_localizacao VARCHAR(50),
  grupo_exterior BOOLEAN,
  info_extra_igreja VARCHAR(500),
  nome_quinta VARCHAR(40),
  morada_quinta VARCHAR(100),
  instrucoes_quinta VARCHAR(200),
  timeline VARCHAR(200),
  FOREIGN KEY (cod_servico) REFERENCES Servicos(cod_servico) ON DELETE CASCADE
);

CREATE TABLE Servico_Detalhes_ComunhaoParticular (
  cod_servico INT PRIMARY KEY,
  fotos BOOLEAN,
  video BOOLEAN,
  drone BOOLEAN,
  sde BOOLEAN,
  fotos_convidados BOOLEAN,
  num_convidados_fotos INTEGER,
  venda_fotos BOOLEAN,
  hora_chegada_casa_crianca VARCHAR(10),
  hora_saida_casa_crianca VARCHAR(10),
  nome_crianca VARCHAR(40),
  morada_crianca VARCHAR(100),
  agregado_crianca VARCHAR(50),
  info_extra_crianca VARCHAR(500),
  morada_igreja VARCHAR(100),
  instrucoes_igreja VARCHAR(200),
  coro BOOLEAN,
  coro_localizacao VARCHAR(50),
  grupo_exterior BOOLEAN,
  info_extra_igreja VARCHAR(500),
  nome_quinta VARCHAR(40),
  morada_quinta VARCHAR(100),
  instrucoes_quinta VARCHAR(200),
  timeline VARCHAR(200),
  FOREIGN KEY (cod_servico) REFERENCES Servicos(cod_servico) ON DELETE CASCADE
);

CREATE TABLE Servico_Detalhes_ComunhaoGeral (
  cod_servico INT PRIMARY KEY,
  fotos BOOLEAN,
  video BOOLEAN,
  drone BOOLEAN,
  sde BOOLEAN,
  formato_fotos VARCHAR(10),
  valor_foto DECIMAL(10, 2),
  formato_video VARCHAR(10),
  valor_video DECIMAL(10, 2),
  hora_chegada_igreja VARCHAR(5),
  num_criancas INTEGER,
  info_extra_comunhao VARCHAR(300),
  coro BOOLEAN,
  coro_localizacao VARCHAR(50),
  diplomas BOOLEAN,
  grupo_exterior BOOLEAN,
  FOREIGN KEY (cod_servico) REFERENCES Servicos(cod_servico) ON DELETE CASCADE
);

CREATE TABLE Servico_Detalhes_EvCorporativo (
  cod_servico INT PRIMARY KEY,
  fotos BOOLEAN,
  video BOOLEAN,
  drone BOOLEAN,
  sde BOOLEAN,
  hora_chegada_corp VARCHAR(10),
  info_extra_corp VARCHAR(300),
  FOREIGN KEY (cod_servico) REFERENCES Servicos(cod_servico) ON DELETE CASCADE
);

-- Tabelas de relação
CREATE TABLE Servico_Funcionario (
  cod_servico INT,
  cod_funcionario INT,
  PRIMARY KEY (cod_servico, cod_funcionario),
  data_alocacao_inicio DATE NOT NULL,
  data_alocacao_fim DATE NOT NULL,
  funcao_no_servico VARCHAR(50),
  FOREIGN KEY (cod_servico) REFERENCES Servicos(cod_servico) ON DELETE CASCADE,
  FOREIGN KEY (cod_funcionario) REFERENCES Funcionarios(cod_funcionario) ON DELETE CASCADE
);

CREATE TABLE funcionario_funcao (
  cod_funcionario INT NOT NULL,
  cod_funcao INT NOT NULL,
  PRIMARY KEY (cod_funcionario, cod_funcao),
  FOREIGN KEY (cod_funcionario) REFERENCES Funcionarios(cod_funcionario),
  FOREIGN KEY (cod_funcao) REFERENCES Funcao(cod_funcao)
);

SET FOREIGN_KEY_CHECKS = 1;

-- ====================
-- Dados Essenciais
-- ====================

INSERT INTO Nivel (cod_nivel, nivel) VALUES
(1, 'Administrador'), (2, 'Funcionário Interno'), (3, 'Funcionário Externo');

INSERT INTO Modelo (cod_modelo, modelo) VALUES
(1, 'EOS 5D Mark IV'), (2, 'Alpha A7 III'), (3, 'Phantom 4 Pro'), (4, 'Hero 9'), (5, 'D850');

INSERT INTO Material_Estado (estado_nome) VALUES
('Operacional'), ('Em manutenção'), ('Avariado'), ('Perdido');

INSERT INTO Marca (cod_marca, marca) VALUES
(1, 'Canon'), (2, 'Sony'), (3, 'DJI'), (4, 'GoPro'), (5, 'Nikon');

INSERT INTO Categoria (cod_categoria, categoria) VALUES
('CAM', 'Câmara'), ('LEN', 'Lente'), ('DRN', 'Drone'), ('TRP', 'Tripé'), ('MIC', 'Microfone');

INSERT INTO Material (
  cod_material, cod_categoria, cod_marca, cod_modelo,
  num_serie, cod_estado, observacoes
) VALUES
('MAT001', 'CAM', 1, 1, 'CN12345', 1, 'Usada para eventos'),
('MAT002', 'CAM', 2, 2, 'SN67890', 1, 'Câmara principal de vídeo'),
('MAT003', 'DRN', 3, 3, 'DJI0001', 1, 'Drone com 4 baterias'),
('MAT004', 'CAM', 4, 4, 'GP11223', 2, 'A necessitar de revisão'),
('MAT005', 'CAM', 5, 5, 'NK99887', 1, 'Usada para backup');

INSERT INTO Funcao (cod_funcao, funcao) VALUES
(1, 'Fotógrafo'), (2, 'Videógrafo'), (3, 'Piloto de Drone'), (4, 'Editor'), (5, 'Assistente Técnico');

INSERT INTO Funcionario_Estado (estado_nome) VALUES
('Ativo'), ('Ocupado');

INSERT INTO Funcionarios (
  cod_nivel, nome, telefone, mail, morada,
  cod_funcao, cod_estado, pilota_drone, tem_equipamento_proprio
) VALUES
(1, 'Ana Silva', '912345678', 'ana@exemplo.com', 'Lisboa', 1, 1, FALSE, TRUE),
(2, 'Bruno Costa', '913456789', 'bruno@exemplo.com', 'Porto', 2, 1, FALSE, FALSE),
(2, 'Carlos Mendes', '914567890', 'carlos@exemplo.com', 'Faro', 3, 1, TRUE, TRUE),
(3, 'Daniela Rocha', '915678901', 'daniela@exemplo.com', 'Coimbra', 4, 2, FALSE, TRUE),
(3, 'Eduardo Pereira', '916789012', 'eduardo@exemplo.com', 'Braga', 5, 1, FALSE, FALSE);

INSERT INTO funcionario_funcao (cod_funcionario, cod_funcao) VALUES (1, 1);
INSERT INTO funcionario_funcao (cod_funcionario, cod_funcao) VALUES (2, 2), (2, 5);
INSERT INTO funcionario_funcao (cod_funcionario, cod_funcao) VALUES (3, 3);
INSERT INTO funcionario_funcao (cod_funcionario, cod_funcao) VALUES (4, 4);
INSERT INTO funcionario_funcao (cod_funcionario, cod_funcao) VALUES (5, 5);

INSERT INTO TiposServico (nome_tipo) VALUES
('Casamento'), ('Batizado'), ('Evento Corporativo'), ('Comunhão Particular'), ('Comunhão Geral');

INSERT INTO Localizacoes (nome_local) VALUES
('Lisboa'), ('Porto'), ('Coimbra'), ('Braga'), ('Guimarães');

INSERT INTO Clientes (nome, telefone, mail) VALUES
('Rui e Sofia', '921234567', 'ruisofia@email.com'),
('Carlos e Ana', '931234678', 'carlosana@email.com'),
('Família Fernandes', '941234789', 'familiafernandes@email.com'),
('Família Oliveira', '951234890', 'familiaoliveira@email.com'),
('Empresa ABC', '961234901', 'contato@empresaabc.com'),
('João e Maria', '911112223', 'joaomaria@email.com'),
('Pedro e Inês', '961234789', 'pedroines@email.com'),
('André e Carla', '962345678', 'andrecarla@email.com'),
('Miguel e Patrícia', '963456789', 'miguelpatricia@email.com'),
('Tiago e Beatriz', '964567890', 'tiagobeatriz@email.com'),
('Familia Martins', '921111111', 'leonor.martins@email.com'),
('Familia Costa', '922222222', 'mateus.costa@email.com'),
('Familia Ribeiro', '923333333', 'ines.ribeiro@email.com'),
('Familia Lopes', '924444444', 'santiago.lopes@email.com'),
('Familia Sousa', '925555555', 'beatriz.sousa@email.com'),
('Familia Alves', '926111111', 'catarina.alves@email.com'),
('Familia Ferreira', '926222222', 'tomas.ferreira@email.com'),
('Familia Mendes', '926333333', 'laura.mendes@email.com'),
('Familia Rocha', '926444444', 'gabriel.rocha@email.com'),
('Familia Cruz', '926555555', 'matilde.cruz@email.com'),
('Pais do Martim Correia', '927111111', 'martim.correia@email.com'),
('Pais da Clara Santos', '927222222', 'clara.santos@email.com'),
('Pais do Rodrigo Almeida', '927333333', 'rodrigo.almeida@email.com'),
('Pais da Mafalda Dias', '927444444', 'mafalda.dias@email.com'),
('Empresa TechNova', '928111111', 'eventos@technova.com'),
('Empresa InovaMais', '928222222', 'comunicacao@inovamais.pt'),
('Grupo FutureCorp', '928333333', 'contacto@futurecorp.pt'),
('Organização SigmaEvent', '928444444', 'sigma@eventos.pt');

INSERT INTO Servicos (cod_cliente, cod_tipo_servico, cod_local_servico, data_inicio, data_fim, nome_servico) VALUES
(1, 1, 1, '2025-09-20', '2025-09-21', 'Casamento Rui e Sofia'),
(2, 1, 2, '2025-10-10', '2025-10-11', 'Casamento Carlos e Ana'),
(3, 2, 3, '2025-07-05', '2025-07-05', 'Batizado do João Fernandes'),
(4, 2, 4, '2025-08-15', '2025-08-15', 'Batizado da Mariana Oliveira'),
(3, 5, 3, '2025-06-15', '2025-06-15', 'Comunhão Geral de Lanheses'),
(4, 4, 4, '2025-06-30', '2025-06-30', 'Comunhão Privada da Beatriz Oliveira'),
(5, 3, 5, '2025-11-05', '2025-11-06', 'Evento Empresarial ABC 2025'),
(6, 1, 1, '2025-12-20', '2025-12-21', 'Casamento João e Maria'),
(7, 1, 2, '2025-01-10', '2025-01-11', 'Casamento Pedro e Inês'),
(8, 1, 3, '2025-02-15', '2025-02-16', 'Casamento André e Carla'),
(9, 1, 4, '2025-03-20', '2025-03-21', 'Casamento Miguel e Patrícia'),
(10, 1, 5, '2025-04-25', '2025-04-26', 'Casamento Tiago e Beatriz'),
(11, 2, 1, '2025-05-10', '2025-05-10', 'Batizado da Leonor Martins'),
(12, 2, 2, '2025-06-01', '2025-06-01', 'Batizado do Mateus Costa'),
(13, 2, 3, '2025-07-20', '2025-07-20', 'Batizado da Inês Ribeiro'),
(14, 2, 4, '2025-08-03', '2025-08-03', 'Batizado do Santiago Lopes'),
(15, 2, 5, '2025-09-07', '2025-09-07', 'Batizado da Beatriz Sousa'),
(16, 4, 1, '2025-05-25', '2025-05-25', 'Comunhão Geral da Catarina Alves'),
(17, 4, 2, '2025-06-10', '2025-06-10', 'Comunhão Geral de Oliveira'),
(18, 4, 3, '2025-06-18', '2025-06-18', 'Comunhão Geral de Vila Verde'),
(19, 4, 4, '2025-07-02', '2025-07-02', 'Comunhão Geral de Rendufinho'),
(20, 4, 5, '2025-07-15', '2025-07-15', 'Comunhão Geral de Mordor'),
(21, 5, 1, '2025-06-01', '2025-06-01', 'Comunhão Particular do Martim Correia'),
(22, 5, 2, '2025-06-10', '2025-06-10', 'Comunhão Particular da Clara Santos'),
(23, 5, 3, '2025-06-15', '2025-06-15', 'Comunhão Particular do Rodrigo Almeida'),
(24, 5, 4, '2025-07-01', '2025-07-01', 'Comunhão Particular da Mafalda Dias'),
(25, 3, 1, '2025-09-10', '2025-09-11', 'Evento Corporativo TechNova Connect'),
(26, 3, 2, '2025-10-02', '2025-10-02', 'Workshop InovaMais 2025'),
(27, 3, 3, '2025-11-15', '2025-11-16', 'Conferência FutureCorp'),
(28, 3, 4, '2025-12-05', '2025-12-05', 'Networking SigmaEvent – Fim de Ano');

INSERT INTO Servico_Detalhes_Casamento (cod_servico, fotos, video, drone, sde, fotos_convidados, num_convidados_fotos, venda_fotos,
  hora_chegada_casa_noivo, hora_saida_casa_noivo, nome_noivo, morada_noivo, agregado_noivo, info_extra_noivo,
  hora_chegada_casa_noiva, nome_noiva, morada_noiva, agregado_noiva, info_extra_noiva,
  morada_igreja, instrucoes_igreja, ordem_entrada, coro, coro_localizacao, ordem_leituras,
  oferta_ramo, grupo_exterior, instrucoes_saida_igreja, info_extra_igreja,
  nome_quinta, morada_quinta, instrucoes_quinta, timeline) VALUES
(1, TRUE, TRUE, TRUE, TRUE, TRUE, 75, TRUE,
  '09:00', '10:00', 'Rui Martins', 'Rua das Oliveiras, Braga', 'Família Martins', 'Noivo gosta de fotos espontâneas',
  '10:15', 'Sofia Almeida', 'Rua das Rosas, Braga', 'Família Almeida', 'Noiva quer fotos com amigas',
  'Igreja da Sé', 'Entrada pelo lado esquerdo', 'Noivo, padrinhos, convidados', TRUE, 'Frente', 'Salmo, Leitura',
  TRUE, FALSE, 'Saída organizada pelo altar', 'Padre pede silêncio',
  'Quinta das Flores', 'Braga', 'Zona VIP reservada', '13:00 Chegada, 14:00 Almoço, 16:30 Corte do bolo'),
(2, TRUE, TRUE, FALSE, TRUE, FALSE, 60, FALSE,
  '11:00', '12:00', 'Carlos Silva', 'Rua das Flores, Porto', 'Família Silva', 'Noivo quer fotos com o cão',
  '12:15', 'Ana Costa', 'Rua dos Cravos, Porto', 'Família Costa', 'Noiva quer fotos com avó',
  'Igreja de São Francisco', 'Chegar 10 min antes', 'Noiva, Noivo, Padrinhos', FALSE, '', 'Leitura 1, Leitura 2',
  FALSE, TRUE, 'Aguardar saída dos noivos', 'Cuidado com chuva',
  'Quinta do Vale', 'Rua Quinta 10, Porto', 'Entrada principal', '14:00 Chegada, 15:00 Almoço, 17:00 Corte do bolo'),
  (8, TRUE, TRUE, TRUE, FALSE, TRUE, 80, TRUE,
  '08:30', '09:30', 'João Ribeiro', 'Rua da Amizade, Guimarães', 'Família Ribeiro', 'Fotografar relógio antigo do avô',
  '09:45', 'Maria Lopes', 'Avenida Central, Guimarães', 'Família Lopes', 'Momentos com damas de honor',
  'Igreja de Nossa Senhora da Consolação', 'Entrada simultânea padrinhos/noivo', 'Padrinhos, Noivo, Noiva', TRUE, 'Lado direito', 'Salmo, Leitura',
  TRUE, TRUE, 'Saída com pétalas', 'Atentar à luz solar direta',
  'Solar do Arco', 'Rua do Arco, Guimarães', 'Decoração personalizada', '12:30 Chegada, 14:00 Almoço, 17:00 Bolo'),

(9, TRUE, FALSE, FALSE, TRUE, FALSE, 40, FALSE,
  '10:00', '11:00', 'Pedro Faria', 'Travessa das Camélias, Viana', 'Família Faria', 'Noivo prefere poucas fotos',
  '11:15', 'Inês Monteiro', 'Rua do Mirante, Viana do Castelo', 'Família Monteiro', 'Sessão rápida antes da igreja',
  'Igreja Matriz de Viana', 'Fotógrafo entra primeiro', 'Noivo, padrinhos, noiva', FALSE, '', 'Leitura única',
  FALSE, FALSE, 'Saída tradicional', 'Noiva quer foto com madrinha',
  'Quinta da Lameira', 'Estrada Nacional 13, Viana', 'Zona de jardim priorizada', '13:00 Chegada, 14:30 Almoço'),

(10, TRUE, TRUE, TRUE, TRUE, TRUE, 120, TRUE,
  '07:30', '08:30', 'André Pinto', 'Rua do Cruzeiro, Barcelos', 'Família Pinto', 'Fotos com carro antigo',
  '08:45', 'Carla Matos', 'Rua das Palmeiras, Barcelos', 'Família Matos', 'Retratos com irmãos',
  'Igreja do Senhor da Cruz', 'Entrada em silêncio', 'Noiva, madrinha, noivo', TRUE, 'Varanda', 'Leitura 1, Leitura 2, Evangelho',
  TRUE, TRUE, 'Saída com balões', 'Padre é sensível a barulho',
  'Quinta dos Moinhos', 'Barcelos', 'Cuidado com escadas na entrada', '12:00 Chegada, 13:00 Almoço, 15:30 Bolo'),

(11, TRUE, TRUE, FALSE, TRUE, TRUE, 50, FALSE,
  '10:30', '11:30', 'Miguel Gonçalves', 'Rua das Laranjeiras, Braga', 'Família Gonçalves', 'Quer fotos com irmãos mais novos',
  '11:45', 'Patrícia Rocha', 'Rua da Escola, Braga', 'Família Rocha', 'Quer captar bouquet entregue pela avó',
  'Igreja de São João do Souto', 'Entrada alternada', 'Noivo, mãe, noiva', FALSE, '', 'Salmo responsorial',
  TRUE, FALSE, 'Saída com confettis', 'Padre permite apenas 1 fotógrafo no altar',
  'Quinta Encantada', 'Braga', 'Evitar fios elétricos visíveis', '13:00 Chegada, 14:00 Almoço, 17:00 Corte do bolo'),

(12, FALSE, TRUE, TRUE, TRUE, FALSE, 80, TRUE,
  '09:00', '10:15', 'Tiago Ferreira', 'Rua das Vinhas, Famalicão', 'Família Ferreira', 'Sem sessão com os pais',
  '10:30', 'Beatriz Carvalho', 'Rua da Liberdade, Famalicão', 'Família Carvalho', 'Fotos com animal de estimação',
  'Capela de Santo António', 'Chegar com antecedência', 'Convidados, noivo, noiva', TRUE, 'Galeria superior', 'Leitura breve',
  FALSE, TRUE, 'Aguardar os noivos antes de sair', 'Cuidado com piso escorregadio',
  'Quinta dos Sonhos', 'Famalicão', 'Entrada secundária para staff', '13:30 Chegada, 15:00 Almoço, 18:00 Bolo');



INSERT INTO Servico_Detalhes_Batizado (cod_servico, fotos, video, drone, sde, fotos_convidados, num_convidados_fotos, venda_fotos,
  hora_chegada_casa_bebe, hora_saida_casa_bebe, nome_bebe, morada_bebe, agregado_bebe, info_extra_bebe,
  morada_igreja, instrucoes_igreja, coro, coro_localizacao, grupo_exterior, info_extra_igreja,
  nome_quinta, morada_quinta, instrucoes_quinta, timeline) VALUES
(3, TRUE, FALSE, FALSE, FALSE, TRUE, 30, FALSE,
  '10:00', '11:00', 'João Fernandes', 'Rua da Fonte, Coimbra', 'Família Fernandes', 'Bebé dorme cedo',
  'Igreja do Carmo', 'Padre pede silêncio', FALSE, '', FALSE, '',
  'Quinta das Pedras', 'Coimbra', '', '12:30 Almoço, 14:30 fotos'),
(4, TRUE, TRUE, FALSE, TRUE, TRUE, 40, TRUE,
  '09:30', '10:45', 'Mariana Oliveira', 'Rua dos Lírios, Guimarães', 'Família Oliveira', 'Bebé gosta de música',
  'Capela de São Bento', 'Entrada discreta', TRUE, 'Perto do altar', FALSE, '',
  'Quinta do Lago', 'Guimarães', 'Buffet livre', '12:00 Almoço, 15:30 atividades'),
  (13, TRUE, TRUE, FALSE, FALSE, TRUE, 25, FALSE,
  '08:45', '10:00', 'Leonor Martins', 'Rua da Paz, Braga', 'Família Martins', 'Evitar barulhos de manhã',
  'Igreja de São Vicente', 'Chegar com 15 min de antecedência', TRUE, 'Galeria lateral', FALSE, '',
  'Quinta da Alegria', 'Braga', 'Entrada com carrinho', '12:00 Almoço, 13:30 sessão fotográfica'),

(14, TRUE, FALSE, FALSE, TRUE, FALSE, 100, TRUE,
  '09:00', '10:00', 'Mateus Costa', 'Rua do Sol, Viana do Castelo', 'Família Costa', 'Bebé com sono frequente',
  'Capela do Carmo', 'Respeitar silêncio', FALSE, '', TRUE, 'Grupo de animação infantil à saída',
  'Quinta do Sol', 'Viana do Castelo', '', '13:00 Almoço, 15:00 bolo'),

(15, TRUE, TRUE, TRUE, TRUE, TRUE, 35, TRUE,
  '10:00', '11:15', 'Inês Ribeiro', 'Rua das Camélias, Braga', 'Família Ribeiro', 'Captar momento do banho',
  'Igreja da Misericórdia', 'Fotógrafo autorizado na sacristia', TRUE, 'Corredor central', TRUE, 'Balões à saída',
  'Quinta do Arco', 'Braga', 'Espaço com zona infantil', '12:30 Almoço, 16:00 jogos e lanche'),

(16, TRUE, TRUE, FALSE, FALSE, TRUE, 20, FALSE,
  '09:30', '10:30', 'Santiago Lopes', 'Rua das Rosas, Porto', 'Família Lopes', 'Momentos com os avós',
  'Igreja de Santo António', 'Início com cântico', TRUE, 'Frente ao altar', FALSE, '',
  'Quinta da Relva', 'Porto', 'Decoração azul e branca', '12:00 Almoço, 14:30 brincadeiras'),

(17, TRUE, FALSE, FALSE, TRUE, TRUE, 15, FALSE,
  '08:30', '09:45', 'Beatriz Sousa', 'Rua do Pinhal, Aveiro', 'Família Sousa', 'Levar brinquedo preferido',
  'Capela da Boa Nova', 'Luz natural forte – ajustar ISO', FALSE, '', FALSE, '',
  'Quinta do Prado', 'Aveiro', 'Atenção ao acesso de carrinhos', '11:45 Almoço, 13:15 bolo e fotos');

INSERT INTO Servico_Detalhes_ComunhaoGeral (cod_servico, fotos, video, drone, sde, formato_fotos, valor_foto, formato_video, valor_video,
  hora_chegada_igreja, num_criancas, info_extra_comunhao, coro, coro_localizacao, diplomas, grupo_exterior) VALUES
(5, TRUE, TRUE, FALSE, FALSE, 'Digital', 5.00, 'MP4', 15.00,
  '10:00', 20, 'Preparação a cargo da catequese', TRUE, 'Frente', TRUE, FALSE),
  (18, TRUE, TRUE, FALSE, TRUE, 'Impressas', 5.00, 'MP4', 12.00,
  '09:30', 25, 'Cada criança terá 2 fotos individuais e 1 de grupo', TRUE, 'Varanda', TRUE, TRUE),

(19, TRUE, FALSE, FALSE, FALSE, 'Impressas', 4.00, 'MP4', 10.00,
  '10:15', 18, 'Fotos serão impressas no final', FALSE, '', FALSE, FALSE),

(20, TRUE, TRUE, TRUE, FALSE, 'Digital', 6.50, 'DVD', 20.00,
  '09:45', 30, 'Captar chegada dos pais e catequistas', TRUE, 'Galeria superior', TRUE, TRUE),

(21, TRUE, TRUE, FALSE, TRUE, 'Impressas', 5.00, 'DVD', 15.00,
  '11:00', 22, 'Registrar entrega dos diplomas individualmente', TRUE, 'Frente ao altar', TRUE, FALSE),

(22, TRUE, FALSE, FALSE, FALSE, 'Impressas', 3.50, 'DVD', 10.00,
  '10:00', 12, 'Grupo pequeno, comunhão privada', FALSE, '', FALSE, FALSE);

INSERT INTO Servico_Detalhes_ComunhaoParticular (cod_servico, fotos, video, drone, sde, fotos_convidados, num_convidados_fotos, venda_fotos,
  hora_chegada_casa_crianca, hora_saida_casa_crianca, nome_crianca, morada_crianca, agregado_crianca, info_extra_crianca,
  morada_igreja, instrucoes_igreja, coro, coro_localizacao, grupo_exterior, info_extra_igreja,
  nome_quinta, morada_quinta, instrucoes_quinta, timeline) VALUES
(6, TRUE, TRUE, FALSE, TRUE, TRUE, 35, TRUE,
  '09:00', '10:30', 'Beatriz Oliveira', 'Rua dos Lírios, Guimarães', 'Família Oliveira', 'Gosta de fotos com primos',
  'Capela de Nossa Senhora', 'Chegada discreta', FALSE, '', FALSE, '',
  'Quinta da Serra', 'Guimarães', 'Espaço privado', '12:30 Almoço, 14:00 sessão de fotos'),
  (23, TRUE, TRUE, TRUE, TRUE, TRUE, 40, TRUE,
  '08:30', '09:45', 'Martim Correia', 'Rua do Jardim, Braga', 'Família Correia', 'Quer fotos com os avós paternos',
  'Igreja de São José', 'Padre permite fotos na entrada', TRUE, 'Frente', FALSE, '',
  'Quinta da Fonte', 'Braga', 'Zona de sombra para fotos', '12:00 Almoço, 13:30 Bolo'),

(24, TRUE, FALSE, FALSE, FALSE, TRUE, 15, FALSE,
  '09:00', '10:15', 'Clara Santos', 'Rua da Liberdade, Porto', 'Família Santos', 'Fotografar com o cão de estimação',
  'Capela do Carmo', 'Silêncio absoluto na entrada', FALSE, '', TRUE, 'Grupo de canto à saída',
  'Quinta do Prado', 'Porto', 'Espaço reservado para crianças', '13:00 Almoço, 15:00 Corte do bolo'),

(25, TRUE, TRUE, FALSE, TRUE, TRUE, 28, TRUE,
  '10:00', '11:00', 'Rodrigo Almeida', 'Rua dos Pinheiros, Viana do Castelo', 'Família Almeida', 'Gosta de fotos com guitarra',
  'Igreja Matriz de Viana', 'Aguardar todos antes de entrar', TRUE, 'Lado direito', TRUE, '',
  'Quinta Encantada', 'Viana do Castelo', 'Cuidado com degraus na entrada', '11:45 Almoço, 14:15 jogos'),

(26, TRUE, TRUE, TRUE, TRUE, FALSE, 100, FALSE,
  '07:45', '09:00', 'Mafalda Dias', 'Avenida Central, Braga', 'Família Dias', 'Pais preferem estilo documental',
  'Igreja do Senhor dos Passos', 'Entrada organizada por ordem de chegada', TRUE, 'Corredor lateral', FALSE, '',
  'Quinta do Sol', 'Braga', 'Evitar flash no salão', '12:15 Almoço, 14:00 dança');

INSERT INTO Servico_Detalhes_EvCorporativo (cod_servico, fotos, video, drone, sde, hora_chegada_corp, info_extra_corp) VALUES
(7, TRUE, TRUE, TRUE, FALSE, '08:30', 'Capturar discursos principais, networking e entrega de prémios'),
(27, TRUE, TRUE, FALSE, TRUE, '09:00', 'Fotografar momento de abertura, stands de empresas e interação com público'),

(28, TRUE, FALSE, FALSE, FALSE, '10:00', 'Evento interno com equipa — foco em sessões de brainstorming e partilha'),

(29, TRUE, TRUE, TRUE, TRUE, '08:00', 'Cobertura completa de convenção — registo de oradores e atividades paralelas'),

(30, TRUE, TRUE, FALSE, TRUE, '07:45', 'Documentar chegada de parceiros, assinatura de protocolos e coffee-breaks');


-- Novas Categorias
INSERT INTO Categoria (cod_categoria, categoria) VALUES
('BAT', 'Baterias'),
('LUM', 'Iluminação'),
('SDC', 'Cartões de Memoria'),
('MOC','Mochilas'),
('ACCS', 'Acessórios');

-- Novas Marcas
INSERT INTO Marca (cod_marca, marca) VALUES
(6, 'Fujifilm'),
(7, 'Manfrotto'),
(8, 'Godox'),
(9, 'Sandisk'),
(10, 'RODE'),
(11, 'Neewer'),
(12, 'Lowepro');


-- Novos Modelos
INSERT INTO Modelo (cod_modelo, modelo) VALUES
(6, ' LP-E6NH'),
(7, ' XProIIC '),
(8, '128GB SDXC Extreme PRO UHS-I'),
(9, '64GB Extreme Pro UHS-I SDXC'),
(10, 'Canon RF 70-200mm F2.8L IS USM'),
(11, 'ENEL15c'),
(12, 'EOS 6D'),
(13, 'EOS R6'),
(14, 'FE 28-70mm f/2 GM Lens'),
(15, 'FE 70-200mm f/2.8 GM OSS II'),
(16, 'Fujinon XF 18-135mm f/3.5-5.6 R LM OIS WR'),
(17, 'Intelligent Flight Battery'),
(18, 'MVK500AM'),
(19, 'MVMXPRO500'),
(20, 'Mini 4 Pro Fly More '),
(21, 'NIKKOR Z 28-75mm f/2.8 Lens'),
(22, 'NIKKOR Z 70-180mm f/2.8 Lens'),
(23, 'NL660'),
(24, 'NP-FZ100'),
(25, 'NP-W126S '),
(26, 'RF 24-70mm F2.8L IS USM'),
(27, 'RS 4 MINI Combo'),
(28, 'Speedlite V1'),
(29, 'VB26'),
(30, 'Wirelesso Go III'),
(31, 'XF 16-55mm f/2.8 R LM WR'),
(32, 'XH1'),
(33, 'Z6II'),
(34, 'a7S III'),
(35,'ProTactic BP 450 AW');


-- Materiais do Ficheiro Excel
INSERT INTO Material (
  cod_material, cod_categoria, cod_marca, cod_modelo,
  num_serie, cod_estado, observacoes
) VALUES
    ('MAT006', 'CAM', 1, 13, 'FF5541FM', 1, ''),
    ('MAT007', 'CAM', 1, 13, 'AA1RAQF5', 1, ''),
    ('MAT008', 'CAM', 1, 13, 'V7Y0IA84', 1, ''),
    ('MAT009', 'CAM', 1, 12, 'HPOOPVS0', 1, ''),
    ('MAT010', 'CAM', 5, 33, 'TIHSLLAB34', 1, ''),
    ('MAT011', 'CAM', 5, 33, 'XAOSSFCJ', 1, ''),
    ('MAT012', 'CAM', 6, 32, 'JI1563W5', 1, ''),
    ('MAT013', 'CAM', 6, 32, '5NOKIW61', 1, ''),
    ('MAT014', 'CAM', 2, 34, '2M9P8S4V', 1, ''),
    ('MAT015', 'CAM', 2, 34, '7X3Z1Q9W', 1, ''),
    ('MAT016', 'CAM', 2, 34, 'B5N1D8K6', 1, ''),
    ('MAT017', 'CAM', 2, 34, 'G0F7J4H2', 1, ''),
    ('MAT018', 'CAM', 2, 34, 'L3K9M0N1', 1, ''),
    ('MAT019', 'CAM', 2, 34, 'P6R2T8Y4', 1, ''),
    ('MAT020', 'LEN', 1, 26, 'V9C5X1Z7', 1, ''),
    ('MAT021', 'LEN', 1, 26, 'D2A8E3F0', 1, ''),
    ('MAT022', 'LEN', 1, 26, 'H4I1J6L9', 1, ''),
    ('MAT023', 'LEN', 1, 26, 'O7P3Q5R8', 1, ''),
    ('MAT024', 'LEN', 1, 10, 'S0U6V2W4', 1, ''),
    ('MAT025', 'LEN', 1, 10, 'Y1Z7A9B5', 1, ''),
    ('MAT026', 'LEN', 1, 10, 'E6F2G8H0', 1, ''),
    ('MAT027', 'LEN', 1, 10, 'I3J9K5L1', 1, ''),
    ('MAT028', 'LEN', 5, 21, 'M0N6P2Q8', 1, ''),
    ('MAT029', 'LEN', 5, 22, 'R5S1T7U3', 1, ''),
    ('MAT030', 'LEN', 2, 14, 'W8X4Y0Z6', 1, ''),
    ('MAT031', 'LEN', 2, 14, 'GLMBVL5N', 1, ''),
    ('MAT032', 'LEN', 2, 14, 'J2K8L4M0', 1, ''),
    ('MAT033', 'LEN', 2, 14, 'N1O7P3Q9', 1, ''),
    ('MAT034', 'LEN', 2, 14, 'S4T0U6V2', 1, ''),
    ('MAT035', 'LEN', 2, 14, 'X9Y5Z1A7', 1, ''),
    ('MAT036', 'LEN', 2, 15, '7OOD1M2S', 1, ''),
    ('MAT037', 'LEN', 2, 15, 'S2UW4HWC', 1, ''),
    ('MAT038', 'LEN', 2, 15, 'FFFSCVB4', 1, ''),
    ('MAT039', 'LEN', 2, 15, '5656RAQF5', 1, ''),
    ('MAT040', 'LEN', 2, 15, 'V4152A84', 1, ''),
    ('MAT041', 'LEN', 2, 15, 'HNICEVS0', 1, ''),
    ('MAT042', 'LEN', 6, 31, '2DSLB14N', 1, ''),
    ('MAT043', 'LEN', 6, 16, 'XADDFSCJ', 1, ''),
    ('MAT044', 'BAT', 1, 6, 'FDSSSXCJ', 1, ''),
    ('MAT045', 'BAT', 1, 6, 'NUKKW61', 1, ''),
    ('MAT046', 'BAT', 1, 6, 'Q1A2B3C4', 1, ''),
    ('MAT047', 'BAT', 1, 6, 'R2D3E4F5', 1, ''),
    ('MAT048', 'BAT', 1, 6, 'S3F4G5H6', 1, ''),
    ('MAT049', 'BAT', 1, 6, 'T4H5I6J7', 1, ''),
    ('MAT050', 'BAT', 1, 6, 'U5J6K7L8', 1, ''),
    ('MAT051', 'BAT', 1, 6, 'V6L7M8N9', 1, ''),
    ('MAT052', 'BAT', 1, 6, 'W7N8O9P0', 1, ''),
    ('MAT053', 'BAT', 1, 6, 'X8P9Q0R1', 1, ''),
    ('MAT054', 'BAT', 1, 6, 'Y9R0S1T2', 1, ''),
    ('MAT055', 'BAT', 1, 6, 'Z0T1U2V3', 1, ''),
    ('MAT056', 'BAT', 1, 6, 'A1V2W3X4', 1, ''),
    ('MAT057', 'BAT', 1, 6, 'B2X3Y4Z5', 1, ''),
    ('MAT058', 'BAT', 1, 6, 'C3Z4A5B6', 1, ''),
    ('MAT059', 'BAT', 1, 6, 'D4B5C6D7', 1, ''),
    ('MAT060', 'BAT', 5, 11, 'E5D6E7F8', 1, ''),
    ('MAT061', 'BAT', 5, 11, 'F6F7G8H9', 1, ''),
    ('MAT062', 'BAT', 5, 11, 'G7H8I9J0', 1, ''),
    ('MAT063', 'BAT', 5, 11, 'H8J9K0L1', 1, ''),
    ('MAT064', 'BAT', 5, 11, 'I9L0M1N2', 1, ''),
    ('MAT065', 'BAT', 5, 11, 'J0N1O2P3', 1, ''),
    ('MAT066', 'BAT', 5, 11, 'K1P2Q3R4', 1, ''),
    ('MAT067', 'BAT', 5, 11, 'L2R3S4T5', 1, ''),
    ('MAT068', 'BAT', 6, 25, 'M3T4U5V6', 1, ''),
    ('MAT069', 'BAT', 6, 25, 'N4V5W6X7', 1, ''),
    ('MAT070', 'BAT', 6, 25, 'FC4IB5FM', 1, ''),
    ('MAT071', 'BAT', 6, 25, '5656FFQF5', 1, ''),
    ('MAT072', 'BAT', 6, 25, 'V1147A84', 1, ''),
    ('MAT073', 'BAT', 6, 25, 'HFVARVS0', 1, ''),
    ('MAT074', 'BAT', 6, 25, 'SLB1904NN', 1, ''),
    ('MAT075', 'BAT', 6, 25, 'XAO2YQCJ', 1, ''),
    ('MAT076', 'BAT', 2, 24, 'JI156W5', 1, ''),
    ('MAT077', 'BAT', 2, 24, '5GIKEW61', 1, ''),
    ('MAT078', 'BAT', 2, 24, 'M4N5O6P7', 1, ''),
    ('MAT079', 'BAT', 2, 24, 'N5O6P7Q8', 1, ''),
    ('MAT080', 'BAT', 2, 24, 'O6P7Q8R9', 1, ''),
    ('MAT081', 'BAT', 2, 24, 'P7Q8R9S0', 1, ''),
    ('MAT082', 'BAT', 2, 24, 'Q8R9S0T1', 1, ''),
    ('MAT083', 'BAT', 2, 24, 'R9S0T1U2', 1, ''),
    ('MAT084', 'BAT', 2, 24, 'S0T1U2V3', 1, ''),
    ('MAT085', 'BAT', 2, 24, 'T1U2V3W4', 1, ''),
    ('MAT086', 'BAT', 2, 24, 'U2V3W4X5', 1, ''),
    ('MAT087', 'BAT', 2, 24, 'V3W4X5Y6', 1, ''),
    ('MAT088', 'BAT', 2, 24, 'W4X5Y6Z7', 1, ''),
    ('MAT089', 'BAT', 2, 24, 'X5Y6Z7A8', 1, ''),
    ('MAT090', 'BAT', 2, 24, 'Y6Z7A8B9', 1, ''),
    ('MAT091', 'BAT', 2, 24, 'Z7A8B9C0', 1, ''),
    ('MAT092', 'BAT', 2, 24, 'A8B9C0D1', 1, ''),
    ('MAT093', 'BAT', 2, 24, 'B9C0D1E2', 1, ''),
    ('MAT094', 'BAT', 2, 24, 'C0D1E2F3', 1, ''),
    ('MAT095', 'BAT', 2, 24, 'D1E2F3G4', 1, ''),
    ('MAT096', 'BAT', 2, 24, 'E2F3G4H5', 1, ''),
    ('MAT097', 'BAT', 2, 24, 'F3G4H5I6', 1, ''),
    ('MAT098', 'BAT', 2, 24, 'G4H5I6J7', 1, ''),
    ('MAT099', 'BAT', 2, 24, 'H5I6J7K8', 1, ''),
    ('MAT100', 'TRP', 7, 18, 'B0C6D2E8', 1, ''),
    ('MAT101', 'TRP', 7, 18, 'F3G9H5I1', 1, ''),
    ('MAT102', 'TRP', 7, 18, 'FFSD5FM', 1, ''),
    ('MAT103', 'TRP', 7, 18, '565154QF5', 1, ''),
    ('MAT104', 'TRP', 7, 18, 'V1147158', 1, ''),
    ('MAT105', 'TRP', 7, 18, 'HFFEFVS0', 1, ''),
    ('MAT106', 'TRP', 7, 19, '33VAGM97', 1, ''),
    ('MAT107', 'TRP', 7, 19, '6MS2RG5U', 1, ''),
    ('MAT108', 'TRP', 7, 19, 'PNQY09K0', 1, ''),
    ('MAT109', 'TRP', 7, 19, '96OWYEN2', 1, ''),
    ('MAT110', 'TRP', 7, 19, '511ZRR6R', 1, ''),
    ('MAT111', 'TRP', 7, 19, 'JYTQVQND', 1, ''),
    ('MAT112', 'TRP', 3, 27, '5UZGII08', 1, ''),
    ('MAT113', 'TRP', 3, 27, '5JMJKRCS', 1, ''),
    ('MAT114', 'TRP', 3, 27, 'VRNDN1WA', 1, ''),
    ('MAT115', 'TRP', 3, 27, 'MNKAW6IT', 1, ''),
    ('MAT116', 'TRP', 3, 27, '0G5ADHN6', 1, ''),
    ('MAT117', 'TRP', 3, 27, 'DX0NOMVV', 1, ''),
    ('MAT118', 'TRP', 3, 27, 'DMH2P4DU', 1, ''),
    ('MAT119', 'LUM', 1, 28, '2B2FA1ZY', 1, ''),
    ('MAT120', 'LUM', 1, 28, 'Z5R6T00O', 1, ''),
    ('MAT121', 'LUM', 1, 28, 'WPNBJ6FG', 1, ''),
    ('MAT122', 'LUM', 1, 28, '2I2HSRQ5', 1, ''),
    ('MAT123', 'LUM', 1, 28, 'QQKWYI0Z', 1, ''),
    ('MAT124', 'LUM', 1, 28, 'D77XNZ00', 1, ''),
    ('MAT125', 'LUM', 8, 7, 'KUL40GWI', 1, ''),
    ('MAT126', 'LUM', 8, 7, 'OFJBSYET', 1, ''),
    ('MAT127', 'LUM', 8, 7, 'J6OUOKF6', 1, ''),
    ('MAT128', 'LUM', 8, 7, 'VO96EUJ4', 1, ''),
    ('MAT129', 'LUM', 8, 7, 'I8J4KRFF', 1, ''),
    ('MAT130', 'LUM', 8, 7, '8G5KH1MI', 1, ''),
    ('MAT131', 'SDC', 9, 8, 'J4LYFY61', 1, ''),
    ('MAT132', 'SDC', 9, 8, 'E2I7EIGO', 1, ''),
    ('MAT133', 'SDC', 9, 8, 'ZAFGN3ZK', 1, ''),
    ('MAT134', 'SDC', 9, 8, 'L8CPVO96', 1, ''),
    ('MAT135', 'SDC', 9, 8, '759154K2', 1, ''),
    ('MAT136', 'SDC', 9, 8, 'JN542RE8', 1, ''),
    ('MAT137', 'SDC', 9, 8, '5CNN0EDQ', 1, ''),
    ('MAT138', 'SDC', 9, 8, 'FRRQNY52', 1, ''),
    ('MAT139', 'SDC', 9, 8, 'K216NVKM', 1, ''),
    ('MAT140', 'SDC', 9, 8, 'NJQS6MBD', 1, ''),
    ('MAT141', 'SDC', 9, 8, 'Z1L68DK0', 1, ''),
    ('MAT142', 'SDC', 9, 8, '9HIUZNQO', 1, ''),
    ('MAT143', 'SDC', 9, 9, 'T5GJ8512', 1, ''),
    ('MAT144', 'SDC', 9, 9, 'Y55O8S2O', 1, ''),
    ('MAT145', 'SDC', 9, 9, '5NIV1FXB', 1, ''),
    ('MAT146', 'SDC', 9, 9, '4F6O3G5F', 1, ''),
    ('MAT147', 'SDC', 9, 9, 'ZFRG5D7G', 1, ''),
    ('MAT148', 'SDC', 9, 9, 'L50LIQFH', 1, ''),
    ('MAT149', 'SDC', 9, 9, 'TWVZTAE4', 1, ''),
    ('MAT150', 'SDC', 9, 9, '87R3P2S6', 1, ''),
    ('MAT151', 'SDC', 9, 9, 'H78BAWTU', 1, ''),
    ('MAT152', 'SDC', 9, 9, '6U3E07WT', 1, ''),
    ('MAT153', 'SDC', 9, 9, 'P6G0R34E', 1, ''),
    ('MAT154', 'SDC', 9, 9, '8ZXAYOKT', 1, ''),
    ('MAT155', 'SDC', 9, 9, '32ADF9P0', 1, ''),
    ('MAT156', 'SDC', 9, 9, 'FS2ZM9JB', 1, ''),
    ('MAT157', 'SDC', 9, 9, '0ZF2922E', 1, ''),
    ('MAT158', 'SDC', 9, 9, 'R7QE83UL', 1, ''),
    ('MAT159', 'SDC', 9, 9, 'PR8Z3F50', 1, ''),
    ('MAT160', 'SDC', 9, 9, 'KQHQZMWV', 1, ''),
    ('MAT161', 'SDC', 9, 9, 'I8J4K0L6', 1, ''),
    ('MAT162', 'MIC', 10, 30, '5N0A5P13', 1, ''),
    ('MAT163', 'MIC', 10, 30, 'RC45JT8I', 1, ''),
    ('MAT164', 'MIC', 10, 30, 'LUJUYBNS', 1, ''),
    ('MAT165', 'MIC', 10, 30, '2T96TD0M', 1, ''),
    ('MAT166', 'MIC', 10, 30, 'ARHDALUE', 1, ''),
    ('MAT167', 'MIC', 10, 30, '755555K2', 1, ''),
    ('MAT168', 'DRN', 3, 20, 'LRMLQ9LQ', 1, ''),
    ('MAT169', 'DRN', 3, 20, 'LXTHYPB0', 1, ''),
    ('MAT170', 'DRN', 3, 20, 'VJ0DZKWQ', 1, ''),
    ('MAT171', 'DRN', 3, 20, 'DR43SWND', 1, ''),
    ('MAT172', 'BAT', 3, 17, 'NH4T3ATJ', 1, ''),
    ('MAT173', 'BAT', 3, 17, 'OF58ZEJF', 1, ''),
    ('MAT174', 'BAT', 3, 17, '2SPSZ9T4', 1, ''),
    ('MAT175', 'BAT', 3, 17, 'TTG9EM4D', 1, ''),
    ('MAT176', 'BAT', 3, 17, 'IYZP7TWM', 1, ''),
    ('MAT177', 'BAT', 3, 17, 'SDNFOCIE', 1, ''),
    ('MAT178', 'BAT', 3, 17, '0SUDIOZ2', 1, ''),
    ('MAT179', 'BAT', 3, 17, 'HA2RW26U', 1, ''),
    ('MAT180', 'BAT', 3, 17, 'NSLT2D1B', 1, ''),
    ('MAT181', 'BAT', 3, 17, 'AWGWPE6P', 1, ''),
    ('MAT182', 'BAT', 3, 17, '8HS3A8IX', 1, ''),
    ('MAT183', 'BAT', 3, 17, 'ZMOZCRA9', 1, ''),
    ('MAT184', 'BAT', 3, 17, '1LI2FZMO', 1, ''),
    ('MAT185', 'BAT', 3, 17, 'II4DS1UJ', 1, ''),
    ('MAT186', 'BAT', 3, 17, '9G1YHDAS', 1, ''),
    ('MAT187', 'BAT', 3, 17, 'K4L0M6N2', 1, ''),
    ('MAT188', 'LUM', 11, 23, 'O9P5Q1R7', 1, ''),
    ('MAT189', 'LUM', 11, 23, 'S2T8U4V0', 1, ''),
    ('MAT190', 'LUM', 11, 23, 'W7X3Y9Z5', 1, ''),
    ('MAT191', 'LUM', 11, 23, 'A0B6C2D8', 1, ''),
    ('MAT192', 'LUM', 11, 23, 'E5F1G7H3', 1, ''),
    ('MAT193', 'LUM', 11, 23, 'I8J4KREE', 1, ''),
    ('MAT194', 'BAT', 8, 29, 'M1N7O3P9', 1, ''),
    ('MAT195', 'BAT', 8, 29, 'Q4R0S6T2', 1, ''),
    ('MAT196', 'BAT', 8, 29, 'U9V5W1X7', 1, ''),
    ('MAT197', 'BAT', 8, 29, 'Y2Z8A4B0', 1, ''),
    ('MAT198', 'BAT', 8, 29, 'C7D3E9F5', 1, ''),
    ('MAT199', 'BAT', 8, 29, '759Y38K2', 1, ''),
    ('MAT200', 'BAT', 8, 29, 'G0H6I2J8', 1, ''),
    ('MAT201', 'BAT', 8, 29, 'K5L1M7N3', 1, ''),
    ('MAT202', 'BAT', 8, 29, 'O8P4Q0R6', 1, ''),
    ('MAT203', 'BAT', 8, 29, 'S1T7U3V9', 1, ''),
    ('MAT204', 'BAT', 8, 29, 'W4X0Y6Z2', 1, ''),
    ('MAT205', 'BAT', 8, 29, 'A9B5C1D7', 1, ''),
    ('MAT206','MOC', 12, 35, 'J7K3L9M5', 1, ''),
    ('MAT207','MOC', 12, 35, 'D4E0F6G2', 1, ''),
    ('MAT208','MOC', 12, 35, 'H9I5J1K7', 1, ''),
    ('MAT209','MOC', 12, 35, 'N4O0P6Q2', 1, ''),
    ('MAT210','MOC', 12, 35, 'R9S5T1U7', 1, ''),
    ('MAT211','MOC', 12, 35, 'V0W6X2Y8', 1, ''),
    ('MAT212','MOC', 12, 35, 'Z1A7B3C9', 1, ''),
    ('MAT213','MOC', 12, 35, 'DN239GDX', 1, ''),
    ('MAT214','MOC', 12, 35, '8LZC81NT', 1, ''),
    ('MAT215','MOC', 12, 35, 'T0U6V2W4', 1, ''),
    ('MAT216','MOC', 12, 35, 'X5Y1Z7A3', 1, ''),
    ('MAT217','MOC', 12, 35, 'B6C2D8E0', 1, ''),
    ('MAT218','MOC', 12, 35, 'G1H7I3J9', 1, '');





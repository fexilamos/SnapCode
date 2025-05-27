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
  modelo VARCHAR(25)
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

CREATE TABLE Servico_Equipamento (
  cod_servico INT,
  cod_material VARCHAR(25),
  PRIMARY KEY (cod_servico, cod_material),
  data_levantamento DATE NOT NULL,
  data_devolucao DATE NOT NULL,
  FOREIGN KEY (cod_servico) REFERENCES Servicos(cod_servico) ON DELETE CASCADE,
  FOREIGN KEY (cod_material) REFERENCES Material(cod_material) ON DELETE CASCADE
);


INSERT INTO Nivel (cod_nivel, nivel) VALUES
(1, 'Administrador'),
(2, 'Funcionário Interno'),
(3, 'Funcionário Externo');


INSERT INTO Modelo (cod_modelo, modelo) VALUES
(1, 'EOS 5D Mark IV'),
(2, 'Alpha A7 III'),
(3, 'Phantom 4 Pro'),
(4, 'Hero 9'),
(5, 'D850');

INSERT INTO Material_Estado (estado_nome) VALUES
('Operacional'),
('Em manutenção'),
('Avariado'),
('Perdido');

INSERT INTO Marca (cod_marca, marca) VALUES
(1, 'Canon'),
(2, 'Sony'),
(3, 'DJI'),
(4, 'GoPro'),
(5, 'Nikon');

INSERT INTO Categoria (cod_categoria, categoria) VALUES
('CAM', 'Câmara'),
('LEN', 'Lente'),
('DRN', 'Drone'),
('TRP', 'Tripé'),
('MIC', 'Microfone');

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
(1, 'Fotógrafo'),
(2, 'Videógrafo'),
(3, 'Piloto de Drone'),
(4, 'Editor'),
(5, 'Assistente Técnico');

INSERT INTO Funcionario_Estado (estado_nome) VALUES
('Ativo'),
('Ocupado');

INSERT INTO Funcionarios (
  cod_nivel, nome, telefone, mail, morada,
  cod_funcao, cod_estado, pilota_drone, tem_equipamento_proprio
) VALUES
(1, 'Ana Silva', '912345678', 'ana@exemplo.com', 'Rua A, Lisboa', 1, 1, FALSE, TRUE),
(2, 'Bruno Costa', '913456789', 'bruno@exemplo.com', 'Rua B, Porto', 2, 1, FALSE, FALSE),
(2, 'Carlos Mendes', '914567890', 'carlos@exemplo.com', 'Rua C, Faro', 3, 1, TRUE, TRUE),
(3, 'Daniela Rocha', '915678901', 'daniela@exemplo.com', 'Rua D, Coimbra', 4, 2, FALSE, TRUE);

INSERT INTO TiposServico (nome_tipo) VALUES
('Casamento'),
('Batizado'),
('Evento Corporativo'),
('Comunhão Particular'),
('Comunhão Geral');

INSERT INTO Localizacoes (nome_local) VALUES
('Lisboa'),
('Porto'),
('Coimbra'),
('Braga'),
('Guimarães');

INSERT INTO Clientes (nome, telefone, mail) VALUES
('João e Maria', '931234567', 'joaomaria@email.com'),
('Pedro Lopes', '932345678', 'pedro@email.com'),
('Empresário XYZ', '933456789', 'empresa@xyz.com');

INSERT INTO Servicos (
  cod_cliente, cod_tipo_servico, cod_local_servico,
  data_inicio, data_fim, nome_servico
) VALUES
(1, 1, 1, '2025-06-01', '2025-06-02', 'Casamento João e Maria'),
(2, 2, 2, '2025-07-15', '2025-07-15', 'Batizado do Pedro Filho'),
(3, 3, 3, '2025-08-10', '2025-08-11', 'Evento Empresa XYZ');

INSERT INTO Servico_Detalhes_Casamento (
  cod_servico, fotos, video, drone, sde, fotos_convidados, num_convidados_fotos, venda_fotos,
  hora_chegada_casa_noivo, hora_saida_casa_noivo, nome_noivo, morada_noivo, agregado_noivo, info_extra_noivo,
  hora_chegada_casa_noiva, nome_noiva, morada_noiva, agregado_noiva, info_extra_noiva,
  morada_igreja, instrucoes_igreja, ordem_entrada, coro, coro_localizacao, ordem_leituras,
  oferta_ramo, grupo_exterior, instrucoes_saida_igreja, info_extra_igreja,
  nome_quinta, morada_quinta, instrucoes_quinta, timeline
) VALUES (
  1, TRUE, TRUE, TRUE, TRUE, TRUE, 50, TRUE,
  '10:00', '11:30', 'João Silva', 'Rua das Flores 1, Lisboa', 'Família Silva', '',
  '11:45', 'Maria Costa', 'Rua dos Cravos 2, Lisboa', 'Família Costa', '',
  'Igreja de Santa Maria', 'Chegar 15 min antes', 'Noiva, Noivo, Padrinhos', TRUE, 'Frente', 'Leitura 1, Leitura 2',
  TRUE, FALSE, 'Aguardar saída dos noivos', '',
  'Quinta das Laranjeiras', 'Rua Quinta 5, Lisboa', 'Entrada lateral', '14:00 Chegada, 15:00 Almoço, 17:00 Corte do bolo'
);

INSERT INTO Servico_Detalhes_Batizado (
  cod_servico, fotos, video, drone, sde, fotos_convidados, num_convidados_fotos, venda_fotos,
  hora_chegada_casa_bebe, hora_saida_casa_bebe, nome_bebe, morada_bebe, agregado_bebe, info_extra_bebe,
  morada_igreja, instrucoes_igreja, coro, coro_localizacao, grupo_exterior, info_extra_igreja,
  nome_quinta, morada_quinta, instrucoes_quinta, timeline
) VALUES (
  2, TRUE, TRUE, FALSE, FALSE, TRUE, 20, FALSE,
  '09:00', '10:30', 'Pedro Filho', 'Rua das Amendoeiras 45, Porto', 'Família Lopes', '',
  'Igreja de São Pedro', 'Padre pede silêncio', FALSE, '', FALSE, '',
  'Quinta do Sol', 'Rua da Alegria 88, Porto', '', '13:00 Almoço, 14:30 fotos'
);

INSERT INTO Servico_Detalhes_EvCorporativo (
  cod_servico, fotos, video, drone, sde,
  hora_chegada_corp, info_extra_corp
) VALUES (
  3, TRUE, TRUE, TRUE, FALSE,
  '08:00', 'Cobrir chegada dos convidados e apresentações'
);

INSERT INTO Servico_Funcionario (
  cod_servico, cod_funcionario, data_alocacao_inicio, data_alocacao_fim, funcao_no_servico
) VALUES
(1, 1, '2025-06-01', '2025-06-02', 'Fotógrafa principal'),
(1, 2, '2025-06-01', '2025-06-02', 'Vídeo secundário'),
(2, 3, '2025-07-15', '2025-07-15', 'Drone'),
(3, 4, '2025-08-10', '2025-08-11', 'Editora de vídeo');

INSERT INTO Servico_Equipamento (
  cod_servico, cod_material, data_levantamento, data_devolucao
) VALUES
(1, 'MAT001', '2025-06-01', '2025-06-02'),
(1, 'MAT002', '2025-06-01', '2025-06-02'),
(2, 'MAT003', '2025-07-15', '2025-07-15'),
(3, 'MAT005', '2025-08-10', '2025-08-11');

INSERT INTO Avarias (
  cod_material, cod_servico, data_registo, observacoes
) VALUES
('MAT004', 1, '2025-06-02', 'Problema na lente — imagem desfocada');

INSERT INTO Perdas (
  cod_material, cod_servico, data_registo, observacoes
) VALUES
('MAT003', 2, '2025-07-15', 'Drone perdido durante filmagem exterior');

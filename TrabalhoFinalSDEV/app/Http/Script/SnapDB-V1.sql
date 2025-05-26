/*CREATE DATABASE db_Snap;*/

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

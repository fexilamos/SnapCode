-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Maio-2025 às 11:48
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_snap`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avarias`
--

CREATE TABLE `avarias` (
  `cod_avaria` int(11) NOT NULL,
  `cod_material` varchar(25) NOT NULL,
  `cod_servico` int(11) DEFAULT NULL,
  `data_registo` date NOT NULL,
  `observacoes` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `avarias`
--

INSERT INTO `avarias` (`cod_avaria`, `cod_material`, `cod_servico`, `data_registo`, `observacoes`) VALUES
(1, 'MAT004', 1, '2025-06-02', 'Problema na lente — imagem desfocada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_admintest@snap.com|127.0.0.1', 'i:2;', 1748252505),
('laravel_cache_admintest@snap.com|127.0.0.1:timer', 'i:1748252505;', 1748252505);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `cod_categoria` varchar(50) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`cod_categoria`, `categoria`) VALUES
('CAM', 'Câmara'),
('DRN', 'Drone'),
('LEN', 'Lente'),
('MIC', 'Microfone'),
('TRP', 'Tripé');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `cod_cliente` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`cod_cliente`, `nome`, `telefone`, `mail`) VALUES
(1, 'João e Maria', '931234567', 'joaomaria@email.com'),
(2, 'Pedro Lopes', '932345678', 'pedro@email.com'),
(3, 'Empresário XYZ', '933456789', 'empresa@xyz.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcao`
--

CREATE TABLE `funcao` (
  `cod_funcao` int(11) NOT NULL,
  `funcao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `funcao`
--

INSERT INTO `funcao` (`cod_funcao`, `funcao`) VALUES
(1, 'Fotógrafo'),
(2, 'Videógrafo'),
(3, 'Piloto de Drone'),
(4, 'Editor'),
(5, 'Assistente Técnico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `cod_funcionario` int(11) NOT NULL,
  `cod_nivel` int(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `morada` varchar(255) DEFAULT NULL,
  `cod_funcao` int(11) NOT NULL,
  `cod_estado` int(11) NOT NULL,
  `pilota_drone` tinyint(1) DEFAULT 0,
  `tem_equipamento_proprio` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`cod_funcionario`, `cod_nivel`, `nome`, `telefone`, `mail`, `morada`, `cod_funcao`, `cod_estado`, `pilota_drone`, `tem_equipamento_proprio`) VALUES
(1, 1, 'Ana Silva', '912345678', 'ana@exemplo.com', 'Rua A, Lisboa', 1, 1, 0, 1),
(2, 2, 'Bruno Costa', '913456789', 'bruno@exemplo.com', 'Rua B, Porto', 2, 1, 0, 0),
(3, 2, 'Carlos Mendes', '914567890', 'carlos@exemplo.com', 'Rua C, Faro', 3, 1, 1, 1),
(4, 3, 'Daniela Rocha', '915678901', 'daniela@exemplo.com', 'Rua D, Coimbra', 4, 2, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_estado`
--

CREATE TABLE `funcionario_estado` (
  `cod_estado` int(11) NOT NULL,
  `estado_nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `funcionario_estado`
--

INSERT INTO `funcionario_estado` (`cod_estado`, `estado_nome`) VALUES
(1, 'Ativo'),
(2, 'Ocupado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `localizacoes`
--

CREATE TABLE `localizacoes` (
  `cod_local_servico` int(11) NOT NULL,
  `nome_local` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `localizacoes`
--

INSERT INTO `localizacoes` (`cod_local_servico`, `nome_local`) VALUES
(4, 'Braga'),
(3, 'Coimbra'),
(5, 'Guimarães'),
(1, 'Lisboa'),
(2, 'Porto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `cod_marca` int(11) NOT NULL,
  `marca` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`cod_marca`, `marca`) VALUES
(1, 'Canon'),
(2, 'Sony'),
(3, 'DJI'),
(4, 'GoPro'),
(5, 'Nikon');

-- --------------------------------------------------------

--
-- Estrutura da tabela `material`
--

CREATE TABLE `material` (
  `cod_material` varchar(25) NOT NULL,
  `cod_categoria` varchar(50) NOT NULL,
  `cod_marca` int(11) NOT NULL,
  `cod_modelo` int(11) NOT NULL,
  `num_serie` varchar(25) NOT NULL,
  `cod_estado` int(11) NOT NULL,
  `observacoes` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `material`
--

INSERT INTO `material` (`cod_material`, `cod_categoria`, `cod_marca`, `cod_modelo`, `num_serie`, `cod_estado`, `observacoes`) VALUES
('MAT001', 'CAM', 1, 1, 'CN12345', 1, 'Usada para eventos'),
('MAT002', 'CAM', 2, 2, 'SN67890', 1, 'Câmara principal de vídeo'),
('MAT003', 'DRN', 3, 3, 'DJI0001', 1, 'Drone com 4 baterias'),
('MAT004', 'CAM', 4, 4, 'GP11223', 2, 'A necessitar de revisão'),
('MAT005', 'CAM', 5, 5, 'NK99887', 1, 'Usada para backup');

-- --------------------------------------------------------

--
-- Estrutura da tabela `material_estado`
--

CREATE TABLE `material_estado` (
  `cod_estado` int(11) NOT NULL,
  `estado_nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `material_estado`
--

INSERT INTO `material_estado` (`cod_estado`, `estado_nome`) VALUES
(3, 'Avariado'),
(2, 'Em manutenção'),
(1, 'Operacional'),
(4, 'Perdido');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_11_185816_add_cod_funcionario_to_users_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo`
--

CREATE TABLE `modelo` (
  `cod_modelo` int(11) NOT NULL,
  `modelo` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `modelo`
--

INSERT INTO `modelo` (`cod_modelo`, `modelo`) VALUES
(1, 'EOS 5D Mark IV'),
(2, 'Alpha A7 III'),
(3, 'Phantom 4 Pro'),
(4, 'Hero 9'),
(5, 'D850');

-- --------------------------------------------------------

--
-- Estrutura da tabela `nivel`
--

CREATE TABLE `nivel` (
  `cod_nivel` int(11) NOT NULL,
  `nivel` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `nivel`
--

INSERT INTO `nivel` (`cod_nivel`, `nivel`) VALUES
(1, 'Administrador'),
(2, 'Funcionário Interno'),
(3, 'Funcionário Externo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perdas`
--

CREATE TABLE `perdas` (
  `cod_perda` int(11) NOT NULL,
  `cod_material` varchar(25) NOT NULL,
  `cod_servico` int(11) DEFAULT NULL,
  `data_registo` date NOT NULL,
  `observacoes` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `perdas`
--

INSERT INTO `perdas` (`cod_perda`, `cod_material`, `cod_servico`, `data_registo`, `observacoes`) VALUES
(1, 'MAT003', 2, '2025-07-15', 'Drone perdido durante filmagem exterior');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `cod_servico` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_tipo_servico` int(11) NOT NULL,
  `cod_local_servico` int(11) DEFAULT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `nome_servico` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`cod_servico`, `cod_cliente`, `cod_tipo_servico`, `cod_local_servico`, `data_inicio`, `data_fim`, `nome_servico`) VALUES
(1, 1, 1, 1, '2025-06-01', '2025-06-02', 'Casamento João e Maria'),
(2, 2, 2, 2, '2025-07-15', '2025-07-15', 'Batizado do Pedro Filho'),
(3, 3, 3, 3, '2025-08-10', '2025-08-11', 'Evento Empresa XYZ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico_detalhes_batizado`
--

CREATE TABLE `servico_detalhes_batizado` (
  `cod_servico` int(11) NOT NULL,
  `fotos` tinyint(1) DEFAULT NULL,
  `video` tinyint(1) DEFAULT NULL,
  `drone` tinyint(1) DEFAULT NULL,
  `sde` tinyint(1) DEFAULT NULL,
  `fotos_convidados` tinyint(1) DEFAULT NULL,
  `num_convidados_fotos` int(11) DEFAULT NULL,
  `venda_fotos` tinyint(1) DEFAULT NULL,
  `hora_chegada_casa_bebe` varchar(10) DEFAULT NULL,
  `hora_saida_casa_bebe` varchar(10) DEFAULT NULL,
  `nome_bebe` varchar(40) DEFAULT NULL,
  `morada_bebe` varchar(100) DEFAULT NULL,
  `agregado_bebe` varchar(50) DEFAULT NULL,
  `info_extra_bebe` varchar(500) DEFAULT NULL,
  `morada_igreja` varchar(100) DEFAULT NULL,
  `instrucoes_igreja` varchar(200) DEFAULT NULL,
  `coro` tinyint(1) DEFAULT NULL,
  `coro_localizacao` varchar(50) DEFAULT NULL,
  `grupo_exterior` tinyint(1) DEFAULT NULL,
  `info_extra_igreja` varchar(500) DEFAULT NULL,
  `nome_quinta` varchar(40) DEFAULT NULL,
  `morada_quinta` varchar(100) DEFAULT NULL,
  `instrucoes_quinta` varchar(200) DEFAULT NULL,
  `timeline` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servico_detalhes_batizado`
--

INSERT INTO `servico_detalhes_batizado` (`cod_servico`, `fotos`, `video`, `drone`, `sde`, `fotos_convidados`, `num_convidados_fotos`, `venda_fotos`, `hora_chegada_casa_bebe`, `hora_saida_casa_bebe`, `nome_bebe`, `morada_bebe`, `agregado_bebe`, `info_extra_bebe`, `morada_igreja`, `instrucoes_igreja`, `coro`, `coro_localizacao`, `grupo_exterior`, `info_extra_igreja`, `nome_quinta`, `morada_quinta`, `instrucoes_quinta`, `timeline`) VALUES
(2, 1, 1, 0, 0, 1, 20, 0, '09:00', '10:30', 'Pedro Filho', 'Rua das Amendoeiras 45, Porto', 'Família Lopes', '', 'Igreja de São Pedro', 'Padre pede silêncio', 0, '', 0, '', 'Quinta do Sol', 'Rua da Alegria 88, Porto', '', '13:00 Almoço, 14:30 fotos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico_detalhes_casamento`
--

CREATE TABLE `servico_detalhes_casamento` (
  `cod_servico` int(11) NOT NULL,
  `fotos` tinyint(1) DEFAULT NULL,
  `video` tinyint(1) DEFAULT NULL,
  `drone` tinyint(1) DEFAULT NULL,
  `sde` tinyint(1) DEFAULT NULL,
  `fotos_convidados` tinyint(1) DEFAULT NULL,
  `num_convidados_fotos` int(11) DEFAULT NULL,
  `venda_fotos` tinyint(1) DEFAULT NULL,
  `hora_chegada_casa_noivo` varchar(10) DEFAULT NULL,
  `hora_saida_casa_noivo` varchar(10) DEFAULT NULL,
  `nome_noivo` varchar(40) DEFAULT NULL,
  `morada_noivo` varchar(100) DEFAULT NULL,
  `agregado_noivo` varchar(50) DEFAULT NULL,
  `info_extra_noivo` varchar(500) DEFAULT NULL,
  `hora_chegada_casa_noiva` varchar(10) DEFAULT NULL,
  `nome_noiva` varchar(40) DEFAULT NULL,
  `morada_noiva` varchar(100) DEFAULT NULL,
  `agregado_noiva` varchar(50) DEFAULT NULL,
  `info_extra_noiva` varchar(500) DEFAULT NULL,
  `morada_igreja` varchar(100) DEFAULT NULL,
  `instrucoes_igreja` varchar(200) DEFAULT NULL,
  `ordem_entrada` varchar(100) DEFAULT NULL,
  `coro` tinyint(1) DEFAULT NULL,
  `coro_localizacao` varchar(50) DEFAULT NULL,
  `ordem_leituras` varchar(100) DEFAULT NULL,
  `oferta_ramo` tinyint(1) DEFAULT NULL,
  `grupo_exterior` tinyint(1) DEFAULT NULL,
  `instrucoes_saida_igreja` varchar(200) DEFAULT NULL,
  `info_extra_igreja` varchar(500) DEFAULT NULL,
  `nome_quinta` varchar(40) DEFAULT NULL,
  `morada_quinta` varchar(100) DEFAULT NULL,
  `instrucoes_quinta` varchar(200) DEFAULT NULL,
  `timeline` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servico_detalhes_casamento`
--

INSERT INTO `servico_detalhes_casamento` (`cod_servico`, `fotos`, `video`, `drone`, `sde`, `fotos_convidados`, `num_convidados_fotos`, `venda_fotos`, `hora_chegada_casa_noivo`, `hora_saida_casa_noivo`, `nome_noivo`, `morada_noivo`, `agregado_noivo`, `info_extra_noivo`, `hora_chegada_casa_noiva`, `nome_noiva`, `morada_noiva`, `agregado_noiva`, `info_extra_noiva`, `morada_igreja`, `instrucoes_igreja`, `ordem_entrada`, `coro`, `coro_localizacao`, `ordem_leituras`, `oferta_ramo`, `grupo_exterior`, `instrucoes_saida_igreja`, `info_extra_igreja`, `nome_quinta`, `morada_quinta`, `instrucoes_quinta`, `timeline`) VALUES
(1, 1, 1, 1, 1, 1, 50, 1, '10:00', '11:30', 'João Silva', 'Rua das Flores 1, Lisboa', 'Família Silva', '', '11:45', 'Maria Costa', 'Rua dos Cravos 2, Lisboa', 'Família Costa', '', 'Igreja de Santa Maria', 'Chegar 15 min antes', 'Noiva, Noivo, Padrinhos', 1, 'Frente', 'Leitura 1, Leitura 2', 1, 0, 'Aguardar saída dos noivos', '', 'Quinta das Laranjeiras', 'Rua Quinta 5, Lisboa', 'Entrada lateral', '14:00 Chegada, 15:00 Almoço, 17:00 Corte do bolo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico_detalhes_comunhaogeral`
--

CREATE TABLE `servico_detalhes_comunhaogeral` (
  `cod_servico` int(11) NOT NULL,
  `fotos` tinyint(1) DEFAULT NULL,
  `video` tinyint(1) DEFAULT NULL,
  `drone` tinyint(1) DEFAULT NULL,
  `sde` tinyint(1) DEFAULT NULL,
  `formato_fotos` varchar(10) DEFAULT NULL,
  `valor_foto` decimal(10,2) DEFAULT NULL,
  `formato_video` varchar(10) DEFAULT NULL,
  `valor_video` decimal(10,2) DEFAULT NULL,
  `hora_chegada_igreja` varchar(5) DEFAULT NULL,
  `num_criancas` int(11) DEFAULT NULL,
  `info_extra_comunhao` varchar(300) DEFAULT NULL,
  `coro` tinyint(1) DEFAULT NULL,
  `coro_localizacao` varchar(50) DEFAULT NULL,
  `diplomas` tinyint(1) DEFAULT NULL,
  `grupo_exterior` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico_detalhes_comunhaoparticular`
--

CREATE TABLE `servico_detalhes_comunhaoparticular` (
  `cod_servico` int(11) NOT NULL,
  `fotos` tinyint(1) DEFAULT NULL,
  `video` tinyint(1) DEFAULT NULL,
  `drone` tinyint(1) DEFAULT NULL,
  `sde` tinyint(1) DEFAULT NULL,
  `fotos_convidados` tinyint(1) DEFAULT NULL,
  `num_convidados_fotos` int(11) DEFAULT NULL,
  `venda_fotos` tinyint(1) DEFAULT NULL,
  `hora_chegada_casa_crianca` varchar(10) DEFAULT NULL,
  `hora_saida_casa_crianca` varchar(10) DEFAULT NULL,
  `nome_crianca` varchar(40) DEFAULT NULL,
  `morada_crianca` varchar(100) DEFAULT NULL,
  `agregado_crianca` varchar(50) DEFAULT NULL,
  `info_extra_crianca` varchar(500) DEFAULT NULL,
  `morada_igreja` varchar(100) DEFAULT NULL,
  `instrucoes_igreja` varchar(200) DEFAULT NULL,
  `coro` tinyint(1) DEFAULT NULL,
  `coro_localizacao` varchar(50) DEFAULT NULL,
  `grupo_exterior` tinyint(1) DEFAULT NULL,
  `info_extra_igreja` varchar(500) DEFAULT NULL,
  `nome_quinta` varchar(40) DEFAULT NULL,
  `morada_quinta` varchar(100) DEFAULT NULL,
  `instrucoes_quinta` varchar(200) DEFAULT NULL,
  `timeline` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico_detalhes_evcorporativo`
--

CREATE TABLE `servico_detalhes_evcorporativo` (
  `cod_servico` int(11) NOT NULL,
  `fotos` tinyint(1) DEFAULT NULL,
  `video` tinyint(1) DEFAULT NULL,
  `drone` tinyint(1) DEFAULT NULL,
  `sde` tinyint(1) DEFAULT NULL,
  `hora_chegada_corp` varchar(10) DEFAULT NULL,
  `info_extra_corp` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servico_detalhes_evcorporativo`
--

INSERT INTO `servico_detalhes_evcorporativo` (`cod_servico`, `fotos`, `video`, `drone`, `sde`, `hora_chegada_corp`, `info_extra_corp`) VALUES
(3, 1, 1, 1, 0, '08:00', 'Cobrir chegada dos convidados e apresentações');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico_equipamento`
--

CREATE TABLE `servico_equipamento` (
  `cod_servico` int(11) NOT NULL,
  `cod_material` varchar(25) NOT NULL,
  `data_levantamento` date NOT NULL,
  `data_devolucao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servico_equipamento`
--

INSERT INTO `servico_equipamento` (`cod_servico`, `cod_material`, `data_levantamento`, `data_devolucao`) VALUES
(1, 'MAT001', '2025-06-01', '2025-06-02'),
(1, 'MAT002', '2025-06-01', '2025-06-02'),
(2, 'MAT003', '2025-07-15', '2025-07-15'),
(3, 'MAT005', '2025-08-10', '2025-08-11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico_funcionario`
--

CREATE TABLE `servico_funcionario` (
  `cod_servico` int(11) NOT NULL,
  `cod_funcionario` int(11) NOT NULL,
  `data_alocacao_inicio` date NOT NULL,
  `data_alocacao_fim` date NOT NULL,
  `funcao_no_servico` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servico_funcionario`
--

INSERT INTO `servico_funcionario` (`cod_servico`, `cod_funcionario`, `data_alocacao_inicio`, `data_alocacao_fim`, `funcao_no_servico`) VALUES
(1, 1, '2025-06-01', '2025-06-02', 'Fotógrafa principal'),
(1, 2, '2025-06-01', '2025-06-02', 'Vídeo secundário'),
(2, 3, '2025-07-15', '2025-07-15', 'Drone'),
(3, 4, '2025-08-10', '2025-08-11', 'Editora de vídeo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('tiAnkgAUl85pneB9C9KrpMKp2QRsNNho2OrgulUF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUHlRZllXbjB5THE5cHJ2dFFsS3dXMG5XWmRKRU1saUlLdEY5N1Q3cCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748252454);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tiposservico`
--

CREATE TABLE `tiposservico` (
  `cod_tipo_servico` int(11) NOT NULL,
  `nome_tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tiposservico`
--

INSERT INTO `tiposservico` (`cod_tipo_servico`, `nome_tipo`) VALUES
(2, 'Batizado'),
(1, 'Casamento'),
(5, 'Comunhão Geral'),
(4, 'Comunhão Particular'),
(3, 'Evento Corporativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cod_funcionario` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `avarias`
--
ALTER TABLE `avarias`
  ADD PRIMARY KEY (`cod_avaria`),
  ADD KEY `cod_material` (`cod_material`),
  ADD KEY `cod_servico` (`cod_servico`);

--
-- Índices para tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Índices para tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cod_categoria`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cod_cliente`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `funcao`
--
ALTER TABLE `funcao`
  ADD PRIMARY KEY (`cod_funcao`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`cod_funcionario`),
  ADD KEY `cod_nivel` (`cod_nivel`),
  ADD KEY `cod_funcao` (`cod_funcao`),
  ADD KEY `cod_estado` (`cod_estado`);

--
-- Índices para tabela `funcionario_estado`
--
ALTER TABLE `funcionario_estado`
  ADD PRIMARY KEY (`cod_estado`),
  ADD UNIQUE KEY `estado_nome` (`estado_nome`);

--
-- Índices para tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices para tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `localizacoes`
--
ALTER TABLE `localizacoes`
  ADD PRIMARY KEY (`cod_local_servico`),
  ADD UNIQUE KEY `nome_local` (`nome_local`);

--
-- Índices para tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`cod_marca`);

--
-- Índices para tabela `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`cod_material`),
  ADD KEY `cod_categoria` (`cod_categoria`),
  ADD KEY `cod_marca` (`cod_marca`),
  ADD KEY `cod_modelo` (`cod_modelo`),
  ADD KEY `cod_estado` (`cod_estado`);

--
-- Índices para tabela `material_estado`
--
ALTER TABLE `material_estado`
  ADD PRIMARY KEY (`cod_estado`),
  ADD UNIQUE KEY `estado_nome` (`estado_nome`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`cod_modelo`);

--
-- Índices para tabela `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`cod_nivel`);

--
-- Índices para tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices para tabela `perdas`
--
ALTER TABLE `perdas`
  ADD PRIMARY KEY (`cod_perda`),
  ADD KEY `cod_material` (`cod_material`),
  ADD KEY `cod_servico` (`cod_servico`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`cod_servico`),
  ADD KEY `cod_cliente` (`cod_cliente`),
  ADD KEY `cod_tipo_servico` (`cod_tipo_servico`),
  ADD KEY `cod_local_servico` (`cod_local_servico`);

--
-- Índices para tabela `servico_detalhes_batizado`
--
ALTER TABLE `servico_detalhes_batizado`
  ADD PRIMARY KEY (`cod_servico`);

--
-- Índices para tabela `servico_detalhes_casamento`
--
ALTER TABLE `servico_detalhes_casamento`
  ADD PRIMARY KEY (`cod_servico`);

--
-- Índices para tabela `servico_detalhes_comunhaogeral`
--
ALTER TABLE `servico_detalhes_comunhaogeral`
  ADD PRIMARY KEY (`cod_servico`);

--
-- Índices para tabela `servico_detalhes_comunhaoparticular`
--
ALTER TABLE `servico_detalhes_comunhaoparticular`
  ADD PRIMARY KEY (`cod_servico`);

--
-- Índices para tabela `servico_detalhes_evcorporativo`
--
ALTER TABLE `servico_detalhes_evcorporativo`
  ADD PRIMARY KEY (`cod_servico`);

--
-- Índices para tabela `servico_equipamento`
--
ALTER TABLE `servico_equipamento`
  ADD PRIMARY KEY (`cod_servico`,`cod_material`),
  ADD KEY `cod_material` (`cod_material`);

--
-- Índices para tabela `servico_funcionario`
--
ALTER TABLE `servico_funcionario`
  ADD PRIMARY KEY (`cod_servico`,`cod_funcionario`),
  ADD KEY `cod_funcionario` (`cod_funcionario`);

--
-- Índices para tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices para tabela `tiposservico`
--
ALTER TABLE `tiposservico`
  ADD PRIMARY KEY (`cod_tipo_servico`),
  ADD UNIQUE KEY `nome_tipo` (`nome_tipo`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_cod_funcionario_foreign` (`cod_funcionario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avarias`
--
ALTER TABLE `avarias`
  MODIFY `cod_avaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `cod_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `funcionario_estado`
--
ALTER TABLE `funcionario_estado`
  MODIFY `cod_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `localizacoes`
--
ALTER TABLE `localizacoes`
  MODIFY `cod_local_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `material_estado`
--
ALTER TABLE `material_estado`
  MODIFY `cod_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `perdas`
--
ALTER TABLE `perdas`
  MODIFY `cod_perda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `cod_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tiposservico`
--
ALTER TABLE `tiposservico`
  MODIFY `cod_tipo_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `avarias`
--
ALTER TABLE `avarias`
  ADD CONSTRAINT `avarias_ibfk_1` FOREIGN KEY (`cod_material`) REFERENCES `material` (`cod_material`),
  ADD CONSTRAINT `avarias_ibfk_2` FOREIGN KEY (`cod_servico`) REFERENCES `servicos` (`cod_servico`);

--
-- Limitadores para a tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `funcionarios_ibfk_1` FOREIGN KEY (`cod_nivel`) REFERENCES `nivel` (`cod_nivel`),
  ADD CONSTRAINT `funcionarios_ibfk_2` FOREIGN KEY (`cod_funcao`) REFERENCES `funcao` (`cod_funcao`),
  ADD CONSTRAINT `funcionarios_ibfk_3` FOREIGN KEY (`cod_estado`) REFERENCES `funcionario_estado` (`cod_estado`);

--
-- Limitadores para a tabela `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`cod_categoria`) REFERENCES `categoria` (`cod_categoria`),
  ADD CONSTRAINT `material_ibfk_2` FOREIGN KEY (`cod_marca`) REFERENCES `marca` (`cod_marca`),
  ADD CONSTRAINT `material_ibfk_3` FOREIGN KEY (`cod_modelo`) REFERENCES `modelo` (`cod_modelo`),
  ADD CONSTRAINT `material_ibfk_4` FOREIGN KEY (`cod_estado`) REFERENCES `material_estado` (`cod_estado`);

--
-- Limitadores para a tabela `perdas`
--
ALTER TABLE `perdas`
  ADD CONSTRAINT `perdas_ibfk_1` FOREIGN KEY (`cod_material`) REFERENCES `material` (`cod_material`),
  ADD CONSTRAINT `perdas_ibfk_2` FOREIGN KEY (`cod_servico`) REFERENCES `servicos` (`cod_servico`);

--
-- Limitadores para a tabela `servicos`
--
ALTER TABLE `servicos`
  ADD CONSTRAINT `servicos_ibfk_1` FOREIGN KEY (`cod_cliente`) REFERENCES `clientes` (`cod_cliente`),
  ADD CONSTRAINT `servicos_ibfk_2` FOREIGN KEY (`cod_tipo_servico`) REFERENCES `tiposservico` (`cod_tipo_servico`),
  ADD CONSTRAINT `servicos_ibfk_3` FOREIGN KEY (`cod_local_servico`) REFERENCES `localizacoes` (`cod_local_servico`);

--
-- Limitadores para a tabela `servico_detalhes_batizado`
--
ALTER TABLE `servico_detalhes_batizado`
  ADD CONSTRAINT `servico_detalhes_batizado_ibfk_1` FOREIGN KEY (`cod_servico`) REFERENCES `servicos` (`cod_servico`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `servico_detalhes_casamento`
--
ALTER TABLE `servico_detalhes_casamento`
  ADD CONSTRAINT `servico_detalhes_casamento_ibfk_1` FOREIGN KEY (`cod_servico`) REFERENCES `servicos` (`cod_servico`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `servico_detalhes_comunhaogeral`
--
ALTER TABLE `servico_detalhes_comunhaogeral`
  ADD CONSTRAINT `servico_detalhes_comunhaogeral_ibfk_1` FOREIGN KEY (`cod_servico`) REFERENCES `servicos` (`cod_servico`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `servico_detalhes_comunhaoparticular`
--
ALTER TABLE `servico_detalhes_comunhaoparticular`
  ADD CONSTRAINT `servico_detalhes_comunhaoparticular_ibfk_1` FOREIGN KEY (`cod_servico`) REFERENCES `servicos` (`cod_servico`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `servico_detalhes_evcorporativo`
--
ALTER TABLE `servico_detalhes_evcorporativo`
  ADD CONSTRAINT `servico_detalhes_evcorporativo_ibfk_1` FOREIGN KEY (`cod_servico`) REFERENCES `servicos` (`cod_servico`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `servico_equipamento`
--
ALTER TABLE `servico_equipamento`
  ADD CONSTRAINT `servico_equipamento_ibfk_1` FOREIGN KEY (`cod_servico`) REFERENCES `servicos` (`cod_servico`) ON DELETE CASCADE,
  ADD CONSTRAINT `servico_equipamento_ibfk_2` FOREIGN KEY (`cod_material`) REFERENCES `material` (`cod_material`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `servico_funcionario`
--
ALTER TABLE `servico_funcionario`
  ADD CONSTRAINT `servico_funcionario_ibfk_1` FOREIGN KEY (`cod_servico`) REFERENCES `servicos` (`cod_servico`) ON DELETE CASCADE,
  ADD CONSTRAINT `servico_funcionario_ibfk_2` FOREIGN KEY (`cod_funcionario`) REFERENCES `funcionarios` (`cod_funcionario`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_cod_funcionario_foreign` FOREIGN KEY (`cod_funcionario`) REFERENCES `funcionarios` (`cod_funcionario`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

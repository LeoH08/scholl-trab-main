-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/10/2025 às 01:38
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `escola_eetan`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `turma_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `materias_id` int(11) DEFAULT NULL,
  `matricula` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `ano` int(11) DEFAULT NULL,
  `turma` varchar(10) DEFAULT NULL,
  `modalidade` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id`, `curso_id`, `turma_id`, `usuario_id`, `materias_id`, `matricula`, `nome`, `ano`, `turma`, `modalidade`) VALUES
(1, 1, 3, 1, 1, '20240001', 'João Oliveira', 1, '3', 'Regular'),
(2, 1, 3, 4, 2, '20240002', 'Ana Costa', 1, '3', 'Regular'),
(19, 1, 3, NULL, NULL, '20240111', 'Amanda Ribeiro', 1, '3', 'Regular'),
(21, 1, 9, NULL, NULL, '20240113', 'Carla Mendes', 3, '9', 'Regular'),
(41, 2, 7, NULL, NULL, '20240102', 'Bruno Fernandes', 2, '7', 'Regular'),
(55, 2, 4, NULL, NULL, '20249043', 'Diego Souza', 1, '4', 'Regular'),
(56, 1, 6, NULL, NULL, '20240522', 'Eduarda Lima', 2, '6', 'Regular'),
(57, 2, 10, NULL, NULL, '20241213', 'Felipe Martins', 3, '10', 'Regular'),
(58, 10, 5, NULL, NULL, '20240311', 'Gustavo Alves', 1, '5', 'EJA'),
(59, 10, 5, NULL, NULL, '20240312', 'Helena Castro', 1, '5', 'EJA'),
(60, 10, 5, NULL, NULL, '20240313', 'Isabela Duarte', 1, '5', 'EJA'),
(61, 10, 8, NULL, NULL, '20240222', 'Izaias maria', 2, '8', 'Regular'),
(62, 10, 11, NULL, NULL, '20249113', 'larissa fidel', 3, '11', 'Regular');

-- --------------------------------------------------------

--
-- Estrutura para tabela `boletins`
--

CREATE TABLE `boletins` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) DEFAULT NULL,
  `disciplina_id` int(11) DEFAULT NULL,
  `nota` decimal(5,2) DEFAULT NULL,
  `frequencia` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `boletins`
--

INSERT INTO `boletins` (`id`, `aluno_id`, `disciplina_id`, `nota`, `frequencia`, `status`) VALUES
(1, 1, 1, 8.50, 95, 'Aprovado'),
(2, 1, 2, 7.00, 90, 'Aprovado'),
(3, 1, 3, 9.00, 98, 'Aprovado'),
(5, 2, 1, 7.50, 92, 'Aprovado'),
(6, 2, 2, 8.00, 88, 'Aprovado'),
(7, 2, 3, 6.00, 80, 'Reprovado'),
(8, 2, 4, 9.50, 99, 'Aprovado'),
(9, 57, 41, 1.00, 90, 'Aprovado'),
(10, 57, 45, 8.00, 100, 'Aprovado'),
(11, 19, 41, 20.00, 90, 'Aprovado'),
(12, 19, 45, 18.00, 90, 'Aprovado'),
(13, 19, 39, 8.00, 90, 'Aprovado'),
(14, 19, 4, 8.00, 90, 'Aprovado'),
(15, 19, 48, 8.00, 90, 'Aprovado'),
(16, 19, 43, 8.00, 90, 'Aprovado'),
(17, 19, 47, 8.00, 90, 'Aprovado'),
(18, 19, 46, 8.00, 90, 'Aprovado'),
(19, 19, 40, 8.00, 90, 'Aprovado'),
(20, 19, 3, 8.00, 90, 'Aprovado'),
(21, 19, 2, 8.00, 90, 'Aprovado'),
(22, 19, 1, 8.00, 90, 'Aprovado'),
(23, 19, 37, 8.00, 90, 'Aprovado'),
(24, 19, 38, 8.00, 90, 'Aprovado'),
(25, 19, 42, 8.00, 90, 'Aprovado'),
(26, 19, 44, 8.00, 90, 'Aprovado'),
(27, 19, 49, 8.00, 90, 'Aprovado'),
(28, 41, 41, 0.00, 0, 'Aprovado'),
(29, 41, 45, 0.00, 0, 'Aprovado'),
(30, 41, 39, 0.00, 0, 'Aprovado'),
(31, 41, 48, 0.00, 0, 'Aprovado'),
(32, 41, 43, 0.00, 0, 'Aprovado'),
(33, 41, 47, 1.00, 0, 'Aprovado'),
(34, 41, 46, 2.00, 0, 'Aprovado'),
(35, 41, 40, 3.00, 0, 'Aprovado'),
(36, 41, 37, 4.00, 0, 'Aprovado'),
(37, 41, 38, 5.00, 0, 'Aprovado'),
(38, 41, 42, 0.00, 0, 'Aprovado'),
(39, 41, 44, 0.00, 0, 'Aprovado'),
(40, 41, 49, 0.00, 0, 'Aprovado'),
(41, 41, 41, 0.00, 0, 'Aprovado'),
(42, 41, 45, 0.00, 0, 'Aprovado'),
(43, 41, 39, 0.00, 0, 'Aprovado'),
(44, 41, 48, 0.00, 0, 'Aprovado'),
(45, 41, 43, 0.00, 0, 'Aprovado'),
(46, 41, 47, 1.00, 0, 'Aprovado'),
(47, 41, 46, 2.00, 0, 'Aprovado'),
(48, 41, 40, 3.00, 0, 'Aprovado'),
(49, 41, 37, 4.00, 0, 'Aprovado'),
(50, 41, 38, 5.00, 0, 'Aprovado'),
(51, 41, 42, 0.00, 0, 'Aprovado'),
(52, 41, 44, 0.00, 0, 'Aprovado'),
(53, 41, 49, 0.00, 0, 'Aprovado'),
(55, 19, 5, NULL, NULL, 'Aprovado'),
(56, 19, 6, NULL, NULL, 'Aprovado'),
(57, 19, 7, NULL, NULL, 'Aprovado'),
(58, 19, 10, NULL, NULL, 'Aprovado'),
(59, 19, 13, NULL, NULL, 'Aprovado'),
(60, 19, 14, NULL, NULL, 'Aprovado'),
(61, 19, 11, NULL, NULL, 'Aprovado'),
(62, 19, 12, NULL, NULL, 'Aprovado'),
(63, 19, 21, NULL, NULL, 'Aprovado'),
(64, 19, 8, NULL, NULL, 'Aprovado'),
(65, 19, 15, NULL, NULL, 'Aprovado'),
(66, 19, 18, NULL, NULL, 'Aprovado'),
(67, 19, 17, NULL, NULL, 'Aprovado'),
(68, 19, 22, NULL, NULL, 'Aprovado'),
(69, 19, 19, NULL, NULL, 'Aprovado'),
(70, 19, 20, NULL, NULL, 'Aprovado'),
(71, 19, 9, NULL, NULL, 'Aprovado'),
(72, 19, 23, NULL, NULL, 'Aprovado'),
(73, 19, 16, NULL, NULL, 'Aprovado'),
(74, 21, 5, NULL, NULL, 'Aprovado'),
(75, 21, 6, NULL, NULL, 'Aprovado'),
(76, 21, 41, NULL, NULL, 'Aprovado'),
(77, 21, 7, NULL, NULL, 'Aprovado'),
(78, 21, 45, NULL, NULL, 'Aprovado'),
(79, 21, 10, NULL, NULL, 'Aprovado'),
(80, 21, 13, NULL, NULL, 'Aprovado'),
(81, 21, 14, NULL, NULL, 'Aprovado'),
(82, 21, 11, NULL, NULL, 'Aprovado'),
(83, 21, 12, NULL, NULL, 'Aprovado'),
(84, 21, 39, NULL, NULL, 'Aprovado'),
(85, 21, 4, NULL, NULL, 'Aprovado'),
(86, 21, 21, NULL, NULL, 'Aprovado'),
(87, 21, 48, NULL, NULL, 'Aprovado'),
(88, 21, 43, NULL, NULL, 'Aprovado'),
(89, 21, 8, NULL, NULL, 'Aprovado'),
(90, 21, 15, 20.00, NULL, 'Aprovado'),
(91, 21, 47, NULL, NULL, 'Aprovado'),
(92, 21, 18, NULL, NULL, 'Aprovado'),
(93, 21, 17, NULL, NULL, 'Aprovado'),
(94, 21, 46, NULL, NULL, 'Aprovado'),
(95, 21, 40, NULL, NULL, 'Aprovado'),
(96, 21, 22, NULL, NULL, 'Aprovado'),
(97, 21, 3, NULL, NULL, 'Aprovado'),
(98, 21, 2, NULL, NULL, 'Aprovado'),
(99, 21, 1, NULL, NULL, 'Aprovado'),
(100, 21, 19, NULL, NULL, 'Aprovado'),
(101, 21, 37, NULL, NULL, 'Aprovado'),
(102, 21, 38, NULL, NULL, 'Aprovado'),
(103, 21, 20, NULL, NULL, 'Aprovado'),
(104, 21, 42, NULL, NULL, 'Aprovado'),
(105, 21, 9, NULL, NULL, 'Aprovado'),
(106, 21, 23, NULL, NULL, 'Aprovado'),
(107, 21, 16, NULL, NULL, 'Aprovado'),
(108, 21, 44, NULL, NULL, 'Aprovado'),
(109, 21, 49, NULL, NULL, 'Aprovado'),
(110, 1, 41, 20.00, 90, 'Aprovado'),
(111, 1, 45, 20.00, 90, 'Aprovado'),
(112, 1, 39, 20.00, 90, 'Aprovado'),
(113, 1, 4, 20.00, 90, 'Aprovado'),
(114, 1, 48, 20.00, 90, 'Aprovado'),
(115, 1, 43, 20.00, 90, 'Aprovado'),
(116, 1, 47, 20.00, 90, 'Aprovado'),
(117, 1, 46, 20.00, 90, 'Aprovado'),
(118, 1, 40, 20.00, 90, 'Aprovado'),
(119, 1, 37, 20.00, 90, 'Aprovado'),
(120, 1, 38, 20.00, 90, 'Aprovado'),
(121, 1, 42, 20.00, 90, 'Aprovado'),
(122, 1, 44, 20.00, 90, 'Aprovado'),
(123, 1, 49, 20.00, 90, 'Aprovado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `duracao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cursos`
--

INSERT INTO `cursos` (`id`, `nome`, `descricao`, `duracao`) VALUES
(1, 'ds', 'ds', '3 anos'),
(2, 'logistica', 'logistica', '3 anos'),
(10, 'EJA', 'ensino de jovens e adultos\r\n', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `modalidade` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `disciplinas`
--

INSERT INTO `disciplinas` (`id`, `nome`, `curso_id`, `ano`, `modalidade`) VALUES
(1, 'Introdução ao Pensamento Computacional', 1, 1, 'Regular'),
(2, 'Introdução à Lógica', 1, 1, 'Regular'),
(3, 'Inovação Social e Científica em Empreendedorismo', 1, 1, 'Regular'),
(4, 'Empreendedorismo', 1, 1, 'Regular'),
(5, 'Algoritmo e Estrutura de Dados', 1, 2, 'Regular'),
(6, 'Arquitetura de Sistemas', 1, 2, 'Regular'),
(7, 'Banco de Dados', 1, 2, 'Regular'),
(8, 'Front-End I', 1, 2, 'Regular'),
(9, 'Matemática Discreta', 1, 2, 'Regular'),
(10, 'Conceitos Avançados em Arquitetura de Sistemas', 1, 3, 'Regular'),
(11, 'DS Back-End', 1, 3, 'Regular'),
(12, 'DS Front-End II', 1, 3, 'Regular'),
(13, 'Desenvolvimento de Aplicativos', 1, 3, 'Regular'),
(14, 'Desenvolvimento de Software', 1, 3, 'Regular'),
(15, 'Fundamentos de Segurança de Software', 1, 3, 'Regular'),
(16, 'Prática Profissional e Empreendedora', 1, 3, 'Regular'),
(17, 'Gestão de Qualidade', 2, 3, 'Regular'),
(18, 'Gestão de Custos', 2, 3, 'Regular'),
(19, 'Legislação de Transporte de Carga', 2, 3, 'Regular'),
(20, 'Logística Internacional e Aduaneira', 2, 3, 'Regular'),
(21, 'Espanhol para Negócios', 2, 3, 'Regular'),
(22, 'Inglês para Negócios', 2, 3, 'Regular'),
(23, 'Prática Profissional e Empreendedora', 2, 3, 'Regular'),
(37, 'Língua Portuguesa', 1, NULL, 'EJA'),
(38, 'Literatura', 1, NULL, 'EJA'),
(39, 'Educação Física', 1, NULL, 'EJA'),
(40, 'Inglês', 1, NULL, 'EJA'),
(41, 'Artes', 1, NULL, 'EJA'),
(42, 'Matemática', 1, NULL, 'EJA'),
(43, 'Física', 1, NULL, 'EJA'),
(44, 'Química', 1, NULL, 'EJA'),
(45, 'Biologia', 1, NULL, 'EJA'),
(46, 'História', 1, NULL, 'EJA'),
(47, 'Geografia', 1, NULL, 'EJA'),
(48, 'Filosofia', 1, NULL, 'EJA'),
(49, 'Sociologia', 1, NULL, 'EJA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `materias`
--

INSERT INTO `materias` (`id`, `nome`, `descricao`, `curso_id`) VALUES
(1, 'Lógica de Programação', 'Aprender lógica básica', 1),
(2, 'Banco de Dados', 'Modelagem e SQL', 1),
(3, 'Gestão Empresarial', 'Fundamentos de administração', 2),
(5, 'Português', 'Língua Portuguesa', 1),
(6, 'Matemática', 'Matemática', 1),
(7, 'História', 'História', 1),
(8, 'Geografia', 'Geografia', 1),
(9, 'Biologia', 'Biologia', 1),
(10, 'Física', 'Física', 1),
(11, 'Química', 'Química', 1),
(12, 'Inglês', 'Língua Inglesa', 1),
(13, 'Educação Física', 'Educação Física', 1),
(14, 'Artes', 'Artes', 1),
(15, 'Filosofia', 'Filosofia', 1),
(16, 'Sociologia', 'Sociologia', 1),
(17, 'Desenvolvimento de Software', 'Disciplina técnica', 1),
(18, 'CAAS', 'Comunicação, Aplicações e Serviços', 1),
(19, 'Desenvolvimento de Aplicativo', 'Disciplina técnica', 1),
(20, 'Desenvolvimento de Back End', 'Disciplina técnica', 1),
(21, 'Desenvolvimento de Front End', 'Disciplina técnica', 1),
(22, 'Empreendedorismo', 'Disciplina técnica', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `matricula`
--

CREATE TABLE `matricula` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `contato` varchar(100) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `responsavel` varchar(100) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `escola_origem` varchar(100) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `turno` varchar(20) DEFAULT NULL,
  `curso` varchar(100) DEFAULT NULL,
  `necessidades` varchar(255) DEFAULT NULL,
  `doc_paths` text DEFAULT NULL,
  `autorizacao_img` tinyint(1) DEFAULT NULL,
  `dt_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `matricula`
--

INSERT INTO `matricula` (`id`, `nome`, `data_nascimento`, `sexo`, `email`, `contato`, `endereco`, `responsavel`, `cpf`, `rg`, `escola_origem`, `ano`, `turno`, `curso`, `necessidades`, `doc_paths`, `autorizacao_img`, `dt_cadastro`) VALUES
(2, 'leonardo', '2025-08-21', 'masculino', 'adi@gmail.com', '31900000000', 'wafwfwafaf', 'dwafwagfwafwa', '07031401089', '316489426', 'dfafwaffaf', 2, 'integral', 'logistica', 'fwfwaw', NULL, 1, '2025-08-13 11:09:24'),
(3, 'marcilene coelho', '2025-10-23', 'masculino', 'marcilenecoelho@gmail.com', '31987538291', 'Rua Nelson Antunes Lopes,Silvo Pereira 1', 'marli coelho', '82699606081', '320103171', 'paulo franklin', 1, 'integral', 'desenvolvimento', 'nao', NULL, 1, '2025-10-05 23:34:22');

-- --------------------------------------------------------

--
-- Estrutura para tabela `matriculas`
--

CREATE TABLE `matriculas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contato` varchar(30) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `responsavel` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `escola_origem` varchar(100) NOT NULL,
  `ano` int(11) NOT NULL,
  `turno` varchar(20) NOT NULL,
  `curso` varchar(50) NOT NULL,
  `necessidades` varchar(255) DEFAULT NULL,
  `doc_paths` text DEFAULT NULL,
  `autorizacao_img` tinyint(1) NOT NULL DEFAULT 0,
  `dt_cadastro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `nota` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `notas`
--

INSERT INTO `notas` (`id`, `aluno_id`, `materia_id`, `nota`) VALUES
(1, 1, NULL, 8.50),
(2, 2, NULL, 9.00),
(5, 1, 16, 1.00),
(6, 1, 2, 1.00),
(7, 1, 9, 1.00),
(8, 1, 18, 1.00),
(9, 1, 19, 1.00),
(10, 1, 20, 1.00),
(11, 1, 21, 1.00),
(12, 1, 6, 1.00),
(13, 1, 17, 1.00),
(14, 1, 13, 1.00),
(15, 1, 12, 1.00),
(16, 1, 22, 4.00),
(17, 1, 15, 1.00),
(18, 1, 10, 1.00),
(19, 1, 8, 1.00),
(20, 1, 3, 1.00),
(21, 1, 7, 1.00),
(22, 1, 1, 1.00),
(23, 1, 5, 1.00),
(24, 1, 11, 1.00),
(25, 1, 14, 8.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professores`
--

CREATE TABLE `professores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `masp` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `materias_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professores`
--

INSERT INTO `professores` (`id`, `nome`, `masp`, `endereco`, `materias_id`, `usuario_id`, `curso_id`) VALUES
(1, 'Maria Silva', '123456', 'Rua A, 100', 1, 2, 1),
(2, 'Carlos Souza', '654321', 'Rua B, 200', 3, 5, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `turmas`
--

CREATE TABLE `turmas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `curso_id` int(11) NOT NULL,
  `ano` int(11) DEFAULT NULL,
  `modalidade` varchar(20) DEFAULT NULL,
  `professor_id` int(11) NOT NULL,
  `horario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turmas`
--

INSERT INTO `turmas` (`id`, `nome`, `curso_id`, `ano`, `modalidade`, `professor_id`, `horario`) VALUES
(3, '1º DS', 1, 1, 'Regular', 1, '07:00 - 11:30'),
(4, '1º Logística', 2, 1, 'Regular', 2, '07:00 - 11:30'),
(5, '1º EJA', 1, 1, 'EJA', 1, '19:00 - 22:00'),
(6, '2º DS', 1, 2, 'Regular', 1, '07:00 - 11:30'),
(7, '2º Logística', 2, 2, 'Regular', 2, '07:00 - 11:30'),
(8, '2º EJA', 1, 2, 'EJA', 1, '19:00 - 22:00'),
(9, '3º DS', 1, 3, 'Regular', 1, '07:00 - 11:30'),
(10, '3º Logística', 2, 3, 'Regular', 2, '07:00 - 11:30'),
(11, '3º EJA', 1, 3, 'EJA', 1, '19:00 - 22:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `email`, `senha`, `tipo`) VALUES
(1, 'joao_aluno', 'joao@example.com', 'senha123', 'aluno'),
(2, 'maria_prof', 'maria@example.com', 'senha123', 'professor'),
(3, 'admin1', 'admin@example.com', 'admin123', 'admin'),
(4, 'ana_aluna', 'ana@example.com', 'senha456', 'aluno'),
(5, 'carlos_prof', 'carlos@example.com', 'senha456', 'professor');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricula` (`matricula`),
  ADD KEY `curso_id` (`curso_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `materias_id` (`materias_id`);

--
-- Índices de tabela `boletins`
--
ALTER TABLE `boletins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `disciplina_id` (`disciplina_id`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Índices de tabela `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Índices de tabela `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `fk_nota_materia` (`materia_id`);

--
-- Índices de tabela `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `masp` (`masp`),
  ADD KEY `materias_id` (`materias_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Índices de tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_id` (`curso_id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de tabela `boletins`
--
ALTER TABLE `boletins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `professores`
--
ALTER TABLE `professores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `alunos_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `alunos_ibfk_3` FOREIGN KEY (`materias_id`) REFERENCES `materias` (`id`);

--
-- Restrições para tabelas `boletins`
--
ALTER TABLE `boletins`
  ADD CONSTRAINT `boletins_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`),
  ADD CONSTRAINT `boletins_ibfk_2` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`);

--
-- Restrições para tabelas `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD CONSTRAINT `disciplinas_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);

--
-- Restrições para tabelas `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);

--
-- Restrições para tabelas `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `fk_nota_materia` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`);

--
-- Restrições para tabelas `professores`
--
ALTER TABLE `professores`
  ADD CONSTRAINT `professores_ibfk_1` FOREIGN KEY (`materias_id`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `professores_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `professores_ibfk_3` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);

--
-- Restrições para tabelas `turmas`
--
ALTER TABLE `turmas`
  ADD CONSTRAINT `turmas_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `turmas_ibfk_2` FOREIGN KEY (`professor_id`) REFERENCES `professores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 07/07/2014 às 23h43min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `planejamento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id`, `nome`) VALUES
(1, 'SI');

-- --------------------------------------------------------

--
-- Estrutura da tabela `docente`
--

CREATE TABLE IF NOT EXISTS `docente` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `docente`
--

INSERT INTO `docente` (`id`, `nome`) VALUES
(1, 'Fred Durão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inicio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `turma_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_horario_turma` (`turma_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `horario`
--

INSERT INTO `horario` (`id`, `dia`, `inicio`, `fim`, `turma_id`) VALUES
(1, 'seg', '20:30', '22:30', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia`
--

CREATE TABLE IF NOT EXISTS `materia` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credito` int(11) unsigned DEFAULT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `materia`
--

INSERT INTO `materia` (`id`, `nome`, `credito`, `ref`) VALUES
(1, 'Laboratório de Programação WEb', 2, 'MATC84');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE IF NOT EXISTS `turma` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `materia_id` int(11) unsigned DEFAULT NULL,
  `docente_id` int(11) unsigned DEFAULT NULL,
  `curso_id` int(11) unsigned DEFAULT NULL,
  `materia` tinyint(1) unsigned DEFAULT NULL,
  `docente` tinyint(1) unsigned DEFAULT NULL,
  `curso` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_turma_materia` (`materia_id`),
  KEY `index_foreignkey_turma_docente` (`docente_id`),
  KEY `index_foreignkey_turma_curso` (`curso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=38 ;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id`, `materia_id`, `docente_id`, `curso_id`, `materia`, `docente`, `curso`) VALUES
(22, 1, 1, NULL, NULL, NULL, NULL),
(35, 1, 1, NULL, NULL, NULL, NULL),
(36, 1, 1, NULL, NULL, NULL, NULL),
(37, 1, 1, NULL, NULL, NULL, NULL);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `c_fk_horario_turma_id` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Restrições para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `c_fk_turma_curso_id` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `c_fk_turma_docente_id` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `c_fk_turma_materia_id` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

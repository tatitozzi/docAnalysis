-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 01-Jun-2023 às 18:18
-- Versão do servidor: 5.7.36
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_estudos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `estudos`
--

DROP TABLE IF EXISTS `estudos`;
CREATE TABLE IF NOT EXISTS `estudos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_do_estudo` varchar(255) NOT NULL,
  `arquivo_1` longblob,
  `arquivo_2` longblob,
  `anotacoes` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estudos`
--

INSERT INTO `estudos` (`id`, `nome_do_estudo`, `arquivo_1`, `arquivo_2`, `anotacoes`) VALUES
(21, '', 0x7461786f6e6f6d792f, 0x7461786f6e6f6d792f, ''),
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

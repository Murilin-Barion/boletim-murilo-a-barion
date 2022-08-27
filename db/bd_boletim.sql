-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Ago-2022 às 23:54
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_boletim`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_boletim`
--

CREATE TABLE `tb_boletim` (
  `cod_boletim` int(255) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nota1` double(10,2) NOT NULL,
  `nota2` double(10,2) NOT NULL,
  `nota3` double(10,2) NOT NULL,
  `nota4` double(10,2) NOT NULL,
  `media` decimal(10,2) NOT NULL,
  `situacao` varchar(60) NOT NULL,
  `ativo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_boletim`
--
ALTER TABLE `tb_boletim`
  ADD PRIMARY KEY (`cod_boletim`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_boletim`
--
ALTER TABLE `tb_boletim`
  MODIFY `cod_boletim` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

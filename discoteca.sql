-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/08/2024 às 13:58
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
-- Banco de dados: `discoteca`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `artista`
--

CREATE TABLE `artista` (
  `Nome` varchar(300) NOT NULL,
  `IdArtista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `devolucao`
--

CREATE TABLE `devolucao` (
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `IdDev` int(11) NOT NULL,
  `IdEmp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `discos`
--

CREATE TABLE `discos` (
  `Titulo` varchar(300) NOT NULL,
  `IdArtista` int(11) NOT NULL,
  `Ano` year(4) NOT NULL,
  `FotoCapa` varchar(300) NOT NULL,
  `IdDisco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `Nome` varchar(300) NOT NULL,
  `Email` varchar(300) NOT NULL,
  `Data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `IdEmp` int(11) NOT NULL,
  `IdDisco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `artista`
--
ALTER TABLE `artista`
  ADD PRIMARY KEY (`IdArtista`);

--
-- Índices de tabela `devolucao`
--
ALTER TABLE `devolucao`
  ADD PRIMARY KEY (`IdDev`),
  ADD KEY `IdEmp` (`IdEmp`);

--
-- Índices de tabela `discos`
--
ALTER TABLE `discos`
  ADD PRIMARY KEY (`IdDisco`),
  ADD KEY `IdArtista` (`IdArtista`);

--
-- Índices de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`IdEmp`),
  ADD KEY `IdDisco` (`IdDisco`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `artista`
--
ALTER TABLE `artista`
  MODIFY `IdArtista` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `devolucao`
--
ALTER TABLE `devolucao`
  MODIFY `IdDev` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `discos`
--
ALTER TABLE `discos`
  MODIFY `IdDisco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `IdEmp` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `devolucao`
--
ALTER TABLE `devolucao`
  ADD CONSTRAINT `devolucao_ibfk_1` FOREIGN KEY (`IdEmp`) REFERENCES `emprestimo` (`IdEmp`);

--
-- Restrições para tabelas `discos`
--
ALTER TABLE `discos`
  ADD CONSTRAINT `discos_ibfk_1` FOREIGN KEY (`IdArtista`) REFERENCES `artista` (`IdArtista`);

--
-- Restrições para tabelas `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`IdDisco`) REFERENCES `discos` (`IdDisco`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

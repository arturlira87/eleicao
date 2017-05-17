-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02-Maio-2017 às 03:39
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eleicoes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato`
--

CREATE TABLE `candidato` (
  `id_candidato` int(3) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `partido` varchar(100) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `dt_nasc` date NOT NULL,
  `cargo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `candidato`
--

INSERT INTO `candidato` (`id_candidato`, `nome`, `partido`, `cpf`, `dt_nasc`, `cargo`) VALUES
(5, 'Luís Inacio Lula da Silva', 'Partido Verde', '444.444.444-44', '2017-05-01', 'Presidente'),
(6, 'Jair Bolsonaro', 'PSDB', '123.456.789-12', '1947-12-13', 'Presidente'),
(7, 'Marina Silva', 'Partido Verde', '545.345.353-45', '2014-09-01', 'Presidente'),
(8, 'Roberto Claudio', 'PTdoB', '534.543.534-53', '2017-05-01', 'Prefeito');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eleitor`
--

CREATE TABLE `eleitor` (
  `id_eleitor` int(3) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `dt_nasc` date NOT NULL,
  `titulo` varchar(15) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `telefone` varchar(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `voto` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `eleitor`
--

INSERT INTO `eleitor` (`id_eleitor`, `nome`, `dt_nasc`, `titulo`, `cpf`, `telefone`, `bairro`, `voto`) VALUES
(13, 'Artur Lira Souto', '2000-01-29', '9283747', '83847487', '8384747', 'José Walter', 1),
(14, 'Lara Lira Souto', '1995-01-17', '75475475', '748747578', '7487547856', 'José Walter', 1),
(15, 'Maria Mileny', '1998-05-01', '75645768', '7575646', '747674', 'José Walter', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `votos`
--

CREATE TABLE `votos` (
  `id_voto` int(3) NOT NULL,
  `id_candidato` int(3) NOT NULL,
  `qtd_votos` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `votos`
--

INSERT INTO `votos` (`id_voto`, `id_candidato`, `qtd_votos`) VALUES
(20, 5, 12),
(21, 6, 13),
(24, 7, 18),
(25, 8, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`id_candidato`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Indexes for table `eleitor`
--
ALTER TABLE `eleitor`
  ADD PRIMARY KEY (`id_eleitor`),
  ADD UNIQUE KEY `titulo` (`titulo`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Indexes for table `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`id_voto`),
  ADD KEY `id_candidato` (`id_candidato`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidato`
--
ALTER TABLE `candidato`
  MODIFY `id_candidato` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `eleitor`
--
ALTER TABLE `eleitor`
  MODIFY `id_eleitor` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `votos`
--
ALTER TABLE `votos`
  MODIFY `id_voto` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `votos`
--
ALTER TABLE `votos`
  ADD CONSTRAINT `votos_ibfk_1` FOREIGN KEY (`id_candidato`) REFERENCES `candidato` (`id_candidato`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

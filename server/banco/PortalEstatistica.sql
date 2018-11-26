-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 26, 2018 at 02:36 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PortalEstatistica`
--

-- --------------------------------------------------------

--
-- Table structure for table `Estatistica`
--

CREATE TABLE `Estatistica` (
  `Id` int(11) NOT NULL,
  `AnoReferencia` int(4) NOT NULL,
  `CodigoMunicipio` int(11) NOT NULL,
  `idPeriodo` int(11) NOT NULL,
  `Media` int(20) NOT NULL,
  `Mediana` int(20) NOT NULL,
  `Maximo` int(20) NOT NULL,
  `Minimo` int(20) NOT NULL,
  `Desvio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Municipio`
--

CREATE TABLE `Municipio` (
  `IdMunicipio` int(11) NOT NULL,
  `CodigoMunicipio` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Uf` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Municipio`
--

INSERT INTO `Municipio` (`IdMunicipio`, `CodigoMunicipio`, `Nome`, `Uf`) VALUES
(1, 2800308, 'Aracaju', 'SE'),
(2, 1501402, 'Belém', 'PA'),
(3, 3106200, 'Belo Horizonte', 'MG'),
(4, 1400100, 'Boa Vista', 'RR'),
(5, 5300108, 'Brasília', 'DF'),
(6, 5002704, 'Campo Grande', 'MS'),
(7, 5103403, 'Cuiabá', 'MT'),
(8, 4106902, 'Curitibá', 'PR'),
(9, 4205407, 'Florianópolis', 'SC'),
(10, 2304400, 'Fortaleza', 'CE'),
(11, 5208707, 'Goiânia', 'GO'),
(12, 2507507, 'João Pessoa', 'PA'),
(13, 1600303, 'Macapá', 'AP'),
(14, 2704302, 'Maceió', 'AL'),
(15, 1302603, 'Manaus', 'AM'),
(16, 2408102, 'Natal', 'RN'),
(17, 1721000, 'Palmas', 'TO'),
(18, 4314902, 'Porto Alegre', 'RS'),
(19, 1100205, 'Porto Velho', 'RO'),
(20, 2611606, 'Recife', 'PE'),
(21, 1200401, 'Rio Branco', 'AC'),
(22, 3304557, 'Rio de Janeiro', 'RJ'),
(23, 2927408, 'São Luís', 'MA'),
(24, 3550308, 'São Paulo', 'SP'),
(25, 2211001, 'Teresina', 'PI'),
(26, 3205309, 'Vitória', 'ES');

-- --------------------------------------------------------

--
-- Table structure for table `Periodo`
--

CREATE TABLE `Periodo` (
  `idPeriodo` int(11) NOT NULL,
  `JANEIRO` int(50) NOT NULL,
  `FEVEREIRO` int(50) NOT NULL,
  `MARCO` int(50) NOT NULL,
  `ABRIL` int(50) NOT NULL,
  `MAIO` int(50) NOT NULL,
  `JUNHO` int(50) NOT NULL,
  `JULHO` int(50) NOT NULL,
  `AGOSTO` int(50) NOT NULL,
  `SETEMBRO` int(50) NOT NULL,
  `OUTUBRO` int(50) NOT NULL,
  `NOVEMBRO` int(50) NOT NULL,
  `DEZEMBRO` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Estatistica`
--
ALTER TABLE `Estatistica`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `id_fk_ibge` (`CodigoMunicipio`),
  ADD KEY `periodo_id_fk` (`idPeriodo`);

--
-- Indexes for table `Municipio`
--
ALTER TABLE `Municipio`
  ADD PRIMARY KEY (`IdMunicipio`),
  ADD KEY `IBGE_fk` (`CodigoMunicipio`);

--
-- Indexes for table `Periodo`
--
ALTER TABLE `Periodo`
  ADD PRIMARY KEY (`idPeriodo`),
  ADD KEY `fk_periodo` (`idPeriodo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Estatistica`
--
ALTER TABLE `Estatistica`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Municipio`
--
ALTER TABLE `Municipio`
  MODIFY `IdMunicipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `Periodo`
--
ALTER TABLE `Periodo`
  MODIFY `idPeriodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Estatistica`
--
ALTER TABLE `Estatistica`
  ADD CONSTRAINT `id_fk_ibge` FOREIGN KEY (`CodigoMunicipio`) REFERENCES `Municipio` (`CodigoMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `periodo_id_fk` FOREIGN KEY (`idPeriodo`) REFERENCES `Periodo` (`idPeriodo`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

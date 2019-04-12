-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 09, 2019 at 02:34 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.3.3-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `COGIP`
--

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE `facture` (
  `facture_id` int(11) NOT NULL,
  `facture_numero` varchar(45) DEFAULT NULL,
  `facture_date` date DEFAULT NULL,
  `facture_prestation_date` date DEFAULT NULL,
  `facture_insertion_date` varchar(45) DEFAULT NULL,
  `people_people_id` int(11) NOT NULL,
  `societe_societe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `people_id` int(11) NOT NULL,
  `people_nom` varchar(45) DEFAULT NULL,
  `people_prenom` varchar(45) DEFAULT NULL,
  `people_email` varchar(45) DEFAULT NULL,
  `societe_societe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `societe`
--

CREATE TABLE `societe` (
  `societe_id` int(11) NOT NULL,
  `societe_nom` varchar(45) DEFAULT NULL,
  `societe_pays` varchar(45) DEFAULT NULL,
  `societe_tva` varchar(45) DEFAULT NULL,
  `societe_type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`facture_id`,`people_people_id`,`societe_societe_id`),
  ADD KEY `fk_facture_people_idx` (`people_people_id`),
  ADD KEY `fk_facture_societe1_idx` (`societe_societe_id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`people_id`,`societe_societe_id`),
  ADD KEY `fk_people_societe1_idx` (`societe_societe_id`);

--
-- Indexes for table `societe`
--
ALTER TABLE `societe`
  ADD PRIMARY KEY (`societe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `facture`
--
ALTER TABLE `facture`
  MODIFY `facture_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `people_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `societe`
--
ALTER TABLE `societe`
  MODIFY `societe_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `fk_facture_people` FOREIGN KEY (`people_people_id`) REFERENCES `people` (`people_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_facture_societe1` FOREIGN KEY (`societe_societe_id`) REFERENCES `societe` (`societe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `people`
--
ALTER TABLE `people`
  ADD CONSTRAINT `fk_people_societe1` FOREIGN KEY (`societe_societe_id`) REFERENCES `societe` (`societe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

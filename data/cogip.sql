-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2019 at 05:50 AM
-- Server version: 5.7.23
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cogip`
--

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE `facture` (
  `facture_id` int(11) NOT NULL,
  `facture_numero` int(45) DEFAULT NULL,
  `facture_date` date DEFAULT NULL,
  `facture_prestation_date` date DEFAULT NULL,
  `facture_insertion_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `people_people_id` int(11) NOT NULL,
  `societe_societe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `facture`
--

INSERT INTO `facture` (`facture_id`, `facture_numero`, `facture_date`, `facture_prestation_date`, `facture_insertion_date`, `people_people_id`, `societe_societe_id`) VALUES
(1, 1, '2019-04-09', '2019-04-12', '2019-04-09 13:51:46', 1, 1),
(2, 2, '2018-08-13', '2018-11-14', '2019-04-09 13:57:28', 1, 1),
(3, 3, '2019-03-07', '2019-05-10', '2019-04-09 13:58:02', 1, 1),
(4, 4, '2019-04-12', '2019-04-16', '2019-04-12 11:17:23', 1, 2),
(5, 5, '2019-04-12', '2019-04-15', '2019-04-12 11:17:23', 1, 1),
(6, 8, '2019-04-12', '2019-04-16', '2019-04-12 11:17:23', 1, 2),
(7, 9, '2019-04-12', '2019-04-15', '2019-04-12 11:18:35', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `people_id` int(11) NOT NULL,
  `people_nom` varchar(45) DEFAULT NULL,
  `people_prenom` varchar(45) DEFAULT NULL,
  `people_email` varchar(45) DEFAULT NULL,
  `people_phone` varchar(13) DEFAULT NULL,
  `societe_societe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`people_id`, `people_nom`, `people_prenom`, `people_email`, `people_phone`, `societe_societe_id`) VALUES
(1, 'radu', 'jean', 'zpieghozugbc@gmail.com', '98797465', 1),
(5, 'toi', 'salut', 'freedom@gov.scotland', '123456789', 1),
(7, 'slt', 'machin', 'ormu@gov.us', '12345678', 2),
(8, 'berserk', 'guts', 'guts@bersek.gov', '66666666', 5),
(9, 'booe', 'oobe', 'oob@nasa.gov', '7854125478', 5),
(10, 'olub', 'bolu', 'oblu@secret.gov', '7896541235', 3);

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
-- Dumping data for table `societe`
--

INSERT INTO `societe` (`societe_id`, `societe_nom`, `societe_pays`, `societe_tva`, `societe_type`) VALUES
(1, 'COGIP', 'Belgique', 'BE 0999999999', 'client'),
(2, 'OTTOBOCK', 'allemagne', 'DE 0999999999', 'Client'),
(3, 'DEUS VULT', 'LITHUANIA', 'LU 0999999999', 'client'),
(4, 'JOJO', 'JAPAN', 'JP 0999999999', 'client'),
(5, 'NASA', 'USA', 'US 0999999999', 'fournisseur');

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
  MODIFY `facture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `people_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `societe`
--
ALTER TABLE `societe`
  MODIFY `societe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

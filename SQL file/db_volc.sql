-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 06:54 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_volc`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id_country` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id_country`, `country_name`) VALUES
(1, 'United States'),
(2, 'Japan'),
(4, 'Indonesia'),
(5, 'Russia'),
(6, 'Chile'),
(7, 'Ethiopia'),
(8, 'Papua New Guinea'),
(9, 'Philippines'),
(10, 'Mexico'),
(11, 'Iceland'),
(12, 'Ecuador'),
(13, 'Argentina'),
(14, 'Canada'),
(15, 'New Zealand'),
(16, 'Guatemala'),
(17, 'Tonga'),
(18, 'Kenya'),
(19, 'El Salvador'),
(20, 'Antarctica'),
(21, 'France');

-- --------------------------------------------------------

--
-- Table structure for table `volcano`
--

CREATE TABLE `volcano` (
  `id_volcano` int(11) NOT NULL,
  `volcano_name` varchar(255) NOT NULL,
  `id_country` int(11) NOT NULL,
  `id_volc_type` int(11) NOT NULL,
  `last_eruption` int(11) DEFAULT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `summit` float NOT NULL,
  `img_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `volcano`
--

INSERT INTO `volcano` (`id_volcano`, `volcano_name`, `id_country`, `id_volc_type`, `last_eruption`, `latitude`, `longitude`, `summit`, `img_file`) VALUES
(1, 'Adams', 1, 14, 950, 46.206, -121.49, 3742, '1685027312-2237-US_Adams.jpg'),
(3, 'Kīlauea', 1, 13, 2023, 19.421, -155.287, 1222, '1685032303-3093-US_Kilauea.jpg'),
(4, 'Asosan', 2, 1, 2021, 32.884, 131.104, 1592, '1685032393-8899-Japan_Asosan.jpg'),
(5, 'Dieng Volcanic Complex', 4, 2, 2021, -7.2, 109.879, 2565, '1685032458-1431-Indonesia_Dieng Volcanic Complex.jpg'),
(6, 'Ushkovsky', 5, 3, 1890, 56.113, 160.509, 3943, '1685032515-3146-Russia_Ushkovsky.jpg'),
(7, 'Caburgua-Huelemolle', 6, 11, -5050, -39.25, -71.75, 1652, '1685032593-6516-Chile_Caburgua-Huelemolle.jpg'),
(8, 'Dallol', 7, 6, 2011, 14.242, 40.3, -48, '1685032653-9226-Ethiopia_Dallol.jpg'),
(9, 'Bagana', 8, 8, 2023, -6.137, 155.196, 1855, '1685032729-2488-Papua New Guinea_Bagana.jpg'),
(10, 'San Pablo Volcanic Field', 9, 21, 1350, 14.12, 121.3, 1090, '1685032774-7451-Philippines_San Pablo Volcanic Field.jpg'),
(11, 'Blue Lake Crater', 1, 10, 680, 44.411, -121.774, 1230, '1685032846-4049-US_Blue Lake Crater.jpg'),
(12, 'Bogoslof', 1, 16, 2017, 53.93, 168.03, 150, '1685032902-4472-US_Bogoslof.jpg'),
(13, 'Alu-Dalafilla', 7, 7, 2008, 13.793, 40.553, 578, '1685032984-5929-Ethiopia_Alu-Dalafilla.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `volc_type`
--

CREATE TABLE `volc_type` (
  `id_volc_type` int(11) NOT NULL,
  `volc_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `volc_type`
--

INSERT INTO `volc_type` (`id_volc_type`, `volc_type_name`) VALUES
(1, 'Caledra'),
(2, 'Complex'),
(3, 'Compound'),
(4, 'Cone'),
(5, 'Crater rows'),
(6, 'Explosion crater'),
(7, 'Fissure vent'),
(8, 'Lava cone'),
(9, 'Lava dome'),
(10, 'Maar'),
(11, 'Pyroclastic cone'),
(12, 'Pyroclastic shield'),
(13, 'Shield'),
(14, 'Stratovolcano'),
(15, 'Subglacial'),
(16, 'Submarine'),
(17, 'Tuff cone'),
(18, 'Tuff ring'),
(19, 'Tuya'),
(20, 'Unknown'),
(21, 'Volcanic field'),
(22, 'Volcanic remnant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id_country`);

--
-- Indexes for table `volcano`
--
ALTER TABLE `volcano`
  ADD PRIMARY KEY (`id_volcano`),
  ADD KEY `volcano_ibfk_1` (`id_country`),
  ADD KEY `volcano_ibfk_2` (`id_volc_type`);

--
-- Indexes for table `volc_type`
--
ALTER TABLE `volc_type`
  ADD PRIMARY KEY (`id_volc_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id_country` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `volcano`
--
ALTER TABLE `volcano`
  MODIFY `id_volcano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `volc_type`
--
ALTER TABLE `volc_type`
  MODIFY `id_volc_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `volcano`
--
ALTER TABLE `volcano`
  ADD CONSTRAINT `volcano_ibfk_1` FOREIGN KEY (`id_country`) REFERENCES `country` (`id_country`) ON UPDATE CASCADE,
  ADD CONSTRAINT `volcano_ibfk_2` FOREIGN KEY (`id_volc_type`) REFERENCES `volc_type` (`id_volc_type`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

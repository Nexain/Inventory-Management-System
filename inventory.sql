-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2020 at 08:44 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CATEGORY_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NAME_CATEGORY` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CATEGORY_ID`, `NAME_CATEGORY`) VALUES
('FP', 'Fashion Pria'),
('FW', 'Fashion Wanita'),
('KN', 'Kain'),
('MK', 'Makanan'),
('OO', 'Obat-Obatan'),
('PI', 'Peralatan Ibadah');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `PRODUCT_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `CATEGORY_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `PRODUCT_NAME` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PRODUCT_ID`, `CATEGORY_ID`, `PRODUCT_NAME`, `status`) VALUES
('FP0001', 'FP', 'Kemeja Pria Hitam', 'Dijual'),
('FP0002', 'FP', 'Kemeja Batik Pria', 'Tdk Dijual Lagi'),
('FP0033', 'FP', 'Dibuat Akhir April3', 'ST1'),
('FP0991', 'FP', 'Akhir April 1', 'ST1'),
('FP0999', 'FP', 'Dibuat Akhir April2', 'ST1'),
('FW0001', 'FW', 'Kemeja Wanita Merah', 'ST1'),
('FW0002', 'FW', 'Blouse Polkadot Kuning', 'ST1'),
('KN0001', 'KN', 'Kain Batik', 'ST1'),
('MK0001', 'MK', 'Chuba', 'ST1'),
('MK0002', 'MK', 'Bumbu Sasa', 'ST1'),
('OO0001', 'OO', 'Antangin', 'ST1'),
('OO0002', 'OO', 'Ultraflu', 'ST1'),
('OO0010', 'OO', 'Hello World', 'ST1'),
('PI0001', 'PI', 'Sajadah', 'ST1'),
('PI0002', 'PI', 'Sarung', 'ST1');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `WH_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `WH_LOCATION` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`WH_ID`, `WH_LOCATION`) VALUES
('BDG', 'Bandung'),
('JKT', 'Jakarta'),
('SBY', 'Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_log`
--

CREATE TABLE `warehouse_log` (
  `TAG_ID` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `PRODUCT_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `WH_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `DATE_IN` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATE_OUT` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `warehouse_log`
--

INSERT INTO `warehouse_log` (`TAG_ID`, `PRODUCT_ID`, `WH_ID`, `DATE_IN`, `DATE_OUT`) VALUES
('224364056039', 'KN0001', 'BDG', '2020-06-11 01:32:58', '2020-06-11 01:38:19'),
('225924271425', 'KN0001', 'BDG', '2020-06-11 01:32:45', '2020-06-11 01:38:31'),
('88569204068', 'KN0001', 'BDG', '2020-06-10 19:27:31', '2020-06-11 01:38:25'),
('913253256601', 'FW0001', 'BDG', '2020-06-11 01:34:33', '2020-06-11 01:37:58'),
('918786828705', 'FP0001', 'BDG', '2020-06-11 01:34:26', '2020-06-11 01:38:10'),
('habislibur', 'FP0001', 'BDG', '2020-06-11 01:18:41', '0000-00-00 00:00:00'),
('T0001', 'FW0001', 'BDG', '2020-03-19 01:22:07', '2020-03-19 01:22:07'),
('T0002', 'FW0001', 'BDG', '2020-03-19 01:16:11', '2020-03-19 01:16:11'),
('T0003', 'FP0001', 'JKT', '2020-03-19 01:07:47', '0000-00-00 00:00:00'),
('T0004', 'FP0001', 'JKT', '2020-03-19 01:07:47', '0000-00-00 00:00:00'),
('T0005', 'MK0001', 'JKT', '2020-03-19 01:09:55', '0000-00-00 00:00:00'),
('T0006', 'MK0001', 'JKT', '2020-03-19 01:09:55', '0000-00-00 00:00:00'),
('T0007', 'MK0001', 'SBY', '2020-03-19 01:09:55', '0000-00-00 00:00:00'),
('T0008', 'PI0002', 'BDG', '2020-03-19 01:09:55', '0000-00-00 00:00:00'),
('T0009', 'PI0002', 'SBY', '2020-03-19 01:13:24', '2020-03-19 01:13:24'),
('T0010', 'OO0001', 'JKT', '2020-03-19 01:09:55', '0000-00-00 00:00:00'),
('T0011', 'KN0001', 'JKT', '2020-03-19 01:09:55', '0000-00-00 00:00:00'),
('T0012', 'KN0001', 'JKT', '2020-03-19 01:09:55', '0000-00-00 00:00:00');

--
-- Triggers `warehouse_log`
--
DELIMITER $$
CREATE TRIGGER `decreaseWarehouseStock` AFTER UPDATE ON `warehouse_log` FOR EACH ROW BEGIN
	IF (NEW.date_out != OLD.date_out) THEN
	 	UPDATE WAREHOUSE_STOCK
    	SET WAREHOUSE_STOCK.STOCK = WAREHOUSE_STOCK.STOCK - 1
   	 	WHERE WAREHOUSE_STOCK.PRODUCT_ID = NEW.product_id 
   		AND WAREHOUSE_STOCK.WH_ID = NEW.wh_id;
   	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `increaseWarehouseStock` AFTER INSERT ON `warehouse_log` FOR EACH ROW BEGIN
	IF NOT EXISTS 
		(SELECT 1 
		 FROM WAREHOUSE_STOCK  
		 WHERE WAREHOUSE_STOCK.PRODUCT_ID = NEW.PRODUCT_ID 
    	 AND WAREHOUSE_STOCK.WH_ID = NEW.WH_ID) 
   	THEN
    	INSERT INTO WAREHOUSE_STOCK
    	VALUES (NEW.PRODUCT_ID, NEW.WH_ID , 1);
    ELSE
		UPDATE WAREHOUSE_STOCK
   		SET WAREHOUSE_STOCK.STOCK = WAREHOUSE_STOCK.STOCK + 1
   		WHERE WAREHOUSE_STOCK.PRODUCT_ID = NEW.PRODUCT_ID 
   		AND WAREHOUSE_STOCK.WH_ID = new.WH_ID;
	END IF;
	
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_stock`
--

CREATE TABLE `warehouse_stock` (
  `PRODUCT_ID` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WH_ID` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `STOCK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `warehouse_stock`
--

INSERT INTO `warehouse_stock` (`PRODUCT_ID`, `WH_ID`, `STOCK`) VALUES
('FW0001', 'BDG', -1),
('FP0001', 'JKT', 2),
('MK0001', 'JKT', 2),
('MK0001', 'SBY', 1),
('PI0002', 'BDG', 1),
('PI0002', 'SBY', 0),
('OO0001', 'JKT', 1),
('KN0001', 'JKT', 2),
('KN0001    ', 'BDG', 1),
('FP0001    ', 'BDG', 2),
('MK0001', 'BDG', -3),
('FP0002', 'SBY', 0),
('FP0002', 'BDG', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CATEGORY_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PRODUCT_ID`),
  ADD KEY `FK_PRODUCTS_MERUPAKAN_CATEGORY` (`CATEGORY_ID`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`WH_ID`);

--
-- Indexes for table `warehouse_log`
--
ALTER TABLE `warehouse_log`
  ADD PRIMARY KEY (`TAG_ID`),
  ADD KEY `FK_LOG_CONTAIN_PRODUCTS` (`PRODUCT_ID`),
  ADD KEY `FK_LOG_MEMILIKI_WAREHOUS` (`WH_ID`);

--
-- Indexes for table `warehouse_stock`
--
ALTER TABLE `warehouse_stock`
  ADD KEY `FK_WAREHOUS_RELATIONS_WAREHOUS` (`WH_ID`),
  ADD KEY `FK_WAREHOUS_RELATIONS_PRODUCTS` (`PRODUCT_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_PRODUCTS_MERUPAKAN_CATEGORY` FOREIGN KEY (`CATEGORY_ID`) REFERENCES `category` (`CATEGORY_ID`);

--
-- Constraints for table `warehouse_log`
--
ALTER TABLE `warehouse_log`
  ADD CONSTRAINT `FK_LOG_CONTAIN_PRODUCTS` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `products` (`PRODUCT_ID`),
  ADD CONSTRAINT `FK_LOG_MEMILIKI_WAREHOUS` FOREIGN KEY (`WH_ID`) REFERENCES `warehouse` (`WH_ID`);

--
-- Constraints for table `warehouse_stock`
--
ALTER TABLE `warehouse_stock`
  ADD CONSTRAINT `FK_WAREHOUS_RELATIONS_PRODUCTS` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `products` (`PRODUCT_ID`),
  ADD CONSTRAINT `FK_WAREHOUS_RELATIONS_WAREHOUS` FOREIGN KEY (`WH_ID`) REFERENCES `warehouse` (`WH_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

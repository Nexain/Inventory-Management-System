-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2020 at 02:53 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims_proyek3_v3`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CATEGORY_ID` varchar(10) NOT NULL,
  `NAME_CATEGORY` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `PRODUCT_ID` varchar(10) NOT NULL,
  `CATEGORY_ID` varchar(10) NOT NULL,
  `PRODUCT_NAME` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PRODUCT_ID`, `CATEGORY_ID`, `PRODUCT_NAME`) VALUES
('FP0001', 'FP', 'Kemeja Pria Hitam'),
('FP0002', 'FP', 'Kemeja Batik Pria'),
('FW0001', 'FW', 'Kemeja Wanita Merah'),
('FW0002', 'FW', 'Blouse Polkadot Kuning'),
('KN0001', 'KN', 'Kain Batik'),
('MK0001', 'MK', 'Chuba'),
('MK0002', 'MK', 'Bumbu Sasa'),
('OO0001', 'OO', 'Antangin'),
('OO0002', 'OO', 'Ultraflu'),
('PI0001', 'PI', 'Sajadah'),
('PI0002', 'PI', 'Sarung');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `WH_ID` varchar(10) NOT NULL,
  `WH_LOCATION` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `TAG_ID` varchar(15) NOT NULL,
  `PRODUCT_ID` varchar(10) NOT NULL,
  `WH_ID` varchar(10) NOT NULL,
  `DATE_IN` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATE_OUT` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `warehouse_log`
--
DELIMITER $$
CREATE TRIGGER `decreaseWarehouseStock` AFTER UPDATE ON `warehouse_log` FOR EACH ROW BEGIN
		IF (NEW.date_out != old.date_out) THEN
	 		UPDATE warehouse_stock
    		SET warehouse_stock.STOCK = warehouse_stock.STOCK - 1
   	 		WHERE warehouse_stock.PRODUCT_ID = new.product_id 
    		AND warehouse_stock.WH_ID = new.wh_id;
    	end if;
	END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `increaseWarehouseStock` AFTER INSERT ON `warehouse_log` FOR EACH ROW begin
	IF NOT EXISTS 
		(SELECT 1 
		 FROM warehouse_stock  
		 WHERE warehouse_stock.PRODUCT_ID = new.product_id 
    	 AND warehouse_stock.WH_ID = new.wh_id) 
   	THEN
    	INSERT INTO warehouse_stock (product_id,wh_id,stock)
    	VALUES (NEW.product_id, NEW.WH_ID , 1);
    ELSE
		UPDATE warehouse_stock
   		SET warehouse_stock.STOCK = warehouse_stock.STOCK + 1
   		WHERE warehouse_stock.PRODUCT_ID = new.product_id 
   		AND warehouse_stock.WH_ID = new.wh_id;
	END IF;
	
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_stock`
--

CREATE TABLE `warehouse_stock` (
  `PRODUCT_ID` varchar(10) DEFAULT NULL,
  `WH_ID` varchar(10) DEFAULT NULL,
  `STOCK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Constraints for table `warehouse_stock`
--
ALTER TABLE `warehouse_stock`
  ADD CONSTRAINT `FK_WAREHOUS_RELATIONS_PRODUCTS` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `products` (`PRODUCT_ID`),
  ADD CONSTRAINT `FK_WAREHOUS_RELATIONS_WAREHOUS` FOREIGN KEY (`WH_ID`) REFERENCES `warehouse` (`WH_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.19 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para inbox
CREATE DATABASE IF NOT EXISTS `inbox` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inbox`;

-- Copiando estrutura para tabela inbox.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL DEFAULT '0',
  `productId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_cart_users` (`userId`),
  KEY `FK_cart_products` (`productId`),
  CONSTRAINT `FK_cart_products` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_cart_users` FOREIGN KEY (`userId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela inbox.cart: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Copiando estrutura para tabela inbox.checkout
CREATE TABLE IF NOT EXISTS `checkout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL DEFAULT '0',
  `value` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_checkout_users` (`userId`),
  CONSTRAINT `FK_checkout_users` FOREIGN KEY (`userId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela inbox.checkout: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `checkout` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkout` ENABLE KEYS */;

-- Copiando estrutura para tabela inbox.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `price` double NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela inbox.products: ~25 rows (aproximadamente)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `price`, `type`) VALUES
	(1, 'Apple iPhone 7', 799.99, 0),
	(2, 'Sansung Galaxy J3', 599.99, 0),
	(3, 'Apple Iphone X', 1099.99, 0),
	(4, 'Sansung Galaxy Note 8', 899.99, 0),
	(5, 'LG Aristo', 299.99, 0),
	(6, 'Sansung TV 47 LED', 499.99, 1),
	(7, 'LG TV 48 LCD', 348.99, 1),
	(8, 'Toshiba TV 52 LED', 549.99, 1),
	(9, 'TCL TV 52 4K LED', 400.99, 1),
	(10, 'LG TV 62 4K LED', 899.99, 1),
	(11, 'Bose SoundSport Wireless', 99.99, 2),
	(12, 'Powerbeats3 Wireless In-Ear Headphones', 59.99, 2),
	(13, 'Beats Solo3 Wireless On-Ear Headphones', 159.99, 2),
	(14, 'Beats Studio3 Wireless Headphones', 259.99, 2),
	(15, 'Bose SoundSport Wireless Headphones', 109.99, 2),
	(16, 'Norton Security Deluxe - 5 Devices', 15.99, 3),
	(17, 'Microsoft Windows 10 Home', 89.99, 3),
	(18, 'Webroot Business Endpoint Protection 2017', 479.99, 3),
	(19, 'McAfee 2018 Total Protection - 3 Devices', 13.99, 3),
	(20, 'H&R Block Tax Software Premium 2017', 39.99, 3),
	(21, 'Crucial MX300 750GB SATA 2.5 Inch', 199.99, 4),
	(22, 'Seagate Expansion 2TB Portable', 49.99, 4),
	(23, 'Seagate 2TB BarraCuda SATA 6Gb/s', 44.99, 4),
	(24, 'SanDisk SSD PLUS 240GB Solid State Drive', 69.99, 4),
	(25, 'WD Red 4TB NAS Hard Disk Drive', 109.99, 4);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Copiando estrutura para tabela inbox.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL DEFAULT '0',
  `username` char(50) NOT NULL DEFAULT '0',
  `password` char(50) NOT NULL DEFAULT '0',
  `authKey` char(50) DEFAULT '0',
  `currency` char(50) NOT NULL DEFAULT 'EUR',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela inbox.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

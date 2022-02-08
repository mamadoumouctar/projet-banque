
CREATE TABLE `clients` (`id` int(11) NOT NULL AUTO_INCREMENT,`nom` varchar(255) NOT NULL,`prenom` varchar(255) NOT NULL,`telephone` varchar(20) DEFAULT NULL,`address` varchar(255) NOT NULL,`created_at` date NOT NULL, CONSTRAINT PRIMARY KEY (`id`), CONSTRAINT UNIQUE KEY `clients_telephon` (`telephone`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

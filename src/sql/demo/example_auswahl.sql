CREATE TABLE `example_auswahl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bezeichnung` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `example_auswahl` (`id`, `bezeichnung`) VALUES
(1, 'Bergsteigen'),
(2, 'Mountainbiken'),
(3, 'Klettern'),
(4, 'Bouldern'),
(5, 'Schwimmen'),
(6, 'Laufen'),
(7, 'Bungee-Jumping'),
(8, 'Schlafen');
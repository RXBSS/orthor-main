CREATE TABLE `example_version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `version` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `example_version` (`id`, `name`, `version`) VALUES
(1, 'Futuresmart', '1'),
(2, 'Futuresmart', '1.1'),
(3, 'Futuresmart', '1.10.2'),
(4, 'Futuresmart', '2.2.0.1'),
(5, 'Futuresmart', '2.2.0.5'),
(6, 'Futuresmart', '2.2.0.19'),
(7, 'Futuresmart', '2.2.10.1'),
(8, 'Futuresmart', '3'),
(9, 'Futuresmart', '3.0.1'),
(10, 'Futuresmart', '3.0.0.1'),
(11, 'Futuresmart', '3.1.0.1'),
(12, 'Futuresmart', '3.100.2000'),
(13, 'Futuresmart', '3.3'),
(14, 'Futuresmart', '4.0'),
(15, 'Futuresmart', '4.0.0.1'),
(16, 'Futuresmart', '5'),
(17, 'Futuresmart', '5.3');

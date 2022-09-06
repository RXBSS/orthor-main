-- Erste Liste
CREATE TABLE `liste_a` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `bezeichnung` varchar(254) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
    `liste_a` (`id`, `bezeichnung`)
VALUES
    (1, 'Wert A'),
    (2, 'Wert B'),
    (3, 'Wert C'),
    (4, 'Wert D');

-- Zweite Liste
CREATE TABLE `liste_b` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `bezeichnung` varchar(254) NOT NULL,
    `liste_a` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
    `liste_b` (`id`, `bezeichnung`, `liste_a`)
VALUES
    (1, 'Wert A1', 1),
    (2, 'Wert A2', 1),
    (3, 'Wert A3', 1),
    (4, 'Wert B1', 2),
    (5, 'Wert B2', 2),
    (6, 'Wert B3', 2),
    (7, 'Wert C1', 3),
    (8, 'Wert C2', 3),
    (9, 'Wert C3', 3),
    (10, 'Wert D1', 4),
    (11, 'Wert D2', 4),
    (12, 'Wert D3', 4),
    (13, 'Wert Ohne', NULL);
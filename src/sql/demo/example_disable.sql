CREATE TABLE `example_disable` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `example_id` int(11) NOT NULL,
    `filter_id` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
    `example_disable` (`id`, `example_id`, `filter_id`)
VALUES
    (1, 1, 10000),
    (2, 2, 10000),
    (3, 3, 10000),
    (4, 6, 20000),
    (5, 7, 20000),
    (6, 8, 20000),
    (7, 2, 30000),
    (8, 5, 30000),
    (9, 9, 30000),
    (10, 10, 30000);
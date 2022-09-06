CREATE TABLE `example_upload` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(254) NOT NULL,
    `name_original` varchar(254) DEFAULT NULL,
    `pfad` varchar(254) DEFAULT NULL,
    `groesse` int(11) NOT NULL,
    `dateiendung` varchar(100) NOT NULL,
    `mime` varchar(254) NOT NULL,
    `datum_aenderung` datetime DEFAULT NULL,
    `datum_upload` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `example_upload2` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(254) NOT NULL,
    `name_original` varchar(254) DEFAULT NULL,
    `pfad` varchar(254) DEFAULT NULL,
    `groesse` int(11) NOT NULL,
    `dateiendung` varchar(100) NOT NULL,
    `mime` varchar(254) NOT NULL,
    `datum_aenderung` datetime DEFAULT NULL,
    `datum_upload` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
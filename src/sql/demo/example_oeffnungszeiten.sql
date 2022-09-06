CREATE TABLE `example_oeffnungszeiten` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `tag` int(1) NOT NULL,
    `offen` int(1) NOT NULL DEFAULT 0,
    `von1` TIME NULL DEFAULT NULL,
    `bis1` TIME NULL DEFAULT NULL,
    `von2` TIME NULL DEFAULT NULL,
    `bis2` TIME NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
    `example_oeffnungszeiten` (
        `id`,
        `tag`,
        `offen`,
        `von1`,
        `bis1`,
        `von2`,
        `bis2`
    )
VALUES
    (
        DEFAULT,
        1,
        1,
        '08:00:00',
        '16:30:00',
        DEFAULT,
        DEFAULT
    ),
    (
        DEFAULT,
        2,
        1,
        '08:00:00',
        '16:30:00',
        DEFAULT,
        DEFAULT
    ),
    (
        DEFAULT,
        3,
        1,
        '08:00:00',
        '16:30:00',
        '18:00:00',
        '20:00:00'
    ),
    (
        DEFAULT,
        4,
        1,
        '08:00:00',
        '16:30:00',
        '18:00:00',
        '20:00:00'
    ),
    (
        DEFAULT,
        5,
        1,
        '08:00:00',
        '15:00:00',
        DEFAULT,
        DEFAULT
    ),
    (
        DEFAULT,
        6,
        0,
        DEFAULT,
        DEFAULT,
        DEFAULT,
        DEFAULT
    ),
    (
        DEFAULT,
        7,
        0,
        DEFAULT,
        DEFAULT,
        DEFAULT,
        DEFAULT
    );
INSERT INTO
    `_einstellungen` (
        `id`,
        `name`,
        `beschreibung`,
        `berechtigung`,
        `global`,
        `adminWert`,
        `binLength`,
        `standard`,
        `wert`
    )
VALUES
    (
        1,
        'settings1',
        'Einstellung Nummer 1',
        1,
        1,
        '1',
        NULL,
        NULL,
        NULL
    ),
    (
        2,
        'settings2',
        'Einstellung Nummer 2',
        0,
        1,
        '1',
        NULL,
        NULL,
        NULL
    ),
    (
        3,
        'settings3',
        'Einstellung Nummer 3',
        0,
        0,
        '1',
        NULL,
        NULL,
        NULL
    ),
    (
        4,
        'settings4',
        'Einstellung Nummer 4',
        1,
        1,
        '1',
        NULL,
        NULL,
        NULL
    ),
    (
        5,
        'settings5',
        'Binäre Einstellung 5',
        0,
        0,
        '17',
        7,
        124,
        NULL
    ),
    (
        6,
        'settings6',
        'Binäre Einstellung 6',
        0,
        1,
        '17',
        7,
        124,
        NULL
    );
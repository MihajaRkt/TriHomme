--Donnees de test

--Donnees User
INSERT INTO
    User (nom_User, pwd_User, mail_User)
VALUES (
        'Admin',
        '1234',
        'Admin@admin.admin'
    ),
    (
        'Jean',
        '1234',
        'Jean@jean.jean'
    ),
    ('Bob', '1234', 'Bob@bob.bob');

--Donnees Categorie
INSERT INTO
    Categorie (libelle)
VALUES ('Produit menager'),
    ('Nourritures');

--Donnees Objet
INSERT INTO
    Objet (
        id_Proprietaire,
        id_Categorie,
        libelle,
        prix
    )
VALUES (1, 1, 'Balai', 700),
    (2, 1, 'Aspirateur', 1000),
    (3, 2, 'Biscuit', 400),
    (4, 2, 'Pain', 300),
    (5, 1, 'Machine à laver', 1200);

INSERT INTO
    Echanges (
        idEnvoyeur,
        idReceveur,
        idObjetEnvoyeur,
        idObjetReceveur,
        date_creation
    )
VALUES (2, 3, 2, 3, '2026-02-10'), -- Jean propose son Aspirateur (obj 2) contre le Biscuit (obj 3) de Bob
    (1, 2, 1, 2, '2026-01-20'), -- Admin échange son Balai (obj 1) avec l'Aspirateur (obj 2) de Jean (accepté)
    (3, 1, 3, 1, '2026-02-12');
-- Bob propose son Biscuit (obj 3) contre le Balai (obj 1) de l'Admin


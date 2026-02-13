--Donnees de test

    --Donnees User
    INSERT INTO User (nom_User, pwd_User, mail_User) VALUES
    ('Admin', '1234', 'Admin@admin.admin'), 
    ('Jean', '1234', 'Jean@jean.jean'), 
    ('Bob', '1234', 'Bob@bob.bob'); 

    --Donnees Categorie
    INSERT INTO Categorie (libelle) VALUES
    ('Produit menager'), 
    ('Nourritures'); 

    --Donnees Objet
    INSERT INTO Objet (id_Proprietaire, id_Categorie, libelle, prix) VALUES
    (1, 1, 'Balai', 700),
    (2, 1, 'Aspirateur', 1000),
    (3, 2, 'Biscuit', 400),
    (4, 2, 'Pain', 300),
    (5, 1, 'Machine à laver', 1200);

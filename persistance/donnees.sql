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
    (2, 1, 'Balai', 700),
    (3, 2, 'Chips', 1000);
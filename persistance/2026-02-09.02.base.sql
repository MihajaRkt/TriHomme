-- Active: 1769621502980@@127.0.0.1@3306@Takalo
create
or
replace
table User (
    id_User int primary key auto_increment,
    nom_User varchar(75),
    pwd_User varchar(250),
    mail_User varchar(30),
    isAdmin boolean
);

create table Objet (
    id_Objet int primary key auto_increment,
    id_Proprietaire int references User (id_User),
    id_Categorie int references Categorie (id_Categorie),
    libelle varchar(50),
    descriptions varchar(250),
    prix double
);

select count(Objet.id_Categorie) nombre, Categorie.libelle nom_categorie
from Categorie
    join Objet on Objet.id_Categorie = Categorie.id_Categorie
where
    Objet.id_Categorie = 1
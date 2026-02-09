-- Active: 1769621502980@@127.0.0.1@3306@Takalo
create database Takalo;

use Takalo;

create table User(
    id_User int primary key auto_increment,
    nom_User varchar(75),
    pwd_User varchar(20),
    mail_User varchar(30)
);

create table Categorie(
    id_Categorie int primary key auto_increment,
    libelle varchar(50) 
);

create table Objet(
    id_Objet int primary key auto_increment,
    id_Proprietaire int references User(id_User),
    id_Categorie int references Categorie(id_Categorie),
    libelle varchar(50),
    prix double
);
create table Objet_fille(
    id_Objet int references Objet(id_Objet),
    img varchar(100)
);


-- Active: 1769404705310@@127.0.0.1@3306@Takalo
create or replace table User(
    id_User int primary key auto_increment,
    nom_User varchar(75),
    pwd_User varchar(250),
    mail_User varchar(30),
    isAdmin boolean
);
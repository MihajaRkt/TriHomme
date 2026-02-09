create or replace table User(
    id_User int primary key auto_increment,
    nom_User varchar(75),
    pwd_User varchar(20),
    mail_User varchar(30),
    isAdmin boolean
);
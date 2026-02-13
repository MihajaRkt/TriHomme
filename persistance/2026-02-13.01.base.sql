--Echange
create or replace table Echanges(
    idEchange int primary key auto_increment,
    idEnvoyeur int REFERENCES User(id_User),
    idReceveur int REFERENCES User(id_User),
    idObjetEnvoyeur int REFERENCES Objet(id_Objet),
    idObjetReceveur int REFERENCES Objet(id_Objet),
    Statut boolean,                              
    date Date
);


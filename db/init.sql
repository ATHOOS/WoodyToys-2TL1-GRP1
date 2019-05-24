CREATE user 'web'@172.16.1.5 identified by 'xxx';
CREATE user 'admin'@'localhost' identified by 'xxx';
grant all privileges on *.* TO 'web'@172.16.1.5;
grant all privileges on *.* TO 'admin'@'localhost';

CREATE DATABASE WTdb
create table CLIENT
(ONSS char(4) not null,
 NOM  varchar(12) not null,
 ADRESSE varchar(20) not null,
 LOCALITE varchar(12) not null,
 PASSWORD varchar(20) not null,
 NEWS bool not null,
 primary key (NCLI));

create table PRODUIT
(NPRO char(5) not null,
 LIBELLE varchar(20) not null,
 PRIX decimal(5,0) not null,
 QSTOCK decimal(6,0) not null,
 primary key (NPRO));

create table COMMANDE
(NCOM char(5) not null,
 NCLI char(4) not null,
 DATECOM datetime not null,
 primary key (NCOM),
 foreign key (NCLI) references CLIENT);

create table DETAIL
(NCOM char(5) not null,
 NPRO char(5) not null,
 QCOM decimal(4,0) not null,
 primary key (NCOM,NPRO),
 foreign key (NCOM) references COMMANDE,
 foreign key (NPRO) references PRODUIT);

insert into PRODUIT values ('CS262','PIPE ET JAMBE DE BOIS 200x6x2',  75,  45);
insert into PRODUIT values ('CS264','BATEAU PIRATE 200x6x4', 120,2690);
insert into PRODUIT values ('CS464','MAISON 40x10x20', 220, 450);
insert into PRODUIT values ('PA45' ,'EGLISE 150x20x50',105, 580);
insert into PRODUIT values ('PA60' ,'GARNISON 60x60x70', 95, 134);
insert into PRODUIT values ('PH222','FERME 200x20x200',  230, 782);
insert into PRODUIT values ('PS222','BOULANGERIE 110x40x20',  185,1220);
insert into PRODUIT values ('PS222','HOPITAL 200x20x2',  185,1220);

flush privileges;

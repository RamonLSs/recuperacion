drop table if exists televisores;
drop table if exists usuario;

-- Tabla televisores --
create table televisores(
    id int auto_increment primary key,
    tipo varchar(50) not null,
    pulgadas float (4,2),
    imagen varchar(120) default 'img/televisores/default.jpg',
    precio float (6,2),
    descripcion varchar(200) not null,
    marca varchar(20) not null
);
-- Tabla usuario --
create table usuario(
    id int auto_increment primary key,
    mail varchar(40) unique not null,
    pass varchar(255) not null
);


-- Metiendo datos en las tablas --

-- Tabla usuario
insert into usuario values(1,'admin@gmail.com','admin');
insert into usuario values(2,'usu1@gmail.com','usu1');
insert into usuario values(3,'usu2@gmail.com','usu2');
insert into usuario values(4,'usu3@gmail.com','usu3');

-- Tabla televisores

insert into televisores values(1,'Plasma','45','/img/default.jpg','456.56','Tv de plasma con HD','Samsung');
insert into televisores values(2,'LED','35','/img/default.jpg','234.34','Tv Led de 35 pulgadas','LG');
insert into televisores values(3,'QLED','50','/img/default.jpg','789.89','Tv QLED de 50 pulgadas','Sony');
insert into televisores values(4,'OLED','24','/img/default.jpg','232.32','Tv OLED de 24 pulgadas','Philips');
insert into televisores values(5,'HD','22','/img/default.jpg','221.21','Tv HD de 22 pulgadas ','Noblex');
insert into televisores values(6,'Full HD','23.5','/img/default.jpg','243.34','Tv Full HD de 23.5 pulgadas','TCL');
insert into televisores values(7,'4K','40','/img/default.jpg','678.89','Tv 4K de 40 pulgadas','RCA');
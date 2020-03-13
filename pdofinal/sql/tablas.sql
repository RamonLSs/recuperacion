-- Tablas para pdofinal
-- Tabla Usuarios
-- ------------------------
drop table if exists televisores;
drop table if exists usuarios;

-- -------------------
create table usuarios(
	id int auto_increment primary key, 
	email varchar(40) unique not null,
	pass varchar(255) not null
);
-- Tabla televisores
create table televisores(
	id int auto_increment primary key,
	tipo varchar(60) not null,
	pulgadas float(6,2),
	imagen varchar(120) default 'img/televisores/default.jpg',
	precio float (6,2),
	descripcion varchar (200) not null,
	marca varchar(20) not null
);

-- Datos
insert into usuarios(email, pass) values('admin@email.com','admin');
insert into usuarios(email, pass) values('usu1@email.com','usu1');
insert into usuarios(email, pass) values('usu2@email.com','usu2');
insert into usuarios(email, pass) values('usu3@email.com','usu3');
-- ---------------
insert into televisores(tipo, pulgadas, precio, descripcion, marca) values('Plasma','45','456.56','Tv de plasma con HD','Samsung');
insert into televisores(tipo, pulgadas, precio, descripcion, marca) values('Plasma','45','456.56','Tv de plasma con HD','Samsung');
insert into televisores(tipo, pulgadas, precio, descripcion, marca) values('Plasma','45','456.56','Tv de plasma con HD','Samsung');
insert into televisores(tipo, pulgadas, precio, descripcion, marca) values('Plasma','45','456.56','Tv de plasma con HD','Samsung');
insert into televisores(tipo, pulgadas, precio, descripcion, marca) values('Plasma','45','456.56','Tv de plasma con HD','Samsung');
insert into televisores(tipo, pulgadas, precio, descripcion, marca) values('Plasma','45','456.56','Tv de plasma con HD','Samsung');
insert into televisores(tipo, pulgadas, precio, descripcion, marca) values('Plasma','45','456.56','Tv de plasma con HD','Samsung');
insert into televisores(tipo, pulgadas, precio, descripcion, marca) values('Plasma','45','456.56','Tv de plasma con HD','Samsung');

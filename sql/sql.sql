create database score character set 'utf8' collate 'utf8_general_ci';

create table administradores(
	id int not null primary key auto_increment,
	nome varchar(20) unique not null,
	senha varchar(50) not null
);

create table usuarios(
	id int not null primary key auto_increment,
	cpf varchar(20) unique not null,
	senha varchar(50) not null
);

create table senhas(
	id int not null primary key auto_increment,
	usuario int not null,
	senha varchar(150) not null,
	horario timestamp,
	foreign key(usuario) references usuarios(id)
);

create table respostas(
	id int not null primary key auto_increment,
	usuario int not null,
	inicio timestamp not null,
	fim timestamp,
	foreign key(usuario) references usuarios(id)
);

create table formularios(
	id int not null primary key auto_increment,
	usuario int not null,
	modulo int not null,
	resposta longtext character set 'utf8' not null,
	foreign key(usuario) references usuarios(id)
);

insert into administradores(id, nome, senha) values
(1, 'luizamichi', md5('luizamichi'));

insert into usuarios(id, cpf, senha) values
(1, 'luizamichi', md5('luizamichi'));

insert into senhas(id, usuario, senha, horario) values
(1, 1, 'luizamichi', current_timestamp);

insert into respostas(id, usuario, inicio, fim) values
(1, 1, current_timestamp, null);
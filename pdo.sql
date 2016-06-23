DROP DATABASE IF EXISTS pdo;

create database pdo;
use pdo;

DROP TABLE IF EXISTS alunos;

create table alunos 
(
    id int not null auto_increment,
    nome varchar (255) not null,
    nota int not null,
    primary key (id)
);

insert into alunos (nome, nota) values ('Pedro', 8);
insert into alunos (nome, nota) values ('joao', 5);
insert into alunos (nome, nota) values ('jose', 2);
insert into alunos (nome, nota) values ('isaias', 3);
insert into alunos (nome, nota) values ('tome', 4);
insert into alunos (nome, nota) values ('abalem', 6);
insert into alunos (nome, nota) values ('felipe', 5);
insert into alunos (nome, nota) values ('anita', 8);
insert into alunos (nome, nota) values ('carlos', 7);
insert into alunos (nome, nota) values ('Alexandre', 10);
insert into alunos (nome, nota) values ('Elias', 9.7);
insert into alunos (nome, nota) values ('Bonifacio', 9.8);
insert into alunos (nome, nota) values ('badock', 4.6);
insert into alunos (nome, nota) values ('Pepe', 5);
insert into alunos (nome, nota) values ('Raul', 3);
insert into alunos (nome, nota) values ('salu', 3.4);
insert into alunos (nome, nota) values ('Guilherme', 7);
insert into alunos (nome, nota) values ('Roger', 5);
insert into alunos (nome, nota) values ('Joelsom', 7.5);
insert into alunos (nome, nota) values ('Cacau', 6);

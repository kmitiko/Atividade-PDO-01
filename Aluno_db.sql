drop database Aluno_db;

create database Aluno_db;

use Aluno_db;

create table aluno 
(
	id int primary key auto_increment,
    nome varchar(50) not null,
    email varchar (30) not null unique
    );
    
  insert into aluno (nome, email) Values
  ("Kátia Mitiko", "kmitiko@gmail.com"),
  ("Maria Mitiko", "mariam@gmail.com")
  ON DUPLICATE KEY UPDATE
	 email = VALUE (email);
select * from aluno;

create table endereco
(
	id int primary key auto_increment,
    rua varchar (50) not null,
    bairro varchar (20) not null,
    aluno_id int not null,
    foreign key(aluno_id) references aluno(id) on DELETE Cascade
    
);

insert into endereco
(rua,bairro,aluno_id) Values
("Rua das Flores", "Primavera", 1),
("Rua Colorida", "Das Cores", 2);

-- View creation

CREATE OR REPLACE VIEW aluno_endereco AS
SELECT
al.nome, 
al.email,
end.rua,
end.bairro

from aluno al
join endereco end
on al.id = end.aluno_id;


SELECT * FROM aluno_endereco;
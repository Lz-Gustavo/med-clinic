use GeracaoSaude;
create table medicos(
	crm int unsigned not null,
    nome varchar(60) not null,
    sobrenome varchar(80),
    especializacao varchar(60) not null,
    email varchar(80),
    telefone varchar(60),
	endereco varchar(120),
    primary key(crm))
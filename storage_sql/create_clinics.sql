use GeracaoSaude;

create table clinicas(
	id int unsigned,
    nome varchar(32),
    descricao varchar(1024),
	primary key (id)
);

create table func_clinica(
	crm int unsigned,
	clinica int unsigned,
    seg varchar(8),
    ter varchar(8),
    qua varchar(8),
    qui varchar(8),
    sex varchar(8),
    foreign key (crm) references medicos(crm),
    foreign key (clinica) references clinicas(id)
);
use GeracaoSaude;

create table consultas(
	crm int unsigned,
    cpf int unsigned,
    clinica int unsigned,
    dia varchar(12),
    horario varchar(8),
    obs varchar(256),
    receita varchar(256),
    
    foreign key (crm) references medicos(crm),
    foreign key (cpf) references pacientes(cpf),
    foreign key (clinica) references clinicas(id)
);
    
use GeracaoSaude;
create table credentials(
	crm int unsigned,
    	cpf int unsigned,
    	pw binary(16),
    	foreign key (crm) references medicos(crm),
    	foreign key (cpf) references pacientes(cpf)
);
create table specialite
(
	idSpe int not null,
	NOM char(32) null,
	constraint PK_specialite primary key (idSpe)
);

alter table equipe
add column idSpe int;

alter table equipe
add foreign key(idSpe)
references specialite(idSpe);

alter table entraineur
add column idSpe int;

alter table entraineur
add foreign key(idSpe)
references specialite(idSpe);
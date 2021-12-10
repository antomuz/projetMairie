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

create table speEntraineur
(
	idSpe int not null,
	idEntraineur int not null,
	constraint PK_speEntraineur primary key (idSpe, idEntraineur),
	constraint FK_speEntraineur_entraineur foreign key (idSpe) references entraineur (idSpe),
	constraint FK_speEntraineur_specialite foreign key (idEntraineur) references specialite (idEntraineur)
);


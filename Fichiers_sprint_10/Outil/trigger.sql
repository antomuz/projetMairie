-- trigger pour la vérification de place restante dans une equipe

delimiter |
create trigger verifPlaceEquipe
after insert on equipe_adherent
for each row
BEGIN
DECLARE $nbrPlace int DEFAULT 0;
set $nbrPlace = (SELECT COUNT(*)
                 FROM equipe_adherent
                 where idEquipe = new.idEquipe);
                     
if $nbrPlace > (select nbrPlaceEquipe
                from equipe
                where idEquipe = new.idEquipe)
then
delete from equipe_adherent
where idEquipe = new.idEquipe
and idAdherent = new.idAdherent;
end IF;
end |


-- trigger pour la verification du nombre d'equipe d'un adherent (pas plus de 3)

delimiter |
create trigger verif_equipe_adherent
after insert on equipe_adherent
for each row
BEGIN
DECLARE $nbrPlace int DEFAULT 3;

                     
if $nbrPlace < (selectcount(*)
                from equipe_adherent
                where idAdherent = new.idAdherent)
then
delete from equipe_adherent
where idEquipe = new.idEquipe
and idAdherent = new.idAdherent;
end IF;
end |


-- trigger pour la verification du nombre d'equipe d'un entraineur (pas plus de 3)

delimiter |
create trigger verif_equipe_entraineur
after insert on equipe
for each row
BEGIN
DECLARE $nbrEquipe int DEFAULT 3;

if $nbrEquipe < (select COUNT(*)
                from equipe
                where idEntraineur = new.idEntraineur)
then
delete from equipe
where idEquipe = new.idEquipe;
end IF;
END |


-- trigger pour la vérification de l'adéquation entre spécialité de l'entraineur et de l'équipe

delimiter |
create trigger verif_equipe_entraineur
after insert on equipe
for each row
BEGIN
DECLARE testNb int default 0;
if testNb = (SELECT count(*)
from spe_entraineur
where idEntraineur = new.idEntraineur
and idSpe = new.idSpe)
then
delete from equipe
where idEquipe = new.idEquipe;
end IF;
END |

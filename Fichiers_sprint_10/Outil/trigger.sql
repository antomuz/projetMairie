//trigger pour la vérification de place restante dans une equipe

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


//
CREATE trigger nom_trigger
ON nom_table
FOR INSERT AS
DECLARE @nbrEspeces int

set @nbrEspeces = (select count(*)
                    from soigner
                    where codeSoignant = (select CODESOIGNANT from inserted)


if @nbrEspeces > 3
begin
        delete from soigner
        where codeSoignant = (select codeSoignant from inserted)
        and codeEspece = (select codeEspece from inserted)

print 'nb espèce trop élevé'
end 

-- 

CREATE TRIGGER isqualified
BEFORE INSERT ON equipe
FOR EACH ROW
BEGIN

DECLARE @idEntraineur int
SET @idEntraineur = (select idEntraineur from inserted)

DECLARE @spe int 
SET @spe = (select COUNT(idSpe)
            FROM spe_entraineur
            WHERE idEntraineur = @idEntraineur)

IF @spe = 0
BEGIN
    signal sqlstate '45000'
END 
END
-- Lors de l’affectation d’un entraineur dans une équipe, vérification que l’entraineur n’entraine pas plus de 3 équipes

CREATE TRIGGER pas3EquipesEntraineur
BEFORE INSERT ON equipe
FOR EACH ROW
BEGIN
    DECLARE @idEntraineur int
    SET @idEntraineur = (select idEntraineur from inserted)

    DECLARE @nbEquipe int 
    SET @nbEquipe = (select COUNT(*)
                    FROM equipe
                    WHERE idEntraineur = @idEntraineur)

    IF @nbEquipe > 3
    BEGIN
        signal sqlstate '45000'
    END 
END

--Lors de l’affectation d’un adhérent à une équipe, vérification que l’adhérent ne soit pas déjà dans plus de 3 équipes:


CREATE TRIGGER pas3EquipesAdherent
BEFORE INSERT ON equipe
FOR EACH ROW
BEGIN 
        DECLARE @idAdherent int
        SET @idAdherent = (select idAdherent from inserted)

        DECLARE @nbEquipe int 
        SET @nbEquipe = (select COUNT(*)
                        FROM equipe_adherent
                        WHERE idAdherent = @idAdherent)

        IF @nbEquipe > 3
        BEGIN
            signal sqlstate '45000'
        END 
END



DROP PROCEDURE IF EXISTS SP_GetAllAllergenen;

DELIMITER $$

CREATE PROCEDURE SP_GetAllAllergenen()
BEGIN

    SELECT   ALGE.Id
            ,ALGE.Naam
            ,ALGE.Omschrijving
    FROM Allergeen as ALGE;


END$$

DELIMITER ;
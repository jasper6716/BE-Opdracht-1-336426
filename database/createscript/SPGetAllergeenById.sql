DROP PROCEDURE IF EXISTS SP_GetAllergeenById;

DELIMITER $$

CREATE PROCEDURE SP_GetAllergeenById(
    IN p_id INT
)
BEGIN

    SELECT   ALGE.Id
            ,ALGE.Naam
            ,ALGE.Omschrijving
    FROM Allergeen as ALGE
    WHERE Id = p_id;


END$$

DELIMITER ;
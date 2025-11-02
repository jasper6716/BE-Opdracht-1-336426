DROP PROCEDURE IF EXISTS SP_UpdateAllergeen;

DELIMITER $$

CREATE PROCEDURE SP_UpdateAllergeen(
     IN p_id INT
    ,IN p_naam VARCHAR(50)
    ,IN p_omschrijving VARCHAR(255)
)
BEGIN

    UPDATE   Allergeen AS ALGE
       SET   ALGE.Naam = p_naam
            ,ALGE.Omschrijving = p_omschrijving
            ,ALGE.DatumGewijzigd = DATETIME(6)
     WHERE   ALGE.Id = p_id;

     SELECT ROW_COUNT() AS affected;


END$$

DELIMITER ;
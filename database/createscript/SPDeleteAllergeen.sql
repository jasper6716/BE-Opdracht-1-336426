DROP PROCEDURE IF EXISTS SP_DeleteAllergeen;

DELIMITER $$

CREATE PROCEDURE SP_DeleteAllergeen(
    IN p_id   INT
)

BEGIN
    DELETE FROM Allergeen AS ALGE
        WHERE ALGE.Id = p_id;

        SELECT ROW_COUNT() AS affected;

END$$

DELIMITER ;
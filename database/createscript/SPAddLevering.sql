DROP PROCEDURE IF EXISTS SP_AddLevering;

DELIMITER $$

CREATE PROCEDURE SP_AddLevering(
    IN p_ProductId INT,
    IN p_LeverancierId INT,
    IN p_Aantal TINYINT,
    IN p_DatumEerstVolgende DATETIME
)
BEGIN
    DECLARE v_IsActief BIT;

    SELECT IsActief INTO v_IsActief
    FROM Product
    WHERE Id = p_ProductId;

    IF v_IsActief = 0 THEN
        SELECT 'Product is niet meer actief' AS message;
    ELSE
        INSERT INTO ProductPerLeverancier (
            LeverancierId,
            ProductId,
            DatumLevering,
            Aantal,
            DatumEerstVolgendeLevering,
            IsActief,
            DatumAangemaakt,
            DatumGewijzigd
        ) VALUES (
            p_LeverancierId,
            p_ProductId,
            NOW(6),
            p_Aantal,
            p_DatumEerstVolgende,
            1,
            NOW(6),
            NOW(6)
        );

        SELECT LAST_INSERT_ID() AS new_id;
    END IF;
END$$

DELIMITER ;

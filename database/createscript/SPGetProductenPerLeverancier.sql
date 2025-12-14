DROP PROCEDURE IF EXISTS SP_GetProductenPerLeverancier;

DELIMITER $$

CREATE PROCEDURE SP_GetProductenPerLeverancier(IN p_LeverancierId INT)
BEGIN
    SELECT 
        P.Id AS ProductId,
        P.Naam AS ProductNaam,
        PPL.DatumLevering AS DatumLaatsteLevering,
        PPL.Aantal AS Aantal,
        PPL.DatumEerstVolgendeLevering,
        P.IsActief
    FROM Product AS P
    INNER JOIN ProductPerLeverancier AS PPL
        ON P.Id = PPL.ProductId
    WHERE PPL.LeverancierId = p_LeverancierId
    ORDER BY PPL.Aantal DESC;
END$$

DELIMITER ;

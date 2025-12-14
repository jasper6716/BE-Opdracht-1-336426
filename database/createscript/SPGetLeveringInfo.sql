DROP PROCEDURE IF EXISTS SP_GetLeveringInfo;

DELIMITER $$

CREATE PROCEDURE SP_GetLeveringInfo(
    IN p_id INT
)
BEGIN

    SELECT 	 LVRC.Id
			,LVRC.Naam                          AS LeverancierNaam
            ,LVRC.ContactPersoon
			,LVRC.LeverancierNummer
            ,LVRC.Mobiel
            ,PROD.Naam                          AS ProductNaam
            ,MAGA.AantalAanwezig
            ,CONCAT(TRIM(TRAILING ".0" FROM MAGA.VerpakkingsEenheidInKilogram), " kg")	AS VerpakkingsEenheid
            ,PPLC.DatumLevering
	FROM Leverancier AS LVRC    
    LEFT JOIN ProductPerLeverancier AS PPLC
    ON LVRC.Id = PPLC.LeverancierId
    LEFT JOIN Product AS PROD
    ON PROD.Id = PPLC.ProductId
    LEFT JOIN Magazijn AS MAGA
    ON PROD.Id = MAGA.ProductId
    WHERE LVRC.Id = p_id
    ORDER BY MAGA.AantalAanwezig DESC;

END$$

DELIMITER ;
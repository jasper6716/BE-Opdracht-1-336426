DROP PROCEDURE IF EXISTS SP_GetAllLeveranciers;

DELIMITER $$

CREATE PROCEDURE SP_GetAllLeveranciers(

)
BEGIN

    SELECT 	 LVRC.Id
			,LVRC.Naam
            ,LVRC.ContactPersoon
			,LVRC.LeverancierNummer
            ,LVRC.Mobiel
            ,COUNT(DISTINCT PPLC.ProductId)   AS VerschillendeProducten
	FROM Leverancier AS LVRC    
    LEFT JOIN ProductPerLeverancier AS PPLC
    ON LVRC.Id = PPLC.LeverancierId
    GROUP BY LVRC.Id
    ORDER BY VerschillendeProducten DESC;

END$$

DELIMITER ;
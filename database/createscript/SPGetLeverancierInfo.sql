USE jamin_a1;
DROP PROCEDURE IF EXISTS SP_GetLeverancierInfo;

DELIMITER $$

CREATE PROCEDURE SP_GetLeverancierInfo(IN p_ProductId INT)
BEGIN
    SELECT 
        l.Naam AS LeverancierNaam,
        l.ContactPersoon,
        l.LeverancierNummer,
        l.Mobiel,
        p.Naam AS ProductNaam,
        m.AantalAanwezig,
        m.DatumLevering,
        m.Aantal,
        m.DatumEerstVolgendeLevering
    FROM Product AS p
    INNER JOIN Leverancier AS l ON l.Id = p.LeverancierId
    LEFT JOIN Magazijn AS m ON m.ProductId = p.Id
    WHERE p.Id = p_ProductId;
END$$

DELIMITER ;

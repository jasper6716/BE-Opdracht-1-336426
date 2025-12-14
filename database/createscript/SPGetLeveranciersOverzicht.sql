DROP PROCEDURE IF EXISTS SP_GetLeveranciersOverzicht;

DELIMITER $$

CREATE PROCEDURE SP_GetLeveranciersOverzicht()
BEGIN
    SELECT 
        L.Id,
        L.Naam,
        COUNT(DISTINCT PPL.ProductId) AS AantalProducten
    FROM Leverancier AS L
    LEFT JOIN ProductPerLeverancier AS PPL
        ON L.Id = PPL.LeverancierId
    WHERE L.IsActief = 1
    GROUP BY L.Id, L.Naam
    ORDER BY AantalProducten DESC;
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS SP_GetAllergenenInfoProductById;

DELIMITER $$

CREATE PROCEDURE SP_GetAllergenenInfoProductById(
    IN p_id INT
)
BEGIN

    SELECT   PROD.Naam          AS ProductNaam
            ,PROD.Barcode
            ,ALGE.Naam          AS AllergeenNaam
            ,ALGE.Omschrijving  
    
    FROM Product AS PROD
    LEFT JOIN ProductPerAllergeen AS PPAN
    ON PPAN.ProductId = PROD.Id
    LEFT JOIN Allergeen AS ALGE
    ON PPAN.AllergeenId = ALGE.Id
    WHERE PROD.Id = p_id
    ORDER BY ALGE.Naam ASC;


END$$

DELIMITER ;

-- Gebruik database jamin
USE `jamin-a1`;

-- Step: 02
-- ***************************************************************
-- Doel : Maak een nieuwe tabel aan met de naam Allergeen
-- ***************************************************************
-- Versie       Datum           Auteur              Omschrijving
-- ******       *****           ******              ************
-- 01           12-02-2025      Arjan de Ruijter    Tabel Allergeen
-- ***************************************************************
-- Onderstaande velden toevoegen aan de tabel Allergeen
-- Merk, Model, Prijs, Geheugen, Besturingssysteem, 
-- Schermgrootte, Releasedatum, MegaPixels
-- ***************************************************************
DROP TABLE IF EXISTS Allergeen;

CREATE TABLE IF NOT EXISTS Allergeen
(
     Id                 SMALLINT        UNSIGNED    NOT NULL        AUTO_INCREMENT
    ,Naam               VARCHAR(30)                 NOT NULL
    ,Omschrijving       VARCHAR(100)                NOT NULL     
    ,IsActief           BIT                         NOT NULL        DEFAULT 1
    ,Opmerking          VARCHAR(255)                    NULL        DEFAULT NULL
    ,DatumAangemaakt    DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,DatumGewijzigd     DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,CONSTRAINT         PK_Allergeen_Id             PRIMARY KEY     CLUSTERED(Id)
) ENGINE=InnoDB;

INSERT INTO Allergeen
(
      Naam
     ,Omschrijving
)
VALUES
 ('Gluten', 'Dit product bevat gluten.')
,('Gelatine', 'Dit product bevat Gelatine.')
,('AZO-kleurstof', 'Dit product bevat AZO-kleurstof.')
,('Lactose', 'Dit product bevat lactose.')
,('Soja', 'Dit product bevat soja.');



DROP TABLE IF EXISTS Leverancier;

CREATE TABLE IF NOT EXISTS Leverancier
(
     Id                 SMALLINT        UNSIGNED    NOT NULL        AUTO_INCREMENT
    ,Naam               VARCHAR(30)                 NOT NULL
    ,ContactPersoon     VARCHAR(50)                 NOT NULL
    ,LeverancierNummer  VARCHAR(11)                 NOT NULL
    ,Mobiel             VARCHAR(11)                 NOT NULL
    ,IsActief           BIT                         NOT NULL        DEFAULT 1
    ,Opmerking          VARCHAR(255)                    NULL        DEFAULT NULL
    ,DatumAangemaakt    DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,DatumGewijzigd     DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,CONSTRAINT         PK_Leverancier_Id             PRIMARY KEY     CLUSTERED(Id)
) ENGINE=InnoDB;

INSERT INTO Leverancier
(
      Naam
     ,ContactPersoon
     ,LeverancierNummer
     ,Mobiel

)
VALUES
 ('Venco', 'Bert van Linge', 'L1029384719', '06-28493827')
,('Astra Sweets', 'Jasper del Monte', 'L1029284315', '06-39398734')
,('Haribo', 'Sven Stalman', 'L1029324748', '06-24383291')
,('Basset', 'Joyce Stelterberg', 'L1023845773', '06-48293823')
,('De Bron', 'Remco Veenstra', 'L1023857736', '06-34291234');

DROP TABLE IF EXISTS Product;

CREATE TABLE IF NOT EXISTS Product
(
     Id                 SMALLINT        UNSIGNED    NOT NULL        AUTO_INCREMENT
    ,Naam               VARCHAR(30)                 NOT NULL
    ,Barcode            CHAR(13)                    NOT NULL     
    ,IsActief           BIT                         NOT NULL        DEFAULT 1
    ,Opmerking          VARCHAR(255)                    NULL        DEFAULT NULL
    ,DatumAangemaakt    DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,DatumGewijzigd     DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,CONSTRAINT         PK_Product_Id             PRIMARY KEY     CLUSTERED(Id)
) ENGINE=InnoDB;

INSERT INTO Product
(
      Naam
     ,Barcode
)
VALUES
 ('Mintnopjes', 8719587231278)
,('Schoolkrijt', 8719587326713)
,('Honingdrop', 8719587327836)
,('Zure Beren', 8719587321441)
,('Cola Flesjes', 8719587321237)
,('Turtles', 8719587322245)
,('Witte Muizen', 8719587328256)
,('Reuzen Slangen', 8719587325641)
,('Zoute Rijen', 8719587322739)
,('Winegums', 8719587327527)
,('Drop Munten', 8719587322345)
,('Kruis Drop', 8719587322265)
,('Zuite Ruitjes', 8719587323256);

DROP TABLE IF EXISTS Magazijn;

CREATE TABLE IF NOT EXISTS Magazijn
(
     Id                                 SMALLINT        UNSIGNED    NOT NULL        AUTO_INCREMENT
    ,ProductId                          SMALLINT        UNSIGNED    NOT NULL 
    ,VerpakkingsEenheidInKilogram       DECIMAL(3,1)    UNSIGNED    NOT NULL
    ,AantalAanwezig                     SMALLINT        UNSIGNED        NULL
    ,IsActief                           BIT                         NOT NULL        DEFAULT 1
    ,Opmerking                          VARCHAR(255)                    NULL        DEFAULT NULL
    ,DatumAangemaakt                    DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,DatumGewijzigd                     DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,CONSTRAINT                         PK_Magazijn_Id             PRIMARY KEY     CLUSTERED(Id)
    ,FOREIGN KEY(ProductId)             REFERENCES Product(Id)
) ENGINE=InnoDB;

INSERT INTO Magazijn
(
      ProductId
     ,VerpakkingsEenheidInKilogram
     ,AantalAanwezig
)
VALUES
 (1, 5.0, 453)
,(2, 2.5, 400)
,(3, 5.0, 1)
,(4, 1.0, 800)
,(5, 3.0, 234)
,(6, 2.0, 345)
,(7, 1.0, 795)
,(8, 10.0, 233)
,(9, 2.5, 123)
,(10, 3.0, NULL)
,(11, 2.0, 367)
,(12, 1.0, 467)
,(13, 5.0, 20);

DROP TABLE IF EXISTS ProductPerAllergeen;

CREATE TABLE IF NOT EXISTS ProductPerAllergeen
(
     Id                                 SMALLINT        UNSIGNED    NOT NULL        AUTO_INCREMENT
    ,ProductId                          SMALLINT        UNSIGNED    NOT NULL 
    ,AllergeenId                        SMALLINT        UNSIGNED    NOT NULL
    ,IsActief                           BIT                         NOT NULL        DEFAULT 1
    ,Opmerking                          VARCHAR(255)                    NULL        DEFAULT NULL
    ,DatumAangemaakt                    DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,DatumGewijzigd                     DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,CONSTRAINT                         PK_ProductPerAllergeen_Id             PRIMARY KEY     CLUSTERED(Id)
    ,FOREIGN KEY(ProductId)             REFERENCES Product(Id)
    ,FOREIGN KEY(AllergeenId)           REFERENCES Allergeen(Id)
) ENGINE=InnoDB;

INSERT INTO ProductPerAllergeen
(
      ProductId
     ,AllergeenId
)
VALUES
 (1, 2)
,(1, 1)
,(1, 3)
,(3, 4)
,(6, 5)
,(9, 2)
,(9, 5)
,(10, 2)
,(12, 4)
,(13, 1)
,(13, 4)
,(13, 5);

DROP TABLE IF EXISTS ProductPerLeverancier;

CREATE TABLE IF NOT EXISTS ProductPerLeverancier
(
     Id                                 SMALLINT        UNSIGNED    NOT NULL        AUTO_INCREMENT
    ,LeverancierId                      SMALLINT        UNSIGNED    NOT NULL 
    ,ProductId                          SMALLINT        UNSIGNED    NOT NULL
    ,DatumLevering                      DATETIME                    NOT NULL
    ,Aantal                             TINYINT         UNSIGNED    NOT NULL
    ,DatumEerstVolgendeLevering         DATETIME                        NULL
    ,IsActief                           BIT                         NOT NULL        DEFAULT 1
    ,Opmerking                          VARCHAR(255)                    NULL        DEFAULT NULL
    ,DatumAangemaakt                    DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,DatumGewijzigd                     DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,CONSTRAINT                         PK_ProductPerLeverancier_Id             PRIMARY KEY     CLUSTERED(Id)
    ,FOREIGN KEY(LeverancierId)         REFERENCES Leverancier(Id)
    ,FOREIGN KEY(ProductId)             REFERENCES Product(Id)
) ENGINE=InnoDB;
-- verander dit nog en dan is het klaar
INSERT INTO ProductPerLeverancier
(
      LeverancierId
     ,ProductId
     ,DatumLevering
     ,Aantal
     ,DatumEerstVolgendeLevering
)
VALUES
 (1, 1, "2024-10-09", 23, "2024-10-16")
,(1, 1, "2024-10-18", 21, "2024-10-25")
,(1, 2, "2024-10-09", 12, "2024-10-16")
,(1, 3, "2024-10-10", 11, "2024-10-17")
,(2, 4, "2024-10-14", 16, "2024-10-21")
,(2, 4, "2024-10-21", 23, "2024-10-28")
,(2, 5, "2024-10-14", 45, "2024-10-21")
,(2, 6, "2024-10-14", 30, "2024-10-21")
,(3, 7, "2024-10-12", 12, "2024-10-19")
,(3, 7, "2024-10-19", 23, "2024-10-26")
,(3, 8, "2024-10-10", 12, "2024-10-17")
,(3, 9, "2024-10-11", 1, "2024-10-18")
,(4, 10, "2024-10-16", 24, "2024-10-30")
,(5, 11, "2024-10-10", 47, "2024-10-17")
,(5, 11, "2024-10-19", 60, "2024-10-26")
,(5, 12, "2024-10-11", 45, NULL)
,(5, 13, "2024-10-12", 23, NULL);
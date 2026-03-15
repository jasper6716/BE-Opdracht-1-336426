
USE `jamin`;

DROP TABLE IF EXISTS Allergeen;

CREATE TABLE IF NOT EXISTS Allergeen
(
     Id                 INT             UNSIGNED    NOT NULL        AUTO_INCREMENT
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


DROP TABLE IF EXISTS Contact;

CREATE TABLE IF NOT EXISTS Contact
(
     Id                 INT             UNSIGNED    NOT NULL        AUTO_INCREMENT
    ,Straat             VARCHAR(50)                 NOT NULL
    ,Huisnummer         SMALLINT        UNSIGNED    NOT NULL     
    ,Postcode           VARCHAR(6)                  NOT NULL
    ,Stad               VARCHAR(30)                 NOT NULL     
    ,IsActief           BIT                         NOT NULL        DEFAULT 1
    ,Opmerking          VARCHAR(255)                    NULL        DEFAULT NULL
    ,DatumAangemaakt    DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,DatumGewijzigd     DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,CONSTRAINT         PK_Allergeen_Id             PRIMARY KEY     CLUSTERED(Id)
) ENGINE=InnoDB;

INSERT INTO Contact
(
      Straat
     ,Huisnummer
     ,Postcode
     ,Stad
)
VALUES
 ('Van Gilslaan', 34, '1045CB', 'Hilvarenbeek')
,('Den Dolderpad', 2, '1067RC', 'Utrecht')
,('Fredo Raalteweg', 257, '1236OP', 'Nijmegen')
,('Bertrand Russellhof', 21, '2034AP', 'Den Haag')
,('Leon van Bonstraat', 213, '145XC', 'Lunteren')
,('Bea van Lingenlaan', 234, '2197FG', 'Sint Pancras');

DROP TABLE IF EXISTS Leverancier;

CREATE TABLE IF NOT EXISTS Leverancier
(
     Id                 INT             UNSIGNED    NOT NULL        AUTO_INCREMENT
    ,Naam               VARCHAR(30)                 NOT NULL
    ,ContactPersoon     VARCHAR(50)                 NOT NULL
    ,LeverancierNummer  VARCHAR(11)                 NOT NULL
    ,Mobiel             VARCHAR(11)                 NOT NULL
    ,ContactId          INT             UNSIGNED        NULL
    ,IsActief           BIT                         NOT NULL        DEFAULT 1
    ,Opmerking          VARCHAR(255)                    NULL        DEFAULT NULL
    ,DatumAangemaakt    DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,DatumGewijzigd     DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,CONSTRAINT         PK_Leverancier_Id             PRIMARY KEY     CLUSTERED(Id)
    ,FOREIGN KEY(ContactId)         REFERENCES Contact(Id)
) ENGINE=InnoDB;


INSERT INTO Leverancier
(
      Naam
     ,ContactPersoon
     ,LeverancierNummer
     ,Mobiel
     ,ContactId

)
VALUES
 ('Venco', 'Bert van Linge', 'L1029384719', '06-28493827', 1)
,('Astra Sweets', 'Jasper del Monte', 'L1029284315', '06-39398734', 2)
,('Haribo', 'Sven Stalman', 'L1029324748', '06-24383291', 3)
,('Basset', 'Joyce Stelterberg', 'L1023845773', '06-48293823', 4)
,('De Bron', 'Remco Veenstra', 'L1023857736', '06-34291234', 5)
,('Quality Street', 'Johan Nooij', 'L1029234586', '06-23458456', 6)
,('Hom Ken Food', 'Hom Ken', 'L1029234599', '06-23458477', NULL);

DROP TABLE IF EXISTS Product;

CREATE TABLE IF NOT EXISTS Product
(
     Id                 INT             UNSIGNED    NOT NULL        AUTO_INCREMENT
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
,('Zoute Ruitjes', 8719587323256)
,('Drop ninja’s', 8719587323277);

DROP TABLE IF EXISTS Magazijn;

CREATE TABLE IF NOT EXISTS Magazijn
(
     Id                                 INT             UNSIGNED    NOT NULL        AUTO_INCREMENT
    ,ProductId                          INT             UNSIGNED    NOT NULL 
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
     Id                                 INT             UNSIGNED    NOT NULL        AUTO_INCREMENT
    ,ProductId                          INT             UNSIGNED    NOT NULL 
    ,AllergeenId                        INT             UNSIGNED    NOT NULL
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
,(13, 5)
,(14, 5);

DROP TABLE IF EXISTS ProductPerLeverancier;

CREATE TABLE IF NOT EXISTS ProductPerLeverancier
(
     Id                                 INT             UNSIGNED    NOT NULL        AUTO_INCREMENT
    ,LeverancierId                      INT             UNSIGNED    NOT NULL 
    ,ProductId                          INT             UNSIGNED    NOT NULL
    ,DatumLevering                      DATE                            NULL
    ,Aantal                             TINYINT         UNSIGNED    NOT NULL
    ,DatumEerstVolgendeLevering         DATE                            NULL
    ,IsActief                           BIT                         NOT NULL        DEFAULT 1
    ,Opmerking                          VARCHAR(255)                    NULL        DEFAULT NULL
    ,DatumAangemaakt                    DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,DatumGewijzigd                     DATETIME(6)                 NOT NULL        DEFAULT (SYSDATE(6))
    ,CONSTRAINT                         PK_ProductPerLeverancier_Id             PRIMARY KEY     CLUSTERED(Id)
    ,FOREIGN KEY(LeverancierId)         REFERENCES Leverancier(Id)
    ,FOREIGN KEY(ProductId)             REFERENCES Product(Id)
) ENGINE=InnoDB;

INSERT INTO ProductPerLeverancier
(
      LeverancierId
     ,ProductId
     ,DatumLevering
     ,Aantal
     ,DatumEerstVolgendeLevering
)
VALUES
 (1, 1, "2023-04-09", 23, "2023-04-16")
,(1, 1, "2023-04-18", 21, "2023-04-25")
,(1, 2, "2023-04-09", 12, "2023-04-16")
,(1, 3, "2023-04-10", 11, "2023-04-17")
,(2, 4, "2023-04-14", 16, "2023-04-21")
,(2, 4, "2023-04-21", 23, "2023-04-28")
,(2, 5, "2023-04-14", 45, "2023-04-21")
,(2, 6, "2023-04-14", 30, "2023-04-21")
,(3, 7, "2023-04-12", 12, "2023-04-19")
,(3, 7, "2023-04-19", 23, "2023-04-26")
,(3, 8, "2023-04-10", 12, "2023-04-17")
,(3, 9, "2023-04-11", 1, "2023-04-18")
,(4, 10, "2023-04-16", 24, "2023-04-30")
,(5, 11, "2023-04-10", 47, "2023-04-17")
,(5, 11, "2023-04-19", 60, "2023-04-26")
,(5, 12, "2023-04-11", 45, NULL)
,(5, 13, "2023-04-12", 23, NULL)
,(7, 14, "2023-04-14", 20, NULL);
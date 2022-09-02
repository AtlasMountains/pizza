CREATE TABLE `pizza`.`gebruikers`
(
    `id`              INT         NOT NULL AUTO_INCREMENT,
    `voornaam`        VARCHAR(45) NOT NULL,
    `achternaam`      VARCHAR(45) NOT NULL,
    `straat`          VARCHAR(45) NOT NULL,
    `huisnummer`      VARCHAR(10) NOT NULL,
    `postcode`        VARCHAR(10) NOT NULL,
    `gemeente`        VARCHAR(45) NOT NULL,
    `telefoon`        VARCHAR(45) NOT NULL,
    `email`           VARCHAR(45) NULL DEFAULT NULL,
    `wachtwoord_hash` VARCHAR(255) NULL DEFAULT NULL,
    `korting`         varchar(5)  NOT NULL DEFAULT '0',
    UNIQUE INDEX `email_UNIQUE` (`email` ASC),
    PRIMARY KEY (`id`)
);
INSERT INTO pizza.gebruikers (voornaam, achternaam, straat, huisnummer, postcode, gemeente, telefoon, email,
                              wachtwoord_hash)
VALUES ('admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin@mail.com',
        '$2y$10$VgLsA1MOjgNeQLXZXkEA4uyd.4Yx3qSvgQELw/xiV5j9sg0WMAWPi');

CREATE TABLE `pizza`.`pizzas`
(
    `id`             INT          NOT NULL AUTO_INCREMENT,
    `naam`           VARCHAR(45)  NOT NULL,
    `omschrijving`   VARCHAR(255) NOT NULL,
    `catalogusPrijs` DECIMAL      NOT NULL,
    `fotoLink`       VARCHAR(255) NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `naam_UNIQUE` (`naam` ASC)
);

insert into pizzas (naam, omschrijving, catalogusPrijs, fotoLink)
values ('Ham', 'Tomatensaus, Mozzarella, Ham', 10,
        'https://www.dominos.be/ManagedAssets/BE/product/PHAM/BE_PHAM_all_hero_9262.jpg?v1749652234'),
       ('Funghi', 'Tomatensaus, Mozzarella, Champignons, Pizzakruiden', 12,
        'https://www.dominos.be/ManagedAssets/BE/product/PFGY/BE_PFGY_all_hero_9262.jpg?v751391914'),
       ('Margherita', 'Tomatensaus, mozzarella, extra mozzarella & oregano', 13,
        'https://www.dominos.be/ManagedAssets/BE/product/PMAR/BE_PMAR_all_hero_7547.jpg?v-684953824'),
       ('Hot & Spicy', 'Tomatensaus, mozzarella, ui, kip, paprika, pepperoni & spaanse pepers', 12,
        'https://www.dominos.be/ManagedAssets/BE/product/PHSY/BE_PHSY_all_hero_7547.jpg?v-815265254'),
       ('Hawaiian', 'Tomatensaus, mozzarella, ham, ananas & extra mozzarella', 15,
        'https://www.dominos.be/ManagedAssets/BE/product/PHAW/BE_PHAW_all_hero_8428.jpg?v-214782149'),
       ('quatro Cheese', 'Tomatensaus, mozzarella, gorgonzola, emmentaler & geitenkaas', 15,
        'https://www.dominos.be/ManagedAssets/BE/product/P4FR/BE_P4FR_all_hero_7547.jpg?v-881711820'),
       ('quatro Stagioni', 'Tomatensaus, mozzarella, pepperoni, gegrilde ham, paprika & champignons', 15,
        'https://www.dominos.be/ManagedAssets/BE/product/P4SA/BE_P4SA_all_hero_7780.png?v1544587211'),
       ('Pepper', 'Dubbele portie rundsvlees, tomatenblokjes, rode ui, pepersaus, mozzarella en tomatensaus', 9,
        'https://cdn-catalog.pizzahut.be/images/be/20180705162235580.jpg'),
       ('Super Supreme',
        'Rundsvlees, varkensvlees, ham, pepperoni, champignons, groene paprika, rode ui, zwarte olijven, mozzarella en tomatensaus',
        20, 'https://cdn-catalog.pizzahut.be/images/be/20170830150253939.jpg')
;

create table `pizza`.`statussen`
(
    `id`     int         not null auto_increment,
    `status` varchar(45) not null unique,
    primary key (`id`)
);
insert into `pizza`.`statussen` (status)
values ('geplaatst'),
       ('in de oven'),
       ('klaargemaakt'),
       ('onderweg'),
       ('geleverd');

CREATE TABLE `pizza`.`bestellingen`
(
    `id`          INT          NOT NULL AUTO_INCREMENT,
    `gebruikerID` INT          NULL,
    `time`        TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `prijs`       decimal      not null,
    `korting`     decimal      null     default 0.0,
    `opmerking`   varchar(255) null,
    `statusID`    INT          NOT NULL default 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`gebruikerID`) REFERENCES `gebruikers` (`id`),
    FOREIGN KEY (`statusID`) REFERENCES `statussen` (`id`)
);

CREATE TABLE `pizza`.`bestelLijnen`
(
    `lijnID`   INT   NOT NULL AUTO_INCREMENT,
    `bestelID` INT   NOT NULL,
    `pizzaID`  INT   NOT NULL,
    `aantal`   INT   NOT NULL,
    `prijs`    FLOAT NOT NULL,
    PRIMARY KEY (`lijnID`),
    FOREIGN KEY (`pizzaID`) REFERENCES `pizzas` (`id`),
    FOREIGN KEY (`bestelID`) REFERENCES `bestellingen` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
);

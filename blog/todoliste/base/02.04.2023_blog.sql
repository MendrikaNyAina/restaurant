

CREATE TABLE category (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	name                 varchar(100)  NOT NULL
 ) engine=InnoDB;

CREATE TABLE dish (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	name                 varchar(100)  NOT NULL    ,
	description          text      ,
	cost                 double  NOT NULL    ,
	category_id          int  NOT NULL    ,
    image                varchar(255)    ,
	CONSTRAINT fk_dish_category FOREIGN KEY ( category_id ) REFERENCES category( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

CREATE TABLE `order` (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	date_order           timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP   ,
	status_payment       int  NOT NULL DEFAULT 1   ,
	discount             double  NOT NULL DEFAULT 0
 ) engine=InnoDB;

CREATE TABLE order_details (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	order_id             int  NOT NULL    ,
	dish_id              int  NOT NULL    ,
	quantity             int  NOT NULL DEFAULT 1   ,
	CONSTRAINT fk_order_details_order FOREIGN KEY ( order_id ) REFERENCES `order`( id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_order_details_dish FOREIGN KEY ( dish_id ) REFERENCES dish( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

CREATE TABLE payment (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	order_id             int  NOT NULL    ,
	amount               double  NOT NULL    ,
	type_payment         double  NOT NULL    ,
	CONSTRAINT fk_payment_order FOREIGN KEY ( order_id ) REFERENCES `order`( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

CREATE TABLE settings (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	name                 varchar(100)  NOT NULL    ,
	value                double  NOT NULL    ,
	CONSTRAINT idx_settings UNIQUE ( name )
 ) engine=InnoDB;

CREATE TABLE type_spent (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	name                 varchar(100)  NOT NULL    ,
	normal_value         double  NOT NULL
 ) engine=InnoDB;

ALTER TABLE type_spent MODIFY name varchar(100)  NOT NULL   COMMENT 'name';

CREATE TABLE unity(
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	name                 varchar(100)  NOT NULL    ,
	unit                 varchar(5)  NOT NULL
 ) engine=InnoDB;

CREATE TABLE update_fund (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	date_fund            date  NOT NULL    ,
	amount               double  NOT NULL
 ) engine=InnoDB;

CREATE TABLE ingredient (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	name                 varchar(100)  NOT NULL    ,
	unity_id             int  NOT NULL    ,
	unit_price           double  NOT NULL ,
    image                  varchar(255)    ,
	CONSTRAINT fk_ingredient_unity_id FOREIGN KEY ( unity_id ) REFERENCES unity( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;
--prix unitaire, sans devoir a calculer
CREATE TABLE movement_ingredient (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	unit_price               double  NOT NULL DEFAULT 0   ,
	quantity             double  NOT NULL    ,
	ingredient_id        int  NOT NULL    ,
	date_movement       date  NOT NULL    ,
	type_movement        char(1)  NOT NULL DEFAULT 'e'   ,
	order_id             int      ,
	CONSTRAINT fk_movement_ingredient FOREIGN KEY ( ingredient_id ) REFERENCES ingredient( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

CREATE TABLE spent (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	date_spent           timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP   ,
	type_spent           int  NOT NULL    ,
	description          text      ,
	amount               double  NOT NULL    ,
	CONSTRAINT fk_spent_type_spent FOREIGN KEY ( type_spent ) REFERENCES type_spent( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

CREATE TABLE update_stock (
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	ingredient_id        int  NOT NULL    ,
	date_update          timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP   ,
	quantity             double  NOT NULL    ,
	unit_price               double  NOT NULL    ,
	CONSTRAINT fk_update_stock_ingredient FOREIGN KEY ( ingredient_id ) REFERENCES ingredient( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

CREATE TABLE dish_ingredient (
	ingredient_id        int  NOT NULL    ,
	id                   int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	quantity             double  NOT NULL    ,
	dish_id              int  NOT NULL    ,
	CONSTRAINT fk_dish_ingredient_ingredient FOREIGN KEY ( ingredient_id ) REFERENCES ingredient( id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_dish_ingredient_dish FOREIGN KEY ( dish_id ) REFERENCES dish( id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

INSERT INTO category VALUES (1,'Entrée'),(2,'Plat'),(3,'Dessert'),(4,'Boisson');

INSERT INTO unity VALUES (1,'Kilo','kg'),(2,'Litre','L'),(3,'Pièce','Pc');

INSERT INTO type_spent VALUES
(1,'Electricité',60000),
(2,'Eau',60000),
(3,'Gaz',80000),
(4,'Salaire',1000000),
(5,'Frais de location',250000),
(6,'Frais de transport',20000),
(7,'Frais de formation',0),
(8,'impot',120000),
(9,'autre',0);

INSERT INTO settings VALUES (1,'TVA',0.2),(2,'benefice',0.5);

INSERT INTO ingredient(id, name, unity_id, unit_price) VALUES
(1,'riz',1, 4000),
(2,'lait',2, 2000),
(3,'sucre',1, 1800),
(4,'farine',1, 1500),
(5,'oeuf',3, 600),
(6,'beurre',1, 12000),
(7,'sel',1, 6000),
(8,'poivre',1, 12000),
(9,'piment',1, 12000),
(10,'tomate',1, 4000),
(11,'oignon',1, 1200),
(12,'pomme de terre',1, 2000),
(13,'carotte',1, 1500),
(14,'poulet',1, 10000),
(15,'poisson',1, 10000),
(16,'creme',1, 8000),
(17,'chocolat',1, 20000),
(18,'cafe',1, 20000),
(19,'the',1, 18000),
(20,'eau',2, 1000),
(21,'jus',2, 1000),
(22,'vin',2, 1000),
(23,'biere',2, 5000),
(24,'boeuf',1,8000),
(25,'crevette',1,22000),
(26,'petit pois',1,2000),
(27,'pate',3,1200),
(28,'fruit',1,5000),
(29,'fruit de saison',1,2500);

INSERT INTO dish(id, name, cost, category_id) VALUES
(1,'riz au lait',3000, 3),
(2,'steak au riz', 6000,2),
(3,'poulet au champignon',8000,2);

--le dernier stock de chaque ingredient dans update_stock
CREATE OR REPLACE VIEW v_update_stock AS
SELECT e.ingredient_id, COALESCE(e.unit_price,0) unit_price, COALESCE(e.quantity,0) quantity,e.date_update
from (
    SELECT i.id as ingredient_id, a.unit_price, a.quantity,a.date_update
    from  ingredient i
    LEFT JOIN (
        SELECT u.ingredient_id,   u.unit_price, u.quantity,u.date_update
            from  update_stock u,
            (SELECT ingredient_id,max(date_update) max from update_stock GROUP BY ingredient_id) t
        WHERE u.ingredient_id=t.ingredient_id AND u.date_update=t.max
        ) a ON
        i.id=a.ingredient_id
) e;

--le stock de chaque ingredient dans la table movement_ingredient
CREATE OR REPLACE VIEW v_movement_stock AS
SELECT  m.ingredient_id, m.quantity, m.unit_price, m.date_movement, m.type_movement, CASE WHEN m.type_movement='e' THEN m.quantity ELSE -m.quantity END AS stock
from v_update_stock u, movement_ingredient m
WHERE u.ingredient_id=m.ingredient_id AND m.date_movement>u.date_update;

--le stock de chaque ingredients
CREATE OR REPLACE VIEW v_stock AS
SELECT i.id, i.name, i.unity_id, i.image, sum(e.stock) as stock, sum(e.unit_price)/count(e.quantity) as unit_price from
(
    SELECT ingredient_id, sum(quantity) quantity, sum(stock) stock, sum(unit_price)/count(quantity) unit_price
    from v_movement_stock GROUP BY ingredient_id
        UNION
    SELECT u.ingredient_id, u.quantity, u.quantity stock, u.unit_price  FROM v_update_stock u) e, ingredient i
WHERE e.ingredient_id=i.id;

--version 2
CREATE OR REPLACE VIEW v_stock AS
SELECT i.id, i.name, i.unity_id, i.image, sum(e.stock) as stock, i.unit_price as unit_price from
(
    SELECT ingredient_id, sum(quantity) quantity, sum(stock) stock
    from v_movement_stock GROUP BY ingredient_id
        UNION
    SELECT u.ingredient_id, u.quantity, u.quantity stock  FROM v_update_stock u) e, ingredient i
WHERE e.ingredient_id=i.id GROUP BY i.id, i.name, i.unity_id, i.image,i.unit_price;

--sortie par jour
CREATE OR REPLACE VIEW v_stock_output AS
SELECT SUM(quantity) as quantity, ingredient_id, sum(unit_price)/count(*) as unit_price, date(date_movement) as date_movement, 'e' as type_movement, null as order_id
from movement_ingredient WHERE type_movement='e' GROUP BY date(date_movement), ingredient_id;


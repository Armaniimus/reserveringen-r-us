DROP TABLE IF EXISTS cat;
CREATE TABLE IF NOT EXISTS cat (
    cat_code VARCHAR(10) UNIQUE NOT NULL,
    cat_naam VARCHAR(25),
    PRIMARY KEY (cat_code)
);

INSERT INTO cat
VALUES ('VOG', 'Voorgerechten'),
('HOG', 'Hoofdgerechten'),
('NAG', 'Nagerechten');

DROP TABLE IF EXISTS subcat;
CREATE TABLE IF NOT EXISTS subcat (
    subcat_code VARCHAR(10) UNIQUE NOT NULL,
    cat_code VARCHAR(10),
    cat_naam VARCHAR(25),
    PRIMARY KEY (subcat_code)
);

INSERT INTO subcat
VALUES ('wv-g', 'VOG', 'warme voorgerechten'),
('kv-g', 'VOG', 'koude voorgerechten'),
('os', 'HOG', 'ovenschotels'),
('vl-g', 'HOG', 'vlees gerechten'),
('vi-g', 'HOG', 'vis gerechten');

DROP TABLE IF EXISTS menuitem;
CREATE TABLE IF NOT EXISTS menuitem (
    item_code INT AUTO_INCREMENT UNIQUE NOT NULL,
    subcat_code VARCHAR(10),
    prijs DECIMAL(5,2),
    naam  VARCHAR(65),
    PRIMARY KEY (item_code)
);

INSERT INTO menuitem (subcat_code, prijs, naam)
VALUES ('os', 19.50, 'lasagne'),
('os',   21.40, 'mousaka'),
('vl-g', 15.50, 'biefstuk met champions en sla'),
('vl-g', 12.50, 'spareribs met friet'),
('vi-g', 17.00, 'makreel met friet'),
('vi-g', 26.00, 'kreeft met salade'),
('i',    9.50,  'vanille ijs met chocolade saus'),
('gbk',  15.00, 'appeltaart');

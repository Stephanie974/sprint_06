CREATE TABLE stock vap (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    referenceproduit VARCHAR(100) NOT NULL,
    descriptionproduit TEXT(100) NOT NULL,
    prixachatunitaire FLOAT NOT NULL,
    prixventeunitaire FLOAT NOT NULL,
    quantitstock INT NOT NULL
);
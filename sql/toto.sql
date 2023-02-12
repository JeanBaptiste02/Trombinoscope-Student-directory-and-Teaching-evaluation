CREATE TABLE formation (
nom_formation VARCHAR(255) PRIMARY KEY
);

CREATE TABLE groupe (
nom_groupe VARCHAR(100) NOT NULL,
nom_formation VARCHAR(255) NOT NULL,
PRIMARY KEY (nom_groupe, nom_formation),
FOREIGN KEY (nom_formation) REFERENCES formation (nom_formation)
);

CREATE TABLE enseignants (
    id_ens VARCHAR(255) PRIMARY KEY,
    nom_ens VARCHAR(100) NOT NULL,
    prenom_ens VARCHAR(100) NOT NULL,
    email_ens VARCHAR(255) UNIQUE NOT NULL CHECK (email_ens LIKE '%@cyu.fr'),
    password VARCHAR(100) NOT NULL,
    role VARCHAR(100) NOT NULL
);

CREATE TABLE etudiant (
    num_etu VARCHAR(255) PRIMARY KEY,
    nom_etu VARCHAR(100) NOT NULL,
    prenom_etu VARCHAR(100) NOT NULL,
    email_etu VARCHAR(255) UNIQUE NOT NULL CHECK (email_etu LIKE '%@cyu.fr'),
    groupe VARCHAR(100) NOT NULL,
    formation VARCHAR(100) NOT NULL,
    FOREIGN KEY (groupe, formation) REFERENCES groupe (nom_groupe, nom_formation)

);

CREATE TABLE access_codes (
email_etu VARCHAR(255) NOT NULL,
code VARCHAR(255) UNIQUE NOT NULL,
PRIMARY KEY (email_etu, code),
FOREIGN KEY (email_etu) REFERENCES etudiant (email_etu)
);

INSERT INTO formation(nom_formation) VALUES
('Licence 1 MIPI'),
('Licence 2 Informatique'),
('Licence 3 Informatique');

INSERT INTO groupe(nom_groupe, nom_formation) VALUES
('Groupe A', 'Licence 3 Informatique'),
('Groupe B', 'Licence 3 Informatique'),
('Groupe C', 'Licence 3 Informatique'),
('Groupe D', 'Licence 3 Informatique'),
('Groupe A', 'Licence 2 Informatique'),
('Groupe B', 'Licence 2 Informatique'),
('Groupe C', 'Licence 2 Informatique'),
('Groupe D', 'Licence 2 Informatique'),
('Groupe E', 'Licence 2 Informatique'),
('Groupe A', 'Licence 1 MIPI'),
('Groupe B', 'Licence 1 MIPI'),
('Groupe C', 'Licence 1 MIPI'),
('Groupe D', 'Licence 1 MIPI'),
('Groupe E', 'Licence 1 MIPI'),
('Groupe F', 'Licence 1 MIPI'),
('Groupe G', 'Licence 1 MIPI');

INSERT INTO enseignants (id_ens, nom_ens, prenom_ens, email_ens, password, role) VALUES 
(1, 'Dupont', 'Charles', 'mail1@cyu.fr', 'password1', 'admin'),
(2, 'James', 'Nicolas', 'mail2@cyu.fr', 'password2', 'teacher'),
(3, 'Lamartine', 'Nathan', 'mail3@cyu.fr', 'password3', 'teacher'),
(4, 'Martinez', 'Lisa', 'mail4@cyu.fr', 'password4', 'teacher');


INSERT INTO etudiant (num_etu, nom_etu, prenom_etu, email_etu, groupe, formation) VALUES 
(1, 'Zhang', 'Victor', 'zhang.victoe@cyu.fr', 'Groupe A', 'Licence 3 Informatique'),
(2, 'Elumalai', 'Sriguru', 'elumalai.sriguru@cyu.fr', 'Groupe B', 'Licence 2 Informatique');


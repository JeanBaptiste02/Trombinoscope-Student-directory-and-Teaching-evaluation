Jean-Baptiste DAMODARANE
#3567
ॐ हर हर महादेव ॐ



Salon textuel
Study Buddies:projet-integration
Rechercher

Discussion de projet-integration
29 janvier 2023

वीर मराठा (𝓙𝓑) — 29/01/2023 19:12
donc je sais pas trop

wik — 29/01/2023 19:12
sa me soule la BD, pourquoi il faut demande groupe et formation

वीर मराठा (𝓙𝓑) — 29/01/2023 19:12
je trouve aucune entreprise

wik — 29/01/2023 19:12
et chaque formation à des nombre de groupe different

@wik
et chaque formation à des nombre de groupe different

Sriguru ELUMALAI — 29/01/2023 19:13
oui

@वीर मराठा (𝓙𝓑)
je trouve aucune entreprise

Sriguru ELUMALAI — 29/01/2023 19:13
pareil
[19:14]
ce projet il est vraiment dur

वीर मराठा (𝓙𝓑) — 29/01/2023 19:15
oui
[19:15]
le projet de ziya c'est plus facile à comprendre
[19:16]
ils ont pris 2 mois pour afficher une map qu'on a affiché en 1-2 semaine en L2 (modifié)
[19:16]
on aurait du prendre ce sujet
[19:16]


Sriguru ELUMALAI — 29/01/2023 19:16

[19:17]
sa depend de comment il l'ont afficher mais la map c'est pas un vrai pb c'est apres que les pb commence

वीर मराठा (𝓙𝓑) — 29/01/2023 19:17
oui 

wik — 29/01/2023 19:38
je crois j'ai resolu l'erreur enfin...

Sriguru ELUMALAI — 29/01/2023 19:38
les tables sont creer alors ?

wik — 29/01/2023 19:40
oui
[19:40]
amuse toi

Sriguru ELUMALAI — 29/01/2023 19:40


wik — 29/01/2023 19:45
CREATE TABLE formation (
nom_formation VARCHAR(255) PRIMARY KEY
);

CREATE TABLE groupe (
nom_groupe VARCHAR(100) NOT NULL,
Afficher plus
projetTrombino.sql
3 Ko
[19:46]
et oui je disez que
[19:46]
il faut commence avec le formulaire car c'est le plus simple

wik — 29/01/2023 22:49
blob c'est dure et compliquer

Seed — 29/01/2023 22:53
Oulala elle était longue la journée
[22:54]
Vous bossez encore ?

वीर मराठा (𝓙𝓑) — 29/01/2023 22:55
non
[22:55]
on a fait la BD

Seed — 29/01/2023 22:55
Ok
[22:55]
Moi j'ai bientôt finit le déménagement (modifié)

वीर मराठा (𝓙𝓑) — 29/01/2023 22:55
il nous reste à la faire fonctionner correctement et à implémenter dans le site à travers des formulaires

@Seed
Moi j'ai bientôt finit le déménagement (modifié)

वीर मराठा (𝓙𝓑) — 29/01/2023 22:55
ok c bien

Seed — 29/01/2023 22:56
J'ai passé tout le weekend a faire ça

वीर मराठा (𝓙𝓑) — 29/01/2023 22:56
ah oue chaud

Seed — 29/01/2023 22:56
Demain c'est le dernier jour pour faire le déménagement

wik — 29/01/2023 22:56
ta demenage de saint germain ?

Seed — 29/01/2023 22:57
Non
[22:57]
Mes parents ont vendu le magasin
[22:57]
Du coup ils emménagent a la maison
[22:58]
Genre mes parents habitent au dessus du magasin et mes sœurs et moi a la maison
[22:59]
C'est pour ça que je peux regarder des séries jusqu'à quatre heures du matin sans déranger personne

1

वीर मराठा (𝓙𝓑) — 29/01/2023 22:59
du coup y'a plus de restaurant ?

Seed — 29/01/2023 22:59
Y en a plus oui

वीर मराठा (𝓙𝓑) — 29/01/2023 22:59
ok

@Seed
C'est pour ça que je peux regarder des séries jusqu'à quatre heures du matin sans déranger personne

wik — 29/01/2023 23:00

Seed — 29/01/2023 23:00
Mais du coup quand on fera des vocals plus tard je pourrais plus ouvrir le mic
[23:01]
Comme mes parents seront
[23:01]
Présent

वीर मराठा (𝓙𝓑) — 29/01/2023 23:02
ok ça sera dommage

Seed — 29/01/2023 23:02
Un peu oui

Envoyer un message dans #projet-integration
﻿




 pour sélectionner
Liste des membres pour projet-integration (salon)
EN LIGNE, 2 MEMBRESEN LIGNE — 2

Jockie Music
BOT
Écoute m!help

वीर मराठा (𝓙𝓑)
ॐ हर हर महादेव ॐ
HORS LIGNE, 3 MEMBRESHORS LIGNE — 3

Seed

Sriguru ELUMALAI

wik
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
('Licence 3 Informatique'),
('Licence 2 Informatique'),
('Licence 1 MIPI');

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
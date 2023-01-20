CREATE TABLE Etudiant(
	num_etu varchar(30) PRIMARY KEY;
	nom_etu varchar(50) NOT NULL;
	prenom_etu varchar(50) NOT NULL;
	mail_etu varchar(50) NOT NULL;
	mdp_etu varchar(20) NOT NULL;
	formation_etu varchar(50) NOT NULL;
	grpCM_etu varchar(2) NOT NULL;
	grpTD_etu varchar(2) NOT NULL;
	photo_etu blob NOT NULL;
);

CREATE TABLE Professeur(
	num_prof varchar(30) PRIMARY KEY;
	nom_prof varchar(50) NOT NULL;
	prenom_prof varchar(50) NOT NULL;
	mail_prof varchar(50) NOT NULL;
	mdp_prof varchar(20) NOT NULL;
	dpt_prof varchar(2) NOT NULL;
	FOREIGN KEY (num_etu) REFERENCES Etudiant(num_etu);
	photo_etu blob;
);	


Etudiant  (num_etu, nom_etu, prenom_etu, mail_etu, dpt_etu, formation_etu, grpCM_etu,  grpTD_etu,  photo_etu)
Professeur(num_prof, nom_prof, prenom_prof, mail_prof, dpt_prof, #grpTD_etu, #grpCMetu)



SELECT * FROM Etudiant
WHERE mail_etu LIKE '%@cyu.fr';

SELECT * FROM Prof
WHERE mail_etu LIKE '%@cyu.fr';
CREATE DATABASE IF NOT EXISTS Projet_IO2;

USE Projet_IO2;

CREATE TABLE IF NOT EXISTS users (
    id_user INT(11) NOT NULL AUTO_INCREMENT,
    privilege INT (11) NOT NULL,
    prenom VARCHAR(70) NOT NULL,
    nom VARCHAR(70) NOT NULL,
    pseudo VARCHAR(70) NOT NULL,
    email VARCHAR(70) NOT NULL,
    password VARCHAR(70) NOT NULL,
    anniversaire DATE NOT NULL,
    sexe VARCHAR(10) NOT NULL,
    date_inscription DATETIME NOT NULL,
    pp VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_user)

)CHARSET=utf8;   

CREATE TABLE IF NOT EXISTS publications (
    id_pub INT(11) NOT NULL AUTO_INCREMENT,
    user INT(11) NOT NULL,
    date DATETIME NOT NULL,
    contenu TEXT,
    image VARCHAR(11),
    commentaire INT(11) NOT NULL,
    PRIMARY KEY (id_pub)
)CHARSET=utf8;

CREATE TABLE IF NOT EXISTS privileges (
    id_privilege INT(1) NOT NULL,
    privileges VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_privilege)
) CHARSET=utf8;

INSERT INTO privileges (id_privilege,privileges) VALUES (0, 'Normal');
INSERT INTO privileges (id_privilege,privileges) VALUES (1, 'Admin');

CREATE TABLE IF NOT EXISTS friends (
    id_ami INT(11) NOT NULL AUTO_INCREMENT,
    demandeur INT(11) NOT NULL,
    demandé INT(11) NOT NULL,
    date DATE NOT NULL,
    etat INT(11) NOT NULL,
    PRIMARY KEY (id_ami),
)CHARSET=utf8;
CREATE DATABASE IF NOT EXISTS SocialNetwork;

USE SocialNetwork;

CREATE TABLE IF NOT EXITS users (
  id_user INT(11) NOT NULL AUTO_INCREMENT,
  privilege INT(11) NOT NULL,
  prenom VARCHAR(70) NOT NULL,
  nom VARCHAR (70) NOT NULL,
  pseudo VARCHAR(70) NOT NULL,
  email VARCHAR(70) NOT NULL,
  password VARCHAR(70) NOT NULL,
  anniversaire DATE NOT NULL,
  sexe VARCHAR(70) NOT NULL,
  date_inscription DATETIME NOT NULL,
  pp VARCHAR (200) NOT NULL,
  PRIMARY KEY (id_user)
)CHARSET=utf8;

CREATE TABLE IF NOT EXISTS publications (
  id_pub INT(11) NOT NULL AUTO_INCREMENT,
  author INT(11) NOT NULL,
  date_pub DATETIME NOT NULL,
  contenu TEXT,
  image VARCHAR(70),
  commentaire INT(11) NOT NULL,
  PRIMARY KEY (id_pub)
)CHARSET=utf8;

CREATE TABLE IF NOT EXISTS privileges (
  id_privilege INT(1) NOT NULL,
  privilege VARCHAR(70) NOT NULL,
  PRIMARY KEY (id_privilege)
)CHARSET=utf8;

INSERT INTO privileges (id_privilege,privilege) VALUES (0,'Normal');
INSERT INTO privileges (id_privilege,privilege) VALUES (1,'Admin');

CREATE TABLE IF NOT EXIsTS friends (
  id_friend INT(11) NOT NULL AUTO_INCREMENT,
  applicant INT(11) NOT NULL,
  asked INT(11) NOT NULL,
  date_request DATE NOT NULL,
  etat INT(11) NOT NULL,
  PRIMARY KEY (id_friend)
)CHARSET=utf8;

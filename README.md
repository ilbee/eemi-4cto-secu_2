# EEMI Cours 4CTO - Cyber Sécurité

## 1 - /app
Cette application permet de comprendre comment réaliser une fuite de données en exploitant une injection SQL.

Voici la structure de la base de données utilisée : 
``` sql
CREATE DATABASE IF NOT EXISTS `secu`;

USE `secu`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `last_login_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `last_login_at`) VALUES
	(8, 'superman@lol.fr', '827ccb0eea8a706c4c34a16891f84e7b', NOW(), NOW()),
	(4, 'amina@lol.fr', '5d9cc902d4187c5bee3bd85822eedc9e', NOW(), NOW()),
	(5, 'thomas@lol.fr', 'f47ce3067bf114190f84ec6a2ec8e71c', NOW(), NOW()),
	(6, 'corentin@lol.fr', '7682fe272099ea26efe39c890b33675b', NOW(), NOW()),
	(7, 'patou@prison.com', 'f32ace8357b6e57f80eac02d71887efd', NOW(), NOW()),
	(9, 'mathieu@lol.fr', '4d4098d64e163d2726959455d046fd7c', NOW(), NOW()),
	(10, 'chloe@lol.fr', '721a9b52bfceacc503c056e3b9b93cfa', NOW(), NOW()),
	(11, 'henri@lol.fr', '48bb6e862e54f2a795ffc4e541caed4d', NOW(), NOW()),
	(12, 'test@test.com', 'e10adc3949ba59abbe56e057f20f883e', NOW(), NOW()),
	(13, 'nom@bril.com', '98e7add4957bd4b799efb07fe0894cca', NOW(), NOW()),
	(14, 'oui@gmail.com', '6712f4bb23e1c5f20f97bcce78c13320', NOW(), NOW()),
```

## 2 - /crack
Cette application permet de déchiffrer le mot de passe de l'utilisateur en utilisant 2 méthodes : 
- Brute Force
  - Le brute force consiste à essayer toutes les combinaisons possibles de mots de passe en utilisant la fonction `md5` de PHP afin d'identifier le bon mot de passe que nous avons récupéré en réalisant le data leak sur le /app.
- Dictionary
  - Le mode dictionnaire consiste à utiliser un dictionnaire de mots de passe pour essayer de déchiffrer le mot de passe. Dans notre exemple nous avons utilisé le dictionnaire de **rockyou.txt** qui contient plus de 14 000 000 de mots de passe.

### 2.1 - Comment utiliser le script brute force ?
``` ssh
cd ./crack/
php ./brute_force.php HASH_MD5
```

### 2.2 - Comment utiliser le script dictonnaire ?
``` ssh
cd ./crack/
php ./dictionary.php HASH_MD5
```
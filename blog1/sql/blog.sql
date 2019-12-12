CREATE DATABASE `blog`
	DEFAULT CHARACTER SET utf8;

USE blog;

CREATE TABLE `users` (
	`id` INT NOT NULL UNIQUE AUTO_INCREMENT,
	`name` VARCHAR(20) NOT NULL UNIQUE,
	`email` VARCHAR(255) NOT NULL UNIQUE,
	`password` VARCHAR(255) NOT NULL,
	`register_date` DATETIME NOT NULL,
	`active` TINYINT NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE entries (
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	id_author INT NOT NULL,
	title VARCHAR(255) NOT NULL,
	url TINYTEXT NOT NULL;
	content TEXT CHARACTER SET utf8 NOT NULL,
	created_date DATETIME NOT NULL,
	active TINYINT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(id_author)
		REFERENCES users(id)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
);

CREATE TABLE comments (
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	id_author INT NOT NULL,
	id_entry INT NOT NULL,
	title VARCHAR(255) NOT NULL,
	content TEXT CHARACTER SET utf8 NOT NULL,
	register_date DATETIME NOT NULL,
	active TINYINT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(id_author)
		REFERENCES users(id)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	FOREIGN KEY(id_entry)
		REFERENCES entries(id)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
);

CREATE TABLE password_recovery (
		id INT NOT NULL UNIQUE AUTO_INCREMENT,
		id_user INT NOT NULL,
		secret_url VARCHAR(255) NOT NULL,
		created_date DATETIME NOT NULL,
		PRIMARY KEY(id),
		FOREIGN KEY(id_user)
			REFERENCES users(id)
			ON UPDATE CASCADE
			ON DELETE RESTRICT
);
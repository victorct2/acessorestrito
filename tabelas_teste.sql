
CREATE TABLE `tipo_arquivo` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`descricao` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`Ativa` CHAR(1) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`id`) USING BTREE
)







CREATE TABLE `cooperado_arquivo` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_user` INT(11) NOT NULL,
	`id_arquivo` INT(11) NOT NULL,
	PRIMARY KEY (`id`) USING BTREE
);

CREATE TABLE `arquivo_upload` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`nome_arquivo` VARCHAR(250) NOT NULL COLLATE 'utf8_general_ci',
	`tipo_arquivo` INT(4) NOT NULL,
	`arquivo` VARCHAR(150) NOT NULL COLLATE 'utf8_general_ci',
	`Descricao` VARCHAR(25) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`Data_cadastro` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	`individual` ENUM('S','N') NULL DEFAULT 'S' COLLATE 'utf8_general_ci',
	PRIMARY KEY (`id`) USING BTREE
)

CREATE TABLE `avisos` (
	`descricao` TEXT NULL DEFAULT NULL COLLATE ,
	`sinopse` VARCHAR(250) NULL DEFAULT NULL COLLATE ,
	`descricao_completa` TEXT NULL DEFAULT NULL COLLATE ,
	`link` VARCHAR(255) NULL DEFAULT NULL COLLATE ,
	`friendly_url` TEXT NULL DEFAULT NULL COLLATE ,
	`alinfile` ENUM('E','D') NOT NULL DEFAULT 'E' COLLATE ,
	`dia` DATE NULL DEFAULT NULL,
	`periodo` SMALLINT(6) NULL DEFAULT NULL,
	`releaseNoticia` ENUM('N','R','NR') NULL DEFAULT NULL COLLATE ,
	`ativa` CHAR(1) NULL DEFAULT NULL COLLATE ,
	`site_novo` ENUM('S','N') NULL DEFAULT NULL COLLATE ,
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`releaseAviso` ENUM('Y','N') NULL DEFAULT NULL COLLATE ,
	PRIMARY KEY (`id`) USING BTREE

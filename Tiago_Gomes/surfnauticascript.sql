
CREATE SCHEMA IF NOT EXISTS `surfnautica2` DEFAULT CHARACTER SET utf8mb4 ;
USE `surfnautica2` ;

DROP TABLE IF EXISTS `atividades_professor`;
DROP TABLE IF EXISTS  `pranchas` ;
DROP TABLE IF EXISTS  `equipamentos`;
DROP TABLE IF EXISTS  `parcerias`;
DROP TABLE IF EXISTS  `contactos`;
DROP TABLE IF EXISTS  `noticias` ;
DROP TABLE IF EXISTS  `professor`;
DROP TABLE IF EXISTS  `utilizadores`;
DROP TABLE IF EXISTS  `atividades`;

CREATE TABLE `atividades` (
  `id_atividades` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(20) NOT NULL,
  `descricao` TEXT NOT NULL,
  `data` DATE NOT NULL,
  `hora` DATE NOT NULL,
  `foto` VARCHAR(45) NULL,
  PRIMARY KEY (`id_atividades`)
  ) ENGINE = InnoDB;

CREATE TABLE `utilizadores` (
  `id_utilizadores` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `nivel_acesso` ENUM('P', 'A', 'N') NOT NULL,
  `foto` VARCHAR(45) NULL,
  PRIMARY KEY (`id_utilizadores`)
  )ENGINE = InnoDB;

CREATE TABLE `professor` (
  `id_professor` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `idade` INT NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `id_utilizadoresfk` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_professor`, `id_utilizadoresfk`),
  FOREIGN KEY (`id_utilizadoresfk`) REFERENCES `utilizadores` (`id_utilizadores`)
  )ENGINE = InnoDB;

CREATE TABLE `noticias` (
  `id_noticias` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  `data` DATE NOT NULL,
  `foto` VARCHAR(45) NULL,
  `id_utilizadoresfk` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_noticias`, `id_utilizadoresfk`),
  FOREIGN KEY (`id_utilizadoresfk`) REFERENCES `utilizadores` (`id_utilizadores`)
  )ENGINE = InnoDB;

CREATE TABLE `contactos` (
  `id_contactos` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `topico` VARCHAR(45) NOT NULL,
  `descricao` TEXT NOT NULL,
  `id_utilizadoresfk` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_contactos`, `id_utilizadoresfk`),
  FOREIGN KEY (`id_utilizadoresfk`) REFERENCES `utilizadores` (`id_utilizadores`)
)ENGINE = InnoDB;

CREATE TABLE `parcerias` (
  `id_parcerias` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `img` VARCHAR(45) NULL,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` TEXT NOT NULL,
  PRIMARY KEY (`id_parcerias`)
)ENGINE = InnoDB;

CREATE TABLE `equipamentos` (
  `id_equipamentos` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` TEXT NOT NULL,
  `id_parcerias` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_equipamentos`, `id_parcerias`),
 FOREIGN KEY (`id_parcerias`)
    REFERENCES `parcerias` (`id_parcerias`)
)ENGINE = InnoDB;


CREATE TABLE `pranchas` (
  `id_pranchas` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `id_parcerias` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_pranchas`, `id_parcerias`),
  FOREIGN KEY (`id_parcerias`)
    REFERENCES `parcerias` (`id_parcerias`)
)ENGINE = InnoDB;

CREATE TABLE `atividades_professor` (
  `atividades_id_atividades` INT UNSIGNED NOT NULL,
  `professor_id_professor` INT UNSIGNED NOT NULL,
  `responsavel` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`atividades_id_atividades`, `professor_id_professor`),
   FOREIGN KEY (`atividades_id_atividades`) REFERENCES `atividades` (`id_atividades`),
   FOREIGN KEY (`professor_id_professor`) REFERENCES `professor` (`id_professor`)
)ENGINE = InnoDB;


CREATE VIEW `atividades_horas` AS SELECT `atividades`.`titulo` AS `titulo`, `atividades`.`descricao` AS `descricao`, `atividades`.`hora` AS `hora` FROM `atividades`;
CREATE VIEW `equip_ver` AS SELECT `equipamentos`.`id_equipamentos` AS `id_equipamentos`, `equipamentos`.`nome` AS `nome`, `equipamentos`.`descricao` AS `descricao`, `equipamentos`.`id_parcerias` AS `id_parcerias` FROM `equipamentos`;
CREATE VIEW `noticia_v` AS SELECT `noticias`.`titulo` AS `titulo`, `noticias`.`descricao` AS `descricao` FROM `noticias`;
CREATE VIEW `pranchas_idparcerias` AS SELECT `pranchas`.`id_pranchas` AS `id_pranchas`, `pranchas`.`nome` AS `nome`, `pranchas`.`id_parcerias` AS `id_parcerias` FROM `pranchas`;
CREATE VIEW `user_niv` AS SELECT `utilizadores`.`nome` AS `nome`, `utilizadores`.`nivel_acesso` AS `nivel_acesso` FROM `utilizadores`;

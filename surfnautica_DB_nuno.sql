CREATE SCHEMA IF NOT EXISTS `surfnautica` DEFAULT CHARACTER SET latin1 ;
USE `surfnautica` ;


CREATE TABLE IF NOT EXISTS `surfnautica`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(50) NOT NULL,
  `nome` VARCHAR(50) NOT NULL,
  `pass` VARCHAR(250) NOT NULL,
  `permission` INT(11) NOT NULL default 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


CREATE TABLE IF NOT EXISTS `surfnautica`.`professor` (
  `id_prof` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `foto` VARCHAR(50) NULL DEFAULT NULL,
  `id` INT(11) NOT NULL,
  PRIMARY KEY (`id_prof`),
  INDEX `fk_professor_users_idx` (`id` ASC),
  CONSTRAINT `fk_professor_users`
    FOREIGN KEY (`id`)
    REFERENCES `surfnautica`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


CREATE TABLE IF NOT EXISTS `surfnautica`.`aulas` (
  `id_aula` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(50) NOT NULL,
  `data` DATETIME NOT NULL,
  `id_prof` INT(11) NOT NULL,
  PRIMARY KEY (`id_aula`),
  INDEX `fk_aulas_professor1_idx` (`id_prof` ASC),
  CONSTRAINT `fk_aulas_professor1`
    FOREIGN KEY (`id_prof`)
    REFERENCES `surfnautica`.`professor` (`id_prof`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


CREATE TABLE IF NOT EXISTS `surfnautica`.`diaaberto` (
  `id_diaAberto` INT(11) NOT NULL AUTO_INCREMENT,
  `data` DATETIME NOT NULL,
  `id_prof` INT(11) NOT NULL,
  PRIMARY KEY (`id_diaAberto`),
  INDEX `fk_diaaberto_professor1_idx` (`id_prof` ASC),
  CONSTRAINT `fk_diaaberto_professor1`
    FOREIGN KEY (`id_prof`)
    REFERENCES `surfnautica`.`professor` (`id_prof`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


CREATE TABLE IF NOT EXISTS `surfnautica`.`parcerias` (
  `id_parceria` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `descricao` VARCHAR(50) NOT NULL,
  `foto` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`id_parceria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


CREATE TABLE IF NOT EXISTS `surfnautica`.`equipamentos` (
  `id_equipa` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `descricao` VARCHAR(250) NOT NULL,
  `foto` VARCHAR(50) NULL DEFAULT NULL,
  `id_parceria` INT(11) NOT NULL,
  PRIMARY KEY (`id_equipa`),
  INDEX `fk_equipamentos_parcerias1_idx` (`id_parceria` ASC),
  CONSTRAINT `fk_equipamentos_parcerias1`
    FOREIGN KEY (`id_parceria`)
    REFERENCES `surfnautica`.`parcerias` (`id_parceria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


CREATE TABLE IF NOT EXISTS `surfnautica`.`pranchas` (
  `id_prancha` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `descricao` VARCHAR(250) NOT NULL,
  `foto` VARCHAR(50) NOT NULL,
  `id_parceria` INT(11) NOT NULL,
  PRIMARY KEY (`id_prancha`),
  INDEX `fk_pranchas_parcerias1_idx` (`id_parceria` ASC),
  CONSTRAINT `fk_pranchas_parcerias1`
    FOREIGN KEY (`id_parceria`)
    REFERENCES `surfnautica`.`parcerias` (`id_parceria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


CREATE TABLE IF NOT EXISTS `surfnautica`.`sobre` (
  `id_sobre` INT(11) NOT NULL AUTO_INCREMENT,
  `foto` VARCHAR(50) NULL DEFAULT NULL,
  `id_parceria` INT(11) NOT NULL,
  PRIMARY KEY (`id_sobre`),
  INDEX `fk_sobre_parcerias1_idx` (`id_parceria` ASC),
  CONSTRAINT `fk_sobre_parcerias1`
    FOREIGN KEY (`id_parceria`)
    REFERENCES `surfnautica`.`parcerias` (`id_parceria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


CREATE TABLE IF NOT EXISTS `surfnautica`.`contacto` (
  `id_cont` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(50) NOT NULL,
  `nome` VARCHAR(50) NOT NULL,
  `assunto` VARCHAR(50) NOT NULL,
  `mensagem` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id_cont`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


CREATE TABLE IF NOT EXISTS `surfnautica`.`noticia` (
  `id_not` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(50) NOT NULL,
  `descricao` VARCHAR(250) NOT NULL,
  `data` DATETIME NOT NULL,
  `foto` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`id_not`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;



SELECT * FROM users order by permission DESC;
INSERT INTO users (email, nome, pass,permission) VALUES ('admin@gmail.com', 'admin', '$2a$04$jjMVG5tB3b7VOu3icp7Ej.hDaywgE4zBCnZe83V3eXyB/q3rCw/8O','2');
INSERT INTO users (email, nome, pass,permission) VALUES ('nuno@gmail.com', 'Nuno', '$2a$04$YJNRyb32svEsFWrj1kbweudlHMFCSGV3sJkd2U2uGKm//gURKHTiK','0');
INSERT INTO users (email, nome, pass,permission) VALUES ('tn10@gmail.com', 'Toino', '$2a$04$5hmIH2FZWV4R81t8odsDHOU32roEqiEWdYX7IU5K3XwYBhhwBq.ye','0');
INSERT INTO users (email, nome, pass,permission) VALUES ('ricardo2020@gmail.com', 'Ricardo', '$2a$04$auR6aG2S0s3Se1sE7KvxZuWjkKX7n1LTYIxnHTaj8viBlci4N/7eu','1');

SELECT * FROM professor;
INSERT INTO professor (email, nome, foto,id) VALUES ('ricardo2020@gmail.com', 'Ricardo', 'foto_prof','4');

SELECT * FROM aulas;
INSERT INTO aulas (titulo, data, id_prof) VALUES ('Aula de Surf', '2023-05-14 09:00:00','1');
INSERT INTO aulas (titulo, data, id_prof) VALUES ('Aula de Surf', '2023-05-14 15:00:00','1');
INSERT INTO aulas (titulo, data, id_prof) VALUES ('Aula de Surf', '2023-05-21 11:00:00','1');

SELECT * FROM parcerias;
INSERT INTO parcerias (nome, descricao) VALUES ('SurFoz', 'Loja de venda de equipamentos');
INSERT INTO parcerias (nome, descricao) VALUES ('Billabong', 'Loja de venda de equipamentos de surf');
INSERT INTO parcerias (nome, descricao) VALUES ('Hurley', 'Loja de venda de equipamentos e roupa');
INSERT INTO parcerias (nome, descricao) VALUES ('Rip Curl', 'Loja de venda de equipamentos pranchas e roupa');

SELECT * FROM contacto;
INSERT INTO contacto (email, nome, assunto,mensagem) VALUES ('nuno@gmail.com', 'Nuno', 'Aulas Abertas','Queria saber quando vai haver aulas abertas e a que horas');

create view nome_user as select nome from users;
create view email_user as select email from users;
create view prof as select * from professor;
create view aula as select titulo, data from aulas;
create view all_parcerias as select nome from parcerias;

DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `professor`;
DROP TABLE IF EXISTS `aulas`;
DROP TABLE IF EXISTS `diaaberto`;
DROP TABLE IF EXISTS `parcerias`;
DROP TABLE IF EXISTS `equipamentos`;
DROP TABLE IF EXISTS `pranchas`;
DROP TABLE IF EXISTS `sobre`;
DROP TABLE IF EXISTS `contacto`;
DROP TABLE IF EXISTS `noticia`;
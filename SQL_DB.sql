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
  `foto` VARCHAR(50),
  `especialidade` VARCHAR(70) NOT NULL,
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
  `data1` timestamp NOT NULL,
  `horas` VARCHAR(50) NOT NULL,
  `foto` VARCHAR(250),
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
  `titulo` VARCHAR(50) NOT NULL,
  `data1` timestamp NOT NULL,
  `horas` VARCHAR(50) NOT NULL,
  `foto` VARCHAR(250),
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
  `descricao` VARCHAR(250) NOT NULL,
  `img` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id_parceria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


CREATE TABLE IF NOT EXISTS `surfnautica`.`equipamentos` (
  `id_equipa` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `descricao` VARCHAR(250) NOT NULL,
  `img` VARCHAR(250) NOT NULL,
  `data_pub` timestamp default current_timestamp,
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
  `foto` VARCHAR(250),
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
  `foto` VARCHAR(50),
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
  `foto` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_not`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


INSERT INTO users (email, nome, pass, permission) VALUES ('user1@example.com', 'João Silva', 'senha123', 1);
INSERT INTO users (email, nome, pass, permission) VALUES ('user2@example.com', 'Maria Santos', 'abc456', 1);
INSERT INTO users (email, nome, pass, permission) VALUES ('user3@example.com', 'Pedro Costa', 'qwerty', 1);


INSERT INTO professor (nome, email, foto, especialidade, id) 
VALUES ('João Silva', 'joao@example.com', 'foto1.jpg', 'Surfista Profissional', 1);
INSERT INTO professor (nome, email, foto, especialidade, id) 
VALUES ('Maria Santos', 'maria@example.com', 'foto2.jpg', 'Surfista Instrutora', 2);
INSERT INTO professor (nome, email, foto, especialidade, id) 
VALUES ('Pedro Costa', 'pedro@example.com', 'foto3.jpg', 'Surfista Competitivo', 3);

insert into equipamentos (nome, descricao, img, id_parceria) values ('Fatos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'yyy.jpg', 1);
insert into parcerias (nome, descricao, img) values ('RipCurl', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'www.jpg');

INSERT INTO diaaberto (titulo, data1, horas, id_prof) 
VALUES ('Terças', '2023-07-16 00:00:00', '17h-18h', 4);
INSERT INTO diaaberto (titulo, data1, horas, id_prof) 
VALUES ('Quintas', '2023-07-18 00:00:00', '17h-18h', 5);
INSERT INTO diaaberto (titulo, data1, horas, id_prof) 
VALUES ('Sábado', '2023-07-20 00:00:00', '17h-18h', 6);

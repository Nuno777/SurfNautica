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
  `nome` VARCHAR(250) NOT NULL,
  `descricao` VARCHAR(1500) NOT NULL,
  `img` VARCHAR(250),
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
  `nome` VARCHAR(250) NOT NULL,
  `descricao` VARCHAR(1500) NOT NULL,
  `img` VARCHAR(250),
  `data_pub` timestamp default current_timestamp,
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
  `resposta` VARCHAR(250),
  PRIMARY KEY (`id_cont`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


CREATE TABLE IF NOT EXISTS `surfnautica`.`noticia` (
  `id_not` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(50) NOT NULL,
  `descricao` VARCHAR(250) NOT NULL,
  `data_not` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_not`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


INSERT INTO users (email, nome, pass, permission) VALUES ('user1@example.com', 'João Silva', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 0);
INSERT INTO users (email, nome, pass, permission) VALUES ('user2@example.com', 'Maria Santos', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 0);
INSERT INTO users (email, nome, pass, permission) VALUES ('user3@example.com', 'Pedro Costa', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 0);
INSERT INTO users (email, nome, pass, permission) VALUES ('admin@gmail.com', 'Admin', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1);


INSERT INTO professor (nome, email, foto, especialidade, id) 
VALUES ('João Silva', 'joao@example.com', 'foto1.jpg', 'Surfista Profissional', 1);
INSERT INTO professor (nome, email, foto, especialidade, id) 
VALUES ('Maria Santos', 'maria@example.com', 'foto2.jpg', 'Surfista Instrutora', 2);
INSERT INTO professor (nome, email, foto, especialidade, id) 
VALUES ('Pedro Costa', 'pedro@example.com', 'foto3.jpg', 'Surfista Competitivo', 3);

insert into parcerias (nome, descricao, img) values ('RipCurl', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'www.jpg');

insert into equipamentos (nome, descricao, img, id_parceria) values ('Fato', 'Apesar de muitos surfistas negligenciarem o uso de roupas adequadas, esse aspecto também é muito relevante para a segurança, principalmente em relação à temperatura da água.Uma boa wetsuit (roupa de borracha ou neoprene) é essencial para surfar em águas frias, pois esse tipo de roupa deixa o corpo do surfista mais protegido e evita, por exemplo, a ocorrência de uma hipotermia. Já quando a água está com uma temperatura mais elevada e o sol está muito forte, o indicado é combinar o uso de uma bermuda bastante confortável com uma camiseta de lycra que deixe o surfista protegido da radiação solar.', 'qedhb2hbb3b4.jpg', 1);
insert into equipamentos (nome, descricao, img, id_parceria) values ('Leach', 'Este é um equipamento essencial para o surf. A leash nada mais é que aquela corda que fica com uma ponta fixada à prancha e a outra presa ao tornozelo do surfista. As principais funções da leash são evitar que o surfista perca o contato com a sua prancha e auxiliá-lo no retorno para cima dela após uma queda.', 'y2u23g44h3h1b312.jpg', 1);
insert into equipamentos (nome, descricao, img, id_parceria) values ('Prancha', 'A prancha é a grande estrela do surf, tanto que alguns surfistas não a consideram apenas um equipamento para o surf, mas uma companheira inseparável. E isso é compreensível, afinal, ela é o elo entre o surfista e a água. O material mais comum na composição das pranchas é o poliuretano, sendo que existem três variações principais em relação ao tamanho: Shortboard, Funboard e Longboard. Em relação à segurança, é sempre bom dar uma analisada na prancha antes de cair na água, pois se ela estiver amassada ou quebrada, o surfista fica mais sujeito a acidentes. Além disso, ter uma boa capa para prancha é fundamental para manter a parceira bem protegida quando não estiver dentro da água.', 'dasd76a8dasdad7d.jpg', 1);
insert into equipamentos (nome, descricao, img, id_parceria) values ('Parafina e decks', 'Como o surf é um esporte praticado dentro d’água e que exige a realização de alguns movimentos rápidos, os praticantes estão sujeitos a sofrerem escorregões. E é exatamente por isso que o uso da parafina e dos decks é tão relevante. No caso da parafina, que é mais utilizada na parte frontal das pranchas, por ser um material que gera mais adesão, a sola dos pés do surfista fica bastante fixada à prancha, evitando escorregões e quedas. Já os decks, que são colocados na parte traseira da prancha, como são feitos de borracha antiderrapante, fazem com que o pé do surfista esteja sempre bem fixo e os movimentos possam ser realizados com mais segurança.', 'das5da5dsa78adda5.jpg', 1);

insert into pranchas (nome, descricao, img, id_parceria) values ('Longboard', 'A Longboard é a prancha de surf do início de tudo. Quando o surf começou a se propagar pelo mundo, predominavam essas pranchas maiores. Mas se engana quem acha que as Longboards estão fora de moda! Elas dão tamanha estabilidade ao surfista que permitem um estilo de surf único: suave e muito elegante. Também é possível surfar em alta performance com a longboard, tanto é que existe um circuito da WSL voltado a essa modalidade. A Longboard é uma prancha ótima para quem está começando. Essa prancha de surf dá confiança ao surfista iniciante, pois lhe dá mais tempo para formar a base. A Longboard absorve os impactos das ondas, e faz com que o surfista mergulhe nessa experiência de forma gradual, assimilando pouco a pouco as inúmeras variáveis existentes na hora de surfar. São ideais para ondas mais longas e cheias. Nos modelos mais clássicos de Longboard, o fundo é pouco curvado (chamado de fundo “flat”). Isso dá tanta segurança que permite ao surfista andar sobre a prancha, tornando o surf clássico ainda mais estiloso. O surf com a Longboard oferece uma infinidade de manobras a quem já desenvolveu bastante as técnicas. É possível fazer movimentos próprios da Longboard, como o “Hang Five” (posicionar um pé na frente da prancha e esticar o outro, mantendo-o no ar), o “Hang Ten” (posicionar os dois pés na frente da prancha) e os passos cruzados. Além disso, os surfistas que dominam essa prancha de surf com maestria são capazes até de realizar manobras típicas de pranchas menores!', 'da83ydnf83hrifgw.jpg', 1);
insert into pranchas (nome, descricao, img, id_parceria) values ('Shortboard', 'A Shortboard é usada pelos profissionais super famosos, nos maiores campeonatos de surf do mundo. Ela revolucionou o surf, passando a permitir aos surfistas movimentos mais radicais. É uma prancha de surf pequena e ágil, que facilita a execução de manobras. Suas bordas são pouco espessas. Além de deixar a prancha mais leve, esse tipo de borda reduz a flutuação. Apesar de tirar a estabilidade e exigir muita força na remada, faz com que o surfista entre mais na onda, para fazer as famosas “rasgadas”. Depois de um bom tempo de treino e do desenvolvimento das técnicas avançadas de surf, o surfista pode sentir a pranchinha em todo o seu potencial. Quando isso acontece, ela percorre a onda muito livremente, abrindo possibilidades para vários tipos de movimentos. A Shortboard é bem versátil, adaptável a vários tipos de onda. Porém, por ser instável e não boiar tão facilmente, é uma prancha que exige um nível de surf avançado. Assim, a performance ideal da Shortboard acontece em ondas rápidas e fortes, que dão velocidade à prancha de surf.', 'd8djf9dd9fhah.jpg', 1);
insert into pranchas (nome, descricao, img, id_parceria) values ('Funboard', 'A Funboard é uma prancha boa tanto para iniciantes com alguma experiência como para intermediários. Podemos dizer que é uma boa prancha de surf  para fazer a transição entre a Longboard e a Shortboard, pois combina as características de ambas. Também conhecida como Malibu, a Funboard não é tão extensa quanto a Longboard, o que possibilita a introdução a algumas manobras. Ao mesmo tempo, ela é bastante espessa, propicia um bom volume. Esses atributos dão estabilidade ao surfista iniciante, para que ele tenha confiança ao pegar as primeiras ondas. Por causa dessas características, a Funboard permite ao surfista realizar manobras sem muito esforço físico, diferentemente da Pranchinha, que exige um preparo maior. Outra vantagem da Funboard é a sua versatilidade, ou seja, a capacidade de se adaptar a um bom número de ondas.', 'b50412a009fbf720.jpg', 1);
insert into pranchas (nome, descricao, img, id_parceria) values ('Fish', 'As pranchas Fish são ideais para ondas pequenas e médias, e podem ser um tipo de prancha excelente para surfistas de intermediários a avançados que estão buscando mais ousadia em suas manobras. Seu tamanho é intermediário entre a Funboard e a Shortboard. Sua característica mais marcante é a rabeta que normalmente é swallow (parecido com formato de rabo de peixe), além de serem mais largas e espessas que a Shortboard. Essas características dão mais estabilidade ao surfista, em razão de um volume maior. Além disso, são pranchas mais rápidas, deslizando naturalmente pelas ondas. Por isso, essa prancha de surf é ideal para ondas que não são tão pequenas mas permitem que o surfista fique bastante tempo na onda.', 'da7da8d7ad5ad45.jpg', 1);
insert into pranchas (nome, descricao, img, id_parceria) values ('Evolution ', 'São pranchas de surf intermediárias entre a Shortboard e a Funboard. Elas são mais volumosas que a Pranchinha, garantindo ao surfista estabilidade e facilidade na remada. Porém, não são tão longas quanto a Funboard, possibilitando uma amplitude maior de manobras. O bico da Evolution se parece com o da Funboard, e a rabeta é mais semelhante à da Pranchinha. É uma prancha bastante versátil, considerada um bom próximo passo para o surfista iniciante que quer experimentar coisas além da Funboard. A Evolution é mais uma etapa na transição gradual da Longboard para a Shortboard. Ela é um pouco mais próxima da Pranchinha, pois já possibilita uma gama maior de manobras a quem está trilhando o caminho do surf.', '20191114090122.jpg', 1);
insert into pranchas (nome, descricao, img, id_parceria) values ('Gun', 'A prancha Gun é uma prancha bem longa, estreita e com o bico extremamente pontudo. São pranchas de ondas grandes. Elas são estáveis e fáceis de remar, para que o surfista possa entrar rapidamente na onda. A estabilidade dessa prancha de surf é combinada com a velocidade. Essas duas características, juntas, permitem ao surfista encarar as ondas grandes com o controle necessário para se manter em pé. Conhecida também como “Gunzeira” não é uma prancha de surf para iniciantes. Ela só não é mais radical do que as pranchas Tow-In, utilizadas no surf de ondas gigantes, como em Nazaré. Essa prática é feita com o auxílio de jet-skis. Esses são os principais tipos de prancha de surf! Agora, você já tem uma boa ideia de qual delas melhor se encaixa com o seu estilo e nível de surf, e pode escolher melhor a sua prancha. Mas lembre-se que é muito importante receber o acompanhamento de profissionais. Surfistas mais experientes, técnicos e escolas de surf podem te ajudar muito na escolha do equipamento ideal para você pegar ondas inesquecíveis!', 'df5fs6s8a78asd67dr5d79s90d.jpg', 1);

INSERT INTO diaaberto (titulo, data1, horas, id_prof) 
VALUES ('Terças', '2023-07-16 00:00:00', '17h-18h', 1);
INSERT INTO diaaberto (titulo, data1, horas, id_prof) 
VALUES ('Quintas', '2023-07-18 00:00:00', '17h-18h', 2);
INSERT INTO diaaberto (titulo, data1, horas, id_prof) 
VALUES ('Sábado', '2023-07-20 00:00:00', '17h-18h', 3);

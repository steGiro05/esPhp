CREATE database 5bi_film;

CREATE TABLE genere (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(20)
);

CREATE TABLE film (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(20),
    anno int (11)
);

CREATE TABLE attore (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(20),
    cognome VARCHAR(20)
);

CREATE TABLE recita (
    fkAttore int(11),
    fkFilm int(11),
    foreign key (fkAttore) references attore(id),
    foreign key (fkFilm) references film(id),
    PRIMARY KEY (fkFilm, fkAttore)
);


CREATE TABLE appartiene (
    fkFilm int(11),
    fkGenere int(11),
    foreign key (fkGenere) references genere(id),
    foreign key (fkFilm) references film(id),
    PRIMARY KEY (fkFilm, fkGenere)

);






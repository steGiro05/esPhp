-- Inserisci dati nella tabella "genere"
INSERT INTO genere (nome) VALUES
    ('Azione'),
    ('Commedia'),
    ('Drammatico'),
    ('Fantasy');

-- Inserisci dati nella tabella "film"
INSERT INTO film (titolo, anno) VALUES
    ('Il Signore degli Anelli', 2001),
    ('Titanic', 1997),
    ('Jurassic Park', 1993),
    ("L'era glaciale", 2002);

-- Inserisci dati nella tabella "attore"
INSERT INTO attore (nome, cognome) VALUES
    ('Leonardo', 'Di Caprio'),
    ('Laura', 'Dern'),
    ('Jack', 'Black'),
    ('Elija', 'Wood');

-- Inserisci dati nella tabella "recita"
INSERT INTO recita (fkAttore, fkFilm) VALUES
    (1, 2),  -- Leonardo Di Caprio recita in Titanic
    (2, 3),  -- Laura Dern recita in Jurassic Park
    (3, 4),  -- Jack Black recita in L'era glaciale
    (4, 1);  -- Elija Wood recita in Il Signore degli Anelli

-- Inserisci dati nella tabella "appartiene"
INSERT INTO appartiene (fkFilm, fkGenere) VALUES
    (1, 4),  -- Il Signore degli Anelli è di genere Fantasy
    (2, 3),  -- Titanic è di genere Drammatico
    (3, 1),  -- Jurassic Park è di genere Azione
    (4, 2);  -- L'era glaciale è di genere Commedia



-- TABLA GENEROS
DROP TABLE IF EXISTS generos CASCADE;

CREATE TABLE generos
(
       id     BIGSERIAL    PRIMARY KEY
    ,  nombre VARCHAR(255) UNIQUE
);




-- TABLA PELICULAS
DROP TABLE IF EXISTS peliculas CASCADE;

CREATE TABLE peliculas
(
        id        BIGSERIAL    PRIMARY KEY
     ,  titulo    VARCHAR(255) NOT NULL
     ,  anyo      NUMERIC(4)   DEFAULT 0
     ,  sinopsis  VARCHAR(255)
     ,  genero_id BIGINT       REFERENCES generos (id)
                               ON DELETE NO ACTION
                               ON UPDATE CASCADE
);


-- INSERT

INSERT INTO generos (nombre)
     VALUES ('Acción'), ('Terror'),
            ('Suspense'), ('Animación'),
            ('Comedia');


INSERT INTO peliculas (titulo, anyo, sinopsis, genero_id)
     VALUES ('Crudo', 2016, 'Come carne muy cruda', 2),
            ('Rec 4', 2015, 'Bicho malvado mata a los demás', 2),
            ('Fast and Furious 8', 2016, 'Carreras de coches', 1),
            ('Jacuzi al pasado', 2009, 'Viajan al pasado por un jacuzi', 5);

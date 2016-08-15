-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Client(
id SERIAL PRIMARY KEY,
name varchar(50) NOT NULL,
password varchar(50) NOT NULL,
admin boolean NOT NULL DEFAULT FALSE
);

CREATE TABLE Recipe(
id SERIAL PRIMARY KEY,
name varchar(50) NOT NULL,
description varchar(400),
instructions varchar(400),
added DATE
);

CREATE TABLE Ingredient(
id SERIAL PRIMARY KEY,
name varchar(50) NOT NULL
);

CREATE TABLE Recipe_ingredient(
recipe_id INTEGER REFERENCES Recipe(id),
ingredient_id INTEGER REFERENCES Ingredient(id)
);

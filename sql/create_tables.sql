-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Client(
id SERIAL PRIMARY KEY,
name varchar(50) NOT NULL,
password varchar(50) NOT NULL,
admin boolean NOT NULL DEFAULT FALSE
);

CREATE TABLE Recipe(
id SERIAL PRIMARY KEY,
user_id INTEGER REFERENCES Client(id),
name varchar(50) NOT NULL,
description varchar(400),
added DATE
);
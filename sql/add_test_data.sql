-- Lisää INSERT INTO lauseet tähän tiedostoon
--Client:
--INSERT INTO Client (name, password) VALUES ('Stig', '123');
--INSERT INTO Client (name, password) VALUES ('Heikki', '123');

--Recipe:
INSERT INTO Recipe (name, description, instructions, added) VALUES ('G&T', 'Ginipohjainen', 'sekoita', NOW());
INSERT INTO Recipe (name, description, instructions, added) VALUES ('Mojito', 'Rommipohjainen', 'ravista', NOW());


-- CREATE TABLE utilisateurs (
--     id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
--     nom text NOT NULL,
--     prenom text NOT NULL,
--     email text NOT NULL,
--     mdp text NOT NULL,
--     role INTEGER DEFAULT 0 NOT NULL
-- );

-- CREATE TABLE billets (
--     id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
--     id_utilisateur uuid NOT NULL,
--     id_soiree uuid NOT NULL,
--     tarif integer NOT NULL,
--     FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id)
-- );

-- CREATE TABLE panier (
--     id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
--     id_utilisateur uuid NOT NULL,
--     id_soiree uuid NOT NULL,
--     FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id)
-- );

\list
\c utilisateurs

INSERT INTO utilisateurs (id, nom, prenom, email, mdp, role) VALUES
('46e5ee3f-4987-4b50-91d1-b4ec6e9a339a','admin', 'admin', 'admin@admin.admin', '$2y$10$VV.XZ6sQ0XV4H9Tp3Yp52u3UvYTX/VVjN0gBo8raYOYifrhK14jZO', 2),
('1694237a-9079-4e8c-a682-db16c387a930','staff', 'staff', 'staff@staff.staff', '$2y$10$0mZQqwqsv6q6l/SehFm0QeFpfYItnwU.oSaiPrhN1tAMY5tC4evwm', 1),
('68a2a594-2d3b-4737-8de9-188fdcc8d5b7','user1', 'user1', 'user1@user.user', '$2y$10$.Hd0KVeRh5AGRYmSk94ZDeKU5zsHrmUO.iw1K0jlGW6w1iXMdastW', 0),
('ea42019b-8a6e-420a-a743-4063e176694f','user2', 'user2', 'user2@user.user', '$2y$10$.Hd0KVeRh5AGRYmSk94ZDeKU5zsHrmUO.iw1K0jlGW6w1iXMdastW', 0);

INSERT INTO paniers (id, id_utilisateur, id_soiree, tarif, valider) VALUES
('a8326c4e-529f-4c98-980c-1c697b7f3af0','68a2a594-2d3b-4737-8de9-188fdcc8d5b7','b7b2e51e-5d34-4a83-b16c-33f8122de220',16.00,FALSE),
('00394348-61da-40f9-acf1-dc05b4d5dbab','68a2a594-2d3b-4737-8de9-188fdcc8d5b7','dcaa5019-76eb-4424-9c91-d8720f6b89cc',30.00,FALSE),
('3ddd8845-25fc-4d9a-ae6b-ef83392e8024','68a2a594-2d3b-4737-8de9-188fdcc8d5b7','4f9d8891-bb95-4a3a-8c91-1600f74c3621',25.00,TRUE),
('9f8ace5f-3cb6-4f21-ace1-e276637ca7c6','68a2a594-2d3b-4737-8de9-188fdcc8d5b7','e46d5253-4d5d-4a6b-94c0-fc84217dc42d',12.00,TRUE),
('e20d5571-4f58-4189-ac25-8ff40f9b4c05','ea42019b-8a6e-420a-a743-4063e176694f','4d19c2c8-28be-4dff-9f35-bcf8b7d38b5e',29.00,FALSE),
('d71debf0-0e16-4d90-aac4-55ac481eb797','ea42019b-8a6e-420a-a743-4063e176694f','7819e353-09e2-43fc-bc72-258fbd35a59e',24.00,FALSE),
('b185e511-7199-41c1-ac5e-691e942640e6','ea42019b-8a6e-420a-a743-4063e176694f','d3040c3c-cb8c-4e74-9e1e-dff1eb8e7024',15.00,FALSE),
('11394bc1-4a19-44ae-81d9-ca9d9e7402f2','ea42019b-8a6e-420a-a743-4063e176694f','e05e054b-f3c0-4c3e-bb12-b8a047da4141',22.00,TRUE);

INSERT INTO billets (id_panier) VALUES
('3ddd8845-25fc-4d9a-ae6b-ef83392e8024'),
('9f8ace5f-3cb6-4f21-ace1-e276637ca7c6'),
('11394bc1-4a19-44ae-81d9-ca9d9e7402f2');


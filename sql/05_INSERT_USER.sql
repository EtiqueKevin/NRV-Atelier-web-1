-- CREATE TABLE utilisateurs (
--     id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
--     nom text NOT NULL,
--     prenom text NOT NULL,
--     email text NOT NULL,
--     mdp text NOT NULL,
--     role INTEGER DEFAULT 0 NOT NULL
-- );

-- CREATE TABLE paniers (
--     id uuid PRIMARY KEY,
--     id_soiree uuid NOT NULL,
--     tarif integer NOT NULL,
--     quantite integer DEFAULT 1 NOT NULL,
--     tarif_total integer DEFAULT 0 NOT NULL,
--     FOREIGN KEY (id_panier) REFERENCES paniers_utilisateurs(id_panier)
-- );

-- CREATE TABLE paniers_utilisateurs (
--     id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
--     id_utilisateur uuid NOT NULL,
--     id_panier uuid NOT NULL,
--     valide boolean DEFAULT FALSE NOT NULL,
--     FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id)
-- );

\list
\c utilisateurs

INSERT INTO utilisateurs (id, nom, prenom, email, mdp, role) VALUES
('46e5ee3f-4987-4b50-91d1-b4ec6e9a339a','admin', 'admin', 'admin@admin.admin', '$2y$10$VV.XZ6sQ0XV4H9Tp3Yp52u3UvYTX/VVjN0gBo8raYOYifrhK14jZO', 2),
('1694237a-9079-4e8c-a682-db16c387a930','staff', 'staff', 'staff@staff.staff', '$2y$10$0mZQqwqsv6q6l/SehFm0QeFpfYItnwU.oSaiPrhN1tAMY5tC4evwm', 1),
('68a2a594-2d3b-4737-8de9-188fdcc8d5b7','user1', 'user1', 'user1@user.user', '$2y$10$.Hd0KVeRh5AGRYmSk94ZDeKU5zsHrmUO.iw1K0jlGW6w1iXMdastW', 0),
('ea42019b-8a6e-420a-a743-4063e176694f','user2', 'user2', 'user2@user.user', '$2y$10$.Hd0KVeRh5AGRYmSk94ZDeKU5zsHrmUO.iw1K0jlGW6w1iXMdastW', 0);

INSERT INTO paniers_utilisateurs (id_utilisateur,id_panier,valide) VALUES
('1694237a-9079-4e8c-a682-db16c387a930','300ab149-3ee7-446a-bbe1-c86e2c961398',FALSE),
('68a2a594-2d3b-4737-8de9-188fdcc8d5b7','7881a0f9-4d40-428e-99e7-eb8081cf7a84',FALSE),
('ea42019b-8a6e-420a-a743-4063e176694f','9c3deb2d-1e3c-49f4-bc17-c0c81e3b1aee',FALSE);

INSERT INTO paniers (id_panier, id_soiree, tarif, quantite) VALUES
('300ab149-3ee7-446a-bbe1-c86e2c961398','b7b2e51e-5d34-4a83-b16c-33f8122de220',28.00,3),
('7881a0f9-4d40-428e-99e7-eb8081cf7a84','dcaa5019-76eb-4424-9c91-d8720f6b89cc',18.00,10),
('9c3deb2d-1e3c-49f4-bc17-c0c81e3b1aee','4f9d8891-bb95-4a3a-8c91-1600f74c3621',25.00,1),
('300ab149-3ee7-446a-bbe1-c86e2c961398','e46d5253-4d5d-4a6b-94c0-fc84217dc42d',12.00,20);




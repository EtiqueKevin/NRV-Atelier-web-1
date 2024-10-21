\list
\c soirees

CREATE TABLE lieux (
    id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
    nom text NOT NULL,
    adresse text NOT NULL,
    places_assises integer NOT NULL,
    places_debout integer NOT NULL
);

CREATE TABLE spectacles (
    id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
    titre text NOT NULL,
    description text NOT NULL,
    heure TIME NOT NULL,
    url_video text NOT NULL
);

CREATE TABLE soirees (
    id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
    nom text NOT NULL,
    thematique text NOT NULL,
    date TIMESTAMP NOT NULL,
    id_lieu uuid NOT NULL,
    tarif_normal integer NOT NULL,
    tarif_reduit integer NOT NULL,
    FOREIGN KEY (id_lieu) REFERENCES lieux(id)
);

CREATE TABLE soirees_spectacles (
    id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
    id_soiree uuid NOT NULL,
    id_spectacle uuid NOT NULL,
    FOREIGN KEY (id_soiree) REFERENCES soirees(id),
    FOREIGN KEY (id_spectacle) REFERENCES spectacles(id)
);

CREATE TABLE img_spectacles (
    id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
    id_spectacle uuid NOT NULL,
    url_img text NOT NULL,
    FOREIGN KEY (id_spectacle) REFERENCES spectacles(id)
);

CREATE TABLE artistes (
    id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
    nom text NOT NULL,
    prenom text NOT NULL,
    description text NOT NULL
);

CREATE TABLE artistes_spectacles (
    id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
    id_artiste uuid NOT NULL,
    id_spectacle uuid NOT NULL,
    FOREIGN KEY (id_artiste) REFERENCES artistes(id),
    FOREIGN KEY (id_spectacle) REFERENCES spectacles(id)
);

\list
\c utilisateurs

CREATE TABLE utilisateurs (
    id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
    nom text NOT NULL,
    prenom text NOT NULL,
    email text NOT NULL,
    mdp text NOT NULL,
    admin INTEGER DEFAULT 0 NOT NULL;
);

CREATE TABLE billets (
    id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
    id_utilisateur uuid NOT NULL,
    id_soiree uuid NOT NULL,
    tarif integer NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id)
);

CREATE TABLE panier (
    id uuid DEFAULT gen_random_uuid() PRIMARY KEY,
    id_utilisateur uuid NOT NULL,
    id_soiree uuid NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id)
);

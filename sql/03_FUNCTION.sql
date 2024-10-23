\list
\c utilisateurs

CREATE OR REPLACE FUNCTION calculer_tarif_total() RETURNS TRIGGER AS $$
BEGIN
    NEW.tarif_total := NEW.tarif * NEW.quantite;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_calcul_tarif_total
BEFORE INSERT OR UPDATE ON paniers
FOR EACH ROW EXECUTE FUNCTION calculer_tarif_total();

--=================================

CREATE OR REPLACE FUNCTION gerer_panier_valide() RETURNS TRIGGER AS $$
BEGIN
    -- Si le panier devient valide
    IF NEW.valide = TRUE THEN
        -- Supprimer les paniers associés
        DELETE FROM paniers WHERE id_panier = NEW.id_panier;

        -- Remettre à false le champ "valide"
        NEW.valide := FALSE;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_panier_valide
BEFORE UPDATE ON paniers_utilisateurs
FOR EACH ROW
WHEN (OLD.valide = FALSE AND NEW.valide = TRUE)
EXECUTE FUNCTION gerer_panier_valide();
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
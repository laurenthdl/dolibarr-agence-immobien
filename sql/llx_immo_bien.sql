CREATE TABLE IF NOT EXISTS llx_immo_bien (
    rowid SERIAL PRIMARY KEY,
    ref VARCHAR(128) NOT NULL UNIQUE,
    label VARCHAR(255) NOT NULL,
    fk_soc_proprietaire INTEGER,
    type_bien VARCHAR(64),
    etat VARCHAR(32) DEFAULT 'A_ACQUERIR',
    adresse VARCHAR(255),
    cp VARCHAR(32),
    ville VARCHAR(128),
    pays VARCHAR(2) DEFAULT 'CI',
    superficie_habitable DECIMAL(24,8),
    nombre_pieces INTEGER,
    description TEXT,
    prix_location DECIMAL(24,8),
    prix_vente DECIMAL(24,8),
    fk_user_creat INTEGER NOT NULL,
    datec TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tms TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status INTEGER NOT NULL DEFAULT 0
);

CREATE INDEX IF NOT EXISTS idx_immo_bien_ref ON llx_immo_bien(ref);
CREATE INDEX IF NOT EXISTS idx_immo_bien_ville ON llx_immo_bien(ville);

CREATE OR REPLACE FUNCTION update_tms() RETURNS TRIGGER AS $$ BEGIN NEW.tms = CURRENT_TIMESTAMP; RETURN NEW; END; $$ LANGUAGE plpgsql;
DROP TRIGGER IF EXISTS trg_immo_bien_tms ON llx_immo_bien;
CREATE TRIGGER trg_immo_bien_tms BEFORE UPDATE ON llx_immo_bien FOR EACH ROW EXECUTE FUNCTION update_tms();

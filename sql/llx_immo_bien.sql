-- Table immo_bien
CREATE TABLE IF NOT EXISTS llx_immo_bien (
    rowid SERIAL PRIMARY KEY,
    ref VARCHAR(128) NOT NULL,
    fk_user_creat INTEGER NOT NULL,
    datec TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tms TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status INTEGER NOT NULL DEFAULT 0
) TABLESPACE pg_default;

-- Indexes
CREATE INDEX IF NOT EXISTS idx_immo_bien_ref ON llx_immo_bien(ref);
CREATE INDEX IF NOT EXISTS idx_immo_bien_status ON llx_immo_bien(status);

-- Trigger for tms
CREATE OR REPLACE FUNCTION update_tms_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.tms = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ language 'plpgsql';

DROP TRIGGER IF EXISTS trg_immo_bien_tms ON llx_immo_bien;
CREATE TRIGGER trg_immo_bien_tms
    BEFORE UPDATE ON llx_immo_bien
    FOR EACH ROW
    EXECUTE FUNCTION update_tms_column();

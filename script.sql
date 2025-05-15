CREATE TABLE IF NOT EXISTS clientes (
  id SERIAL PRIMARY KEY,
  nome TEXT NOT NULL,
  limite INTEGER NOT NULL,
  saldo INTEGER NOT NULL DEFAULT 0
);

DO $$
BEGIN
  INSERT INTO clientes (nome, limite)
  VALUES
    ('o barato sai caro', 100000),
    ('zan corp ltda', 80000),
    ('les cruders', 1000000),
    ('padaria joia de cocaia', 10000000),
    ('kid mais', 500000);
END; $$;

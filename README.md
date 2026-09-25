# dvojcatanauteku.cz

Web knihy *Dvojčata na útěku* (Radim Keith). Nette 3.2, PHP 8.4, MariaDB.

## Struktura

- `app/` – presentery (`Presentation/Front`, `Presentation/Admin`), model
- `config/` – konfigurace; `local.neon` (není v gitu) přepisuje hesla, DB a mailer
- `www/` – document root (jediná veřejná složka)
- `sql/` – záloha databáze (dump z Wedosu), v Dockeru se importuje automaticky
- `data/orders/` – objednávky z formuláře (osobní údaje, nejsou v gitu)

Administrace je na `/edit` (přihlášení heslem, hashe hesel v `config/local.neon`).

## Vývoj (Docker)

```sh
make up        # web http://localhost:8080, adminer :8081, mailpit :8025
make down
make db-reset  # znovu naimportuje sql/
```

## Produkce

```sh
git clone git@github.com:mlazovla/dvojcatanauteku.git www
cd www
make init                      # temp, log, data/orders + config/local.neon z příkladu
make password-hash             # hash do config/local.neon -> admin.passwordHashes
composer install --no-dev --optimize-autoloader
```

Aktualizace: `make update`.

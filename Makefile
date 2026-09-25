.PHONY: help init up down logs shell composer-install db-reset update cache-clear password-hash

DC = docker compose

help:
	@echo "Vývoj (Docker):"
	@echo "  make init              připraví config/local.neon a adresáře temp, log, data/orders"
	@echo "  make up                sestaví a spustí kontejnery (web http://localhost:8080, adminer :8081, mailpit :8025)"
	@echo "  make down              zastaví kontejnery"
	@echo "  make logs              logy kontejnerů"
	@echo "  make shell             shell v PHP kontejneru"
	@echo "  make composer-install  composer install v kontejneru"
	@echo "  make db-reset          smaže databázi a znovu naimportuje dump ze sql/"
	@echo ""
	@echo "Produkce:"
	@echo "  make update            git pull, composer install (bez dev) a smazání cache"
	@echo "  make cache-clear       smaže temp/cache"
	@echo "  make password-hash     vygeneruje hash hesla do administrace (config/local.neon)"

init:
	mkdir -p temp log data/orders
	chmod 0777 temp log data/orders
	test -f config/local.neon || cp config/local.example.neon config/local.neon

up: init
	$(DC) up -d --build
	$(MAKE) composer-install

down:
	$(DC) down

logs:
	$(DC) logs -f

shell:
	$(DC) exec app bash

composer-install:
	$(DC) exec app composer install --no-interaction

db-reset:
	$(DC) rm -sf db
	docker volume rm -f dvojcatanauteku_db-data
	$(DC) up -d --wait db

update:
	git pull --ff-only
	composer install --no-dev --optimize-autoloader --no-interaction
	$(MAKE) cache-clear

cache-clear:
	rm -rf temp/cache/* 2>/dev/null || sudo rm -rf temp/cache/*

password-hash:
	@php -r '$$p = readline("Heslo: "); echo password_hash($$p, PASSWORD_DEFAULT), PHP_EOL;'

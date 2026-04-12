# Gemini Coffee

## Požiadavky

- PHP
- Composer
- Docker

## Homebrew (macOS)

```bash
brew install php composer
brew install --cask docker
```

Nainštaluj a spusti **Docker Desktop**.

## PostgreSQL (Docker)

```bash
docker run -d --name GeminiCoffee \
  -e POSTGRES_PASSWORD=secret \
  -e POSTGRES_DB=eshop \
  -p 5432:5432 \
  postgres
```

### Pripojenie v `.env`

`.env.example` má **ukážkové** nastavenie databázy pre lokálny Postgres v tomto kontajneri. Po `cp .env.example .env` ho nechaj, alebo uprav podľa seba.

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=eshop
DB_USERNAME=postgres
DB_PASSWORD=secret
```

## Spustenie

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

Otvor **[http://127.0.0.1:8000](http://127.0.0.1:8000)**.

Po seederi existuje účet **admin** (`admin@gmail.com` / heslo `admin`, rola `admin`) na vstup do admin časti. Ostatní používatelia sa registrujú cez Register (rola `customer`).
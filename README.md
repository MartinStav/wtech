# Gemini Coffee – E-shop

Semestrálny projekt WTECH 2025/2026 – Fáza 2  
**Autori:** Jakub Kelemen, Martin Stavrovsky

---

## Technológie

- **Backend:** Laravel 12 (PHP 8.3), server-side rendering (Blade)
- **Databáza:** PostgreSQL
- **Frontend:** Bootstrap 5, vanilla JS
- **Autentifikácia:** Laravel session auth

---

## Funkcie

### Zákazník (klient)

| Funkcia | Popis |
| --- | --- |
| Výpis produktov | Zoznam s kartami, obrázkami, cenou |
| Filtrovanie | Kategória, roast level, pôvod, cenové rozpätie (4 filtre) |
| Zoradenie | Cena vzostupne/zostupne, názov A–Z |
| Paginovanie | 6 produktov na stránku |
| Full-text vyhľadávanie | Podľa názvu, popisu, pôvodu, roastu, kategórie |
| Detail produktu | Galéria obrázkov, specs, popis, výber množstva |
| Košík | Pridanie, odobranie, zmena množstva, vyprázdnenie |
| Checkout | 3 kroky: doprava → platba → review → potvrdenie |
| Registrácia / Prihlásenie | Email + heslo, remember me |
| Perzistencia košíka | Prihlásený: DB; hosť: session; zlúčenie pri prihlásení |
| Hosťovský checkout | Checkout bez registrácie |
| Obľúbené produkty | Pridanie/odobratie ♥ z výpisu aj detailu |
| Profil používateľa | Zobrazenie obľúbených produktov |

### Administrátor

| Funkcia | Popis |
| --- | --- |
| Chránený prístup | Middleware – rola `admin` |
| Zoznam produktov | Tabuľka so všetkými produktmi z DB |
| Pridanie produktu | Formulár s validáciou, upload obrázkov |
| Editácia produktu | Predvyplnený formulár, správa obrázkov |
| Vymazanie produktu | Zmazanie z DB + fyzické súbory |

### Validácia formulárov

| Pole | FE | BE |
| --- | --- | --- |
| Číslo karty | Len číslice, max 16 | `digits:16` |
| CVV | Len číslice, max 3 | `digits:3` |
| Expiry | Maska MM/YY | regex `(0[1-9]\|1[0-2])\/\d{2}` |
| Email | `pattern` atribút | regex s doménou |
| ZIP | Len číslice, 4–10 znakov | regex `\d{4,10}` |

---

## Dátový model

```text
users           – id, name, email, password, role (customer/admin)
categories      – id, name, slug
products        – id, category_id, name, slug, description, price,
                  stock_quantity, is_active, origin_label, roast_level, weight_grams
product_images  – id, product_id, path, sort_order
cart_items      – id, user_id (nullable), session_id (nullable), product_id, quantity
favorites       – id, user_id, product_id
```

---

## Spustenie

### Požiadavky

- PHP 8.2+, Composer
- PostgreSQL (alebo Docker)

### PostgreSQL cez Docker

```bash
docker run -d --name GeminiCoffee \
  -e POSTGRES_PASSWORD=secret \
  -e POSTGRES_DB=eshop \
  -p 5432:5432 \
  postgres
```

### Postgres.app (macOS)

Otvorte **Postgres.app**, kliknite **Start** a vytvorte databázu:

```bash
psql -U postgres -c "CREATE DATABASE eshop;"
```

### Inštalácia

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed
php artisan serve
```

Otvorte <http://127.0.0.1:8000>

---

## Testovacie účty

| Rola | Email | Heslo |
| --- | --- | --- |
| Admin | admin@gmail.com | admin |
| Zákazník | zaregistrujte sa cez /register | — |

Admin panel: <http://127.0.0.1:8000/src/admin/dashboard.php>

---

## Štruktúra projektu

```text
app/
  Http/Controllers/
    AdminController.php      – CRUD produktov (admin)
    AuthController.php       – registrácia, prihlásenie, odhlásenie
    CartController.php       – košík
    CheckoutController.php   – 3-krokový checkout
    FavoriteController.php   – obľúbené + profil
    HomeController.php       – domovská stránka
    ShopController.php       – výpis a detail produktov
  Models/
    User, Product, Category, ProductImage, CartItem, Favorite
resources/views/
  src/
    admin/     – dashboard, product-add, product-edit
    auth/      – login, register
    order/     – basket, shipping, payment, review
    public/    – shop, product
    profile    – profil používateľa s obľúbenými
  partials/    – header, footer, nav-items, checkout-order-summary
  layouts/     – app.blade.php
```

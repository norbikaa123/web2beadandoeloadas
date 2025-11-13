
# Tanösvény (Laravel 11) – starter pack

Ez a csomag *készre drótozott* fájlokat tartalmaz a Webprogramozás II Laravel beadandóhoz.
Másold egy frissen létrehozott Laravel-projektbe, futtasd a parancsokat, és kész is.

## Követelmények
- PHP 8.2+ (pdo_sqlite vagy mysql), Composer
- Node.js + npm (Breeze assetek miatt)
- SQLite **vagy** MySQL (alapértelmezetten SQLite-ot használunk)

## Gyors telepítés (teljesen automatizált)
```bash
# 1) Új Laravel projekt
composer create-project laravel/laravel tanosveny
cd tanosveny

# 2) Breeze telepítése az autentikációhoz
composer require laravel/breeze --dev
php artisan breeze:install blade

# 3) (Opcionális) ha nem akarsz npm-et: működik npm nélkül is, mert a nézetek CDN-t használnak.
#    De a Breeze auth oldalak miatt javasolt:
npm install
npm run build

# 4) Másold be a starter pack fájlokat a projekt gyökerébe (fedd le a meglévőket is)
#    - Csomag kibontása a projekt gyökerébe
# (ha ezt a README-t a letöltött zipből olvasod, egyszerűen másold a mappák tartalmát a projektbe)

# 5) .env beállítása
#    Használhatsz SQLite-ot:
#    DB_CONNECTION=sqlite
#    DB_DATABASE=/abszolút/elérési/út/adat.sqlite
#    értelemszerűen hozd létre a fájlt: touch storage/database.sqlite (vagy DB_DATABASE útvonalon)
#    vagy használj MySQL-t és állítsd be a DB_... értékeket.

# 6) Migráció + seeding
php artisan migrate --force
php artisan db:seed --force

# 7) (Opcionális) A feltöltött tanosveny.db importálása a saját adatbázisodba
#    Másold a tanosveny.db-t a projekt gyökerébe, majd:
php artisan tanosveny:import tanosveny.db

# 8) Indítás
php artisan serve
```

### Választott reszponzív téma
A **Bootswatch – Lux** (MIT licenc) témát alkalmazzuk Bootstrap CDN-en keresztül.
Forrás: https://bootswatch.com/lux/

### Menük és jogosultságok
- Főoldal, Adatbázis, Diagram, Kapcsolat: bárki
- Üzenetek: bejelentkezve
- CRUD (Tanösvények): bejelentkezve
- Admin: bejelentkezve + admin szerep

### Diagram
Chart.js CDN-nel (bar chart): tanösvények száma NP-nként.

### GitHub
- Nyilvános repo, több commit (min. 5/fő), branch + PR javasolt.
- README-ben add meg az élő oldal URL-jét is.

### Deploy
- .env beállítás (APP_KEY, DB)
- `php artisan migrate --force && php artisan db:seed --force`
- (Opcionális) `php artisan tanosveny:import tanosveny.db`
- Webroot: `public/`

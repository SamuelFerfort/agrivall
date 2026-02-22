# AGRIVALL

Aplicación web para una empresa de agroturismo en Valencia. Permite gestionar productos artesanales, pedidos, un blog de noticias y reservas de casa rural.

## Tecnologías

- Laravel 12
- Laravel Breeze (autenticación)
- Tailwind CSS
- MySQL

## Instalación

```bash
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Estructura

- `/admin` — Panel de administración (requiere login)
- `/productos` — Catálogo público de productos
- `/blog` — Noticias y artículos
- `/casa-rural` — Semanas disponibles para reservar
- `/carrito` — Carrito de compra

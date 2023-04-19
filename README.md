# Inertia example project

Stack: Laravel 10 + InertiaJS + Vue 3 (Composition)

Styles are based on [Breeze](https://laravel.com/docs/10.x/starter-kits#breeze-and-inertia),
[TailwindCSS](https://tailwindcss.com/) 
and [Flowbite](https://flowbite.com/)

### Requirements:
- Docker
- Composer 2
- PHP 8.2

### Installation:
Without composer installed:
- `docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  laravelsail/php82-composer:latest \
  composer install --ignore-platform-reqs`

With composer installed:
- `composer install`
- `cp .env.example .env`

To make sure sail is always available,
you may add this to your shell configuration file in your home directory,
such as `~/.zshrc` or `~/.bashrc`, and then restart your shell.

`alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'`

- `sail up -d`
- `sail artisan key:generate`
- `sail artisan migrate`
- `sail artisan db:seed`
- `npm install`
- `npm run dev`

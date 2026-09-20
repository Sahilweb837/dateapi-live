#!/usr/bin/env bash
set -euo pipefail

APP_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$APP_DIR"

if ! command -v php >/dev/null 2>&1; then
    echo "PHP is required. Install PHP 8.2+ and the Laravel extensions first." >&2
    exit 1
fi

if [ ! -f .env ]; then
    echo ".env is missing. Copy .env.example to .env and configure production values first." >&2
    exit 1
fi

if grep -Eq '^ADMIN_PASSWORD=(replace-with-a-long-random-password)?$' .env; then
    echo "Set a private random ADMIN_PASSWORD in .env before continuing." >&2
    exit 1
fi

if command -v node >/dev/null 2>&1 && command -v npm >/dev/null 2>&1; then
    echo "Node: $(node --version)"
    echo "npm:  $(npm --version)"
    npm ci
    npm run build
else
    echo "Node.js/npm are unavailable in this hosting container."
    echo "Using the prebuilt public/build assets shipped with the release."
fi

if [ ! -s public/build/manifest.json ] ||
   [ ! -f public/build/assets/$(php -r '
       $manifest = json_decode(file_get_contents("public/build/manifest.json"), true);
       echo basename($manifest["resources/css/app.css"]["file"] ?? "");
   ') ]; then
    echo "CSS assets are missing. Build on a machine with Node.js and upload public/build." >&2
    exit 1
fi

php artisan storage:link || true
php artisan config:clear
php artisan route:clear
php artisan view:cache
php artisan config:cache
php artisan route:cache

echo "CupDate production assets and Laravel caches are ready."

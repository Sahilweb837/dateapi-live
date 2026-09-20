#!/usr/bin/env bash
set -euo pipefail

APP_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$APP_DIR"

if ! command -v php >/dev/null 2>&1; then
    echo "PHP is required. Install PHP 8.2+ and the Laravel extensions first." >&2
    exit 1
fi

if ! command -v node >/dev/null 2>&1 || ! command -v npm >/dev/null 2>&1; then
    echo "Node.js/npm are missing. Installing the Ubuntu packages..."
    if ! command -v sudo >/dev/null 2>&1; then
        echo "sudo is required to install nodejs and npm, or install them as root." >&2
        exit 1
    fi
    sudo apt-get update
    sudo apt-get install -y nodejs npm
fi

echo "Node: $(node --version)"
echo "npm:  $(npm --version)"

if [ ! -f .env ]; then
    echo ".env is missing. Copy .env.example to .env and configure production values first." >&2
    exit 1
fi

if grep -Eq '^ADMIN_PASSWORD=(replace-with-a-long-random-password)?$' .env; then
    echo "Set a private random ADMIN_PASSWORD in .env before continuing." >&2
    exit 1
fi

npm ci
npm run build

if [ ! -f public/build/manifest.json ]; then
    echo "Vite build completed without public/build/manifest.json." >&2
    exit 1
fi

php artisan storage:link || true
php artisan config:clear
php artisan route:clear
php artisan view:cache
php artisan config:cache
php artisan route:cache

echo "CupDate production assets and Laravel caches are ready."

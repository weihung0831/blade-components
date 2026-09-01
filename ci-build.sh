#!/usr/bin/env sh
set -e

curl -fsSL -o /tmp/php.tar.gz https://dl.static-php.dev/static-php-cli/common/php-8.4.8-cli-linux-x86_64.tar.gz
mkdir -p /tmp/php-bin
tar -xzf /tmp/php.tar.gz -C /tmp/php-bin
export PATH="/tmp/php-bin:$PATH"
php -v

curl -fsSL -o /tmp/php-bin/composer https://getcomposer.org/download/latest-stable/composer.phar
chmod +x /tmp/php-bin/composer

composer install --no-interaction --no-dev --prefer-dist
cp .env.example .env
php artisan key:generate --force
npm ci
npm run build
php artisan site:export https://blade-components.weihung.xyz

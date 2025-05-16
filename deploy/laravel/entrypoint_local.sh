#!/bin/bash

echo "=== Copy .env ==="
cp -v /opt/laravel_setup/.env_local /application/.env

echo "=== Switching shell to /application folder ==="
cd /application

echo "=== Run composer install ==="
composer install

echo "=== Run npm install ==="
npm install

echo "=== Run npm run build ==="
npm run build

echo "=== Run php artisan key:generate ==="
php artisan key:generate

echo "=== Run php artisan storage:link ==="
php artisan storage:link

echo "=== Run php artisan migrate ==="
php artisan migrate

echo "=== Run supervisord ==="
service supervisor start
supervisorctl start laravel-task
supervisorctl start cron
supervisorctl status laravel-task
supervisorctl status cron

echo "=== Run install mc ==="
apt install -y mc

echo "=== Run /usr/sbin/php-fpm8.3 -O ==="
/usr/sbin/php-fpm8.3 -O
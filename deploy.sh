#!/bin/bash
# запуск : sh ./deploy.sh

set -e

echo "Deploying..."

php artisan down

git pull origin main

php artisan migrate --force

php artisan up

echo "Done!"
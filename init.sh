#!/bin/bash
php artisan migrate --force
php artisan cache:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan queue:restart
chmod +777 database/database.sqlite

chmod +777 ./storage -R

service supervisor start
supervisorctl reread
supervisorctl update
supervisorctl start "laravel-worker:*"

php artisan serve  --host=0.0.0.0 --port=8080

#!/bin/bash
php artisan migrate --force
chmod +777 database/database.sqlite

chmod +777 ./storage -R

service supervisor start
supervisorctl reread
supervisorctl update
supervisorctl start "laravel-worker:*"

php artisan serve  --host=0.0.0.0 --port=8080

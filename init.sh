#!/bin/bash
php artisan migrate --force
chmod +777 database/database.sqlite

crontab cron
php artisan serve  --host=0.0.0.0 --port=8080

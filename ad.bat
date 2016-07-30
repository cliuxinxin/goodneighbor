@echo off
echo begin to deploy form github.
git pull
php artisan migrate
call npm install
call composer install
echo deploy complete.

#!/bin/bash

cd src

cp .env.example .env

cd ../

docker-compose up -d

docker-compose exec app npm install

docker-compose exec app composer install

docker-compose exec app php artisan key:generate

docker-compose exec app php artisan migrate:refresh --seed


docker-compose exec app php artisan config:clear 

docker compose exec app php artisan cache:clear

docker-compose exec app php artisan route:clear

docker-compose exec app php artisan view:clear

docker-compose exec app npm run build

docker-compose exec app npm run dev
up:
	docker compose up -d

down:
	docker compose down

migrate:
	docker exec app php artisan migrate

seed:
	docker exec app php artisan db:seed

composer-install:
	docker exec app composer install

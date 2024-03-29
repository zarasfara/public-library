init:
	cp .env.example .env

# Run this command in the container with application
run:
	composer install --optimize-autoloader --no-progress --no-interaction
	chown -R www-data:www-data storage/ bootstrap/cache
	chmod -R 775 storage bootstrap/cache
	php artisan key:generate

gen-doc:
	docker exec -it public-library-php-fpm-1 php artisan ide-helper:models
	docker exec -it public-library-php-fpm-1 php artisan ide-helper:generate

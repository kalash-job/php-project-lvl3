start:
	php artisan serve --host 0.0.0.0

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed
	npm install

test:
	php artisan test

deploy:
	git push heroku

lint:
	composer run-script phpcs -- --standard=PSR12 public tests

lint-fix:
	composer run-script phpcbf -- --standard=PSR12 public tests

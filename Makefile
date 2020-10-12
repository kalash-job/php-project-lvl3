start:
	php artisan serve --host 0.0.0.0

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi

test:
	php artisan test

deploy:
	git push heroku

lint:
	composer run-script phpcs -- --standard=PSR12 public tests

lint-fix:
	composer run-script phpcbf -- --standard=PSR12 public tests

test:
	composer phpunit tests

test-coverage:
	composer phpunit tests -- --coverage-clover build/logs/clover.xml

env?="dev"

run-local:
	php artisan serve

tests:
	vendor/bin/phpunit -c phpunit.xml

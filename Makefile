env?="dev"

ifeq (composer,$(firstword $(MAKECMDGOALS)))
COMPOSER_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
$(eval $(COMPOSER_ARGS):;@:)
endif

ifeq (artisan,$(firstword $(MAKECMDGOALS)))
ARTISAN_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
$(eval $(ARTISAN_ARGS):;@:)
endif

build:
	docker-compose up --build -d
	make -- composer install --ignore-platform-reqs --no-interaction --prefer-source

rebuild:
	make remove
	make build

remove:
	make stop
	docker ps -a --filter="name=acme" --format="{{.ID}}" | xargs docker rm -v

start:
	docker-compose up -d

stop:
	docker ps -a -q  --filter="name=acme" | xargs docker stop

app-ssh:
	docker exec -it acme_nginx bash

app-logs:
	docker logs -f acme_nginx

app-php:
	docker exec -it acme_php bash

app-mysql:
	docker exec -it acme_mysql /bin/bash

tests:
	docker exec -it acme_testing /var/www/acme/src/vendor/bin/phpunit -c /var/www/acme/src/phpunit.xml

composer:
	docker run --rm -ti -v `pwd`:/app composer:latest composer $(COMPOSER_ARGS)

artisan:
	docker-compose exec php php ../acme/src/artisan $(ARTISAN_ARGS)

migrate:
	docker-compose exec php php ../acme/src/artisan doctrine:migrations:migrate

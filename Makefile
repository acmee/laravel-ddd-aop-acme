env?="local"
XDEBUG_HOST=$(shell ipconfig getifaddr en0)
XDEBUG_IDEKEY="PHPSTORM"
ARGS=""

ifeq (composer,$(firstword $(MAKECMDGOALS)))
    COMPOSER_ARGS = $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
    $(eval $(COMPOSER_ARGS):;@:)
endif

# removed for now, only the first : is safely recognized
#ifeq (artisan,$(firstword $(MAKECMDGOALS)))
#    ARTISAN_ARGS:=$(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
#    ARTISAN_ARGS:=$(subst :,%,$(ARTISAN_ARGS))
#    $(eval $(ARTISAN_ARGS):;@:)
#    #$(info $(ARTISAN_ARGS))
#endif

help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  build                                 create containers and install application"
	@echo "  rebuild                               remove containers and build again"
	@echo "  delete                                delete all containers (images are not deleted)"
	@echo "  start                                 start all containers"
	@echo "  stop                                  stop all containers"
	@echo "  app-ssh                               log into the application container (acme_php)"
	@echo "  app-logs                              tail the logs of the webserver container (acme_nginx)"
	@echo "  app-php                               log into the PHP container (acme_php)"
	@echo "  app-mysql                             log into the MySQL container (acme_mysql)"
	@echo "  tests                                 run tests (acme_testing)"
	@echo ""
	@echo "  artisan ARGS=ARTISAN COMMAND          to run Laravel artisan commands pass the command to the"
	@echo "                                        ARGS variable, e.g. make artisan ARGS=route:list"
	@echo "                                        for now, it is not possible to pass in artisan options even if make"
	@echo "                                        is marked with a '--'"
	@echo "                                        if artisan options are needed, run make app-php and run artisan"
	@echo "                                        inside that container"
	@echo "  composer <COMPOSER_ARGS>              to install/remove/update composer dependencies"
	@echo "  -- composer <COMPOSER_ARGS> --option  if you need to pass options (like --prefer-source)"
	@echo "                                        to the command you have to prefix your call with '--':"
	@echo "                                        make -- composer <COMPOSER ARGS> --prefer-source"
	@echo "  migrate                               run database migrations"

build:
	XDEBUG_HOST=${XDEBUG_HOST} XDEBUG_IDEKEY=${XDEBUG_IDEKEY} docker-compose up -d
	make -- composer install --ignore-platform-reqs --no-interaction --prefer-source

rebuild:
	make delete
	make build

delete:
	make stop
	docker ps -a --filter="name=acme" --format="{{.ID}}" | xargs docker rm -v

start:
	XDEBUG_HOST=${XDEBUG_HOST} XDEBUG_IDEKEY=${XDEBUG_IDEKEY} docker-compose up -d --no-build

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
	docker exec -it acme_php php ../acme/src/artisan $(ARGS)

migrate:
	make artisan ARGS=doctrine:migrations:migrate

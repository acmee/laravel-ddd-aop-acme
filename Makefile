env?="dev"

install:
	docker-compose up --build -d
	make composer-install

rebuild:
	make remove
	make install
	make composer-install

remove:
	make stop
	docker rm -f acme_mysql acme_testing acme_nginx acme_nginx_proxy acme_php acme_php_composer

#ifeq (composer,$(firstword $(MAKECMDGOALS)))
#	# use the rest as arguments for "composer"
#	COMPOSER_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
#	# ...and turn them into do-nothing targets
#	$(eval $(COMPOSER_ARGS):;@:)
#endif
composer-install:
	docker run -ti \
	-v `pwd`:/app \
	# composer $(COMPOSER_ARGS)
	composer install --ignore-platform-reqs --no-interaction --prefer-source

composer-update:
	docker run -ti \
	-v `pwd`:/app \
	composer update --ignore-platform-reqs --no-interaction --prefer-source

start:
	docker-compose up -d

stop:
	docker stop -t 5 acme_mysql acme_testing acme_nginx acme_nginx_proxy acme_php

run-tests:
	docker exec -it acme_testing /var/www/acme/vendor/bin/phpunit -c /var/www/acme/phpunit.xml

app-ssh:
	docker exec -it acme_nginx bash

app-logs:
	docker logs -f acme_nginx

app-php:
	docker exec -it acme_php bash

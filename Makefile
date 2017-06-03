env?="dev"

run:
	docker-compose up -d

stop:
	docker stop -t 5 acme_mysql acme_testing acme_nginx acme_php

run-tests:
	docker exec -it acme_testing /var/www/acme/vendor/bin/phpunit -c /var/www/acme/phpunit.xml

app-ssh:
	docker exec -it acme_nginx bash

app-logs:
	docker logs -f acme_nginx

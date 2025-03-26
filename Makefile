build:
	docker compose build

start:
	docker compose up -d

stop:
	docker compose down

restart:
	docker compose down && docker compose up -d --build

bash:
	docker exec -it tax-calculator-php-1 bash

logs:
	docker compose logs -f

cache-clear:
	docker exec -it tax-calculator-php-1 bash -c "php bin/console cache:clear"

frontend-install:
	docker exec -it tax-calculator-php-1 sh -c "cd /var/www/html && yarn install"

frontend-dev:
	docker exec -it tax-calculator-php-1 sh -c "cd /var/www/html && yarn encore dev"

frontend-watch:
	docker exec -it tax-calculator-php-1 sh -c "cd /var/www/html && yarn encore dev --watch"

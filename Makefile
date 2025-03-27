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

test:
	docker-compose exec php php bin/phpunit
install:
	@echo "Build des images Docker..."
	docker-compose build

	@echo "Lancement des conteneurs..."
	docker-compose up -d

	@echo "Installation des dépendances PHP (composer)..."
	docker-compose exec php composer install

	@echo "Installation des dépendances JS (yarn)..."
	docker-compose exec php yarn install

	@echo "Compilation du frontend (Encore)..."
	docker-compose exec php yarn encore dev

	@echo "Exécution des migrations Doctrine..."
	docker-compose exec php php bin/console doctrine:migrations:migrate --no-interaction

	@echo "Exécution des tests unitaires (PHPUnit)..."
	docker-compose exec php php bin/phpunit

	@echo "Installation terminée avec succès"

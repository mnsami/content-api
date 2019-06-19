DOCKER_COMPOSE = docker-compose
PROJECT = "Endouble API."
COMPOSER ?= composer

ifeq ($(RUNNER), travis)
	CMD :=
else
	CMD := docker-compose exec php-fpm
endif

app/config/parameters.yml:
	cp app/config/parameters.yml.dist app/config/parameters.yml

all: clear lint-composer composer lint-php lint-json lint-yaml lint-eol phpcs db-schema-create

composer:
	@echo "\n==> Running composer install, runner $(RUNNER)"
	$(CMD) $(COMPOSER) install

cc:
	rm -rf app/cache/*

clear: cc
	rm -rf build/* app/logs/* vendor/ web/bundles/ bin/

lint: lint-json lint-yaml lint-php phpcs lint-composer lint-eol
	@echo All good.

lint-eol:
	@echo "\n==> Validating unix style line endings of files:"
	@! grep -lIUr --color '^M' app/ web/ src/ composer.* || ( echo '[ERROR] Above files have CRLF line endings' && exit 1 )
	@echo All files have valid line endings

lint-composer:
	@echo "\n==> Validating composer.json and composer.lock:"
	$(CMD) $(COMPOSER) validate --strict

lint-json:
	@echo "\n==> Validating all json files:"
	@find src -type f -name \*.json -o -name \*.schema | php -R 'echo "$$argn\t\t";json_decode(file_get_contents($$argn));if(json_last_error()!==0){echo "<-- invalid\n";exit(1);}else{echo "\n";}'

lint-yaml:
	@echo "\n==> Validating all yaml files:"
	@find app/config src -type f -name \*.yml | while read file; do echo -n "$$file"; php app/console --no-debug --no-interaction --env=test lint:yaml "$$file" || exit 1; done

lint-php:
	@echo "\n==> Validating all php files:"
	@find src -type f -name \*.php | while read file; do php -l "$$file" || exit 1; done

phpcs:
	$(CMD) bin/phpcs --standard=phpcs.xml -p

phpcbf:
	$(CMD) bin/phpcbf

db-schema-create:
	$(CMD) php bin/console doctrine:schema:create

db-schema-drop:
	$(CMD) php bin/console doctrine:schema:drop --force

container-stop:
	@echo "\n==> Stopping docker container"
	$(DOCKER_COMPOSE) stop

container-down:
	@echo "\n==> Removing docker container"
	$(DOCKER_COMPOSE) down

container-up:
	@echo "\n==> Docker container building and starting ..."
	$(DOCKER_COMPOSE) up --build -d

tear-down: container-stop container-down

.PHONY: container-up container-stop container-down tear-down all composer cc lint lint-eol lint-composer lint-json lint-yaml lint-php phpcs phpcbf db-schema-create db-schema-drop

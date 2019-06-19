DOCKER_COMPOSE = docker-compose
PROJECT = "Endouble API."

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

.PHONY: container-up container-stop container-down tear-down

.PHONY: help
.DEFAULT_GOAL := help

help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

init: down build up install-backend ## Initialize project.

build: ## Build services.
	docker-compose -f docker-compose.yml build $(c)

up: ## Create and start services.
	docker-compose -f docker-compose.yml up -d $(c)

start: ## Start services.
	docker-compose -f docker-compose.yml start $(c)

down: ## Stop and remove containers.
	docker-compose -f docker-compose.yml down $(c)

destroy: ## Stop and remove containers and volumes.
	docker-compose -f docker-compose.yml down -v $(c)

stop: ## Stop cervices.
	docker-compose -f docker-compose.yml stop $(c)

restart: ## Restart services.
	docker-compose -f docker-compose.yml stop $(c)
	docker-compose -f docker-compose.yml up -d $(c)

ps: ## Show started services.
	docker-compose ps

logs: ## Display logs.
	docker-compose -f docker-compose.yml logs --tail=100 -f $(c)

console-web: ## Login in webserver console.
	docker-compose -f docker-compose.yml exec web /bin/sh

console-backend: ## Login in backend console.
	docker-compose -f docker-compose.yml exec backend /bin/bash

install-backend: ## Clone backend sources and install dependencies.
	rm -rf ./backend/src/{*,.[^.]*}
	git clone git@github.com:de1vin/marketplace-demo-backend.git ./backend/tmp
	mv ./backend/tmp/{*,.[^.]*} ./backend/src
	rm -rf ./backend/tmp
	cp -f ./.env ./backend/src/.env
	docker-compose -f docker-compose.yml exec backend composer install

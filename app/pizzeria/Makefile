# ============================================================================ #
#                                Initialization                                #
# ============================================================================ #
# Load environment variables from env files
include .env


.PHONY: install update db migration migrate fixture server watch deploy clear
.DEFAULT_GOAL = help

# ============================================================================ #
#                                    Aliases                                   #
# ============================================================================ #
NPM = npm
SF = php bin/console
COMPOSER = composer
PORT ?= 8001

# ============================================================================ #
#                                    Symfony                                   #
# ============================================================================ #
composer.lock:
	$(COMPOSER) update

vendor:
ifeq ($(APP_ENV),prod)
	$(COMPOSER) install --no-dev --optimize-autoloader
else
	$(COMPOSER) install
endif

package-lock:
	$(NPM) update
	$(NPM) audit fix

node_modules:
	$(NPM) install
	$(NPM) audit fix

npm_build:
	$(NPM) run build

install:  vendor   node_modules   npm_build  migrate fixture ## Install project dependencies

db: ## Create database
	$(SF) doctrine:database:create

migration:  ## Generate a new migration file
	$(SF) doctrine:migrations:diff

migrate:  ## Migrate database
	$(SF) doctrine:migrations:migrate --no-interaction

fixture:   ## Load fixtures
	$(SF) doctrine:fixtures:load --append

reset-db:
	$(SF) doctrine:database:drop --force
	$(SF) doctrine:database:create
	$(SF) doctrine:migrations:migrate --no-interaction;



help:
	@grep -h -E '^[a-zA-Z_-]+:.*?##:q .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

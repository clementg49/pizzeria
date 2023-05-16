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
composer.lock: composer.json
	$(COMPOSER) update

vendor: composer.lock
ifeq ($(APP_ENV),prod)
	$(COMPOSER) install --no-dev --optimize-autoloader
else
	$(COMPOSER) install
endif

package-lock: package.json
	$(NPM) update
	$(NPM) audit fix

node_modules: package-lock.json
	$(NPM) install
	$(NPM) audit fix

npm: package-lock.json
	$(NPM) run build

install: .env  vendor composer.json   package-lock.json  migrate fixture npm## Install project dependencies

update: composer.json package.json ## Update project dependencies
ifeq ($(APP_ENV),prod)
	$(COMPOSER) update --no-dev --optimize-autoloader
else
	$(COMPOSER) update
endif

#	$(NPM) update
#	$(NPM) audit fix

db: .env  vendor  ## Create database
	$(SF) doctrine:database:create

migration: vendor ## Generate a new migration file
	$(SF) doctrine:migrations:diff

migrate: vendor ## Migrate database
	$(SF) doctrine:migrations:migrate --no-interaction

fixture:   ## Load fixtures
	$(SF) doctrine:fixtures:load --append

reset-db: .env  vendor
	$(SF) doctrine:database:drop --force
	$(SF) doctrine:database:create
	$(SF) doctrine:migrations:migrate --no-interaction;

watch: node_modules ## Watch files
	$(NPM) run watch

clear:
ifneq ($(FCGI),/path/fpm.sock)
	php vendor/bin/cachetool opcache:reset --fcgi=$(FCGI)
endif
	php bin/console cache:pool:clear cache.global_clearer
	php bin/console cache:clear
ifeq ($(APP_ENV),prod)
	chown -R www-data:www-data var/cache/prod
endif

help:
	@grep -h -E '^[a-zA-Z_-]+:.*?##:q .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

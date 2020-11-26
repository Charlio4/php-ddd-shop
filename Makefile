## —— Make file ————————————————————————————————————————————————————————————————
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— Tools Project ————————————————————————————————————————————————————————
install: ## Install vendors according to the current composer.lock file
	composer install

update: ## Update vendors according to the current composer.json file
	composer update

fix-perms: ## Fix permissions of all var files
	chmod -R 777 var/*

purge: ## Purge cache and logs
	rm -rf var/logs/*.log
	ls var | grep -v logs | grep -v cache | xargs -I % sh -c 'rm -rf var/%'
	ls var/cache/doctrine | grep -v '.gitkeep' | xargs -I % sh -c 'rm -rf var/cache/doctrine/%'

cs: ## Launch check style and static analysis
	bin/php-cs-fixer --no-interaction --dry-run --diff -v fix

cs-fix: ## Executes cs fixer
	bin/php-cs-fixer --no-interaction --diff -v fix

## —— Test —————————————————————————————————————————————————————————————————
test-unit: phpunit.xml ## Launch unit tests
	bin/phpunit --stop-on-failure --testdox

test-pre-commit: phpunit.xml ## Launch all functional and unit tests
	bin/phpunit --stop-on-failure --testdox --colors=always --no-coverage

.PHONY: help static-analysis unit-tests

help: ## Show this help.
	@printf "\033[33mUsage:\033[0m\n  make [target] [arg=\"val\"...]\n\n\033[33mTargets:\033[0m\n"
	@grep -E '^[-a-zA-Z0-9_\.\/]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[32m%-30s\033[0m %s\n", $$1, $$2}'

static-analysis: static-analysis/phpstan static-analysis/mago ## Run static analysis.

static-analysis/mago: ## Run PHPStan static analysis.
	vendor/bin/mago lint

static-analysis/phpstan: ## Run PHPStan static analysis.
	XDEBUG_MODE=off vendor/bin/phpstan analyse --memory-limit=-1

unit-tests: ## Run unit tests.
	XDEBUG_MODE=coverage vendor/bin/phpunit --coverage-text --colors=always

coding-style/check: ## Check coding style.
	XDEBUG_MODE=off vendor/bin/mago format --dry-run

coding-style/format: ## Check coding style.
	XDEBUG_MODE=off vendor/bin/mago format

coding-style: coding-style/check coding-style/format

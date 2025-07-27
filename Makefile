.PHONY: help static-analysis unit-tests

help: ## Show this help.
	@printf "\033[33mUsage:\033[0m\n  make [target] [arg=\"val\"...]\n\n\033[33mTargets:\033[0m\n"
	@grep -E '^[-a-zA-Z0-9_\.\/]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[32m%-30s\033[0m %s\n", $$1, $$2}'

static-analysis: ## Run static analysis tools.
	XDEBUG_MODE=off vendor/bin/phpstan analyse --memory-limit=-1

unit-tests: ## Run unit tests.
	XDEBUG_MODE=coverage vendor/bin/phpunit --coverage-text --colors=always
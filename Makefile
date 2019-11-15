install:
	composer install
	
lint:
	composer run-script phpcs

test:
	composer run-script phpunit tests
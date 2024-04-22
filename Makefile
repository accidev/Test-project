.SILENT:

build: install-composer
	docker-compose build

run: build
	docker-compose up -d

install-composer:
	composer install

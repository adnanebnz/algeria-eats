# Algeria Eats - Docker Makefile
# Usage: make [command]

.PHONY: help build up down restart logs shell migrate fresh seed cache clear test

# Default target
help:
	@echo "Algeria Eats - Docker Commands"
	@echo ""
	@echo "Usage: make [command]"
	@echo ""
	@echo "Commands:"
	@echo "  build         Build Docker images"
	@echo "  up            Start all containers"
	@echo "  up-d          Start all containers in detached mode"
	@echo "  down          Stop and remove all containers"
	@echo "  restart       Restart all containers"
	@echo "  logs          View logs from all containers"
	@echo "  logs-app      View logs from app container"
	@echo "  shell         Open shell in app container"
	@echo "  migrate       Run database migrations"
	@echo "  fresh         Fresh migration with seeders"
	@echo "  seed          Run database seeders"
	@echo "  cache         Cache config, routes, and views"
	@echo "  clear         Clear all caches"
	@echo "  test          Run tests"
	@echo "  composer      Run composer command (use: make composer c='install')"
	@echo "  artisan       Run artisan command (use: make artisan c='inspire')"
	@echo "  npm           Run npm command (use: make npm c='run dev')"
	@echo "  tools         Start with optional tools (phpmyadmin, mailpit)"
	@echo "  prod          Start in production mode"
	@echo "  setup         Initial setup (build, up, migrate, seed)"

# Build Docker images
build:
	docker-compose build

# Start containers
up:
	docker-compose up

up-d:
	docker-compose up -d

# Stop containers
down:
	docker-compose down

# Restart containers
restart:
	docker-compose restart

# View logs
logs:
	docker-compose logs -f

logs-app:
	docker-compose logs -f app

logs-nginx:
	docker-compose logs -f nginx

logs-queue:
	docker-compose logs -f queue

# Shell access
shell:
	docker-compose exec app sh

shell-db:
	docker-compose exec db mysql -u$(DB_USERNAME) -p$(DB_PASSWORD) $(DB_DATABASE)

# Laravel commands
migrate:
	docker-compose exec app php artisan migrate

fresh:
	docker-compose exec app php artisan migrate:fresh --seed

seed:
	docker-compose exec app php artisan db:seed

cache:
	docker-compose exec app php artisan config:cache
	docker-compose exec app php artisan route:cache
	docker-compose exec app php artisan view:cache

clear:
	docker-compose exec app php artisan cache:clear
	docker-compose exec app php artisan config:clear
	docker-compose exec app php artisan route:clear
	docker-compose exec app php artisan view:clear

# Testing
test:
	docker-compose exec app php artisan test

# Composer
composer:
	docker-compose exec app composer $(c)

# Artisan
artisan:
	docker-compose exec app php artisan $(c)

# NPM (for development)
npm:
	docker-compose run --rm node npm $(c)

# Start with tools (phpmyadmin, mailpit)
tools:
	docker-compose --profile tools up -d

# Production deployment
prod:
	docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d

# Initial setup
setup:
	@echo "Setting up Algeria Eats..."
	@cp -n .env.docker .env || true
	docker-compose build
	docker-compose up -d
	@echo "Waiting for services to start..."
	@sleep 10
	docker-compose exec app php artisan key:generate
	docker-compose exec app php artisan migrate --seed
	docker-compose exec app php artisan storage:link
	@echo ""
	@echo "Setup complete! Access the application at http://localhost"
	@echo "phpMyAdmin (if enabled): http://localhost:8080"
	@echo "Mailpit (if enabled): http://localhost:8025"

# Clean everything
clean:
	docker-compose down -v --rmi all --remove-orphans
	rm -rf vendor node_modules

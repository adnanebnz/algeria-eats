# Algeria Eats - Docker Deployment Guide

This guide will help you deploy the Algeria Eats application using Docker.

## Prerequisites

- Docker Engine 20.10+
- Docker Compose 2.0+
- Git

## Quick Start

### 1. Clone and Setup

```bash
# Clone the repository (if not already done)
git clone <your-repository-url>
cd algeria-eats

# Copy the Docker environment file
cp .env.docker .env

# Edit .env and set your values (especially APP_KEY)
```

### 2. Build and Start

```bash
# Using Make (recommended)
make setup

# Or manually:
docker-compose build
docker-compose up -d
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --seed
docker-compose exec app php artisan storage:link
```

### 3. Access the Application

- **Application**: http://localhost
- **phpMyAdmin** (optional): http://localhost:8080
- **Mailpit** (optional): http://localhost:8025

## Docker Services

| Service | Description | Port |
|---------|-------------|------|
| app | PHP-FPM Application | 9000 (internal) |
| nginx | Web Server | 80 |
| db | MySQL Database | 3306 |
| redis | Cache & Queue | 6379 |
| queue | Queue Worker | - |
| scheduler | Task Scheduler | - |
| phpmyadmin | Database Admin | 8080 |
| mailpit | Email Testing | 8025/1025 |

## Common Commands

### Using Make

```bash
make build        # Build images
make up           # Start containers (foreground)
make up-d         # Start containers (background)
make down         # Stop containers
make restart      # Restart containers
make logs         # View all logs
make logs-app     # View app logs
make shell        # Open shell in app container
make migrate      # Run migrations
make fresh        # Fresh migrate with seed
make seed         # Run seeders
make cache        # Cache config/routes/views
make clear        # Clear all caches
make test         # Run tests
make tools        # Start with phpMyAdmin & Mailpit
make prod         # Start in production mode
```

### Using Docker Compose

```bash
# Start all services
docker-compose up -d

# Stop all services
docker-compose down

# View logs
docker-compose logs -f

# Execute commands in app container
docker-compose exec app php artisan migrate
docker-compose exec app composer install

# Start with optional tools (phpMyAdmin, Mailpit)
docker-compose --profile tools up -d
```

## Production Deployment

### 1. Prepare Environment

```bash
# Copy and configure production environment
cp .env.docker .env

# Edit .env with production values:
# - APP_ENV=production
# - APP_DEBUG=false
# - Set secure passwords
# - Configure mail settings
# - Set proper APP_URL
```

### 2. Deploy

```bash
# Build and start in production mode
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d

# Or using make
make prod
```

### 3. SSL/HTTPS (Recommended)

For production, use a reverse proxy like Traefik or configure SSL in Nginx:

```bash
# Example with Traefik (add to docker-compose.prod.yml)
# See: https://doc.traefik.io/traefik/

# Or use Certbot with Nginx
docker-compose exec nginx certbot --nginx -d yourdomain.com
```

## VPS Deployment Steps

### 1. On Your VPS

```bash
# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

# Install Docker Compose
sudo apt install docker-compose-plugin

# Add your user to docker group
sudo usermod -aG docker $USER

# Logout and login again
```

### 2. Transfer Files

```bash
# From your local machine
scp -r ./algeria-eats user@your-vps-ip:/home/user/

# Or use Git
ssh user@your-vps-ip
git clone <your-repo> algeria-eats
cd algeria-eats
```

### 3. Configure and Start

```bash
# On VPS
cd algeria-eats
cp .env.docker .env
nano .env  # Configure your settings

# Build and start
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d

# Run migrations
docker-compose exec app php artisan migrate --seed
```

## Troubleshooting

### Database Connection Issues

```bash
# Check if database is running
docker-compose ps db

# View database logs
docker-compose logs db

# Connect to database
docker-compose exec db mysql -uroot -p
```

### Permission Issues

```bash
# Fix storage permissions
docker-compose exec app chmod -R 775 storage bootstrap/cache
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
```

### Clear All Caches

```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
docker-compose exec app composer dump-autoload
```

### Rebuild Everything

```bash
# Stop and remove everything
docker-compose down -v

# Rebuild
docker-compose build --no-cache
docker-compose up -d
```

## Backup & Restore

### Database Backup

```bash
# Backup
docker-compose exec db mysqldump -u root -p algeria_eats > backup.sql

# Restore
docker-compose exec -T db mysql -u root -p algeria_eats < backup.sql
```

### Full Backup

```bash
# Backup volumes
docker run --rm -v algeria-eats_db-data:/data -v $(pwd):/backup alpine tar cvf /backup/db-backup.tar /data
```

## Environment Variables

| Variable | Description | Default |
|----------|-------------|---------|
| APP_PORT | Application port | 80 |
| DB_DATABASE | Database name | algeria_eats |
| DB_USERNAME | Database user | algeria_eats |
| DB_PASSWORD | Database password | secret |
| DB_ROOT_PASSWORD | MySQL root password | rootsecret |
| REDIS_PORT | Redis port | 6379 |
| PHPMYADMIN_PORT | phpMyAdmin port | 8080 |

## Security Recommendations

1. **Change default passwords** in production
2. **Use HTTPS** with SSL certificates
3. **Limit exposed ports** in production
4. **Regular updates** of Docker images
5. **Enable firewall** and restrict access
6. **Use secrets** for sensitive data

## Support

If you encounter issues, check:
1. Container logs: `docker-compose logs`
2. Laravel logs: `storage/logs/laravel.log`
3. Nginx logs: `docker-compose logs nginx`

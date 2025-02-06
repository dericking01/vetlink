# Build the Docker images
docker-compose build

# Start the containers
docker-compose up -d

# Run migrations (if needed)
docker-compose exec app php artisan migrate
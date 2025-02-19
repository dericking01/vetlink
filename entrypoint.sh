#!/bin/sh
# Start PHP-FPM in the background
php-fpm &

# Run the main process (e.g., supervisord or a shell)
exec "$@"
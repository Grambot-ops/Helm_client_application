#!/bin/sh

echo "Starting PHP-Nginx application host entrypoint script... V2.0.12"

# Set up the application directory
APP_DIR="/var/www/html"

# Validate critical environment variables
echo "Validating environment configuration..."
if [ -z "$DB_HOST" ] || [ -z "$DB_DATABASE" ] || [ -z "$DB_USERNAME" ]; then
    echo "WARNING: Critical database environment variables are missing!"
    echo "DB_HOST: $DB_HOST"
    echo "DB_DATABASE: $DB_DATABASE" 
    echo "DB_USERNAME: $DB_USERNAME"
fi

# Check if .env file exists, if not create from .env.example
if [ ! -f "${APP_DIR}/.env" ] && [ -f "${APP_DIR}/.env.example" ]; then
    echo "Creating .env file from .env.example..."
    cp "${APP_DIR}/.env.example" "${APP_DIR}/.env"
fi

# Ensure correct permissions
chown -R www-data:www-data "$APP_DIR"
chmod -R 755 "$APP_DIR"

# Wait for database to be ready
echo "Waiting for database connection..."
while ! nc -z db 3306; do
    echo "Waiting for database..."
    sleep 1
done
echo "Database is ready!"

# Check if composer.json exists and run composer install
if [ -f "${APP_DIR}/composer.json" ]; then
    echo "Found composer.json, installing dependencies..."
    cd "${APP_DIR}"
    composer update --no-interaction
    composer install --no-interaction --no-dev --optimize-autoloader
    echo "Composer dependencies installed successfully"
    
    # Check if it's a Laravel project and run appropriate commands
    if [ -f "${APP_DIR}/artisan" ]; then
        echo "Laravel project detected, running additional setup..."
        
        # Set up storage directory permissions
        mkdir -p "${APP_DIR}/storage/framework/cache"
        mkdir -p "${APP_DIR}/storage/framework/sessions"
        mkdir -p "${APP_DIR}/storage/framework/views"
        mkdir -p "${APP_DIR}/storage/logs"
        
        # Generate app key if needed (only if not set or is placeholder)
        echo "Checking APP_KEY configuration..."
        
        # First check if APP_KEY is set in environment or .env file
        if [ -z "$APP_KEY" ]; then
            APP_KEY=$(grep "^APP_KEY=" "${APP_DIR}/.env" 2>/dev/null | cut -d'=' -f2- | tr -d '"')
        fi
        
        # Check if key is missing, empty, or is a placeholder
        if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:YourGeneratedKeyWillBeHere" ] || [ "$APP_KEY" = "YourGeneratedKeyWillBeHere" ] || [ ${#APP_KEY} -lt 20 ]; then
            echo "APP_KEY is missing, invalid, or too short. Generating new key..."
            
            # Backup .env file before key generation
            if [ -f "${APP_DIR}/.env" ]; then
                cp "${APP_DIR}/.env" "${APP_DIR}/.env.backup.$(date +%s)"
            fi
            
            # Generate new key with error handling
            if php artisan key:generate --force; then
                echo "New APP_KEY generated successfully"
                
                # Verify the key was actually set
                NEW_KEY=$(grep "^APP_KEY=" "${APP_DIR}/.env" 2>/dev/null | cut -d'=' -f2- | tr -d '"')
                if [ -z "$NEW_KEY" ] || [ ${#NEW_KEY} -lt 20 ]; then
                    echo "ERROR: Key generation failed or produced invalid key"
                    exit 1
                fi
            else
                echo "ERROR: Failed to generate APP_KEY"
                exit 1
            fi
        else
            echo "Valid APP_KEY found (length: ${#APP_KEY}), skipping key generation"
        fi
        
        # Add HTTPS enforcement to AppServiceProvider (only for production)
        APP_SERVICE_PROVIDER="${APP_DIR}/app/Providers/AppServiceProvider.php"

        if [ -f "$APP_SERVICE_PROVIDER" ]; then
            echo "Ensuring 'use URL' import exists..."
            if ! grep -q "use Illuminate\\\Support\\\Facades\\\URL;" "$APP_SERVICE_PROVIDER"; then
                sed -i "/use Illuminate\\\Support\\\ServiceProvider;/a use Illuminate\\\Support\\\Facades\\\URL;" "$APP_SERVICE_PROVIDER"
                echo "Added 'use URL' import."
            else
                echo "'use URL' already exists."
            fi

            echo "Injecting HTTPS enforcement in boot()..."
            # Only modify if not already injected
            if ! grep -q "URL::forceScheme('https')" "$APP_SERVICE_PROVIDER"; then
                sed -i "/public function boot()/,/^    }/s|^    }|        if (\$this->app->environment('production')) {\n            URL::forceScheme('https');\n        }\n    }|" "$APP_SERVICE_PROVIDER"
                echo "Injected HTTPS enforcement into boot()."
            else
                echo "HTTPS logic already present."
            fi
        else
            echo "AppServiceProvider.php not found, skipping HTTPS injection."
        fi

        # Run migrations with error handling
        echo "Running database migrations..."
        if php artisan migrate --force; then
            echo "Database migrations completed successfully"
        else
            echo "WARNING: Database migrations failed. This might be expected on first run."
            echo "Application will continue starting..."
        fi
        
        # Install and build frontend assets
        if [ -f "${APP_DIR}/package.json" ]; then
            echo "Installing and building frontend assets..."

            npm install --no-bin-links
            npm audit fix --force || true
            npm run build

            echo "Frontend assets built successfully"
        fi
        
        echo "Laravel setup completed"
    fi
else
    echo "No composer.json found, skipping dependency installation"
fi

# Make storage and bootstrap/cache writable
if [ -d "${APP_DIR}/storage" ]; then
    chmod -R 775 "${APP_DIR}/storage"
    chown -R www-data:www-data "${APP_DIR}/storage"
fi

if [ -d "${APP_DIR}/bootstrap/cache" ]; then
    chmod -R 775 "${APP_DIR}/bootstrap/cache"
    chown -R www-data:www-data "${APP_DIR}/bootstrap/cache"
fi

# Start PHP-FPM and Nginx
echo "Starting PHP-FPM..."
php-fpm &

echo "Starting Nginx..."
nginx -g "daemon off;"
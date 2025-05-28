# Kubernetes Deployment Notes

## Required Environment Variables

### Critical Variables (Must be set):
- `APP_KEY`: Laravel encryption key (will be auto-generated if not provided)
- `DB_HOST`: Database hostname
- `DB_DATABASE`: Database name  
- `DB_USERNAME`: Database username
- `DB_PASSWORD`: Database password

### Recommended Variables:
- `APP_ENV`: Set to "production" for production deployments
- `APP_DEBUG`: Set to "false" for production
- `APP_URL`: Your application URL
- `CACHE_DRIVER`: Consider "redis" for production
- `SESSION_DRIVER`: Consider "redis" for production

## Helm Deployment Considerations

1. **APP_KEY Generation**: The entrypoint script will automatically generate an APP_KEY if one is not provided or is invalid.

2. **Database Connection**: Ensure your database service is available before the application starts.

3. **Persistent Storage**: Map the following directories for persistence:
   - `/var/www/html/storage/logs`
   - `/var/www/html/storage/app`

4. **Health Checks**: The application will be ready when:
   - Database connection is established
   - APP_KEY is valid
   - Laravel migrations complete

## Example Kubernetes Secret for Environment Variables

```yaml
apiVersion: v1
kind: Secret
metadata:
  name: laravel-env
type: Opaque
stringData:
  APP_KEY: ""  # Leave empty - will be auto-generated
  DB_PASSWORD: "your-secure-password"
  DB_HOST: "mysql-service"
  DB_DATABASE: "laravel"
  DB_USERNAME: "laravel_user"
  APP_ENV: "production"
  APP_DEBUG: "false"
```

## Troubleshooting

- If you get encryption errors, delete the APP_KEY from your secret and restart the pod
- Check logs with: `kubectl logs deployment/your-app-name`
- The entrypoint script version is logged at startup for debugging

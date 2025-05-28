# Laravel App Helm Chart

This Helm chart deploys a Laravel application with MySQL database and optional PHPMyAdmin.

## Prerequisites

-   Kubernetes 1.16+
-   Helm 3.0+

## Installation

1. Build and push your Docker image:

```bash
docker build -t your-registry/laravel-app:latest .
docker push your-registry/laravel-app:latest
```

2. Update the `values.yaml` file with your image repository:

```yaml
image:
    repository: your-registry/laravel-app
    tag: latest
```

3. Install the chart:

```bash
helm install my-laravel-app ./helm/laravel-app
```

## Configuration

The following table lists the configurable parameters and their default values:

### Application Configuration

| Parameter          | Description                    | Default        |
| ------------------ | ------------------------------ | -------------- |
| `replicaCount`     | Number of Laravel app replicas | `1`            |
| `image.repository` | Laravel app image repository   | `laravel-app`  |
| `image.tag`        | Laravel app image tag          | `latest`       |
| `image.pullPolicy` | Image pull policy              | `IfNotPresent` |

### Laravel Configuration

| Parameter                     | Description             | Default               |
| ----------------------------- | ----------------------- | --------------------- |
| `laravel.env.APP_NAME`        | Application name        | `Laravel`             |
| `laravel.env.APP_ENV`         | Application environment | `production`          |
| `laravel.env.APP_DEBUG`       | Debug mode              | `false`               |
| `laravel.secrets.APP_KEY`     | Laravel encryption key  | `""` (auto-generated) |
| `laravel.secrets.DB_PASSWORD` | Database password       | `laravel_password`    |

### Database Configuration

| Parameter                           | Description              | Default            |
| ----------------------------------- | ------------------------ | ------------------ |
| `mysql.enabled`                     | Enable MySQL deployment  | `true`             |
| `mysql.auth.database`               | Database name            | `laravel`          |
| `mysql.auth.username`               | Database username        | `laravel_user`     |
| `mysql.auth.password`               | Database password        | `laravel_password` |
| `mysql.primary.persistence.enabled` | Enable MySQL persistence | `true`             |
| `mysql.primary.persistence.size`    | MySQL storage size       | `8Gi`              |

### Ingress Configuration

| Parameter                        | Description    | Default             |
| -------------------------------- | -------------- | ------------------- |
| `ingress.enabled`                | Enable ingress | `false`             |
| `ingress.hosts[0].host`          | Hostname       | `laravel-app.local` |
| `ingress.hosts[0].paths[0].path` | Path           | `/`                 |

## Accessing the Application

### Local Development

1. Port forward to access the application:

```bash
kubectl port-forward service/my-laravel-app 8080:80
```

2. Access the application at `http://localhost:8080`

### PHPMyAdmin

If enabled, access PHPMyAdmin by port-forwarding:

```bash
kubectl port-forward service/my-laravel-app-phpmyadmin 8081:80
```

Access PHPMyAdmin at `http://localhost:8081`

## Persistence

The chart supports persistent storage for:

-   Laravel storage directory (`/var/www/html/storage/app`)
-   Laravel logs (`/var/www/html/storage/logs`)
-   MySQL data

## Upgrading

To upgrade the release:

```bash
helm upgrade my-laravel-app ./helm/laravel-app
```

## Uninstalling

To uninstall the release:

```bash
helm uninstall my-laravel-app
```

## Troubleshooting

1. Check pod status:

```bash
kubectl get pods
```

2. Check logs:

```bash
kubectl logs deployment/my-laravel-app
```

3. Check Laravel setup:

```bash
kubectl exec -it deployment/my-laravel-app -- php artisan --version
```

## Security Considerations

-   Change default passwords in production
-   Use proper image tags instead of `latest`
-   Configure resource limits
-   Enable HTTPS with proper TLS certificates
-   Use Kubernetes secrets for sensitive data

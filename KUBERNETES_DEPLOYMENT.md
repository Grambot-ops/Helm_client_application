# Laravel Kubernetes Deployment Guide

This guide explains how to deploy your Laravel application to Kubernetes using the provided Helm chart.

## Quick Start

### 1. Prerequisites

-   Docker
-   Kubernetes cluster (minikube, kind, or cloud provider)
-   Helm 3.x installed
-   kubectl configured

### 2. Build and Push Docker Image

```bash
# Build the Docker image
docker build -t your-registry/laravel-app:latest .

# Push to your container registry
docker push your-registry/laravel-app:latest
```

### 3. Update Helm Values

Edit `helm/laravel-app/values.yaml`:

```yaml
image:
    repository: your-registry/laravel-app
    tag: latest
```

### 4. Deploy to Kubernetes

```bash
# Test the chart first
./test-helm-chart.sh

# Install for development
helm install my-laravel-app ./helm/laravel-app -f ./helm/laravel-app/values-development.yaml

# Or install for production
helm install my-laravel-app ./helm/laravel-app -f ./helm/laravel-app/values-production.yaml
```

## Development Setup

For local development with minikube:

```bash
# Start minikube
minikube start

# Build image in minikube's Docker environment
eval $(minikube docker-env)
docker build -t laravel-app:dev .

# Deploy with development values
helm install laravel-dev ./helm/laravel-app -f ./helm/laravel-app/values-development.yaml

# Access the application
minikube service laravel-dev --url
```

## Production Deployment

### 1. Prepare Production Values

Copy and customize `values-production.yaml`:

```yaml
image:
    repository: your-registry/laravel-app
    tag: "v1.0.0" # Use specific version tags

laravel:
    env:
        APP_URL: "https://your-domain.com"
    secrets:
        APP_KEY: "your-generated-key"
        DB_PASSWORD: "secure-password"

ingress:
    enabled: true
    hosts:
        - host: your-domain.com
          paths:
              - path: /
                pathType: Prefix
```

### 2. Deploy to Production

```bash
# Install with production configuration
helm install laravel-prod ./helm/laravel-app -f ./helm/laravel-app/values-production.yaml

# Or upgrade existing deployment
helm upgrade laravel-prod ./helm/laravel-app -f ./helm/laravel-app/values-production.yaml
```

## Monitoring and Maintenance

### Check Application Status

```bash
# Check pods
kubectl get pods -l app.kubernetes.io/name=laravel-app

# Check services
kubectl get services

# Check logs
kubectl logs deployment/laravel-prod
```

### Database Operations

```bash
# Connect to MySQL
kubectl exec -it deployment/laravel-prod-mysql -- mysql -u laravel_user -p laravel

# Run Laravel migrations
kubectl exec -it deployment/laravel-prod -- php artisan migrate

# Clear cache
kubectl exec -it deployment/laravel-prod -- php artisan cache:clear
```

### Scaling

```bash
# Manual scaling
kubectl scale deployment laravel-prod --replicas=5

# Enable auto-scaling (edit values.yaml)
autoscaling:
  enabled: true
  minReplicas: 2
  maxReplicas: 10
```

## Troubleshooting

### Common Issues

1. **Image Pull Errors**

    - Ensure image exists in registry
    - Check imagePullSecrets if using private registry

2. **Database Connection Issues**

    - Verify MySQL is running: `kubectl get pods`
    - Check database credentials in ConfigMap/Secret

3. **Application Errors**
    - Check logs: `kubectl logs deployment/laravel-prod`
    - Verify environment variables: `kubectl describe configmap laravel-prod-env`

### Useful Commands

```bash
# Port forward for local access
kubectl port-forward service/laravel-prod 8080:80

# Execute commands in pod
kubectl exec -it deployment/laravel-prod -- bash

# View all resources
kubectl get all -l app.kubernetes.io/instance=laravel-prod
```

## Security Best Practices

1. **Use specific image tags** instead of `latest`
2. **Set resource limits** to prevent resource exhaustion
3. **Use Kubernetes secrets** for sensitive data
4. **Enable network policies** for pod-to-pod communication
5. **Regularly update** base images and dependencies
6. **Use HTTPS** with proper TLS certificates
7. **Disable debug mode** in production
8. **Remove PHPMyAdmin** from production deployments

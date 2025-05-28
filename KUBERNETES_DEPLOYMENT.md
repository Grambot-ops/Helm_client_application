# Laravel Kubernetes Deployment Guide - Local Deployment Focus

This guide explains how to deploy your Laravel application to a **local Kubernetes cluster** using the provided Helm chart.

## Quick Start for Local Development

### 1. Prerequisites

-   **Local Kubernetes cluster**: minikube, kind, k3s, or Docker Desktop
-   **Docker** for building images
-   **Helm 3.x** installed
-   **kubectl** configured for your local cluster

### 2. Build and Load Docker Image Locally

```bash
# Build the Docker image locally
docker build -t laravel-app:latest .

# For minikube - load image into minikube
minikube image load laravel-app:latest

# For kind - load image into kind cluster
kind load docker-image laravel-app:latest

# For k3s/k3d - import image
k3d image import laravel-app:latest
```

### 3. Validate Helm Chart

```bash
# Test the chart
./test-helm-chart.sh

# Lint the chart
helm lint ./helm/laravel-app
```

### 4. Deploy to Local Kubernetes

```bash
# Create namespace and deploy
helm install laravel-local ./helm/laravel-app \
  -f ./helm/laravel-app/values-development.yaml \
  --set image.repository=laravel-app \
  --set image.tag=latest \
  --set image.pullPolicy=Never \
  --namespace laravel-local \
  --create-namespace \
  --wait --timeout=300s
```

### 5. Access Your Application

```bash
# Get service information
kubectl get services -n laravel-local

# For minikube - get URL directly
minikube service laravel-local --url -n laravel-local

# For other local clusters - use port forwarding
kubectl port-forward service/laravel-local 8080:80 -n laravel-local

# Access PHPMyAdmin (if enabled)
kubectl port-forward service/laravel-local-phpmyadmin 8081:80 -n laravel-local
```

### 6. Verify Deployment

```bash
# Check pod status
kubectl get pods -n laravel-local

# Check logs
kubectl logs -f deployment/laravel-local -n laravel-local

# Execute commands in the container
kubectl exec -it deployment/laravel-local -n laravel-local -- php artisan --version
```

## Local Development Setup

For active development with live reloading:

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

## Troubleshooting Local Deployments

### Common Issues

1. **Image Pull Errors**

    ```bash
    # Check if image exists locally
    docker images | grep laravel-app

    # For minikube - ensure image is loaded
    minikube image ls | grep laravel-app

    # For kind - ensure image is loaded
    docker exec -it kind-control-plane crictl images | grep laravel-app
    ```

2. **Database Connection Issues**

    ```bash
    # Check MySQL pod status
    kubectl get pods -n laravel-local | grep mysql

    # Check MySQL logs
    kubectl logs deployment/laravel-local-mysql -n laravel-local

    # Test database connection from Laravel pod
    kubectl exec -it deployment/laravel-local -n laravel-local -- php artisan migrate:status
    ```

3. **Service Not Accessible**

    ```bash
    # Check service endpoints
    kubectl get endpoints -n laravel-local

    # For minikube - ensure tunnel is running
    minikube tunnel

    # Check NodePort assignments
    kubectl get services -n laravel-local -o wide
    ```

### Useful Commands for Local Development

```bash
# Rebuild and redeploy quickly
docker build -t laravel-app:latest . && \
minikube image load laravel-app:latest && \
helm upgrade laravel-local ./helm/laravel-app \
  -f ./helm/laravel-app/values-development.yaml \
  --set image.repository=laravel-app \
  --set image.tag=latest \
  --set image.pullPolicy=Never \
  -n laravel-local

# View all resources
kubectl get all -n laravel-local

# Port forward for development
kubectl port-forward service/laravel-local 8080:80 -n laravel-local

# Clean up completely
helm uninstall laravel-local -n laravel-local
kubectl delete namespace laravel-local
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

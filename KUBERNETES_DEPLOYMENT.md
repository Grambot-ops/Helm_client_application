# Laravel Kubernetes Deployment Guide - Kubeadm Cluster

This guide explains how to deploy your Laravel application to a **kubeadm Kubernetes cluster** using the provided Helm chart.

## Quick Start for Kubeadm Clusters

### 1. Prerequisites

-   **Kubeadm Kubernetes cluster** (control plane + worker nodes)
-   **Docker** installed on all nodes
-   **Container registry** access (Docker Hub, private registry, or local registry)
-   **Helm 3.x** installed on your kubectl client machine
-   **kubectl** configured with kubeconfig for your cluster

### 2. Build and Push Docker Image

For kubeadm clusters, you need to make the image available to all nodes:

#### Option A: Push to Registry (Recommended)

```bash
# Build and tag the image
docker build -t your-registry/laravel-app:latest .

# Push to your registry (Docker Hub, private registry, etc.)
docker push your-registry/laravel-app:latest

# Update values.yaml with your registry
# image:
#   repository: your-registry/laravel-app
#   pullPolicy: Always
#   tag: "latest"
```

#### Option B: Load on All Nodes (Development)

```bash
# Build the image
docker build -t laravel-app:latest .

# Save image to tar file
docker save laravel-app:latest > laravel-app.tar

# Copy and load on each node
for node in worker1 worker2 worker3; do
  scp laravel-app.tar $node:/tmp/
  ssh $node "docker load < /tmp/laravel-app.tar"
done

# Also load on control plane if it's schedulable
ssh control-plane "docker load < /tmp/laravel-app.tar"
```

#### Option C: Local Container Registry

```bash
# Set up a local registry (run on one of the nodes)
docker run -d -p 5000:5000 --restart=always --name registry registry:2

# Build and push to local registry
docker build -t localhost:5000/laravel-app:latest .
docker push localhost:5000/laravel-app:latest

# Update values to use local registry
# image:
#   repository: <node-ip>:5000/laravel-app
#   pullPolicy: Always
#   tag: "latest"
```

### 3. Validate Helm Chart

```bash
# Test the chart
./test-helm-chart.sh

# Lint the chart
helm lint ./helm/laravel-app
```

### 4. Deploy to Kubeadm Cluster

#### Using Registry Image (Recommended)

```bash
# Create namespace and deploy
helm install laravel-app ./helm/laravel-app \
  -f ./helm/laravel-app/values-development.yaml \
  --set image.repository=your-registry/laravel-app \
  --set image.tag=latest \
  --set image.pullPolicy=Always \
  --namespace laravel-dev \
  --create-namespace \
  --wait --timeout=300s
```

#### Using Local Images (Development)

```bash
# Deploy with local images (must be loaded on all nodes)
helm install laravel-app ./helm/laravel-app \
  -f ./helm/laravel-app/values-development.yaml \
  --set image.repository=laravel-app \
  --set image.tag=latest \
  --set image.pullPolicy=Never \
  --namespace laravel-dev \
  --create-namespace \
  --wait --timeout=300s
```

### 5. Access Your Application

For kubeadm clusters, you have several options to access your application:

#### Option A: NodePort Service (Default)

```bash
# Get the NodePort
kubectl get services -n laravel-dev
NODE_PORT=$(kubectl get service laravel-app -n laravel-dev -o jsonpath='{.spec.ports[0].nodePort}')

# Access via any node IP
curl http://<any-node-ip>:$NODE_PORT

# Or get all node IPs
kubectl get nodes -o wide
```

#### Option B: Port Forward (Development)

```bash
# Port forward from your kubectl client
kubectl port-forward service/laravel-app 8080:80 -n laravel-dev

# Access at http://localhost:8080
```

#### Option C: Ingress (Production)

```bash
# Install ingress controller (nginx example)
kubectl apply -f https://raw.githubusercontent.com/kubernetes/ingress-nginx/controller-v1.8.2/deploy/static/provider/baremetal/deploy.yaml

# Enable ingress in values and set hostname
helm upgrade laravel-app ./helm/laravel-app \
  --set ingress.enabled=true \
  --set ingress.hosts[0].host=laravel.your-domain.com \
  -n laravel-dev
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

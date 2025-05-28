# ArgoCD Deployment Configuration - Updated for Local Kubernetes

This directory contains ArgoCD Application configurations for deploying the Laravel application using the Helm chart from the GitHub repository. **Updated for local Kubernetes deployment**.

## Files

-   `laravel-app.yaml` - Production environment ArgoCD Application
-   `laravel-app-development.yaml` - Development environment ArgoCD Application
-   `laravel-app-applicationset.yaml` - ApplicationSet for managing multiple environments

## Prerequisites for Local Deployment

1. **Local Kubernetes cluster** (minikube, kind, k3s, or Docker Desktop)
2. **ArgoCD installed** in your Kubernetes cluster
3. **Docker** for building local images
4. **Helm 3.x** installed
5. **kubectl** configured for your local cluster

## Local Setup Instructions

### Step 1: Build Local Docker Image

```bash
# Build the Laravel application image locally
docker build -t laravel-app:latest .

# If using minikube, load the image into minikube
minikube image load laravel-app:latest

# If using kind, load the image into kind
kind load docker-image laravel-app:latest
```

### Step 2: Install ArgoCD (if not already installed)

```bash
# Create ArgoCD namespace
kubectl create namespace argocd

# Install ArgoCD
kubectl apply -n argocd -f https://raw.githubusercontent.com/argoproj/argo-cd/stable/manifests/install.yaml

# Wait for ArgoCD to be ready
kubectl wait --for=condition=available --timeout=300s deployment/argocd-server -n argocd

# Get initial admin password
kubectl -n argocd get secret argocd-initial-admin-secret -o jsonpath="{.data.password}" | base64 -d
```

### Step 3: Deploy to Local Environment

#### Deploy to Development Environment

```bash
kubectl apply -f argocd/laravel-app-development.yaml
```

#### Deploy to Production Environment

```bash
kubectl apply -f argocd/laravel-app.yaml
```

### Option 2: ApplicationSet (Recommended)

Deploy both environments using ApplicationSet:

```bash
kubectl apply -f argocd/laravel-app-applicationset.yaml
```

## Configuration

### Before Deploying

1. **Update Image Repository**: Edit the Helm chart values files to point to your actual Docker registry:

    ```yaml
    image:
        repository: your-registry.com/laravel-app
        tag: "latest"
    ```

2. **Update Domain Names**: Modify the ArgoCD applications to use your actual domain names:

    ```yaml
    - name: ingress.hosts[0].host
      value: "your-domain.com"
    ```

3. **Configure Environment Variables**: Update the Helm chart values files with your specific environment configurations.

### Environment-Specific Configurations

#### Development Environment

-   **Namespace**: `laravel-app-dev`
-   **Domain**: `laravel-app-dev.example.com`
-   **Replicas**: 1
-   **Resources**: Lower resource limits for cost efficiency
-   **Debug Mode**: Enabled
-   **PHPMyAdmin**: Enabled

#### Production Environment

-   **Namespace**: `laravel-app`
-   **Domain**: `laravel-app.example.com`
-   **Replicas**: 3 (with auto-scaling)
-   **Resources**: Higher resource limits for performance
-   **Debug Mode**: Disabled
-   **PHPMyAdmin**: Disabled
-   **SSL/TLS**: Enabled

## Monitoring Deployment

### Check Application Status

```bash
# List ArgoCD applications
kubectl get applications -n argocd

# Get detailed status
kubectl describe application laravel-app -n argocd
kubectl describe application laravel-app-dev -n argocd
```

### Check Application Pods

```bash
# Production environment
kubectl get pods -n laravel-app

# Development environment
kubectl get pods -n laravel-app-dev
```

### Access Applications

```bash
# Port forward to access locally (for testing)
kubectl port-forward -n laravel-app svc/laravel-app 8080:80

# Or access via ingress (configure DNS/hosts file)
# Production: https://laravel-app.example.com
# Development: https://laravel-app-dev.example.com
```

## Troubleshooting

### Common Issues

1. **Image Pull Errors**

    - Ensure the Docker image exists and is accessible
    - Check image registry credentials if using private registry

2. **Database Connection Issues**

    - Verify MySQL service is running: `kubectl get pods -n <namespace> | grep mysql`
    - Check database credentials in secrets
    - Verify network policies allow communication

3. **Ingress Issues**
    - Ensure ingress controller is installed
    - Check DNS configuration
    - Verify SSL certificates (if using HTTPS)

### Debugging Commands

```bash
# Check application logs
kubectl logs -n laravel-app deployment/laravel-app -f

# Check ArgoCD application sync status
kubectl get application laravel-app -n argocd -o yaml

# Check Helm release status
helm list -n laravel-app
helm status laravel-app -n laravel-app

# Check all resources in namespace
kubectl get all -n laravel-app
```

## Sync Policies

The applications are configured with automatic sync policies:

-   **Automated pruning**: Removes resources not in Git
-   **Self-healing**: Automatically fixes drift
-   **Retry logic**: Retries failed sync operations

## Security Considerations

1. **Secrets Management**: All sensitive data is stored in Kubernetes secrets
2. **RBAC**: Configure appropriate role-based access control
3. **Network Policies**: Consider implementing network policies for isolation
4. **Image Security**: Use security scanning for container images
5. **SSL/TLS**: Enable HTTPS for production deployments

## Customization

To customize the deployment for your specific needs:

1. **Modify Helm values**: Update `helm/laravel-app/values-*.yaml` files
2. **Update ArgoCD parameters**: Modify the parameter overrides in the ArgoCD application files
3. **Add additional environments**: Extend the ApplicationSet with new environment configurations

## Support

For issues related to:

-   **Helm Chart**: Check the chart documentation in `helm/laravel-app/README.md`
-   **Kubernetes Deployment**: Refer to `KUBERNETES_DEPLOYMENT.md`
-   **ArgoCD**: Check ArgoCD official documentation

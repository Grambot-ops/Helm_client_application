# Complete Deployment Guide - Laravel Application with ArgoCD

This guide provides step-by-step instructions to deploy the Laravel application using the Helm chart and ArgoCD for GitOps-based continuous deployment.

## 🏗️ Architecture Overview

```
GitHub Repository → Docker Registry → Kubernetes Cluster
                                    ↓
ArgoCD → Helm Chart → Laravel App + MySQL + PHPMyAdmin
```

## 📋 Prerequisites

### 1. Infrastructure Requirements

-   **Kubernetes Cluster** (v1.24+)
-   **ArgoCD** installed in the cluster
-   **Ingress Controller** (NGINX, Traefik, or similar)
-   **Container Registry** access (GitHub Container Registry or Docker Hub)

### 2. Tools Required

-   `kubectl` configured for your cluster
-   `helm` (v3.8+)
-   `docker` for local testing
-   `argocd` CLI (optional)

### 3. Repository Setup

-   GitHub repository: `https://github.com/Grambot-ops/Helm_client_application.git`
-   Docker image repository configured

## 🚀 Deployment Steps

### Step 1: Prepare the Environment

#### 1.1 Configure Container Registry

Update the image repository in Helm values:

```bash
# Edit values.yaml
vim helm/laravel-app/values.yaml
```

Update the image section:

```yaml
image:
    repository: ghcr.io/grambot-ops/helm_client_application/laravel-app
    pullPolicy: IfNotPresent
    tag: "latest"
```

#### 1.2 Configure Domains

Update ingress hosts for your environments:

**Production** (`helm/laravel-app/values-production.yaml`):

```yaml
ingress:
    hosts:
        - host: laravel-app.yourdomain.com
          paths:
              - path: /
                pathType: Prefix
```

**Development** (`helm/laravel-app/values-development.yaml`):

```yaml
ingress:
    hosts:
        - host: laravel-app-dev.yourdomain.com
          paths:
              - path: /
                pathType: Prefix
```

### Step 2: Set Up GitHub Actions (Optional)

If using GitHub Actions for CI/CD:

#### 2.1 Configure Repository Secrets

In your GitHub repository settings, add these secrets:

-   `KUBE_CONFIG`: Base64-encoded kubeconfig file
-   `GITHUB_TOKEN`: Automatically provided

#### 2.2 Trigger Initial Build

```bash
# Push to trigger the pipeline
git add .
git commit -m "Configure deployment pipeline"
git push origin main
```

### Step 3: Deploy with ArgoCD

#### 3.1 Option A: Individual Applications

Deploy development environment:

```bash
kubectl apply -f argocd/laravel-app-development.yaml
```

Deploy production environment:

```bash
kubectl apply -f argocd/laravel-app.yaml
```

#### 3.2 Option B: ApplicationSet (Recommended)

Deploy both environments:

```bash
kubectl apply -f argocd/laravel-app-applicationset.yaml
```

### Step 4: Monitor Deployment

#### 4.1 Check ArgoCD Applications

```bash
# List applications
kubectl get applications -n argocd

# Check sync status
kubectl describe application laravel-app -n argocd
kubectl describe application laravel-app-dev -n argocd
```

#### 4.2 Monitor Application Pods

```bash
# Production
kubectl get pods -n laravel-app -w

# Development
kubectl get pods -n laravel-app-dev -w
```

#### 4.3 Check Services and Ingress

```bash
# Check services
kubectl get svc -n laravel-app
kubectl get svc -n laravel-app-dev

# Check ingress
kubectl get ingress -n laravel-app
kubectl get ingress -n laravel-app-dev
```

### Step 5: Verify Deployment

#### 5.1 Health Checks

```bash
# Port forward to test locally
kubectl port-forward -n laravel-app svc/laravel-app 8080:80

# Test health endpoints
curl http://localhost:8080/health
curl http://localhost:8080/health/detailed
```

#### 5.2 Database Connectivity

```bash
# Check MySQL pod
kubectl get pods -n laravel-app | grep mysql

# Test database connection from app pod
kubectl exec -it -n laravel-app deployment/laravel-app -- php artisan migrate:status
```

#### 5.3 Access Applications

**Production**: `https://laravel-app.yourdomain.com`
**Development**: `https://laravel-app-dev.yourdomain.com`

## 🔧 Configuration Management

### Environment Variables

Key environment variables are managed through Kubernetes ConfigMaps and Secrets:

#### ConfigMap (Non-sensitive)

```yaml
APP_NAME: "Laravel App"
APP_ENV: "production"
APP_DEBUG: "false"
LOG_CHANNEL: "stderr"
DB_CONNECTION: "mysql"
DB_HOST: "laravel-app-mysql"
DB_PORT: "3306"
DB_DATABASE: "laravel"
```

#### Secrets (Sensitive)

```yaml
APP_KEY: "base64:generated-key"
DB_USERNAME: "laravel"
DB_PASSWORD: "secure-password"
MYSQL_ROOT_PASSWORD: "root-password"
```

### Updating Configuration

1. **Modify Helm values** in Git repository
2. **Commit changes** to trigger sync
3. **ArgoCD automatically applies** changes

```bash
# Example: Update replica count
vim helm/laravel-app/values-production.yaml
git add .
git commit -m "Scale production to 5 replicas"
git push origin main
```

## 📊 Monitoring and Logging

### Application Logs

```bash
# View application logs
kubectl logs -n laravel-app deployment/laravel-app -f

# View MySQL logs
kubectl logs -n laravel-app deployment/laravel-app-mysql -f
```

### Resource Monitoring

```bash
# Check resource usage
kubectl top pods -n laravel-app
kubectl top nodes
```

### Horizontal Pod Autoscaler

```bash
# Check HPA status
kubectl get hpa -n laravel-app
kubectl describe hpa laravel-app -n laravel-app
```

## 🛠️ Troubleshooting

### Common Issues

#### 1. Image Pull Errors

```bash
# Check image pull secrets
kubectl get secrets -n laravel-app

# Verify image exists
docker pull ghcr.io/grambot-ops/helm_client_application/laravel-app:latest
```

#### 2. Database Connection Issues

```bash
# Check MySQL service
kubectl get svc -n laravel-app | grep mysql

# Test database connectivity
kubectl exec -it -n laravel-app deployment/laravel-app -- nc -zv laravel-app-mysql 3306
```

#### 3. Ingress Issues

```bash
# Check ingress controller
kubectl get pods -n ingress-nginx

# Verify ingress configuration
kubectl describe ingress laravel-app -n laravel-app
```

#### 4. ArgoCD Sync Issues

```bash
# Force sync
kubectl patch application laravel-app -n argocd --type merge -p='{"operation":{"sync":{"force":true}}}'

# Check ArgoCD controller logs
kubectl logs -n argocd -l app.kubernetes.io/name=argocd-application-controller -f
```

### Debug Commands

```bash
# Get all resources in namespace
kubectl get all -n laravel-app

# Describe problematic pod
kubectl describe pod <pod-name> -n laravel-app

# Get events
kubectl get events -n laravel-app --sort-by='.lastTimestamp'

# Check Helm release
helm list -n laravel-app
helm status laravel-app -n laravel-app
```

## 🔄 Updates and Maintenance

### Application Updates

1. **Build new image** with updated code
2. **Update image tag** in Helm values
3. **Commit changes** to Git
4. **ArgoCD syncs** automatically

### Database Migrations

```bash
# Run migrations manually
kubectl exec -it -n laravel-app deployment/laravel-app -- php artisan migrate

# Or add as init container in deployment
```

### Backup Strategy

```bash
# Backup MySQL database
kubectl exec -it -n laravel-app deployment/laravel-app-mysql -- mysqldump -u root -p laravel > backup.sql

# Backup persistent volumes
kubectl get pv
```

## 🔐 Security Considerations

### 1. RBAC Configuration

```yaml
apiVersion: rbac.authorization.k8s.io/v1
kind: Role
metadata:
    namespace: laravel-app
    name: laravel-app-role
rules:
    - apiGroups: [""]
      resources: ["secrets", "configmaps"]
      verbs: ["get", "list"]
```

### 2. Network Policies

```yaml
apiVersion: networking.k8s.io/v1
kind: NetworkPolicy
metadata:
    name: laravel-app-netpol
    namespace: laravel-app
spec:
    podSelector:
        matchLabels:
            app.kubernetes.io/name: laravel-app
    policyTypes:
        - Ingress
        - Egress
```

### 3. Pod Security Standards

```yaml
securityContext:
    runAsNonRoot: true
    runAsUser: 1000
    fsGroup: 2000
    seccompProfile:
        type: RuntimeDefault
```

## 📚 Additional Resources

-   **Helm Chart Documentation**: `helm/laravel-app/README.md`
-   **Kubernetes Deployment Guide**: `KUBERNETES_DEPLOYMENT.md`
-   **ArgoCD Configuration**: `argocd/README.md`
-   **GitHub Actions Workflow**: `.github/workflows/deploy.yml`

## 🎯 Next Steps

1. **Configure monitoring** with Prometheus/Grafana
2. **Set up log aggregation** with ELK stack
3. **Implement backup automation**
4. **Configure alerting** for critical issues
5. **Set up staging environment**
6. **Implement blue-green deployment**

## 📞 Support

For deployment issues:

1. Check the troubleshooting section above
2. Review application and ArgoCD logs
3. Verify Helm chart configuration
4. Check Kubernetes cluster status

Remember to follow GitOps principles: all changes should be made through Git commits to maintain consistency and auditability.

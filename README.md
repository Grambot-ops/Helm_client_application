# Helm_client_application

# Project PHP | 2 ITF APP-A-ACS | 2023-2024

## Team: VCO-A

## Client: Vince Colson

## Subject: Competition platform

## Team members:

| Role          | Name             | Email                          | Github Username |
| :------------ | :--------------- | :----------------------------- | :-------------- |
| Scrum Master  | Niels Van Nerum  | r0894354@student.thomasmore.be | NielsVanNerum   |
| Document lead | Katoo Roofthooft | r0929442@student.thomasmore.be | KatooRoofthooft |
| Member        | Yussef Dalton    | r0930164@student.thomasmore.be | ydalton         |
| Member        | Ian Hoogstrate   | r0915510@student.thomasmore.be | Ian0035         |
| Member        | Stef Pelkmans    | r0739242@student.thomasmore.be | UmbralPrime     |
| Member        | Nathan D'Hoore   | r0916741@student.thomasmore.be | NathanDhoore1   |

## Login credentials

| Role  | Email                     | Password |
| :---- | :------------------------ | :------- |
| Admin | admin@vcoa.tmcplatform.be | admin    |
| User  | user@vcoa.tmcplatform.be  | password |

## URL: [https://vcoa.tmcplatform.be](https://vcoa.tmcplatform.be)

## 🚀 Local Kubernetes Deployment

This project includes complete Helm charts for deploying to a **local Kubernetes cluster**. The configuration has been optimized for local development environments.

### Quick Start

1. **Build local Docker image:**

    ```bash
    docker build -t laravel-app:latest .
    ```

2. **Load image into your local cluster:**

    ```bash
    # For minikube
    minikube image load laravel-app:latest

    # For kind
    kind load docker-image laravel-app:latest
    ```

3. **Deploy with Helm:**

    ```bash
    helm install laravel-local ./helm/laravel-app \
      -f ./helm/laravel-app/values-development.yaml \
      --set image.repository=laravel-app \
      --set image.tag=latest \
      --set image.pullPolicy=Never \
      --namespace laravel-local \
      --create-namespace
    ```

4. **Access the application:**

    ```bash
    # For minikube
    minikube service laravel-local --url -n laravel-local

    # For other clusters
    kubectl port-forward service/laravel-local 8080:80 -n laravel-local
    ```

### Features Included

-   ✅ **Laravel application** with PHP 8.2 and Nginx
-   ✅ **MySQL database** with persistent storage (optional for dev)
-   ✅ **PHPMyAdmin** for database management
-   ✅ **NodePort services** for easy local access
-   ✅ **Development and production** value files
-   ✅ **ArgoCD configurations** for GitOps deployment
-   ✅ **Horizontal Pod Autoscaling** support
-   ✅ **Persistent volume claims** for storage
-   ✅ **ConfigMaps and Secrets** for configuration

### Documentation

-   📖 [**Kubernetes Deployment Guide**](KUBERNETES_DEPLOYMENT.md) - Detailed local deployment instructions
-   📖 [**Complete Deployment Guide**](COMPLETE_DEPLOYMENT_GUIDE.md) - Full GitOps setup with ArgoCD
-   📖 [**ArgoCD Configuration**](argocd/README.md) - ArgoCD setup for local and production
-   📖 [**Helm Chart Documentation**](helm/laravel-app/README.md) - Chart configuration details

### Testing

Run the test script to validate your Helm chart:

```bash
./test-helm-chart.sh
```

This project is ready for local Kubernetes deployment! 🎉

#!/bin/bash

# Helm Chart Test Script for Laravel App

set -e

CHART_DIR="./helm/laravel-app"
RELEASE_NAME="test-laravel-app"
NAMESPACE="default"

echo "🧪 Testing Laravel App Helm Chart"
echo "=================================="

# Check if helm is installed
if ! command -v helm &> /dev/null; then
    echo "❌ Helm is not installed. Please install Helm first."
    exit 1
fi

echo "✅ Helm is installed"

# Validate chart syntax
echo "🔍 Validating chart syntax..."
helm lint "$CHART_DIR"
echo "✅ Chart syntax is valid"

# Test template rendering
echo "🎨 Testing template rendering..."
helm template "$RELEASE_NAME" "$CHART_DIR" > /tmp/laravel-chart-output.yaml
echo "✅ Templates render successfully"

# Test with different values
echo "🔧 Testing with development values..."
helm template "$RELEASE_NAME" "$CHART_DIR" -f "$CHART_DIR/values-development.yaml" > /tmp/laravel-chart-dev.yaml
echo "✅ Development values work"

echo "🏭 Testing with production values..."
helm template "$RELEASE_NAME" "$CHART_DIR" -f "$CHART_DIR/values-production.yaml" > /tmp/laravel-chart-prod.yaml
echo "✅ Production values work"

# Dry run installation (only if cluster is available)
echo "🚀 Testing dry-run installation..."
if kubectl cluster-info &> /dev/null; then
    helm install "$RELEASE_NAME" "$CHART_DIR" --dry-run --debug > /tmp/laravel-chart-dryrun.yaml
    echo "✅ Dry-run installation successful"
else
    echo "⚠️  No Kubernetes cluster available - skipping dry-run test"
    echo "   (This is normal if you haven't set up a cluster yet)"
fi

echo ""
echo "🎉 All tests passed!"
echo ""
echo "Generated files for review:"
echo "  - /tmp/laravel-chart-output.yaml (default values)"
echo "  - /tmp/laravel-chart-dev.yaml (development values)"  
echo "  - /tmp/laravel-chart-prod.yaml (production values)"
echo "  - /tmp/laravel-chart-dryrun.yaml (dry-run output)"
echo ""
echo "To install the chart for real:"
echo "  helm install $RELEASE_NAME $CHART_DIR"
echo ""
echo "To install with custom values:"
echo "  helm install $RELEASE_NAME $CHART_DIR -f $CHART_DIR/values-development.yaml"
echo ""
echo "🚀 For LOCAL KUBERNETES deployment:"
echo "======================================"
echo ""
echo "1. Build local Docker image:"
echo "   docker build -t laravel-app:latest ."
echo ""
echo "2A. For MINIKUBE clusters:"
echo "    minikube image load laravel-app:latest"
echo ""
echo "2B. For KUBEADM clusters (choose one method):"
echo "    # Method 1: Load on all nodes manually"
echo "    docker save laravel-app:latest | ssh node1 'docker load'"
echo "    docker save laravel-app:latest | ssh node2 'docker load'"
echo ""
echo "    # Method 2: Use local registry"
echo "    docker run -d -p 5000:5000 --name registry registry:2"
echo "    docker tag laravel-app:latest localhost:5000/laravel-app:latest"
echo "    docker push localhost:5000/laravel-app:latest"
echo "    # Then update values.yaml: repository: localhost:5000/laravel-app"
echo ""
echo "    # Method 3: Push to external registry"
echo "    docker tag laravel-app:latest your-registry.com/laravel-app:latest"
echo "    docker push your-registry.com/laravel-app:latest"
echo ""
echo "3. Deploy to local cluster:"
echo "   helm install laravel-local $CHART_DIR -f $CHART_DIR/values-development.yaml \\"
echo "     --set image.repository=laravel-app \\"
echo "     --set image.tag=latest \\"
echo "     --set image.pullPolicy=Never \\"
echo "     --namespace laravel-local --create-namespace"
echo ""
echo "4A. Access via NodePort (kubeadm):"
echo "    kubectl get services -n laravel-local"
echo "    # Access via http://NODE_IP:NODE_PORT"
echo ""
echo "4B. Access via minikube:"
echo "    minikube service laravel-local --url -n laravel-local"
echo ""
echo "4C. Access via port-forward (all clusters):"
echo "    kubectl port-forward service/laravel-local 8080:80 -n laravel-local"
echo ""
echo "5. Clean up:"
echo "   helm uninstall laravel-local -n laravel-local"
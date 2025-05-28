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

# Dry run installation
echo "🚀 Testing dry-run installation..."
helm install "$RELEASE_NAME" "$CHART_DIR" --dry-run --debug > /tmp/laravel-chart-dryrun.yaml
echo "✅ Dry-run installation successful"

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
#!/bin/bash
# ==============================================
# Deploy Script untuk Production VPS
# Jalankan di VPS dengan: bash deploy.sh
# ==============================================

set -e  # Exit on error

echo "🚀 Starting deployment to production..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration
PROJECT_DIR="/var/www/html/cuaninstan"
PHP_FPM_SERVICE="php8.3-fpm"  # Adjust to your PHP version
WEB_SERVER="nginx"            # atau "apache2"

# Step 1: Pull latest code
echo -e "${YELLOW}📥 Pulling latest code from git...${NC}"
cd $PROJECT_DIR
git pull origin main

# Step 2: Install dependencies
echo -e "${YELLOW}📦 Installing composer dependencies...${NC}"
composer install --optimize-autoloader --no-dev --no-interaction

# Step 3: Check .env configuration
echo -e "${YELLOW}⚙️  Checking .env configuration...${NC}"

# Function to check .env value
check_env() {
    local key=$1
    local expected=$2
    local actual=$(grep "^${key}=" .env | cut -d '=' -f 2)
    
    if [ "$actual" != "$expected" ]; then
        echo -e "${RED}❌ ${key} is '${actual}', expected '${expected}'${NC}"
        return 1
    else
        echo -e "${GREEN}✅ ${key} = ${actual}${NC}"
        return 0
    fi
}

# Critical checks
check_env "APP_ENV" "production"
check_env "APP_DEBUG" "false"
check_env "SESSION_DRIVER" "database"
check_env "SESSION_SECURE_COOKIE" "true"

# Check SESSION_DOMAIN is not "null"
SESSION_DOMAIN_VALUE=$(grep "^SESSION_DOMAIN=" .env | cut -d '=' -f 2)
if [ "$SESSION_DOMAIN_VALUE" == "null" ]; then
    echo -e "${RED}❌ SESSION_DOMAIN should be empty, not 'null'!${NC}"
    echo -e "${YELLOW}Fix: Edit .env and change SESSION_DOMAIN=null to SESSION_DOMAIN=${NC}"
    exit 1
else
    echo -e "${GREEN}✅ SESSION_DOMAIN is correctly set${NC}"
fi

# Step 4: Run migrations
echo -e "${YELLOW}🗄️  Running database migrations...${NC}"
php artisan migrate --force

# Step 5: Clear and rebuild cache
echo -e "${YELLOW}🧹 Clearing caches...${NC}"
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo -e "${YELLOW}🔨 Building cache for production...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Step 6: Set permissions
echo -e "${YELLOW}🔐 Setting correct permissions...${NC}"
sudo chown -R www-data:www-data $PROJECT_DIR
sudo chmod -R 755 $PROJECT_DIR
sudo chmod -R 775 $PROJECT_DIR/storage
sudo chmod -R 775 $PROJECT_DIR/bootstrap/cache

# Step 7: Restart services
echo -e "${YELLOW}🔄 Restarting services...${NC}"
sudo systemctl restart $PHP_FPM_SERVICE
sudo systemctl restart $WEB_SERVER

# Step 8: Health check
echo -e "${YELLOW}🏥 Running health check...${NC}"
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" https://cuaninstan.my.id/up)
if [ "$HTTP_CODE" == "200" ]; then
    echo -e "${GREEN}✅ Application is healthy (HTTP $HTTP_CODE)${NC}"
else
    echo -e "${RED}❌ Application health check failed (HTTP $HTTP_CODE)${NC}"
fi

# Step 9: Test admin access
echo -e "${YELLOW}🔍 Testing admin endpoint...${NC}"
ADMIN_HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" https://cuaninstan.my.id/admin)
if [ "$ADMIN_HTTP_CODE" == "200" ] || [ "$ADMIN_HTTP_CODE" == "302" ]; then
    echo -e "${GREEN}✅ Admin endpoint is accessible (HTTP $ADMIN_HTTP_CODE)${NC}"
else
    echo -e "${RED}❌ Admin endpoint returned HTTP $ADMIN_HTTP_CODE${NC}"
    echo -e "${YELLOW}Check logs: tail -50 storage/logs/laravel.log${NC}"
fi

# Final summary
echo ""
echo -e "${GREEN}=====================================${NC}"
echo -e "${GREEN}✅ Deployment completed successfully!${NC}"
echo -e "${GREEN}=====================================${NC}"
echo ""
echo "📋 Next steps:"
echo "1. Test login: https://cuaninstan.my.id/login"
echo "2. Test admin access: https://cuaninstan.my.id/admin"
echo "3. Monitor logs: tail -f storage/logs/laravel.log"
echo ""
echo "🔧 If you encounter 403 error:"
echo "1. Upload public/debug-session.php to VPS"
echo "2. Login as admin first"
echo "3. Visit: https://cuaninstan.my.id/debug-session.php"
echo "4. Check for errors and fix accordingly"
echo "5. DELETE debug-session.php after debugging!"
echo ""

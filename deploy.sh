#!/usr/bin/env bash
# ============================================================
# Déploiement Khara Consulting (serveur LWS, après un git pull)
# Usage sur le serveur :   cd ~/khara-consulting && git pull && bash deploy.sh
# ============================================================
set -e

APP="$HOME/khara-consulting"
WEB="$HOME/public_html"
cd "$APP"

echo "==> 1/5 Dépendances PHP (composer, sans dev)"
composer install --no-dev --optimize-autoloader

echo "==> 2/5 Copie des assets (build, brand, images) vers public_html"
rm -rf "$WEB/build"  && cp -R "$APP/public/build"  "$WEB/build"
rm -rf "$WEB/brand"  && cp -R "$APP/public/brand"  "$WEB/brand"
rm -rf "$WEB/images" && cp -R "$APP/public/images" "$WEB/images"
[ -f "$APP/public/robots.txt" ] && cp -f "$APP/public/robots.txt" "$WEB/robots.txt" || true

echo "==> 3/5 Lien de stockage (images uploadées) + permissions de traversée"
php artisan storage:link 2>/dev/null || true
rm -f "$WEB/storage"
ln -s "$APP/storage/app/public" "$WEB/storage"
# Le serveur web (nobody) doit pouvoir traverser le dossier de l'app pour servir /storage
chmod o+x "$APP"

echo "==> 4/5 Base de données (migrations ADDITIVES + réglages manquants)"
php artisan migrate --force
php artisan db:seed --class=Database\\Seeders\\SettingsSeeder --force

echo "==> 5/5 Caches de production"
php artisan config:clear && php artisan route:clear && php artisan view:clear
php artisan config:cache && php artisan route:cache && php artisan view:cache

echo "==> ✅ Déploiement terminé."

# Guide de déploiement - Khara Consulting

Ce document décrit les étapes pour mettre le projet en ligne.

---

## 1. Prérequis serveur

- **PHP** 8.2 ou supérieur (extensions : mbstring, pdo, openssl, tokenizer, xml, ctype, json, fileinfo)
- **Composer** 2.x
- **Node.js** 18+ et **npm**
- **Base de données** : MySQL 8+ ou MariaDB (recommandé en production) ou SQLite
- **Serveur web** : Nginx ou Apache avec mod_rewrite

---

## 2. Configuration de l'environnement (.env)

Sur le serveur, créez un fichier `.env` à partir de `.env.example` :

```bash
cp .env.example .env
```

### Variables à modifier pour la production

| Variable | Valeur production | Description |
|----------|-------------------|-------------|
| `APP_ENV` | `production` | Environnement |
| `APP_DEBUG` | `false` | **Important** : désactiver en prod |
| `APP_URL` | `https://votre-domaine.com` | URL du site |
| `APP_KEY` | (générer) | Clé d'encryption Laravel |

### Base de données (MySQL recommandé)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=khara_db
DB_USERNAME=khara_user
DB_PASSWORD=votre_mot_de_passe_securise
```

### Stockage des fichiers (logos, images slides, etc.)

Les uploads sont stockés dans `storage/app/public`. Le lien symbolique doit être créé (voir étape 4).

---

## 3. Commandes de déploiement

Exécutez ces commandes sur le serveur, dans le répertoire du projet :

```bash
# 1. Installer les dépendances PHP (sans dev)
composer install --optimize-autoloader --no-dev

# 2. Générer la clé d'application (si pas encore fait)
php artisan key:generate

# 3. Créer le fichier .env et le configurer avant les étapes suivantes

# 4. Migrations et base de données
php artisan migrate --force

# 5. Contenu de base (services, FAQ, programmes, page À propos, réglages…)
#    Idempotent : peut être relancé sans risque.
php artisan db:seed --force

# 6. Lien symbolique pour le stockage (logos, images)
php artisan storage:link

# 7. Build des assets (CSS, JS)
npm ci
npm run build

# 8. Optimisations Laravel (production)
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 4. Configuration du serveur web

### Nginx (exemple)

```nginx
server {
    listen 80;
    server_name votre-domaine.com;
    root /chemin/vers/khara/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }
}
```

### Apache

Le fichier `public/.htaccess` est déjà configuré. Activez `mod_rewrite`.

---

## 5. Permissions

```bash
# Propriétaire du serveur web (ex: www-data)
chown -R www-data:www-data /chemin/vers/khara
chmod -R 755 /chemin/vers/khara
chmod -R 775 storage bootstrap/cache
```

---

## 6. HTTPS (recommandé)

Utilisez **Let's Encrypt** (Certbot) pour un certificat SSL gratuit :

```bash
sudo certbot --nginx -d votre-domaine.com
```

Puis redirigez HTTP vers HTTPS dans la config Nginx.

---

## 7. Checklist avant mise en ligne

- [ ] `APP_DEBUG=false` et `APP_ENV=production`
- [ ] `APP_URL` correct (domaine HTTPS)
- [ ] `APP_KEY` générée (`php artisan key:generate`)
- [ ] Base de données créée, migrée (`migrate --force`) et contenu installé (`db:seed --force`)
- [ ] `php artisan storage:link` exécuté
- [ ] `npm run build` exécuté
- [ ] Caches de prod : `config:cache`, `route:cache`, `view:cache`
- [ ] Permissions `storage` et `bootstrap/cache` correctes (775)
- [ ] Compte super-admin créé (`khara:create-admin`) + **compte de test supprimé**
- [ ] **SMTP configuré** (`MAIL_MAILER=smtp` + identifiants) — sinon le formulaire de contact n'envoie pas d'email
- [ ] Réglages du site renseignés dans l'admin : logo, favicon, adresse, téléphone, **WhatsApp**, email, réseaux sociaux, meta SEO
- [ ] Contenus renseignés : réalisations, témoignages, équipe, chiffres clés, photo du hero
- [ ] Certificat HTTPS actif (Let's Encrypt)

---

## 8. Créer le premier administrateur

Une commande dédiée crée un **super-administrateur** :

```bash
php artisan khara:create-admin "Admin Khara" admin@kharaconsulting.com "MotDePasseSolide123!"
```

(Sans arguments, la commande les demande de façon interactive ; le mot de passe est masqué.)

**Important** : utilisez un mot de passe fort et changez-le après la première connexion.

### Rôles
- **Super administrateur** : accès total, y compris la gestion des comptes.
- **Éditeur** : gestion du contenu uniquement (pas de gestion des utilisateurs).

⚠️ **Avant la mise en ligne**, supprimez tout compte de test :

```bash
php artisan tinker --execute="\App\Models\User::where('email','test@example.com')->delete();"
```

---

## 9. Mettre à jour un site DÉJÀ EN LIGNE sans perdre les données

> Objectif : déployer la nouvelle version **sans** détruire les contacts reçus, les réglages, le logo et les contenus déjà saisis en production.

### Ce qu'il faut savoir
- Les **migrations sont additives** : `migrate --force` ne joue que les migrations **nouvelles** (ajout de la colonne `role`, des tables `realisations`, `team_members`, `programs`, `stats`, `content_blocks`). Elles ne suppriment **aucune** donnée existante.
- Les **seeders de contenu ne doivent PAS être relancés** sur un site existant (ils rajouteraient des services/FAQ en doublon). `SettingsSeeder` et `PageSeeder` sont en `firstOrCreate` : ils n'ajoutent que ce qui manque, sans écraser l'existant.
- Les **fichiers uploadés** (logo, images) sont dans `storage/app/public` : ils ne doivent jamais être écrasés par le déploiement.
- Le fichier **`.env`** de production ne doit jamais être remplacé.

### ⛔ À NE JAMAIS FAIRE sur la prod
- `php artisan migrate:fresh` ❌ (supprime TOUTES les tables)
- `php artisan migrate:refresh` ❌ (rollback + recrée)
- `php artisan db:wipe` ❌
- `php artisan db:seed` (complet) ❌ sur un site existant — il relancerait **tous** les seeders.
- Écraser/supprimer le dossier `storage/` ou le fichier `.env`.

### Étape 0 — SAUVEGARDE (obligatoire avant tout)
```bash
# Base de données
mysqldump -u UTILISATEUR -p NOM_BASE > backup_$(date +%F_%H%M).sql

# Fichiers uploadés + config
tar -czf storage_backup_$(date +%F_%H%M).tar.gz storage/app/public .env
```

### Étapes de mise à jour
```bash
# 1. Mettre le site en maintenance (optionnel mais conseillé)
php artisan down

# 2. Récupérer le nouveau code (préserve .env et storage/, qui sont git-ignorés)
git pull origin main
composer install --optimize-autoloader --no-dev
npm ci && npm run build

# 3. Migrations (ADDITIVES — aucune donnée supprimée)
php artisan migrate --force

# 4. Ajouter UNIQUEMENT les nouvelles clés de réglages (non destructif)
php artisan db:seed --class=Database\\Seeders\\SettingsSeeder --force

# 5. (Optionnel) pré-remplir les NOUVELLES sections ajoutées par cette version
#    (page Programmes + piliers/méthode de l'accueil). Si vous préférez les
#    saisir à la main dans l'admin, ignorez cette ligne — le site affiche des
#    textes par défaut en attendant.
php artisan db:seed --class=Database\\Seeders\\ProgramSeeder --force
php artisan db:seed --class=Database\\Seeders\\ContentBlockSeeder --force

# 6. Lien de stockage (si absent) + caches de prod
php artisan storage:link
php artisan config:cache && php artisan route:cache && php artisan view:cache

# 7. Remettre le site en ligne
php artisan up
```

> ⚠️ Ne lancez **pas** `ServiceSeeder`, `FaqSeeder` ni `db:seed` complet : vos services et FAQ déjà saisis en prod sont conservés tels quels.

### En cas de problème — rollback
```bash
php artisan down
# restaurer la base
mysql -u UTILISATEUR -p NOM_BASE < backup_XXXX.sql
# restaurer les fichiers si besoin
tar -xzf storage_backup_XXXX.tar.gz
# revenir au code précédent
git checkout <commit_précédent>
composer install --optimize-autoloader --no-dev && npm ci && npm run build
php artisan config:cache && php artisan route:cache && php artisan view:cache
php artisan up
```

### Vérification post-déploiement
- [ ] Les **contacts reçus** sont toujours présents (admin → Contacts)
- [ ] Les **réglages** (logo, téléphone, WhatsApp, réseaux) sont intacts
- [ ] Les **services / FAQ** existants sont là
- [ ] Les nouveaux menus (Réalisations, Programmes, Équipe, Chiffres clés, Contenus) apparaissent
- [ ] Le site public s'affiche correctement sur mobile et desktop

---

## 9 bis. Cas spécifique : hébergement mutualisé (cPanel / FTP), site déjà en ligne

Même logique qu'en 9 (migrations additives, pas de `db:seed` complet, ne pas toucher `.env` ni `storage/`), adaptée au mutualisé.

### A. Préparer en local (car pas de Composer/Node sur le serveur)
```bash
# Dépendances de prod + assets, construits sur votre machine
composer install --no-dev --optimize-autoloader
npm ci && npm run build
```

### B. Sauvegarder la prod AVANT (indispensable)
- Base de données : cPanel → **phpMyAdmin** → base Khara → **Exporter** (SQL).
- Fichiers : cPanel → **Gestionnaire de fichiers** → compresser `storage/app/public` et télécharger. Sauvegarder aussi `.env`.

### C. Envoyer les fichiers par FTP — à UPLOADER
`app/`, `bootstrap/` (sauf `bootstrap/cache/*`), `config/`, `database/`, `lang/`, `public/` (dont `public/build/`), `resources/`, `routes/`, `vendor/`, `artisan`, `composer.json`, `composer.lock`.

### ❌ À NE PAS uploader / écraser
- **`.env`** (garder celui de la prod)
- **`storage/app/public/`** (logo, images déjà en ligne)
- `storage/framework/` (cache/sessions du serveur)
- `node_modules/`

> Astuce : uploadez dans un dossier temporaire puis basculez, ou uploadez `app/`, `resources/`, `routes/`, `public/build/` en priorité (le gros des changements).

### D. Lancer les commandes artisan (sans SSH)
Trois options selon ce que propose votre hébergeur :

**Option 1 — Terminal cPanel** (le plus simple, souvent disponible) :
```bash
cd ~/chemin/vers/khara
php artisan migrate --force
php artisan db:seed --class=Database\\Seeders\\SettingsSeeder --force
php artisan storage:link
php artisan config:clear && php artisan route:clear && php artisan view:clear
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

**Option 2 — Tâche Cron (one-shot)** : cPanel → **Cron Jobs**, créer une tâche qui s'exécute une fois :
```
cd ~/chemin/vers/khara && php artisan migrate --force && php artisan db:seed --class=Database\\Seeders\\SettingsSeeder --force && php artisan config:cache && php artisan route:cache && php artisan view:cache
```
Puis **supprimez la tâche** après exécution.

**Option 3 — Aucune CLI** : dites-le-moi, je vous fournis un petit script de déploiement protégé par mot de passe (à placer dans `public/`, lancer une fois dans le navigateur, puis **supprimer immédiatement**).

### E. Après : vérifier (checklist section 9) et remettre `APP_DEBUG=false`.

> ⚠️ Détail cPanel fréquent : la racine web pointe vers `public_html`. Si le projet Laravel est **dans** `public_html`, le contenu du dossier `public/` doit être à la racine de `public_html` et les chemins dans `index.php` ajustés — vérifiez comment la 1re version a été installée et **reproduisez la même structure**.

---

## Hébergeurs compatibles

- **VPS** : DigitalOcean, OVH, Scaleway, etc.
- **Shared hosting** : vérifier PHP 8.2+, Composer, Node.js
- **PaaS** : Laravel Forge, Ploi, Railway, Render

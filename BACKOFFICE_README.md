# Backoffice Khara Consulting

## Accès au backoffice

URL : `/admin/login`

## Création d'un utilisateur administrateur

Un utilisateur administrateur a été créé automatiquement. Si vous devez en créer un autre :

```bash
php artisan admin:create-user --email=votre-email@example.com --password=votre-mot-de-passe --name="Votre Nom"
```

Ou sans options (génère un mot de passe aléatoire) :
```bash
php artisan admin:create-user
```

## Identifiants par défaut

- **Email** : `admin@khara-consulting.com`
- **Mot de passe** : Voir la sortie de la commande `php artisan admin:create-user`

⚠️ **Important** : Changez le mot de passe après la première connexion !

## Fonctionnalités disponibles

### 1. Dashboard (`/admin/dashboard`)
- Statistiques des contacts (total, aujourd'hui, cette semaine, ce mois)
- Liste des 5 contacts les plus récents
- Vue d'ensemble rapide

### 2. Gestion des Contacts (`/admin/contacts`)
- **Liste** : Affichage de tous les contacts avec pagination
- **Filtres** : Recherche, type, date
- **Détails** : Vue complète d'un contact avec toutes les informations
- **Actions** :
  - Répondre par email
  - Appeler directement
  - Contacter via WhatsApp
  - Supprimer un contact

### 3. Authentification
- Connexion sécurisée
- Session avec "Se souvenir de moi"
- Déconnexion
- Protection des routes par middleware `auth`

### 4. Paramètres / Configuration (`/admin/settings`) ✅ NOUVEAU
- Paramètres généraux (nom, logo, adresse, contacts)
- Configuration email
- Paramètres SEO (meta tags, Google Analytics)
- Réseaux sociaux
- Mode maintenance

### 5. Gestion des Utilisateurs Admin (`/admin/users`) ✅ NOUVEAU
- Liste des administrateurs
- Créer un nouvel utilisateur
- Modifier un utilisateur (nom, email, mot de passe)
- Supprimer un utilisateur
- Vue détaillée d'un utilisateur

## Routes disponibles

- `GET /admin/login` - Page de connexion
- `POST /admin/login` - Traitement de la connexion
- `POST /admin/logout` - Déconnexion
- `GET /admin/dashboard` - Dashboard (protégé)
- `GET /admin/contacts` - Liste des contacts (protégé)
- `GET /admin/contacts/{id}` - Détails d'un contact (protégé)
- `DELETE /admin/contacts/{id}` - Supprimer un contact (protégé)
- `GET /admin/settings` - Paramètres (protégé)
- `PUT /admin/settings` - Mettre à jour les paramètres (protégé)
- `GET /admin/users` - Liste des utilisateurs (protégé)
- `POST /admin/users` - Créer un utilisateur (protégé)
- `GET /admin/users/create` - Formulaire de création (protégé)
- `GET /admin/users/{id}` - Détails d'un utilisateur (protégé)
- `GET /admin/users/{id}/edit` - Formulaire d'édition (protégé)
- `PUT /admin/users/{id}` - Mettre à jour un utilisateur (protégé)
- `DELETE /admin/users/{id}` - Supprimer un utilisateur (protégé)

## Design

Le backoffice utilise le même design system que le site public :
- Palette Rouge (#DC2626), Blanc, Noir Ardoise
- Typographie Playfair Display + Montserrat
- Sidebar avec navigation
- Cartes Bento pour les statistiques
- Design responsive

## Sécurité

- Toutes les routes admin sont protégées par le middleware `auth`
- Les mots de passe sont hashés avec bcrypt
- Protection CSRF sur tous les formulaires
- Validation des données d'entrée

## Prochaines améliorations à prévoir

### Priorité Haute 🔴
- Export des contacts (CSV, Excel)
- Statistiques avancées avec graphiques
- Journal d'activité / Logs

### Priorité Moyenne 🟡
- Marquer les contacts comme lus/non lus
- Ajouter des notes aux contacts
- Gestion du contenu du site (CMS)
- Gestion des médias/images

### Priorité Basse 🟢
- Recherche avancée globale
- Notifications et alertes
- Sauvegarde et restauration
- Sécurité avancée (2FA)

Voir le fichier `CE_QUI_MANQUE_BACKOFFICE.md` pour plus de détails.

